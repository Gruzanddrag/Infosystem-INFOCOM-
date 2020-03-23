<?php

namespace app\modules\umk\controllers;

use yii\web\Response;
use Yii;
use app\models\Umk;
use app\models\StudentRequirement;
use app\models\Section;
use app\models\SectionResource;
use app\models\UmkResource;
use app\models\SectionDiscipline;
use yii\web\ForbiddenHttpException;

class UmkController extends \yii\rest\ActiveController
{

    public function beforeAction($action){ 

        if(parent::beforeAction($action)){
            if(in_array($action->id, ['index', 'view']) && Yii::$app->user->can('seeUMK')){
                return true;
            }
            if(in_array($action->id, ['create', 'update', 'delete']) && Yii::$app->user->can('setUMK')){
                return true;
            }
        }
        throw new ForbiddenHttpException('NO_ACCESS');
        return false;
    }

    public $modelClass='app\models\Umk';
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['update']);
        unset($actions['create']);
        unset($actions['view']);
        return $actions;
    }

    public function actionUpdate($id){
        $umk_info = Yii::$app->request->post();
        $student_requirements = $umk_info['umkStudentRequirements'];
        $sections = $umk_info['sections'];
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $umk = Umk::findOne($id);
            $umk->attributes = $umk_info;
            $umk->umkStatusId = 2;
            $umk->save();
            $this->saveUmkDetails($umk_info, $umk->umkId);
            $transaction->commit();
        } catch (\Exception $e){
            $transaction->rollback();
            Yii::error($e);
            return [
                'msg' => $e
            ];
        }
        return true;
        
    }


    public function actionCreate($id){
        $umk_info = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $umk = new Umk();
            $umk->attributes = $umk_info;
            $umk->umkStatusId = 2;
            $umk->save();
            $this->saveUmkDetails($umk_info, $umk->umkId);
            $transaction->commit();
        } catch (\Exception $e){
            $transaction->rollback();
            Yii::error($e);
            return [
                'msg' => $e
            ];
        }
        return true;
        
    }

    public function actionConfirm($id){
        if(Yii::$app->user->can('confirmUMK')){
            $umk = Umk::findOne($id);
            $umk->umkStatusId = 1;
            $umk->save();
            return true;
        } else {
            throw new ForbiddenHttpException('NO_ACCESS');
        }
    }

    public function actionDeny($id){
        if(Yii::$app->user->can('denyUMK')){
            $umk = Umk::findOne($id);
            $umk->umkStatusId = 3;
            $umk->save();
            return true;
        } else {
            throw new ForbiddenHttpException('NO_ACCESS');
        }
    }


    public function actionView($id){
        $umk = Umk::findOne($id);
        return $umk->toArray([], ['umkStudentRequirements', 'umkSections']);
    }

    private function saveUmkDetails($umk_info, $umkId){
        $student_requirements = $umk_info['umkStudentRequirements'];
        $sections = $umk_info['sections'];
        // attach all requiremets
        foreach($student_requirements as $requirement){
            $req = new StudentRequirement();
            if(isset($requirement['studentRequirementId'])){
                $req = StudentRequirement::findOne($requirement['studentRequirementId']);
            }
            if($requirement['deleted']){
                if($req->studentRequirementId){
                    $req->delete();
                }
                continue;
            }
            $req->attributes = $requirement;
            $req->umkId = $umkId;
            $req->save();
        }
        // attach all sections
        $this->saveSection($sections, $umkId);
        $this->saveUmkResource($umkId, $umk_info['resources']);
        return true;
    }


    
    /**
     * save section for umk
     * @param array $section
     * @param int $umkId
     */
    private function saveSection($sections, $umkId){
        foreach($sections as $section){
            $sec = new Section();
            if(isset($section['sectionId'])){
                $sec = Section::findOne($section['sectionId']);
            }
            if($section['deleted']){
                $sec->delete();
                continue;
            }
            $sec->attributes = $section;
            $sec->umkId = $umkId;
            $sec->save();
            foreach($section['sectionDiscipline'] as $discipline){
                $dis = new SectionDiscipline();
                if(isset($discipline['sectionDisciplineId'])){
                    $dis = SectionDiscipline::findOne($discipline['sectionDisciplineId']);
                }
                if($discipline['deleted']){
                    $dis->delete();
                    continue;
                }
                $dis->attributes = $discipline;
                $dis->sectionId = $sec->sectionId;
                $dis->validate();
                $dis->save();
            }
            // save section resource
            $this->saveSectionResource($sec->sectionId, $section['resources']);
        }
    }

    
    /**
     * save resource for section
     * @param array $section
     * @param int $umkId
     */
    private function saveSectionResource($sectionsId, $resources){
        foreach($resources as $resource){
            $res = new SectionResource();
            if(isset($resource['id'])){
                $res = SectionResource::findOne($resource['id']);
            }
            if($resource['deleted']){
                $res->delete();
                continue;
            }
            $res->attributes = $resource;
            $res->sectionId = $sectionsId;
            $res->save();
        }
    }
    
    /**
     * save resource for umk
     * @param array $section
     * @param int $umkId
     */
    private function saveUmkResource($umkId, $resources){
        foreach($resources as $resource){
            $res = new UmkResource();
            if(isset($resource['umkResourceId'])){
                $res = UmkResource::findOne($resource['umkResourceId']);
            }
            if($resource['deleted']){
                $res->delete();
                continue;
            }
            $res->attributes = $resource;
            $res->umkId = $umkId;
            $res->save();
        }
    }

}

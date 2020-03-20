<?php

namespace app\modules\umk\controllers;

use yii\web\Response;
use Yii;
use app\models\Umk;
use app\models\StudentRequirement;

class UmkController extends \yii\rest\ActiveController
{
    public $modelClass='app\models\Umk';
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['update']);
        unset($actions['view']);
        return $actions;
    }

    public function actionUpdate($id){
        $umk_info = Yii::$app->request->post();
        $student_requirements = $umk_info['umkStudentRequirements'];
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $umk = Umk::findOne($id);
            $umk->attributes = $umk_info;
            $umk->save();
            // attach all requiremets
            foreach($student_requirements as $requirement){
                $req = new StudentRequirement();
                Yii::error($req);
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
                $req->umkId = $umk->umkId;
                $req->save();
            }
            $transaction->commit();
        } catch (\Exception $e){
            $transaction->rollback();
            return [
                'msg' => $e
            ];
        }
        return true;
        
    }
    public function actionView($id){
        $umk = Umk::findOne($id);
        return $umk->toArray([], ['umkStudentRequirements']);
    }

}

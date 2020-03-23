<?php

namespace app\modules\umk\controllers;

use yii\web\Response;
use app\models\Request;
use Yii;
use yii\web\ForbiddenHttpException;
use app\models\Resource;
use app\models\ResourceMovement;

class ResourcesController extends \yii\rest\ActiveController
{
    public $modelClass='app\models\Resource';


    public function beforeAction($action){ 

        Yii::error('awdawdawdaw');

        if(parent::beforeAction($action)){
            if(in_array($action->id, ['index', 'view']) && Yii::$app->user->can('seeResources')){
                return true;
            }
            if(in_array($action->id, ['create', 'update', 'delete','produce', 'reduce']) && Yii::$app->user->can('setResources')){
                return true;
            }
            if($action->id == "add-internet-resource" && Yii::$app->user->can('setInternetResources')){
                return true;
            }
        }
        
        throw new ForbiddenHttpException('NO_ACCESS');
        return false;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $action;
    }

    public function actionIndex(){
        return Resource::find()->where(['isAvalible' => 1])->all();
    }

    public function actionUpdate($id){
        $resource = Resource::findOne($id);
        $resource->attributes = Yii::$app->request->post();
        $resource->save();
        return $resource;
    }

    public function actionCreate(){
        $resource = new Resource();
        $resource->attributes = Yii::$app->request->post();
        Yii::error($resource->resourceTypeId);
        if($resource->resourceTypeId !== 3){
            $resource->resourceCountAvalible = 0;
        }
        $resource->save();
        return $resource;
    }

    public function actionProduce($id){
        $resource = Resource::findOne($id);
        $data = Yii::$app->request->post();
        Yii::error($data);
        if(self::store($resource->resourceId, $data['resourceMovementReason'], $data['count'])){
            return $resource;
        } else {
            return [
                'msg' => 'Cant store'
            ];
        }
    }

    public function actionReduce($id){
        $resource = Resource::findOne($id);
        $data = Yii::$app->request->post();
        Yii::error($data);
        if(self::del($resource->resourceId, $data['resourceMovementReason'], $data['count'])){
            return $resource;
        } else {
            return [
                'msg' => 'Cant store'
            ];
        }
    }

    public function actionAddInternetResource(){
        $resource = new Resource();
        $data = Yii::$app->request->post();
        $resource->attributes = $data;
        $resource->resourceTypeId = 3;
        $resource->save();
        return $resource;
    }

    public function actionAddNewResource(){
        $resource = new Resource();
        $data = Yii::$app->request->post();
        $resource->attributes = $data;
        $resource->isAvalible = false;
        $resource->save();
        return $resource;
    }

    static function store($resourceId, $reason, $count){
        try {
            $res = Resource::findOne($resourceId);
            $res->isAvalible = true;
            if(!$res->resourceCountAvalible){
                $res->resourceCountAvalible = 0;
            }
            $res->resourceCountAvalible += $count;
            $res->save();
            $resorceMovement = new ResourceMovement();
            $resorceMovement->attributes = [
                'resourceMovementDate' => date("Y-m-d H:i:s"),
                'resourceMovementTypeId' => 2,
                'resourceMovementReason' => $reason,
                'resourceMovementCountState' => $res->resourceCountAvalible,
                'resourceId' => $res->resourceId
            ];
            $resorceMovement->save();
            return true;
        } catch (\Exception $e){
            return false;
        }
    }

    static function del($resourceId, $reason, $count){
        try {
            $res = Resource::findOne($resourceId);
            if(!$res['resourceCountAvalible']){
                $res->resourceCountAvalible = 0;
            }
            $res->resourceCountAvalible -= $count;
            $res->isAvalible = true;
            $res->save();
            $resorceMovement = new ResourceMovement();
            $resorceMovement->attributes = [
                'resourceMovementDate' => date("Y-m-d H:i:s"),
                'resourceMovementTypeId' => 1,
                'resourceMovementReason' => $reason,
                'resourceMovementCountState' => $res->resourceCountAvalible,
                'resourceId' => $res->resourceId
            ];
            $resorceMovement->save();
            return true;
        } catch (\Exception $e){
            return false;
        }
    }

}
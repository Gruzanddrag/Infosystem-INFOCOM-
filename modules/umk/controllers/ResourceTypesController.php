<?php

namespace app\modules\umk\controllers;

use yii\web\Response;
use app\filters\seeDictionaries;
use app\filters\setDictionaries;

class ResourceTypesController extends \yii\rest\ActiveController
{
    public $modelClass='app\models\ResourceType';

    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => seeDictionaries::class,
            'only' => ['index', 'view']
        ];
        $behaviors['admin_access'] = [
            'class' => setDictionaries::class,
            'only' => ['update', 'create', 'delete']
        ];
        return $behaviors;
    }
    
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
        ];
    }

    static function store($resourceId, $reason, $count){
        try {
            $res = Resource::findOne($resourceId);
            $res->resourceCountAvalible += $count;
            $res->isAvalible = true;
            $res->save();
            $resorceMovement = new ResourceMovement();
            $resorceMovement->attributes = [
                'resourceMovementDate' => date("Y-m-d H:i:s"),
                'resourceMovementTypeId' => 2,
                'resourceMovementReason' => $reason,
                'resourceMovementCountState' => $res->resourceCountAvalible,
                'resourceId' => $res->resourceId
            ];
            return true;
        } catch (\Exception $e){
            return false;
        }
    }

    static function delete($resourceId, $reason, $count){
        try {
            $res = Resource::findOne($resourceId);
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
            return true;
        } catch (\Exception $e){
            return false;
        }
    }
}

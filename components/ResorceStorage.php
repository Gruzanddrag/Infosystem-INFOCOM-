<?php


namespace app\components;

use app\models\User;
use app\models\Resource;
use app\models\ResourceMovement;

class ResorceStorage
{
    public function __construct(){}

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
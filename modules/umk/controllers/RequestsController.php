<?php

namespace app\modules\umk\controllers;

use yii\web\Response;
use Yii;
use app\models\Request;
use app\models\Resource;

class RequestsController extends \yii\rest\ActiveController
{
    public $modelClass='app\models\Request';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $req = new Request();
        $req->attributes = Yii::$app->request->post();
        $req->userId = Yii::$app->user->id;
        $req->requestStatusId = 1;
        $req->date = date("Y-m-d H:i:s");
        $req->save();
        return $req;
    }


    public function actionCreateNewResource()
    {
        Yii::error(Yii::$app->request->post());
        $transaction = Yii::$app->db->beginTransaction();
        try {
            // add new resource
            $request_data = Yii::$app->request->post();
            $res = new Resource();
            $res->attributes = $request_data;
            $res->isAvalible = false;
            $res->save();
            // add new request
            $req = new Request();
            $req->attributes = Yii::$app->request->post();
            $req->resourceId = $res->resourceId;
            $req->userId = Yii::$app->user->id;
            $req->requestStatusId = 1;
            $req->date = date("Y-m-d H:i:s");
            $req->save();
            $transaction->commit();
            return $req;
        } catch (\Exception $e){
            $transaction->rollback();
            Yii::$app->response->statusCode = 403;
            Yii::error($e);
            return ['msg' => $e];
        }
    }


    public function actionConfirm($id)
    {
        if(Yii::$app->user->can('confirmRequest')){
            $req = Request::findOne($id);
            $req->requestStatusId = 2;
            $req->save();
            return $req;
        } else {
            return [
                'message' => "NO_ACCESS"
            ];
        }
    }


    public function actionDeny($id)
    {
        if(Yii::$app->user->can('denyRequest')){
            $req = Request::findOne($id);
            $req->requestStatusId = 4;
            $req->save();
            return $req;
        } else {
            return [
                'message' => "NO_ACCESS"
            ];
        }
    }


    public function actionComplete($id)
    {
        if(Yii::$app->user->can('completeRequest')){
            $transaction = Yii::$app->db->beginTransaction();
            $req = Request::findOne($id);
            $req->requestStatusId = 3;
            $req->save();
            $reason = "Приход литературы по заявке:" . ($res->requestType === 'procure' ? 'Закупить' : 'Издать') . ' литиратуру ' . ($req->resource->resourceName) . ' в количесвтве ' . $req->count;
            if(ResourcesController::store($req->resourceId, $reason, $req->count)){
                $transaction->commit();
                return $req;
            } else {
                $transaction->rollback();
                return [
                    'msg' => 'Cant save resource info'
                ];
            }
        } else {
            return [
                'message' => "NO_ACCESS"
            ];
        }
    }
    
}

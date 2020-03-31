<?php

namespace app\modules\umk\controllers;

use Yii;
use yii\web\Response;
use app\filters\seeDictionaries;
use app\filters\setDictionaries;
use app\models\ResourceMovement;

class ResourceMovementsController extends \yii\rest\ActiveController
{
    public $modelClass='app\models\ResourceMovement';

    public function beforeAction($action){ 

        if(parent::beforeAction($action)){
            if(Yii::$app->user->can('setResources')){
                return true;
            }
        }
        
        throw new ForbiddenHttpException('NO_ACCESS');
        return false;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex(){
        return ResourceMovement::find()->all();
    }
    
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
        ];
    }

    
}

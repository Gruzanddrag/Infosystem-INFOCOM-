<?php

namespace app\modules\umk\controllers;

use Yii;
use yii\web\Response;
use app\filters\seeDictionaries;
use app\filters\setDictionaries;

class ResourceMovementsController extends \yii\rest\ActiveController
{
    public $modelClass='app\models\ResourceMovement';

    public function beforeAction($action){ 

        if(parent::beforeAction($action)){
            if(Yii::$app->user->can('manageUser')){
                return true;
            }
        }
        
        throw new ForbiddenHttpException('NO_ACCESS');
        return false;
    }

    
}

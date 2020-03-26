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

    
}

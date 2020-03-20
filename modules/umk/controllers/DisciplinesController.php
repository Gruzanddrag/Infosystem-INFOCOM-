<?php

namespace app\modules\umk\controllers;

use yii\web\Response;

class DisciplinesController extends \yii\rest\ActiveController
{
    public $modelClass='app\models\Discipline';
    protected function verbs()
{
    return [
        'index' => ['GET', 'HEAD'],
        'view' => ['GET', 'HEAD'],
        'create' => ['POST'],
        'update' => ['PUT', 'PATCH'],
        'delete' => ['DELETE'],
    ];
}
}

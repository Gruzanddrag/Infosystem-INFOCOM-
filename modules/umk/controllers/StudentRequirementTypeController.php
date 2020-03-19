<?php

namespace app\modules\umk\controllers;

use yii\web\Response;

class StudentRequirementTypeController extends \yii\rest\ActiveController
{
    public $modelClass='app\models\StudentRequirementType';
    
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
        ];
    }
}

<?php

namespace app\umkControl\controllers;

use app\filters\AdminControl;
use app\filters\HeadControl;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\AccessControl;
use yii\base\InlineAction;
use yii\web\Response;

class DataController extends \yii\rest\Controller
{

    public function behaviors()
    {


        $behaviors = parent::behaviors();
        // grant access to whole module to admin and head of department
        $behaviors = array_merge($behaviors, [
            'department_head_access' =>  [
                'class' => HeadControl::class
            ],
        ]);
        return parent::behaviors();
    }


    public function actionIndex()
    {
        return $this->asJson([
            'data' => 'That for admin only',
        ]);
    }

    public function actionStore()
    {
        return $this->render('store');
    }

}

<?php

namespace app\controllers;

use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\AccessControl;

class DataController extends \yii\rest\Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,

        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index'],
                    'roles' => ['@'],
                ],
            ],
        ];

        return $behaviors;
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

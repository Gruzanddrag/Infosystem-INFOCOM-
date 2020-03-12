<?php

namespace app\controllers;

use app\filters\AdminControl;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\AccessControl;
use yii\base\InlineAction;
use yii\web\NotFoundHttpException;

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
            'class' => AdminControl::class
        ];

        return $behaviors;
    }


    public function actionIndex()
    {
        throw new NotFoundHttpException('NONONO');
        return $this->asJson([
            'data' => 'That for admin only',
        ]);
    }

    public function actionStore()
    {
        return $this->render('store');
    }

}
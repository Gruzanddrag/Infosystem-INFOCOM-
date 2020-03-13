<?php

namespace app\modules\umk\controllers;

use app\filters\FullApiAccess;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\filters\AccessControl;
use yii\base\InlineAction;
use yii\web\Response;

class DataController extends \yii\rest\Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => FullApiAccess::class,
        ];
        return $behaviors;
    }


    public function actionIndex()
    {
        return $this->asJson([
            'data' => 'That for admin only',
        ]);
    }
    public function actionTest()
    {
        return $this->asJson([
            'data' => 'That for employee',
        ]);
    }

}

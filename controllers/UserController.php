<?php

namespace app\controllers;

class UserController extends \yii\rest\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionStore()
    {
        return $this->render('store');
    }

}

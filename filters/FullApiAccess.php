<?php

namespace app\filters;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class FullApiAccess extends ActionFilter
{

    /**
     * If role admin - grant access
     * @param \yii\base\Action $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Yii::error(Yii::$app->user->id . " " .   $action->id);
            if (!Yii::$app->user->can($action->id)) {
                throw new ForbiddenHttpException('NO_ACCESS');
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterAction($action, $result)
    {
        //
        return parent::afterAction($action, $result);
    }
}
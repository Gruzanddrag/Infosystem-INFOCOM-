<?php

namespace app\filters;

use Yii;
use yii\web\ForbiddenHttpException;

class EmployeeControl extends BaseRoleControl
{
    /**
     * If role department library employer - grant access
     * @param \yii\base\Action $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        if(parent::getUserRole() == 'library_empl'){
            return parent::beforeAction($action);
        } else {
            throw new ForbiddenHttpException('NO_ACCESS');
        }
    }

    public function afterAction($action, $result)
    {
        //
        return parent::afterAction($action, $result);
    }
}
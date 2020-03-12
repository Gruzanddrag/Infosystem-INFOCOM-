<?php

namespace app\filters;

use app\models\User;
use app\models\UserRoles;
use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class BaseRoleControl extends ActionFilter
{
    /**
     * JWT token from request
     */
    public $token = "";

    public $user = null;

    /**
     * BaseRoleControl constructor.
     * @param array $config
     * @throws ForbiddenHttpException
     */
    public function __construct($config = [])
    {
        $request = Yii::$app->request;
        $authHeader = $request->getHeaders()->get('Authorization');
        try {
            $this->token = Yii::$app->jwt->loadToken(explode(' ', $authHeader)[1]);
            $this->user = User::findIdentityByAccessToken($this->token);
        } catch (yii\base\ErrorException $e){
//            throw new ForbiddenHttpException('TOKEN_MISSING');
        }
        parent::__construct($config);
    }

    /**
     * Get JWT token from request
     * @return mixed|string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Returns user, that matches token
     * @return User|\yii\web\IdentityInterface|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Returns user's role
     */
    public function getUserRole(){
        $role = $this->user->role;
        return $role->roleCodeName;
    }

    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        //
        return parent::beforeAction($action);
    }

    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        //
        return parent::afterAction($action, $result);
    }
}
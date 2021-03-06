<?php


namespace app\components\JWT;


use sizeg\jwt\JwtHttpBearerAuth;

class JwtTokenHandler extends JwtHttpBearerAuth
{
    /**
     * @param \yii\web\Response $response
     * @throws \yii\web\UnauthorizedHttpException
     */
    public function handleFailure($response)
    {
        \Yii::getLogger()->log($response->getHeaders()->get('Authorization'), 1);
        parent::handleFailure($response); // TODO: Change the autogenerated stub
    }
}
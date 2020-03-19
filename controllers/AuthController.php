<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use MongoDB\BSON\TimestampInterface;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;

class AuthController extends \yii\rest\Controller
{
    /**
     * token will expire after that time
     */
    private $JWT_EXP_TIME = 3600;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
                'refresh'
            ],
            'except' => [
                'registration',
                'options'
            ]
        ];
        
        return $behaviors;
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogin()
    {
        //get JSON from post request
        $user_credential = Yii::$app->request->post();
        $loginForm = new LoginForm();
        $loginForm->attributes = $user_credential;
        if($loginForm->validate()){
            $user = $loginForm->getUser();
            // Generate Token
            /** @var Jwt $jwt */
            $jwt = Yii::$app->jwt;
            $signer = $jwt->getSigner('HS256');
            $key = $jwt->getKey();
            $time = time();
            $token = $jwt->getBuilder()
                ->issuedBy('http://localhost:8081')// Configures the issuer (iss claim)
                ->permittedFor('http://localhost:8081')// Configures the audience (aud claim)
                ->identifiedBy('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
                ->issuedAt($time)// Configures the time that the token was issue (iat claim)
                ->expiresAt($time + $this->JWT_EXP_TIME)// Configures the expiration time of the token (exp claim)
                ->withClaim('uid', $user->userId)// Configures a new claim, called "uid"
                ->getToken($signer, $key); // Retrieves the generated token
            return $this->asJson([
                'access_token' => (string)$token,
                'user' => $user->toArray([], ['role'])
            ]);
        } else {
            Yii::$app->response->setStatusCode(401);
            return  $loginForm->errors;
        }
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionRegistration()
    {
        $role = Yii::$app->request->post('role');
        $user_attrs = Yii::$app->request->post();
        $user = new User();
        $user->attributes = $user_attrs;
        $transaction = Yii::$app->db->beginTransaction();
        if($user->validate()){
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($user_attrs['password']);
            try {
                $user->save();
                $authManager = Yii::$app->authManager;
                $authManager->assign($authManager->getRole($role), $user->userId);
                $transaction->commit();
                return $user->toArray([], ['role']);
            } catch (\Exception $e){
                $transaction->rollBack();
                Yii::$app->response->setStatusCode(401);
                return [
                    'msg' => $e
                ];
            }
        } else {
            Yii::$app->response->setStatusCode(401);
            return  [
                'errors' => $user->errors
            ];
        }
    }

    public function actionRefresh(){
        $data = Yii::$app->jwt->getValidationData();
        $data->setCurrentTime(time() - $this->JWT_EXP_TIME);
        $header = Yii::$app->request->getHeaders()->get('Authorization');
        $token = Yii::$app->jwt->getParser()->parse((string) explode(' ', $header)[1]);
        if($token->validate($data)){
            $user_id = $token->getClaim('uid');
            $jwt = Yii::$app->jwt;
            $signer = $jwt->getSigner('HS256');
            $key = $jwt->getKey();
            $time = time();
            $token = $jwt->getBuilder()
                ->issuedBy('http://localhost:8081')// Configures the issuer (iss claim)
                ->permittedFor('http://localhost:8081')// Configures the audience (aud claim)
                ->identifiedBy('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
                ->issuedAt($time)// Configures the time that the token was issue (iat claim)
                ->expiresAt($time + $this->JWT_EXP_TIME)// Configures the expiration time of the token (exp claim)
                ->withClaim('uid', $user_id)// Configures a new claim, called "uid"
                ->getToken($signer, $key); // Retrieves the generated token
            return $this->asJson([
                'access_token' => (string)$token
            ]);
        } else {
            Yii::$app->response->setStatusCode(401);
            return $this->asJson([
                'msg' => 'Invalid token'
            ]);
        }
    }

    
    public function actionMe(){
        return User::findOne(Yii::$app->user->id)->toArray([], ['role']);
    }

}

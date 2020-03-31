<?php

namespace app\modules\umk;

use app\filters\FullApiAccess;
use app\filters\HeadControl;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\web\Response;

/**
 * umk module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\umk\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {

       $behaviors = parent::behaviors();
        // response in json
       $behaviors['contentNegotiator'] = [
           'class' => 'yii\filters\ContentNegotiator',
           'formats' => [
               'application/json' => Response::FORMAT_JSON,
           ],
       ];
       // check auth
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class
        ];

        return $behaviors;
    }
}

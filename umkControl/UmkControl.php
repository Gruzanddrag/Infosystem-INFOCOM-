<?php

namespace app\umkControl;

use app\filters\AdminControl;
use app\filters\HeadControl;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\web\Response;

/**
 * umk-control module definition class
 */
class UmkControl extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\umkControl\controllers';

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

            ]
        ];
        // you have to be authorized to access this module
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
        ];
        // grant access to whole module to admin and head of department
        $behaviors = array_merge($behaviors, [
            'admin_access' =>  [
               'class' => AdminControl::class
            ],
            'department_head_access' =>  [
                'class' => HeadControl::class
            ],
        ]);

        return $behaviors;
    }
}

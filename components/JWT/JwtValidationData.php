<?php

namespace app\components\JWT;

class JwtValidationData extends \sizeg\jwt\JwtValidationData
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->validationData->setIssuer('http://localhost:8081');
        $this->validationData->setAudience('http://localhost:8081');
        $this->validationData->setId('4f1g23a12aa');
        $this->validationData->setCurrentTime(time());

        parent::init();
    }
}
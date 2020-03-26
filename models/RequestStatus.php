<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_statuses".
 *
 * @property int $requestStatusId
 * @property string|null $requestStatusName
 *
 * @property Requests[] $requests
 */
class RequestStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['requestStatusName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'requestStatusId' => 'Request Status ID',
            'requestStatusName' => 'Request Status Name',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['requestStatusId' => 'requestStatusId']);
    }
}

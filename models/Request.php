<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property int $requestId
 * @property int $resourceId
 * @property int $count
 * @property int $requestStatusId
 * @property string $requestType
 * @property int $userId
 * @property string $date
 *
 * @property RequestStatuses $requestStatus
 * @property Resources $resource
 * @property Users $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resourceId', 'count', 'requestStatusId', 'requestType', 'userId', 'date'], 'required'],
            [['resourceId', 'count', 'requestStatusId', 'userId'], 'integer'],
            [['date'], 'safe'],
            [['requestType'], 'string', 'max' => 255],
            [['requestStatusId'], 'exist', 'skipOnError' => true, 'targetClass' => RequestStatus::className(), 'targetAttribute' => ['requestStatusId' => 'requestStatusId']],
            [['resourceId'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::className(), 'targetAttribute' => ['resourceId' => 'resourceId']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'requestId' => 'Request ID',
            'resourceId' => 'Resource ID',
            'count' => 'Count',
            'requestStatusId' => 'Request Status ID',
            'requestType' => 'Request Type',
            'userId' => 'User ID',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[RequestStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestStatus()
    {
        return $this->hasOne(RequestStatus::className(), ['requestStatusId' => 'requestStatusId']);
    }

    /**
     * Gets query for [[Resource]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['resourceId' => 'resourceId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    public function fields(){
        return array_merge(parent::fields(),[
            'resourceName' => function() {
                return $this->resource->resourceName;
            },
            'resourceType' => function() {
                return $this->resource->resourceType->resourceTypeAlias;
            },
            'user' => function() {
                return $this->user;
            },
            'requestStatus' => function() {
                return $this->requestStatus->requestStatusName;
            }
        ]);
    }

}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource_movement".
 *
 * @property int $resourceMovementId
 * @property string $resourceMovementDate
 * @property int|null $resourceMovementTypeId
 * @property int $resourceId
 *
 * @property Resources $resource
 * @property ResourceMovementTypes $resourceMovementType
 */
class ResourceMovement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource_movement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resourceMovementDate', 'resourceId'], 'required'],
            [['resourceMovementDate'], 'safe'],
            [['resourceMovementTypeId', 'resourceId', 'resourceMovementCountState'], 'integer'],
            [['resourceMovementReason'], 'string', 'max' => 255],
            [['resourceId'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::className(), 'targetAttribute' => ['resourceId' => 'resourceId']],
            [['resourceMovementTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => ResourceMovementType::className(), 'targetAttribute' => ['resourceMovementTypeId' => 'resourceMovementTypeId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'resourceMovementId' => 'Resource Movement ID',
            'resourceMovementDate' => 'Resource Movement Date',
            'resourceMovementTypeId' => 'Resource Movement Type ID',
            'resourceId' => 'Resource ID',
        ];
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
     * Gets query for [[ResourceMovementType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResourceMovementType()
    {
        return $this->hasOne(ResourceMovementType::className(), ['resourceMovementTypeId' => 'resourceMovementTypeId']);
    }
    
    
    public function fields(){
        return array_merge(parent::fields(), [
            'resourceName' => function() {
                return $this->resource->resourceName;
            },
            'resourceType' => function() {
                return $this->resource->resourceType->resourceTypeAlias;
            },
            'resourceTypeId' => function() {
                return $this->resource->resourceType->resourceTypeId;
            },
            'resourceUrl' => function() {
                return $this->resource->resourceUrl;
            },
            'resourceCountAvalible' => function() {
                return $this->resource->resourceCountAvalible;
            },
            'resourceMovementType' => function() {
                return $this->resourceMovementType->resourceMovementTypeAlias;
            },
        ]);
    }
}

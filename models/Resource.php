<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resources".
 *
 * @property int $resourceId
 * @property string $resourceName
 * @property int|null $resourceCountAvalible
 * @property int $resourceTypeId
 * @property string|null $resourceUrl
 *
 * @property Requests[] $requests
 * @property ResourceMovement[] $resourceMovements
 * @property ResourceTypes $resourceType
 * @property SectionResources[] $sectionResources
 * @property UmkMissingResource[] $umkMissingResources
 * @property UmkResource[] $umkResources
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resources';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resourceName', 'resourceTypeId'], 'required'],
            [['resourceCountAvalible', 'resourceTypeId'], 'integer'],
            [['resourceName', 'resourceUrl'], 'string', 'max' => 255],
            [['resourceTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => ResourceType::className(), 'targetAttribute' => ['resourceTypeId' => 'resourceTypeId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'resourceId' => 'Resource ID',
            'resourceName' => 'Resource Name',
            'resourceCountAvalible' => 'Resource Count Avalible',
            'resourceTypeId' => 'Resource Type ID',
            'resourceUrl' => 'Resource Url',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Requests::className(), ['resourceId' => 'resourceId']);
    }

    /**
     * Gets query for [[ResourceMovements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResourceMovements()
    {
        return $this->hasMany(ResourceMovement::className(), ['resourceId' => 'resourceId']);
    }

    /**
     * Gets query for [[ResourceType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResourceType()
    {
        return $this->hasOne(ResourceType::className(), ['resourceTypeId' => 'resourceTypeId']);
    }

    /**
     * Gets query for [[SectionResources]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSectionResources()
    {
        return $this->hasMany(SectionResource::className(), ['resourceId' => 'resourceId']);
    }

    /**
     * Gets query for [[UmkResources]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUmkResources()
    {
        return $this->hasMany(UmkResource::className(), ['resourceId' => 'resourceId']);
    }

    
    public function fields(){

        return array_merge(parent::fields(), [
            'resourceType' => function() {
                return $this->resourceType->resourceTypeAlias;
            },
        ]);

    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "section_resources".
 *
 * @property int $id
 * @property int $sectionId
 * @property int $resourceId
 * @property int|null $count
 *
 * @property Resources $resource
 * @property Sections $section
 */
class SectionResource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_resources';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sectionId', 'resourceId'], 'required'],
            [['sectionId', 'resourceId', 'count'], 'integer'],
            [['resourceId'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::className(), 'targetAttribute' => ['resourceId' => 'resourceId']],
            [['sectionId'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['sectionId' => 'sectionId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sectionId' => 'Section ID',
            'resourceId' => 'Resource ID',
            'count' => 'Count',
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
     * Gets query for [[Section]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['sectionId' => 'sectionId']);
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
        ]);
    }
}

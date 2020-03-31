<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource_types".
 *
 * @property int $resourceTypeId
 * @property string|null $resourceTypeAlias
 *
 * @property Resources[] $resources
 */
class ResourceType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resourceTypeAlias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'resourceTypeId' => 'Resource Type ID',
            'resourceTypeAlias' => 'Тип литературы',
        ];
    }

    /**
     * Gets query for [[Resources]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resource::className(), ['resourceTypeId' => 'resourceTypeId']);
    }
}

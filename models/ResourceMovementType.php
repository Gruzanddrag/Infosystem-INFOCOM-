<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource_movement_types".
 *
 * @property int $resourceMovementTypeId
 * @property string $resourceMovementTypeAlias
 *
 * @property ResourceMovement[] $resourceMovements
 */
class ResourceMovementType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource_movement_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resourceMovementTypeAlias'], 'required'],
            [['resourceMovementTypeAlias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'resourceMovementTypeId' => 'Resource Movement Type ID',
            'resourceMovementTypeAlias' => 'Resource Movement Type Alias',
        ];
    }

    /**
     * Gets query for [[ResourceMovements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResourceMovements()
    {
        return $this->hasMany(ResourceMovement::className(), ['resourceMovementTypeId' => 'resourceMovementTypeId']);
    }
}

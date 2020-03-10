<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userRoles".
 *
 * @property int $roleId
 * @property string|null $roleAlias
 * @property string|null $roleCodeName
 */
class UserRoles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userRoles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['roleAlias', 'roleCodeName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'roleId' => 'Role ID',
            'roleAlias' => 'Role Alias',
            'roleCodeName' => 'Role Code Name',
        ];
    }
}

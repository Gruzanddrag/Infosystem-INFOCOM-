<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $userId
 * @property string|null $phone
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $patronymic
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'name', 'surname', 'patronymic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'phone' => 'Phone',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
        ];
    }
    /**
     * {@inheritdoc}
     * @param \Lcobucci\JWT\Token $token
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['id'] === (string) $token->getClaim('uid')) {
                return new static($user);
            }
        }

        return null;
    }
}
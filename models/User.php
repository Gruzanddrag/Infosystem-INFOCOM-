<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $userId
 * @property string|null $phone
 * @property string|null $name
 * @property string|null $password
 * @property string|null $surname
 * @property string|null $patronymic
 * @property int|null $roleId
 *
 * @property Userroles $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * Find user by EMAIl
     * @param $email
     * @return User|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Validate password
     * @param $password
     * @return bool
     * @throws \yii\base\Exception
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['roleId'], 'integer'],
            [['phone', 'name', 'password', 'surname', 'patronymic', 'roleId', 'email'], 'required'],
            [['phone', 'name', 'password', 'surname', 'patronymic', 'email'], 'string', 'max' => 255],
            [['roleId'], 'exist', 'skipOnError' => true, 'targetClass' => Userroles::className(), 'targetAttribute' => ['roleId' => 'roleId']],
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
            'password' => 'Password',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'roleId' => 'Role ID',
        ];
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery|UserRoles
     */
    public function getRole()
    {
        return $this->hasOne(UserRoles::className(), ['roleId' => 'roleId']);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['userId' => (string) $token->getClaim('uid')]);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}

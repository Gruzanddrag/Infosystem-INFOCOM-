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
     * Is a access granted for user
     * @var bool
     */
    public $accessGranted = false;

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
            [['phone', 'name', 'password', 'surname', 'patronymic', 'email'], 'required'],
            [['phone', 'name', 'password', 'surname', 'patronymic', 'email'], 'string', 'max' => 255],
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
        return $this->userId;
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
    
    public function fields()
    {
        $fields = parent::fields();

        unset($fields['password']);

        return $fields;
    }

}

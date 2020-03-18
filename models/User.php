<?php

namespace app\models;
use yii\web\IdentityInterface;


use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $userId
 * @property string|null $phone
 * @property string|null $name
 * @property string $email
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['roleId'], 'integer'],
            [['phone', 'name', 'email', 'password', 'surname', 'patronymic'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['roleId'], 'exist', 'skipOnError' => true, 'targetClass' => Userroles::className(), 'targetAttribute' => ['roleId' => 'roleId']],
        ];
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
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'phone' => 'Phone',
            'name' => 'Name',
            'email' => 'Email',
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

    

    public function extraFields(){

        return[
            'role' => function() {
            
                $roles = Yii::$app->authManager->getRolesByUser($this->userId);

                list($roleName) = each($roles);
                
                return $roleName;
            }
        ];

    }

}

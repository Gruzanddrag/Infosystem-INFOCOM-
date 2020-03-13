<?php


namespace app\components;


use app\models\User;

class UserAccessControl
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $role;

    /**
     * UserAccessControl constructor.
     * @param $role string
     * @param $user User
     */
    public function __construct($role, $user)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function grantAccess(){
        return $this->role == $this->user->role->roleCodeName || $this->user->isAdmin();
    }
}
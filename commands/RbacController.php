<?php


namespace app\commands;

use Yii;
use yii\console\Controller;
use app\rbac\UserGroupRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;
        // clear previous rules
        $authManager->removeAll();

        // Create roles
        $guest  = $authManager->createRole('guest');
        $admin  = $authManager->createRole('admin');
        $departmentEmployee  = $authManager->createRole('department-e');
        $departmentHead  = $authManager->createRole('department-h');
        $libraryEmployee  = $authManager->createRole('library-e');

        // Create simple, based on action{$NAME} permissions
        $login  = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $error  = $authManager->createPermission('error');
        $signUp = $authManager->createPermission('registration');
        $index  = $authManager->createPermission('index');
        $view   = $authManager->createPermission('view');
        $create = $authManager->createPermission('create');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');
        // custom
        $seeDictionaries = $authManager->createPermission('seeDictionaries');
        $setDictionaries = $authManager->createPermission('setDictionaries');
        $seeUMK = $authManager->createPermission('seeUMK');
        $setUMK = $authManager->createPermission('setUMK');
        $seeResources = $authManager->createPermission('seeResources');
        $setResources = $authManager->createPermission('setResources');
        $setInternetResources = $authManager->createPermission('setInternetResources');
        $setNewResource = $authManager->createPermission('setNewResource');
        $confirmRequest = $authManager->createPermission('confirmRequest');
        $denyRequest = $authManager->createPermission('denyRequest');
        $completeRequest = $authManager->createPermission('completeRequest');
        $confirmUMK = $authManager->createPermission('confirmUMK');
        $denyUMK = $authManager->createPermission('denyUMK');
        $manageUser = $authManager->createPermission('manageUser');


        // Create actions for department head
        // TODO: create actions for department head

        // Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($error);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);
        $authManager->add($create);
        $authManager->add($seeDictionaries);
        $authManager->add($setDictionaries);
        $authManager->add($seeUMK);
        $authManager->add($setUMK);
        $authManager->add($seeResources);
        $authManager->add($setResources);
        $authManager->add($setInternetResources);
        $authManager->add($setNewResource);
        $authManager->add($confirmRequest);
        $authManager->add($denyRequest);
        $authManager->add($completeRequest);
        $authManager->add($confirmUMK);
        $authManager->add($denyUMK);
        $authManager->add($manageUser);


        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($admin);
        $authManager->add($departmentEmployee);
        $authManager->add($departmentHead);
        $authManager->add($libraryEmployee);

        // Add permission-per-role in Yii::$app->authManager
        // Guest
        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $logout);
        $authManager->addChild($guest, $error);
        $authManager->addChild($guest, $signUp);
        $authManager->addChild($guest, $seeDictionaries);
        $authManager->addChild($guest, $seeResources);
        $authManager->addChild($guest, $index);
        $authManager->addChild($guest, $view);

        // Сотрудник кафедры
        $authManager->addChild($departmentEmployee, $update);
        $authManager->addChild($departmentEmployee, $delete);
        $authManager->addChild($departmentEmployee, $seeUMK);
        $authManager->addChild($departmentEmployee, $setUMK);
        $authManager->addChild($departmentEmployee, $create);
        $authManager->addChild($departmentEmployee, $guest);
        $authManager->addChild($departmentEmployee, $setInternetResources);
        $authManager->addChild($departmentEmployee, $setNewResource);


        // Сотрудник библиотеки
        $authManager->addChild($libraryEmployee, $update);
        $authManager->addChild($libraryEmployee, $delete);
        $authManager->addChild($libraryEmployee, $create);
        $authManager->addChild($libraryEmployee, $guest);
        $authManager->addChild($libraryEmployee, $setResources);
        $authManager->addChild($libraryEmployee, $completeRequest);
        $authManager->addChild($libraryEmployee, $denyRequest);

        // Заведующий кафедры
        $authManager->addChild($departmentHead, $departmentEmployee);
        $authManager->addChild($departmentHead, $confirmRequest);
        $authManager->addChild($departmentHead, $denyRequest);
        $authManager->addChild($departmentHead, $confirmUMK);
        $authManager->addChild($departmentHead, $denyUMK);

        // Администратор
        $authManager->addChild($admin, $departmentEmployee);
        $authManager->addChild($admin, $libraryEmployee);
        $authManager->addChild($admin, $departmentHead);
        $authManager->addChild($admin, $setDictionaries);
        $authManager->addChild($admin, $manageUser);
    }
}
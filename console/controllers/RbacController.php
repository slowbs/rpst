<?php
namespace console\controllers;

use Yii;
use yii\helpers\Console;

class RbacController extends \yii\console\Controller {

  public function actionInit(){

    $auth = Yii::$app->authManager;
    $auth->removeAll();
    Console::output('Removing All! RBAC.....');
  
    $manageUser = $auth->createRole('ManageUser');
    $manageUser->description = 'สำหรับจัดการข้อมูลผู้ใช้งาน';
    $auth->add($manageUser);
  
    $author = $auth->createRole('Author');
    $author->description = 'สำหรับการเขียนบทความ';
    $auth->add($author);
  
    $management = $auth->createRole('Management');
    $management->description = 'สำหรับจัดการข้อมูลผู้ใช้งานและบทความ';
    $auth->add($management);
  
    $admin = $auth->createRole('Admin');
    $admin->description = 'สำหรับการดูแลระบบ';
    $auth->add($admin);
  
    $auth->addChild($management, $manageUser);
    $auth->addChild($management, $author);
    $auth->addChild($admin, $management);
  
    $auth->assign($admin, 3);
    $auth->assign($management, 2);
    $auth->assign($author, 4);
  
    Console::output('Success! RBAC roles has been added.');
  
  }

}
?>
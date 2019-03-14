<?php
namespace console\controllers;

use Yii;
use yii\helpers\Console;

class RbacController extends \yii\console\Controller {

  public function actionInit(){

    $auth = Yii::$app->authManager;
    $auth->removeAll();
    Console::output('Removing All! RBAC.....');

    $createPost = $auth->createPermission('createBlog');
    $createPost->description = 'Create a application';
    $auth->add($createPost);

    $updatePost = $auth->createPermission('updateBlog');
    $updatePost->description = 'Update application';
    $auth->add($updatePost);

    $admin = $auth->createRole('Admin');
    $auth->add($admin);

    $author = $auth->createRole('Author');
    $auth->add($author);

    $management = $auth->createRole('Management');
    $auth->add($management);

    // เรียกใช้งาน AuthorRule
    $rule = new \common\rbac\AuthorRule;
    $auth->add($rule);

    // สร้าง permission ขึ้นมาใหม่เพื่อเอาไว้ตรวจสอบและนำ AuthorRule มาใช้งานกับ updateOwnPost
    $updateOwnPost = $auth->createPermission('updateOwnPost');
    $updateOwnPost->description = 'Update Own Post';
    $updateOwnPost->ruleName = $rule->name;
    $auth->add($updateOwnPost);

    $auth->addChild($author,$createPost);

    // เปลี่ยนลำดับ โดยใช้ updatePost อยู่ภายใต้ updateOwnPost และ updateOwnPost อยู่ภายใต้ author อีกที
    $auth->addChild($updateOwnPost, $updatePost);
    $auth->addChild($author, $updateOwnPost);

    $auth->addChild($management, $author);
    $auth->addChild($admin, $management);

    $auth->assign($admin, 2);
    $auth->assign($management, 3);
    $auth->assign($author, 4);
    $auth->assign($author, 5);

    Console::output('Success! RBAC roles has been added.');
  }

}
?>
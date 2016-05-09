<?php

//namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
	public function actionInit()
	{
		$auth = Yii::$app->authManager;

		$login = $auth->createPermission('login');
		$login->description = 'Login';
		$auth->add($login);

		$register = $auth->createPermission('register');
		$login->description = 'Register';
		$auth->add($register);

		$guest = $auth->createRole('guest');
		$auth->add($guest);
		$auth->addChild($guest, $login);
		$auth->addChild($guest, $register);

		$view_book = $auth->createPermission('view_book');
		$view_book->description = 'view_book';
		$auth->add($view_book);

		$list_book = $auth->createPermission('list_book');
		$list_book->description = 'list_book';
		$auth->add($list_book);

		$view_author = $auth->createPermission('view_author');
		$view_author->description = 'view_author';
		$auth->add($view_author);

		$list_author = $auth->createPermission('list_author');
		$list_author->description = 'list_author';
		$auth->add($list_author);

		$update_profile = $auth->createPermission('update_profile');
		$update_profile->description = 'update_profile';
		$auth->add($update_profile);

		$browse_task = $auth->createPermission('browse');
		$auth->add($browse_task);
		$auth->addChild($browse_task, $view_book);
		$auth->addChild($browse_task, $view_author);
		$auth->addChild($browse_task, $list_book);
		$auth->addChild($browse_task, $list_author);

		$member = $auth->createRole('member');
		$auth->add($member);
		$auth->addChild($member, $browse_task);
		$auth->addChild($member, $update_profile);

		$auth->assign($member, 22);
	}
}
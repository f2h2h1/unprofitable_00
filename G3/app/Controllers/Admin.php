<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Container;
use GPojectPHP\Dao\UserDao;
use GPojectPHP\Dao\SubjectDao;
use GPojectPHP\Dao\ClassesDao;
use GPojectPHP\Dao\StudentDao;
use GPojectPHP\Dao\TeacherDao;

class Admin extends Main
{
	/**
	 * 主页
	 */
	public function index() : ?string
	{
		return $this->view();
	}

	/**
	 * 退出
	 */
	public function logout() : ?string
	{
		session_destroy();
		return $this->redirect('Home/login');
	}

	/**
	 * 修改密码
	 */
	public function changePassword() : ?string
	{
		if (IS_GET)
		{
			return $this->view();
		}
		else
		{
			$oldPassword = $_POST['oldPassword'];
			$newPassword = $_POST['newPassword'];
			$userDao = new UserDao($this->container->get('entityManager'));
			if (!$userDao->changePassword($this->user->getId(), $oldPassword, $newPassword))
			{
				$this->setAlertMsg('密码修改失败', 'danger');
				return $this->view();
			}
			$this->setAlertMsg('密码修改成功', 'success');
			return $this->redirect('index');
		}
	}
}

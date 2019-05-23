<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Dao\UserDao;

class Home extends Main
{
	/**
	 * 主页
	 */
	public function index() : ?string
	{
		return $this->view();
	}

	/**
	 * 登录
	 */
	public function login() : ?string
	{
		if ($this->isLogin())
		{
			return $this->redirect('Home/index');
		}
		if (IS_GET)
		{
			return $this->view();
		}
		else
		{
			$name = $_POST['username'];
			$password = $_POST['password'];

			$userDao = new UserDao($this->entityManager);
			$user = $userDao->login($name, $password);

			if ($user !== null)
			{
				// 登录成功
				$_SESSION['user'] = $user;
				$this->user = $user;

				// return $this->view(['model' => $ret[0]], 'index');
				// header('Location: index.php?r=Admin/index');
				return $this->redirect('Home/index');
			}
			else
			{
				// 登录失败
				$this->setAlertMsg('登录失败', 'danger');
				return $this->view();
			}
		}
	}

	/**
	 * 退出
	 */
	public function logout() : ?string
	{
		// 清空 session
		session_destroy();
		// 重定向至登录页
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
			$userDao = new UserDao($this->entityManager);
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

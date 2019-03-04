<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Container;
use GPojectPHP\Dao\UserDao;

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

	#region 用户管理

	/**
	 * 用户列表
	 */
	public function userList() : ?string
	{
		$userDao = new UserDao($this->container->get('entityManager'));
		$userList = $userDao->getUserList();
		return $this->view(['modelList' => $userList]);
	}

	/**
	 * 用户详细
	 */
	public function userDetails() : ?string
	{
		$id = (int)$_GET['id'];

		$userDao = new UserDao($this->container->get('entityManager'));
		$user = $userDao->getUser($id);

		return $this->view(['model' => $user]);
	}

	/**
	 * 新建用户
	 */
	public function userCreate() : ?string
	{
		if (IS_GET)
		{
			return $this->view();
		}
		else
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$role = (int)$_POST['role'];

			$userDao = new UserDao($this->container->get('entityManager'));
			$userDao->add($username, $password, $role);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('userList');
		}
	}

	/**
	 * 删除用户
	 */
	public function userDelete() : ?string
	{
		$id = (int)$_POST['id'];

		if ($id === $this->user->getId())
		{
			$this->setAlertMsg('删除失败', 'danger');
			return $this->redirect('userList');
		}

		$userDao = new UserDao($this->container->get('entityManager'));
		$user = $userDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('userList');
	}

	#endregion

	#region 学科管理

	#endregion

	#region 教师管理

	#endregion

	#region 学生管理

	#endregion
}

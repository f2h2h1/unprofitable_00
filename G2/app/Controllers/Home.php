<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Dao\UserDao;

class Home extends Main
{
	public function index() : ?string
	{	
		// header('Location: index.php?r=Home/login');
		return $this->redirect('login');
	}

	public function login() : ?string
	{
		if ($this->isLogin())
		{
			return $this->redirect('Admin/index');
		}
		if (IS_GET)
		{
			return $this->view();
		}
		else
		{
			$name = $_POST['username'];
			$password = $_POST['password'];
			$userDao = new UserDao($this->container->get('entityManager'));
			$user = $userDao->login($name, $password);

			if ($user !== null)
			{
				// 登录成功
				$_SESSION['user'] = $user;
				$this->user = $user;

				// return $this->view(['model' => $ret[0]], 'index');
				// header('Location: index.php?r=Admin/index');
				return $this->redirect('Admin/index');
			}
			else
			{
				// 登录失败
				$this->setAlertMsg('登录失败', 'danger');
				return $this->view();
			}
		}
	}
}

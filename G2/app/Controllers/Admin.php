<?php
namespace GPojectPHP\Controllers;

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
		$userDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('userList');
	}

	#endregion

	#region 学科管理

	public function subjectList() : ?string
	{
		$subjectDao = new SubjectDao($this->container->get('entityManager'));
		$modelList = $subjectDao->list();
		return $this->view(['modelList' => $modelList]);
	}

	public function subjectCreate() : ?string
	{
		if (IS_GET)
		{
			return $this->view();
		}
		else
		{
			$subjectName = $_POST['subjectName'];

			$subjectDao = new SubjectDao($this->container->get('entityManager'));
			$id = $subjectDao->add($subjectName);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('subjectList');
		}
	}

	public function subjectDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$subjectDao = new SubjectDao($this->container->get('entityManager'));
		$subjectDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('subjectList');
	}

	#endregion

	#region 教师管理

	public function teacherList() : ?string
	{
		$teacherDao = new TeacherDao($this->container->get('entityManager'));
		$modelList = $teacherDao->list();

		$subjectDao = new SubjectDao($this->container->get('entityManager'));
		$subjectList = $subjectDao->list();

		return $this->view(['modelList' => $modelList, 'subjectList' => $subjectList]);
	}

	public function teacherCreate() : ?string
	{
		if (IS_GET)
		{
			$subjectDao = new SubjectDao($this->container->get('entityManager'));
			$subjectList = $subjectDao->list();

			return $this->view(['subjectList' => $subjectList]);
		}
		else
		{
			$name = $_POST['name'];
			$subjectid = (int)$_POST['subjectid'];
			$classid = (int)$_POST['classid'];
			$username = $_POST['username'];
			$password = $_POST['password'];

			$teacherDao = new TeacherDao($this->container->get('entityManager'));
			$id = $teacherDao->add($name, $subjectid, $classid, $username, $password);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('teacherList');
		}
	}

	public function teacherDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$teacherDao = new TeacherDao($this->container->get('entityManager'));
		$teacherDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('teacherList');
	}

	#endregion

	#region 学生管理

	public function classesList() : ?string
	{
		$classesDao = new ClassesDao($this->container->get('entityManager'));
		$modelList = $classesDao->list();
		return $this->view(['modelList' => $modelList]);
	}

	public function classesCreate() : ?string
	{
		if (IS_GET)
		{
			return $this->view();
		}
		else
		{
			$classesName = $_POST['classesName'];
			$number = $_POST['number'];

			$classesDao = new ClassesDao($this->container->get('entityManager'));
			$classesDao->add($classesName, $number);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('classesList');
		}
	}

	public function classesDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$classesDao = new ClassesDao($this->container->get('entityManager'));
		$classesDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('classesList');
	}

	public function studentList() : ?string
	{
		$classid = (int)$_GET['id'];

		$studentDao = new StudentDao($this->container->get('entityManager'));
		$modelList = $studentDao->list($classid);
		return $this->view(['modelList' => $modelList, 'classid' => $classid]);
	}

	public function studentCreate() : ?string
	{
		if (IS_GET)
		{
			$classid = (int)$_GET['classid'];

			return $this->view(['classid' => $classid]);
		}
		else
		{
			$classid = (int)$_POST['classid'];
			$name = $_POST['name'];
			$username = $_POST['username'];
			$password = $_POST['password'];

			$studentDao = new StudentDao($this->container->get('entityManager'));
			$studentDao->add($classid, $name, $username, $password);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('studentList', ['id' => $classid]);
		}
	}

	public function studentDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$studentDao = new StudentDao($this->container->get('entityManager'));
		$studentDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->goback();
	}

	#endregion
}

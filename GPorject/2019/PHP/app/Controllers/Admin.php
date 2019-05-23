<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Dao\UserDao;
use GPojectPHP\Dao\SubjectDao;
use GPojectPHP\Dao\ClassesDao;
use GPojectPHP\Dao\StudentDao;
use GPojectPHP\Dao\TeacherDao;

/**
 * 管理员相关控制器
 */
class Admin extends Main
{
	#region 用户管理

	/**
	 * 用户列表
	 */
	public function userList() : ?string
	{
		$userDao = new UserDao($this->entityManager);
		$userList = $userDao->getUserList();
		return $this->view(['modelList' => $userList]);
	}

	/**
	 * 用户详细
	 */
	public function userDetails() : ?string
	{
		$id = (int)$_GET['id'];

		$userDao = new UserDao($this->entityManager);
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

			$userDao = new UserDao($this->entityManager);
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

		$userDao = new UserDao($this->entityManager);
		$userDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('userList');
	}

	#endregion

	#region 学科管理

	/**
	 * 学科列表
	 */
	public function subjectList() : ?string
	{
		$subjectDao = new SubjectDao($this->entityManager);
		$modelList = $subjectDao->list();
		return $this->view(['modelList' => $modelList]);
	}

	/**
	 * 添加学科
	 */
	public function subjectCreate() : ?string
	{
		if (IS_GET)
		{
			return $this->view();
		}
		else
		{
			$subjectName = $_POST['subjectName'];

			$subjectDao = new SubjectDao($this->entityManager);
			$id = $subjectDao->add($subjectName);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('subjectList');
		}
	}

	/**
	 * 删除学科
	 */
	public function subjectDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$subjectDao = new SubjectDao($this->entityManager);
		$subjectDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('subjectList');
	}

	#endregion

	#region 教师管理

	/**
	 * 教师列表
	 */
	public function teacherList() : ?string
	{
		$teacherDao = new TeacherDao($this->entityManager);
		$modelList = $teacherDao->list();

		$subjectDao = new SubjectDao($this->entityManager);
		$subjectList = $subjectDao->list();

		return $this->view(['modelList' => $modelList, 'subjectList' => $subjectList]);
	}

	/**
	 * 添加教师
	 */
	public function teacherCreate() : ?string
	{
		if (IS_GET)
		{
			$subjectDao = new SubjectDao($this->entityManager);
			$subjectList = $subjectDao->list();

			$classesDao = new ClassesDao($this->entityManager);
			$classesList = $classesDao->list();

			return $this->view(['subjectList' => $subjectList, 'classesList' => $classesList]);
		}
		else
		{
			$name = $_POST['name'];
			$subjectid = (int)$_POST['subjectid'];
			$classid = (int)$_POST['classid'];
			$username = $_POST['username'];
			$password = $_POST['password'];

			$teacherDao = new TeacherDao($this->entityManager);
			$id = $teacherDao->add($name, $subjectid, $classid, $username, $password);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('teacherList');
		}
	}

	/**
	 * 删除教师
	 */
	public function teacherDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$teacherDao = new TeacherDao($this->entityManager);
		$teacherDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('teacherList');
	}

	#endregion

	#region 学生管理

	/**
	 * 班级列表
	 */
	public function classesList() : ?string
	{
		$classesDao = new ClassesDao($this->entityManager);
		$modelList = $classesDao->list();
		return $this->view(['modelList' => $modelList]);
	}

	/**
	 * 添加班级
	 */
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

			$classesDao = new ClassesDao($this->entityManager);
			$classesDao->add($classesName, $number);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('classesList');
		}
	}

	/**
	 * 删除班级
	 */
	public function classesDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$classesDao = new ClassesDao($this->entityManager);
		$classesDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('classesList');
	}

	/**
	 * 学生列表
	 */
	public function studentList() : ?string
	{
		$classid = (int)$_GET['id'];

		$studentDao = new StudentDao($this->entityManager);
		$modelList = $studentDao->list($classid);
		return $this->view(['modelList' => $modelList, 'classid' => $classid]);
	}

	/**
	 * 添加学生
	 */
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

			$studentDao = new StudentDao($this->entityManager);
			$studentDao->add($classid, $name, $username, $password);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('studentList', ['id' => $classid]);
		}
	}

	/**
	 * 删除学生
	 */
	public function studentDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$studentDao = new StudentDao($this->entityManager);
		$studentDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->goback();
	}

	#endregion
}

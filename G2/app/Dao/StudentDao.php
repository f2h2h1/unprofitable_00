<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Models\Student;
use GPojectPHP\Dao\UserDao;

class StudentDao extends MainDao
{
	private $objectName = 'GPojectPHP\Models\Student';
	
	public function list(int $classid) : ?array
	{
		$dql = "SELECT a FROM {$this->objectName} a WHERE a.classid = :classid";
		$ret = $this->entityManager->createQuery($dql)
							->setParameter('classid', $classid)
							->getResult();
		if ($this->isEmpty($ret))
		{
			return null;
		}
		return $ret;
	}

	public function add(int $classid, string $name, string $username, string $password) : ?int
	{
		$role = 3;
		$userDao = new UserDao($this->entityManager);
		$userid = $userDao->add($username, $password, $role);

		$timestamp = time();
		$student = new Student();
		$student->setUserid($userid);
		$student->setName($name);
		$student->setClassid($classid);
		$student->setCreatetime($timestamp);

		$this->entityManager->persist($student);
		$this->entityManager->flush();

		return $student->getId();
	}

	public function del(int $id) : bool
	{
		$model = $this->entityManager->find($this->objectName, $id);
		$this->entityManager->remove($model);

		$userDao = new UserDao($this->entityManager);
		$userDao->del($model->getUserid());

		$this->entityManager->flush();
		return true;
	}
}

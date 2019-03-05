<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Models\Teacher;
use GPojectPHP\Dao\UserDao;

class TeacherDao extends MainDao
{
	private $objectName = 'GPojectPHP\Models\Teacher';

	public function list() : ?array
	{
		$repository = $this->entityManager->getRepository($this->objectName);
		$list = $repository->findAll();

		if ($this->isEmpty($list))
		{
			return null;
		}
		return $list;
	}

	public function add(string $name, int $subjectid, int $classid, string $username, string $password) : ?int
	{
		$role = 2;
		$userDao = new UserDao($this->entityManager);
		$userid = $userDao->add($username, $password, $role);

		$timestamp = time();
		$teacher = new Teacher();
		$teacher->setUserid($userid);
		$teacher->setName($name);
		$teacher->setSubjectid($subjectid);
		$teacher->setClassid($classid);
		$teacher->setCreatetime($timestamp);

		$this->entityManager->persist($teacher);
		$this->entityManager->flush();

		return $teacher->getId();
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

	public function getFromUserid(int $userid) : ?Teacher
	{
		$dql = "SELECT a FROM {$this->objectName} a WHERE a.userid = :userid";
		$ret = $this->entityManager->createQuery($dql)
							->setParameter('userid', $userid)
							->setMaxResults(1)
							->getResult();
		if ($this->isEmpty($ret))
		{
			return null;
		}
		return $ret[0];
	}
}

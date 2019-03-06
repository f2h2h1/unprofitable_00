<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Models\Knowledge;

class KnowledgeDao extends MainDao
{
	protected $objectName = 'GPojectPHP\Models\Knowledge';

	public function list() : ?array
	{
		$dql = "SELECT a FROM {$this->objectName} a";
		$ret = $this->entityManager->createQuery($dql)
							->getResult();
		if ($this->isEmpty($ret))
		{
			return null;
		}
		return $ret;
	}

	public function add(int $subjectid, string $name, string $describe) : ?int
	{
		$timestamp = time();
		$knowledge = new Knowledge();
		$knowledge->setSubjectid($subjectid);
		$knowledge->setName($name);
		$knowledge->setDescribe($describe);
		$knowledge->setCreatetime($timestamp);
		$knowledge->setUpdatetime($timestamp);

		$this->entityManager->persist($knowledge);
		$this->entityManager->flush();

		return $knowledge->getId();
	}

	public function del(int $id) : bool
	{
		$model = $this->entityManager->find($this->objectName, $id);
		$this->entityManager->remove($model);
		$this->entityManager->flush();
		return true;
	}

	public function get(int $id) : ?Knowledge
	{
		return $this->entityManager->find($this->objectName, $id);
	}

	public function update(int $id, string $name, string $describe) : bool
	{
		$timestamp = time();
		$knowledge = $this->get($id);
		$knowledge->setName($name);
		$knowledge->setDescribe($describe);
		$knowledge->setUpdatetime($timestamp);

		$this->entityManager->flush();
		return true;
	}
}

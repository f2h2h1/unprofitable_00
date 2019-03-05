<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Container;
use GPojectPHP\Models\Subject;

class SubjectDao extends MainDao
{
	private $objectName = 'GPojectPHP\Models\Subject';

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

	public function add(string $subjectName) : ?int
	{
		$timestamp = time();
		$subject = new Subject();
		$subject->setName($subjectName);
		$subject->setCreatetime($timestamp);

		$this->entityManager->persist($subject);
		$this->entityManager->flush();

		return $subject->getId();
	}

	public function del(int $id) : bool
	{
		$model = $this->entityManager->find($this->objectName, $id);
		$this->entityManager->remove($model);
		$this->entityManager->flush();
		return true;
	}

	public function get(int $id) : ?Subject
	{
		return $this->entityManager->find($this->objectName, $id);
	}
}

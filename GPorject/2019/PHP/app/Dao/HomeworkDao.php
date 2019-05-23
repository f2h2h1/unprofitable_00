<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Models\Homework;
use GPojectPHP\Dao\KnowledgeDao;

class HomeworkDao extends MainDao
{
	protected $objectName = 'GPojectPHP\Models\Homework';

	public function add(string $name, int $examid, int $studentid, string $path) : ?int
	{
		$timestamp = time();
		$homework = new Homework();
		$homework->setName($name);
		$homework->setExamid($examid);
		$homework->setStudentid($studentid);
		$homework->setPath($path);
		$homework->setCreatetime($timestamp);

		$this->entityManager->persist($homework);
		$this->entityManager->flush();

		return $homework->getId();
	}

	public function del(int $id) : bool
	{
		$model = $this->entityManager->find($this->objectName, $id);
		$this->entityManager->remove($model);
		$this->entityManager->flush();
		return true;
	}

	public function get(int $id) : ?Homework
	{
		return $this->entityManager->find($this->objectName, $id);
	}
}

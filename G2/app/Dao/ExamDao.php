<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Models\Exam;

class ExamDao extends MainDao
{
	protected $objectName = 'GPojectPHP\Models\Exam';

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

	public function add(string $name, int $subjectid, int $type, string $question, int $teacherid) : ?int
	{
		$timestamp = time();
		$exam = new Exam();
		$exam->setName($name);
		$exam->setSubjectid($subjectid);
		$exam->setType($type);
		$exam->setQuestion($question);
		$exam->setTeacherid($teacherid);
		$exam->setCreatetime($timestamp);

		$this->entityManager->persist($exam);
		$this->entityManager->flush();

		return $exam->getId();
	}

	public function del(int $id) : bool
	{
		$model = $this->entityManager->find($this->objectName, $id);
		$this->entityManager->remove($model);
		$this->entityManager->flush();
		return true;
	}

	public function get(int $id) : ?Exam
	{
		return $this->entityManager->find($this->objectName, $id);
	}
}

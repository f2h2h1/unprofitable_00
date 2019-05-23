<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Models\Score;

class ScoreDao extends MainDao
{
	protected $objectName = 'GPojectPHP\Models\Score';

	public function getFromStudentid(int $studentid)
	{
		$ret = $this->entityManager
					->createQueryBuilder()
					->select('a')
					->from($this->objectName, 'a')
					->where('a.studentid = :studentid')
					->getQuery()
					->setParameter('studentid', $studentid)
					->getArrayResult();
		return $ret;
	}

	public function add(int $examid, int $studentid, int $score2) : ?int
	{
		$timestamp = time();
		$score = new Score();
		$score->setExamid($examid);
		$score->setStudentid($studentid);
		$score->setScore($score2);
		$score->setCreatetime($timestamp);

		$this->entityManager->persist($score);
		$this->entityManager->flush();

		return $score->getId();
	}

	public function del(int $id) : bool
	{
		$model = $this->entityManager->find($this->objectName, $id);
		$this->entityManager->remove($model);
		$this->entityManager->flush();
		return true;
	}

	public function get(int $id) : ?Score
	{
		return $this->entityManager->find($this->objectName, $id);
	}
}

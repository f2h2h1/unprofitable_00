<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Models\Problem;
use GPojectPHP\Dao\KnowledgeDao;

class ProblemDao extends MainDao
{
	protected $objectName = 'GPojectPHP\Models\Problem';

	public function list(int $knowledgeid) : ?array
	{
		$dql = "SELECT a FROM {$this->objectName} a WHERE a.knowledgeid = :knowledgeid";
		$ret = $this->entityManager->createQuery($dql)
							->setParameter('knowledgeid', $knowledgeid)
							->getResult();
		if ($this->isEmpty($ret))
		{
			return null;
		}
		return $ret;
	}

	public function add(int $knowledgeid, string $name, int $type, string $describe, string $answer) : ?int
	{
		$timestamp = time();
		$problem = new Problem();
		$problem->setKnowledgeid($knowledgeid);
		$problem->setName($name);
		$problem->setType($type);
		$problem->setDescribe($describe);
		$problem->setAnswer($answer);
		$problem->setCreatetime($timestamp);
		$problem->setUpdatetime($timestamp);

		$this->entityManager->persist($problem);
		$this->entityManager->flush();

		return $problem->getId();
	}

	public function del(int $id) : bool
	{
		$model = $this->entityManager->find($this->objectName, $id);
		$this->entityManager->remove($model);
		$this->entityManager->flush();
		return true;
	}

	public function get(int $id) : ?Problem
	{
		return $this->entityManager->find($this->objectName, $id);
	}

	public function getFromSubjectid(int $subjectid) : ?array
	{
		$knowledgeDao = new KnowledgeDao($this->entityManager);
		$knowledgeObjectName = $knowledgeDao->getObjectName();
		$expr = $this->entityManager->getExpressionBuilder();
		$ret = $this->entityManager
					->createQueryBuilder()
					->select('a')
					->from($this->objectName, 'a')
					->where($expr->in(
							'a.knowledgeid',
							$this->entityManager->createQueryBuilder()
								->select('b.id')
								->from($knowledgeObjectName, 'b')
								->where('b.subjectid = :subjectid')
								->getDQL()
							)
						)
					->getQuery()
					->setParameter('subjectid', $subjectid)
					->getArrayResult();
		// $dql = "SELECT a FROM GPojectPHP\Models\Problem a WHERE a.knowledgeid IN(SELECT b.id FROM GPojectPHP\Models\knowledge b WHERE b.subjectid = :subjectid";
		if ($this->isEmpty($ret))
		{
			return null;
		}
		// var_dump($ret);
		return $ret;
	}
}

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

	/**
	 * 根据学科 id 获取题目列表
	 */
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

	/**
	 * 检测习题的答案是否正确
	 */
	public function checkAnswer(array $answer) : ?array
	{
		$answerLen = count($answer);

		$answerId = [];
		foreach ($answer as $item)
		{
			array_push($answerId, $item['id']);
		}

		// 获取题目
		$expr = $this->entityManager->getExpressionBuilder();
		$ret = $this->entityManager
					->createQueryBuilder()
					->select('a')
					->from($this->objectName, 'a')
					->where("a.id IN(:id)")
					->getQuery()
					->setParameter('id', $answerId)
					->getArrayResult();

		$right = []; // 正确的题目
		$wrong = []; // 错误的题目
		// 第一层循环是提交的题目
		for ($i = 0; $i < $answerLen; $i++)
		{
			// 第二层循环是从数据库获取的题目
			for ($j = 0, $len = count($ret); $j < $len; $j++)
			{
				// 找到需要对应的题目，两个题目id一致的
				if ($answer[$i]['id'] == $ret[$j]['id'])
				{	
					// 获取题目类型
					$type = $answer[$i]['type'];
					if ($type == 1 || $type == 2)
					{
						// 选择题或判断题
						if ($answer[$i]['answer'] == $ret[$j]['answer'])
						{
							array_push($right, $ret[$j]);
						}
						else
						{
							array_push($wrong, $ret[$j]);
						}
					}
					else
					{
						// 填空题

						// 判断填空的数量是否一致
						$key1 = $answer[$i]['answer'];
						$key2 = explode(',', trim($ret[$j]['answer']));
						$key1Len = count($key1);
						$key2Len = count($key2);

						if ($key1Len != $key2Len)
						{
							array_push($wrong, $ret[$j]);
							continue;
						}

						// 判断每一个空的答案是否一致
						$flg = false;
						for ($k = 0; $k < $key2Len; $k++)
						{
							if ($key1[$k] != $key2[$k])
							{
								array_push($wrong, $ret[$j]);
								$flg = true;
								break;
							}
						}
						if ($flg)
						{
							continue;
						}

						array_push($right, $ret[$j]);
					}
				}
			}
		}

		return ['right' => $right, 'wrong' => $wrong];
	}
}

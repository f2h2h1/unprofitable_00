<?php
namespace GPojectPHP\Dao;


class MainDao
{
	protected $entityManager;

	protected $errMsg;
	protected $errCode;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
	}

	protected function isEmpty($retult) : bool
	{
		if (!(is_array($retult) && count($retult) > 0))
		{
			return true;
		}
		return false;
	}

	protected function setErr()
	{

	}

	public function getLastErr()
	{

	}

	public function getObjectName() : string
	{
		return $this->objectName;
	}

	public function getArray(int $id) : ?array
	{
		$ret = $this->entityManager
					->createQueryBuilder()
					->select('a')
					->from($this->objectName, 'a')
					->where('a.id = :id')
					->getQuery()
					->setParameter('id', $id)
					->setMaxResults(1)
					->getArrayResult();
		if (count($ret) === 0)
		{
			return null;
		}
		return $ret[0];
	}
}

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
}

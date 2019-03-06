<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Container;
use GPojectPHP\Models\Classes;

class ClassesDao extends MainDao
{
	protected $objectName = 'GPojectPHP\Models\Classes';

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

	public function add(string $classesName, string $number) : ?int
	{
		$timestamp = time();
		$classes = new Classes();
		$classes->setName($classesName);
		$classes->setNumber($number);
		$classes->setCreatetime($timestamp);

		$this->entityManager->persist($classes);
		$this->entityManager->flush();

		return $classes->getId();
	}

	public function del(int $id) : bool
	{
		$model = $this->entityManager->find($this->objectName, $id);

		$studentDao = new StudentDao($this->entityManager);
		$studentList = $studentDao->list($model->getId());
		if (!$this->isEmpty($studentList))
		{
			foreach ($studentList as $item)
			{
				$studentDao->del($item->getId());
			}
		}

		$this->entityManager->remove($model);
		$this->entityManager->flush();

		return true;
	}
}

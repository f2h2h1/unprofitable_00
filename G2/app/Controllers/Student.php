<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Dao\SubjectDao;
use GPojectPHP\Dao\StudymaterialsDao;
use GPojectPHP\Dao\KnowledgeDao;
use GPojectPHP\Dao\ProblemDao;

class Student extends Main
{
	public function studymaterialsList() : ?string
	{
		$studymaterialsDao = new StudymaterialsDao($this->container->get('entityManager'));
		$modelList = $studymaterialsDao->list();

		$subjectDao = new SubjectDao($this->container->get('entityManager'));
		$subjectList = $subjectDao->list();

		return $this->view(['modelList' => $modelList, 'subjectList' => $subjectList]);
	}

	public function subjectList() : ?string
	{
		$subjectDao = new SubjectDao($this->container->get('entityManager'));
		$modelList = $subjectDao->list();
		return $this->view(['modelList' => $modelList]);
	}

	public function knowledgeList() : ?string
	{
		$id = (int)$_GET['id'];

		$knowledgeDao = new KnowledgeDao($this->container->get('entityManager'));
		$modelList = $knowledgeDao->list($id);

		return $this->view(['modelList' => $modelList]);
	}

	public function exercises() : ?string
	{
		$id = (int)$_GET['id'];

		$problemDao = new ProblemDao($this->container->get('entityManager'));
		$modelList = $problemDao->list($id);

		return $this->view(['modelList' => $modelList]);
	}

	public function result() : ?string
	{
		$answer = $_POST['answer'];
		$answer = json_decode($answer, true);

		$problemDao = new ProblemDao($this->container->get('entityManager'));
		$ret = $problemDao->checkAnswer($answer);
		// var_dump($ret);

		// return $_POST['answer'];

		$wrong = $ret['wrong'];
		$right = $ret['right'];
		$correctProbability = count($wrong) / (count($right) + count($wrong));

		return $this->view(['correctProbability' => $correctProbability, 'modelList' => $wrong]);
	}
}

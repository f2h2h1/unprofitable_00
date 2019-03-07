<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Container;
use GPojectPHP\Dao\ExamDao;
use GPojectPHP\Dao\SubjectDao;
use GPojectPHP\Dao\TeacherDao;
use GPojectPHP\Dao\ProblemDao;
use GPojectPHP\Dao\KnowledgeDao;

class Exam extends Main
{
	public function examList() : ?string
	{
		$examDao = new ExamDao($this->container->get('entityManager'));
		$modelList = $examDao->list();

		$subjectDao = new SubjectDao($this->container->get('entityManager'));
		$subjectList = $subjectDao->list();

		return $this->view(['modelList' => $modelList, 'subjectList' => $subjectList]);
	}

	public function examCreate() : ?string
	{
		if (IS_GET)
		{
			$subjectDao = new SubjectDao($this->container->get('entityManager'));
			$subjectList = $subjectDao->list();

			return $this->view(['subjectList' => $subjectList]);
		}
		else
		{
			$name = $_POST['name'];
			$subjectid = (int)$_POST['subjectid'];
			$type = (int)$_POST['type'];
			$question = $_POST['question'];

			$teacherDao = new TeacherDao($this->container->get('entityManager'));
			$teacher = $teacherDao->getFromUserid($this->user->getId());
			$teacherid = $teacher->getId();

			$examDao = new ExamDao($this->container->get('entityManager'));
			$examDao->add($name, $subjectid, $type, $question, $teacherid);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('examList');
		}
	}

	public function getQuestionList() : ?string
	{
		$subjectid = (int)$_GET['subjectid'];

		$problemDao = new ProblemDao($this->container->get('entityManager'));
		$problemList = $problemDao->getFromSubjectid($subjectid);

		$knowledgeDao = new KnowledgeDao($this->container->get('entityManager'));
		$knowledgeList = $knowledgeDao->list($subjectid);

		for ($i = 0, $len = count($problemList); $i < $len; $i++)
		{
			foreach ($knowledgeList as $item)
			{
				$knowledgeid = $item->getId();
				if ($knowledgeid == $problemList[$i]['knowledgeid'])
				{
					$problemList[$i]['knowledge'] = $item->getName();
				}
			}
		}

		return json_encode($problemList, JSON_UNESCAPED_UNICODE);
	}

	public function examEdit() : ?string
	{
		if (IS_GET)
		{
		}
		else
		{
		}
	}

	public function examDetails() : ?string
	{

	}

	public function examDelete() : ?string
	{

	}
}

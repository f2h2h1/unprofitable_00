<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Dao\ExamDao;
use GPojectPHP\Dao\SubjectDao;
use GPojectPHP\Dao\TeacherDao;
use GPojectPHP\Dao\ProblemDao;
use GPojectPHP\Dao\KnowledgeDao;

/**
 * 考核相关控制器
 */
class Exam extends Main
{
	/**
	 * 考核列表
	 */
	public function examList() : ?string
	{
		$examDao = new ExamDao($this->entityManager);
		$modelList = $examDao->list();

		$subjectDao = new SubjectDao($this->entityManager);
		$subjectList = $subjectDao->list();

		return $this->view(['modelList' => $modelList, 'subjectList' => $subjectList]);
	}

	/**
	 * 添加考核
	 */
	public function examCreate() : ?string
	{
		if (IS_GET)
		{
			$subjectDao = new SubjectDao($this->entityManager);
			$subjectList = $subjectDao->list();

			return $this->view(['subjectList' => $subjectList]);
		}
		else
		{
			$name = $_POST['name'];
			$subjectid = (int)$_POST['subjectid'];
			$type = (int)$_POST['type'];
			$question = $_POST['question'];

			$teacherDao = new TeacherDao($this->entityManager);
			$teacher = $teacherDao->getFromUserid($this->user->getId());
			$teacherid = $teacher->getId();

			$examDao = new ExamDao($this->entityManager);
			$examDao->add($name, $subjectid, $type, $question, $teacherid);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('examList');
		}
	}

	/**
	 * 获取题目列表
	 */
	public function getQuestionList() : ?string
	{
		$subjectid = (int)$_GET['subjectid'];

		$problemDao = new ProblemDao($this->entityManager);
		$problemList = $problemDao->getFromSubjectid($subjectid);

		$knowledgeDao = new KnowledgeDao($this->entityManager);
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

		header('Content-Type:application/json; charset=utf-8');
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
		return null;
	}

	/**
	 * 考核详细
	 */
	public function examDetails() : ?string
	{
		$id = (int)$_GET['id'];
		$examDao = new ExamDao($this->entityManager);
		$exam = $examDao->get($id);

		$questionList = [];
		if ($exam->getType() === 1)
		{
			$question = $exam->getQuestion();
			$question = explode(",", $question);
			$problemDao = new ProblemDao($this->entityManager);
			foreach ($question as $item)
			{
				array_push($questionList, $problemDao->getArray($item));
			}
		}

		$subjectDao = new SubjectDao($this->entityManager);
		$subjectList = $subjectDao->list();
		$a = json_encode($questionList, JSON_UNESCAPED_UNICODE);
		return $this->view(['exam' => $exam, 'subjectList' => $subjectList, 'questionList' => $questionList]);
	}

	/**
	 * 删除考核
	 */
	public function examDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$examDao = new ExamDao($this->entityManager);
		$examDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('examList');
	}
}

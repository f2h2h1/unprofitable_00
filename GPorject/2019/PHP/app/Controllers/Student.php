<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Dao\SubjectDao;
use GPojectPHP\Dao\StudymaterialsDao;
use GPojectPHP\Dao\KnowledgeDao;
use GPojectPHP\Dao\ProblemDao;
use GPojectPHP\Dao\ExamDao;
use GPojectPHP\Dao\HomeworkDao;
use GPojectPHP\Dao\ScoreDao;

/**
 * 学生相关控制器
 */
class Student extends Main
{
	#region 练习

	/**
	 * 学科列表
	 */
	public function subjectList() : ?string
	{
		$subjectDao = new SubjectDao($this->entityManager);
		$modelList = $subjectDao->list();
		return $this->view(['modelList' => $modelList]);
	}

	/**
	 * 知识点列表
	 */
	public function knowledgeList() : ?string
	{
		$id = (int)$_GET['id'];

		$knowledgeDao = new KnowledgeDao($this->entityManager);
		$modelList = $knowledgeDao->list($id);

		return $this->view(['modelList' => $modelList]);
	}

	/**
	 * 练习
	 */
	public function exercises() : ?string
	{
		$id = (int)$_GET['id'];

		$problemDao = new ProblemDao($this->entityManager);
		$modelList = $problemDao->list($id);

		return $this->view(['modelList' => $modelList]);
	}

	/**
	 * 练习结果
	 */
	public function exercisesResult() : ?string
	{
		$answer = $_POST['answer'];
		$answer = json_decode($answer, true);

		$problemDao = new ProblemDao($this->entityManager);
		$ret = $problemDao->checkAnswer($answer);
		// var_dump($ret);

		// return $_POST['answer'];

		$wrong = $ret['wrong'];
		$right = $ret['right'];
		$correctProbability = count($wrong) / (count($right) + count($wrong));

		return $this->view(['correctProbability' => $correctProbability, 'modelList' => $wrong]);
	}

	#endregion

	#region 考核

	/**
	 * 考核列表
	 */
	public function examList() : ?string
	{
		$examDao = new ExamDao($this->entityManager);
		$modelList = $examDao->list();

		$subjectDao = new SubjectDao($this->entityManager);
		$subjectList = $subjectDao->list();

		$user = $_SESSION['user'];
		$userId = $user->getId(); // 用户id
		$scoreDao = new ScoreDao($this->entityManager);
		$scoreList = $scoreDao->getFromStudentid($userId);


		return $this->view(['modelList' => $modelList, 
			'subjectList' => $subjectList, 'scoreList' => $scoreList]);
	}

	/**
	 * 考核页面
	 */
	public function exam() : ?string
	{
		$id = (int)$_GET['id'];

		$examDao = new ExamDao($this->entityManager);
		$exam = $examDao->get($id); // 根据id获取考核信息

		$examType = (int)$exam->getType(); // 获取考核的类型

		if ($examType === 1)
		{
			// 在线考核

			$problemList = []; // 题目列表
			$problemIdList = explode(',', $exam->getQuestion(), true); // 题目id列表
			$problemDao = new ProblemDao($this->entityManager);
			foreach ($problemIdList as $problemId)
			{
				$problem = $problemDao->get((int)$problemId); // 通过题目id获取到题目
				array_push($problemList, $problem); // 把题目加入到题目列表
			}
	
			return $this->view(['modelList' => $problemList, 'exam' => $exam], 'examOnline');
		}
		else
		{
			// 上传作业
			return $this->view(['model' => $exam], 'examUpload');
		}


	}

	/**
	 * 考核结果页面
	 */
	public function examResult() : ?string
	{
		$id = (int)$_GET['id']; // 考核id
		if (isset($_POST['answer']))
		{
			$answer = $_POST['answer']; // 答案
			$answer = json_decode($answer, true);
		}
		$user = $_SESSION['user'];
		$userId = $user->getId(); // 用户id

		if (isset($_FILES['attachment']))
		{
			$attachment = $_FILES['attachment']; // 上传附件
			$filename = $attachment['name'];
			if (strpos($filename, '.'))
			{
				$filename_len = strlen($filename);
				$ext = substr($filename, $filename_len-($filename_len-strripos($filename, '.')-1));
			}
			else
			{
				$ext = '';
			}
			$savePath = '/upload/'.time().random_int(1000, 9999).'.'.$ext;
			move_uploaded_file($attachment['tmp_name'], POJECT_ROOT.$savePath);

			$homeworkDao = new HomeworkDao($this->entityManager);
			$homeworkDao->add($filename, $id, $userId, $savePath);
		}
		else
		{
			$problemDao = new ProblemDao($this->entityManager);
			$ret = $problemDao->checkAnswer($answer);

			$wrong = $ret['wrong'];
			$right = $ret['right'];
			$correctProbability = count($right) / count($answer);

			$scoreDao = new ScoreDao($this->entityManager);
			$scoreDao->add($id, $userId, (int)$correctProbability);
		}

		$this->setAlertMsg('提交成功', 'success');
		return $this->redirect('Student/examList');;
	}

	#endregion

	#region 下载资料

	/**
	 * 学习资料列表
	 */
	public function studymaterialsList() : ?string
	{
		$studymaterialsDao = new StudymaterialsDao($this->entityManager);
		$modelList = $studymaterialsDao->list();

		$subjectDao = new SubjectDao($this->entityManager);
		$subjectList = $subjectDao->list();

		return $this->view(['modelList' => $modelList, 'subjectList' => $subjectList]);
	}

	#endregion
}

<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Dao\KnowledgeDao;
use GPojectPHP\Dao\SubjectDao;
use GPojectPHP\Dao\StudymaterialsDao;
use GPojectPHP\Dao\TeacherDao;
use GPojectPHP\Dao\ProblemDao;

/**
 * 知识点相关控制器
 */
class Knowledge extends Main
{
	#region 知识点管理

	/**
	 * 知识点列表
	 */
	public function knowledgeList() : ?string
	{
		$knowledgeDao = new KnowledgeDao($this->entityManager);
		$modelList = $knowledgeDao->list();

		$subjectDao = new SubjectDao($this->entityManager);
		$subjectList = $subjectDao->list();

		return $this->view(['modelList' => $modelList, 'subjectList' => $subjectList]);
	}


	/**
	 * 添加知识点
	 */
	public function knowledgeCreate() : ?string
	{
		if (IS_GET)
		{
			$subjectDao = new SubjectDao($this->entityManager);
			$subjectList = $subjectDao->list();

			return $this->view(['subjectList' => $subjectList]);
		}
		else
		{
			$subjectid = (int)$_POST['subjectid'];
			$name = $_POST['name'];
			$describe = $_POST['describe'];

			$knowledgeDao = new KnowledgeDao($this->entityManager);
			$knowledgeDao->add($subjectid, $name, $describe);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('knowledgeList');
		}
	}

	// public function knowledgeDetails() : ?string
	// {

	// }

	/**
	 * 编辑知识点
	 */
	public function knowledgeEdit() : ?string
	{
		if (IS_GET)
		{
			$id = (int)$_GET['id'];

			$knowledgeDao = new KnowledgeDao($this->entityManager);
			$knowledge = $knowledgeDao->get($id);

			$subjectDao = new SubjectDao($this->entityManager);
			$subjectList = $subjectDao->get($knowledge->getSubjectid());

			return $this->view(['model' => $knowledge, 'subjectList' => $subjectList]);
		}
		else
		{
			$id = (int)$_POST['id'];
			$name = $_POST['name'];
			$describe = $_POST['describe'];

			$knowledgeDao = new KnowledgeDao($this->entityManager);
			$knowledgeDao->update($id, $name, $describe);

			$this->setAlertMsg('保存成功', 'success');
			return $this->redirect('knowledgeList');
		}
	}

	/**
	 * 删除知识点
	 */
	public function knowledgeDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$knowledgeDao = new KnowledgeDao($this->entityManager);
		$knowledgeDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('knowledgeList');
	}

	#endregion

	#region 学习资料管理

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

	/**
	 * 添加学习资料
	 */
	public function studymaterialsCreate() : ?string
	{
		if (IS_GET)
		{
			$subjectDao = new SubjectDao($this->entityManager);
			$subjectList = $subjectDao->list();

			return $this->view(['subjectList' => $subjectList]);
		}
		else
		{
			$subjetid = (int)$_POST['subjetid'];
			// $name = $_POST['name'];
			$attachment = $_FILES['attachment'];

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

			$teacherDao = new TeacherDao($this->entityManager);
			$teacher = $teacherDao->getFromUserid($this->user->getId());

			$studymaterialsDao = new StudymaterialsDao($this->entityManager);
			$studymaterialsDao->add($subjetid, $filename, $savePath, $teacher->getId());

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('studymaterialsList');
		}
	}

	/**
	 * 下载学习资料
	 */
	public function studymaterialsDownload() : ?string
	{
		$id = (int)$_GET['id'];

		$studymaterialsDao = new StudymaterialsDao($this->entityManager);
		$studymaterials = $studymaterialsDao->get($id);

		$filepath = POJECT_ROOT.$studymaterials->getPath();
		$file = file_get_contents($filepath);
		$filename = $studymaterials->getName();

		header("Content-type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header("Accept-Length: ".strlen($file));
		header("Content-Disposition: attachment; filename=".$filename);

		return $file;
	}

	/**
	 * 删除学习资料
	 */
	public function studymaterialsDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$studymaterialsDao = new StudymaterialsDao($this->entityManager);
		$studymaterials = $studymaterialsDao->get($id);
		$studymaterialsDao->del($id);
		unlink(POJECT_ROOT.$studymaterials->getPath());

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('studymaterialsList');
	}

	#endregion

	#region 习题管理

	/**
	 * 习题列表
	 */
	public function problemList() : ?string
	{
		$knowledgeid = (int)$_GET['knowledgeid'];

		$problemDao = new ProblemDao($this->entityManager);
		$modelList = $problemDao->list($knowledgeid);

		return $this->view(['modelList' => $modelList, 'knowledgeid' => $knowledgeid]);
	}

	/**
	 * 添加习题
	 */
	public function problemCreate() : ?string
	{
		if (IS_GET)
		{
			$knowledgeid = (int)$_GET['knowledgeid'];
			return $this->view(['knowledgeid' => $knowledgeid]);
		}
		else
		{
			$knowledgeid = $_POST['knowledgeid'];
			$name = $_POST['name'];
			$type = $_POST['type'];
			$describe = $_POST['describe'];
			$answer = $_POST['answer'];

			$problemDao = new ProblemDao($this->entityManager);
			$problemDao->add($knowledgeid, $name, $type, $describe, $answer);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('problemList', ['knowledgeid' => $knowledgeid]);
		}
	}

	// public function problemEdit() : ?string
	// {
	// 	if (IS_GET)
	// 	{
	// 		$id = (int)$_GET['id'];

	// 		$problemDao = new ProblemDao($this->entityManager);
	// 		$problem = $problemDao->get($id);

	// 		$this->view(['model' => $problem]);
	// 	}
	// 	else
	// 	{
	// 	}
	// }

	/**
	 * 习题详细
	 */
	public function problemDetails() : ?string
	{
		$id = (int)$_GET['id'];

		$problemDao = new ProblemDao($this->entityManager);
		$problem = $problemDao->get($id);

		return $this->view(['model' => $problem]);
	}

	/**
	 * 删除习题
	 */
	public function problemDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$problemDao = new ProblemDao($this->entityManager);
		$problemDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->goback();
	}

	#endregion
}

<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Container;
use GPojectPHP\Dao\KnowledgeDao;
use GPojectPHP\Dao\SubjectDao;
use GPojectPHP\Dao\StudymaterialsDao;
use GPojectPHP\Dao\TeacherDao;
use GPojectPHP\Dao\ProblemDao;

class Knowledge extends Main
{
	#region 知识点管理

	public function knowledgeList() : ?string
	{
		$knowledgeDao = new KnowledgeDao($this->container->get('entityManager'));
		$modelList = $knowledgeDao->list();

		$subjectDao = new SubjectDao($this->container->get('entityManager'));
		$subjectList = $subjectDao->list();

		return $this->view(['modelList' => $modelList, 'subjectList' => $subjectList]);
	}

	public function knowledgeCreate() : ?string
	{
		if (IS_GET)
		{
			$subjectDao = new SubjectDao($this->container->get('entityManager'));
			$subjectList = $subjectDao->list();

			return $this->view(['subjectList' => $subjectList]);
		}
		else
		{
			$subjectid = (int)$_POST['subjectid'];
			$name = $_POST['name'];
			$describe = $_POST['describe'];

			$knowledgeDao = new KnowledgeDao($this->container->get('entityManager'));
			$knowledgeDao->add($subjectid, $name, $describe);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('knowledgeList');
		}
	}

	// public function knowledgeDetails() : ?string
	// {

	// }

	public function knowledgeEdit() : ?string
	{
		if (IS_GET)
		{
			$id = (int)$_GET['id'];

			$knowledgeDao = new KnowledgeDao($this->container->get('entityManager'));
			$knowledge = $knowledgeDao->get($id);

			$subjectDao = new SubjectDao($this->container->get('entityManager'));
			$subjectList = $subjectDao->get($knowledge->getSubjectid());

			return $this->view(['model' => $knowledge, 'subjectList' => $subjectList]);
		}
		else
		{
			$id = (int)$_POST['id'];
			$name = $_POST['name'];
			$describe = $_POST['describe'];

			$knowledgeDao = new KnowledgeDao($this->container->get('entityManager'));
			$knowledgeDao->update($id, $name, $describe);

			$this->setAlertMsg('保存成功', 'success');
			return $this->redirect('knowledgeList');
		}
	}

	public function knowledgeDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$knowledgeDao = new KnowledgeDao($this->container->get('entityManager'));
		$knowledgeDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('knowledgeList');
	}

	#endregion

	#region 学习资料管理

	public function studymaterialsList() : ?string
	{
		$studymaterialsDao = new StudymaterialsDao($this->container->get('entityManager'));
		$modelList = $studymaterialsDao->list();

		$subjectDao = new SubjectDao($this->container->get('entityManager'));
		$subjectList = $subjectDao->list();

		return $this->view(['modelList' => $modelList, 'subjectList' => $subjectList]);
	}

	public function studymaterialsCreate() : ?string
	{
		if (IS_GET)
		{
			$subjectDao = new SubjectDao($this->container->get('entityManager'));
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
			$savePath = POJECT_ROOT.'/upload/'.time().random_int(1000, 9999).'.'.$ext;
			move_uploaded_file($attachment['tmp_name'], $savePath);

			$teacherDao = new TeacherDao($this->container->get('entityManager'));
			$teacher = $teacherDao->getFromUserid($this->user->getId());

			$studymaterialsDao = new StudymaterialsDao($this->container->get('entityManager'));
			$studymaterialsDao->add($subjetid, $filename, $savePath, $teacher->getId());

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('studymaterialsList');
		}
	}

	public function studymaterialsDownload() : ?string
	{
		$id = (int)$_GET['id'];

		$studymaterialsDao = new StudymaterialsDao($this->container->get('entityManager'));
		$studymaterials = $studymaterialsDao->get($id);

		$file = file_get_contents($studymaterials->getPath());
		$filename = $studymaterials->getName();

		header("Content-type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header("Accept-Length: ".strlen($file));
		header("Content-Disposition: attachment; filename=".$filename);

		return $file;
	}

	public function studymaterialsDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$studymaterialsDao = new StudymaterialsDao($this->container->get('entityManager'));
		$studymaterials = $studymaterialsDao->get($id);
		$studymaterialsDao->del($id);
		unlink($studymaterials->getPath());

		$this->setAlertMsg('删除成功', 'success');
		return $this->redirect('studymaterialsList');
	}

	#endregion

	#region 习题管理

	public function problemList() : ?string
	{
		$knowledgeid = (int)$_GET['knowledgeid'];

		$problemDao = new ProblemDao($this->container->get('entityManager'));
		$modelList = $problemDao->list($knowledgeid);

		return $this->view(['modelList' => $modelList, 'knowledgeid' => $knowledgeid]);
	}

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

			$problemDao = new ProblemDao($this->container->get('entityManager'));
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

	// 		$problemDao = new ProblemDao($this->container->get('entityManager'));
	// 		$problem = $problemDao->get($id);

	// 		$this->view(['model' => $problem]);
	// 	}
	// 	else
	// 	{
	// 	}
	// }

	public function problemDetails() : ?string
	{
		$id = (int)$_GET['id'];

		$problemDao = new ProblemDao($this->container->get('entityManager'));
		$problem = $problemDao->get($id);

		return $this->view(['model' => $problem]);
	}

	public function problemDelete() : ?string
	{
		$id = (int)$_POST['id'];

		$problemDao = new ProblemDao($this->container->get('entityManager'));
		$problemDao->del($id);

		$this->setAlertMsg('删除成功', 'success');
		return $this->goback();
	}

	#endregion
}

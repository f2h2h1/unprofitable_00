<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Container;
use GPojectPHP\Dao\KnowledgeDao;
use GPojectPHP\Dao\SubjectDao;
use GPojectPHP\Dao\StudymaterialsDao;
use GPojectPHP\Dao\TeacherDao;

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
			$subjetid = (int)$_POST['subjetid'];
			$name = $_POST['name'];
			$describe = $_POST['describe'];

			$knowledgeDao = new KnowledgeDao($this->container->get('entityManager'));
			$knowledgeDao->add($subjetid, $name, $describe);

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
			$subjectList = $subjectDao->get($knowledge->getSubjetid());

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

	public function knowledgeDetele() : ?string
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
		$studymaterials = new StudymaterialsDao($this->container->get('entityManager'));
		$modelList = $studymaterials->list();

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
			$name = $_POST['name'];
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


			$studymaterials = new StudymaterialsDao($this->container->get('entityManager'));
			$studymaterials->add($subjetid, $name, $savePath, $teacher->getId());

			// $savePath = POJECT_ROOT.'/upload/'.time().'';
			// move_uploaded_file($attachment['tmp_name'], );
			// $knowledgeDao = new KnowledgeDao($this->container->get('entityManager'));
			// $knowledgeDao->add($subjetid, $name, $describe);

			$this->setAlertMsg('添加成功', 'success');
			return $this->redirect('studymaterialsList');
		}
	}

	public function studymaterialsDownload() : ?string
	{

	}

	public function studymaterialsDelete() : ?string
	{

	}

	#endregion
}

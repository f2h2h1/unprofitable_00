<?php

namespace GPojectPHP\Models;

/**
 * @Entity
 * @Table(name="exam")
 */
class Exam
{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;

	/**
	 * @Column(type="string")
	 */
	private $name;

	/**
	 * @Column(type="integer")
	 */
	private $type;

	/**
	 * @Column(type="integer")
	 */
	private $teacherid;

	/**
	 * @Column(type="integer")
	 */
	private $subjectid;

	/**
	 * @Column(type="integer")
	 */
	private $createtime;


	/**
	 * Get id.
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set name.
	 *
	 * @param string $name
	 *
	 * @return Exam
	 */
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}

	/**
	 * Get name.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set type.
	 *
	 * @param int $type
	 *
	 * @return Exam
	 */
	public function setType($type)
	{
		$this->type = $type;
	
		return $this;
	}

	/**
	 * Get type.
	 *
	 * @return int
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set teacherid.
	 *
	 * @param int $teacherid
	 *
	 * @return Exam
	 */
	public function setTeacherid($teacherid)
	{
		$this->teacherid = $teacherid;
	
		return $this;
	}

	/**
	 * Get teacherid.
	 *
	 * @return int
	 */
	public function getTeacherid()
	{
		return $this->teacherid;
	}

	/**
	 * Set subjectid.
	 *
	 * @param int $subjectid
	 *
	 * @return Exam
	 */
	public function setSubjectid($subjectid)
	{
		$this->subjectid = $subjectid;
	
		return $this;
	}

	/**
	 * Get subjectid.
	 *
	 * @return int
	 */
	public function getSubjectid()
	{
		return $this->subjectid;
	}

	/**
	 * Set createtime.
	 *
	 * @param int $createtime
	 *
	 * @return Exam
	 */
	public function setCreatetime($createtime)
	{
		$this->createtime = $createtime;
	
		return $this;
	}

	/**
	 * Get createtime.
	 *
	 * @return int
	 */
	public function getCreatetime()
	{
		return $this->createtime;
	}
}

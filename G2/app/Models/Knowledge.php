<?php

namespace GPojectPHP\Models;

/**
 * @Entity
 * @Table(name="knowledge")
 */
class Knowledge
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
	 * @Column(type="string")
	 */
	private $describe;

	/**
	 * @Column(type="integer")
	 */
	private $subjectid;

	/**
	 * @Column(type="integer")
	 */
	private $createtime;

	/**
	 * @Column(type="integer")
	 */
	private $updatetime;


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
	 * @return Knowledge
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
	 * Set describe.
	 *
	 * @param string $describe
	 *
	 * @return Knowledge
	 */
	public function setDescribe($describe)
	{
		$this->describe = $describe;
	
		return $this;
	}

	/**
	 * Get describe.
	 *
	 * @return string
	 */
	public function getDescribe()
	{
		return $this->describe;
	}

	/**
	 * Set subjetid.
	 *
	 * @param int $subjectid
	 *
	 * @return Knowledge
	 */
	public function setSubjectid($subjectid)
	{
		$this->subjectid = $subjectid;
	
		return $this;
	}

	/**
	 * Get subjetid.
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
	 * @return Knowledge
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

	/**
	 * Set updatetime.
	 *
	 * @param int $updatetime
	 *
	 * @return Knowledge
	 */
	public function setUpdatetime($updatetime)
	{
		$this->updatetime = $updatetime;
	
		return $this;
	}

	/**
	 * Get updatetime.
	 *
	 * @return int
	 */
	public function getUpdatetime()
	{
		return $this->updatetime;
	}
}

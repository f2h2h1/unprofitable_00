<?php

namespace GPojectPHP\Models;

/**
 * @Entity
 * @Table(name="student")
 */
class Student
{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;

	/**
	 * @Column(type="integer")
	 */
	private $userid;

	/**
	 * @Column(type="string")
	 */
	private $name;

	/**
	 * @Column(type="integer")
	 */
	private $classid;

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
	 * Set userid.
	 *
	 * @param int $userid
	 *
	 * @return Student
	 */
	public function setUserid($userid)
	{
		$this->userid = $userid;
	
		return $this;
	}

	/**
	 * Get userid.
	 *
	 * @return int
	 */
	public function getUserid()
	{
		return $this->userid;
	}

	/**
	 * Set name.
	 *
	 * @param string $name
	 *
	 * @return Student
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
	 * Set classid.
	 *
	 * @param int $classid
	 *
	 * @return Student
	 */
	public function setClassid($classid)
	{
		$this->classid = $classid;
	
		return $this;
	}

	/**
	 * Get classid.
	 *
	 * @return int
	 */
	public function getClassid()
	{
		return $this->classid;
	}

	/**
	 * Set createtime.
	 *
	 * @param int $createtime
	 *
	 * @return Student
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

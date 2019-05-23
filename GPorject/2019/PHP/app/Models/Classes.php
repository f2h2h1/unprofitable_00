<?php

namespace GPojectPHP\Models;

/**
 * @Entity
 * @Table(name="classes")
 */
class Classes
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
	private $number;

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
	 * @return Classes
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
	 * Set number.
	 *
	 * @param int $number
	 *
	 * @return Classes
	 */
	public function setNumber($number)
	{
		$this->number = $number;
	
		return $this;
	}

	/**
	 * Get number.
	 *
	 * @return int
	 */
	public function getNumber()
	{
		return $this->number;
	}

	/**
	 * Set createtime.
	 *
	 * @param int $createtime
	 *
	 * @return Classes
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

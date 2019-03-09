<?php

namespace GPojectPHP\Models;

/**
 * @Entity
 * @Table(name="user")
 */
class User
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
	private $password;

	/**
	 * @Column(type="integer")
	 */
	private $role;

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
	 * @return User
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
	 * Set password.
	 *
	 * @param string $password
	 *
	 * @return User
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	
		return $this;
	}

	/**
	 * Get password.
	 *
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set role.
	 *
	 * @param int $role
	 *
	 * @return User
	 */
	public function setRole($role)
	{
		$this->role = $role;
	
		return $this;
	}

	/**
	 * Get role.
	 *
	 * @return int
	 */
	public function getRole()
	{
		return $this->role;
	}

	/**
	 * Set createtime.
	 *
	 * @param int $createtime
	 *
	 * @return User
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
	 * @return User
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

<?php
namespace GPojectPHP\Dao;

use GPojectPHP\Models\User;

class UserDao extends MainDao
{
	private $objectName = 'GPojectPHP\Models\User';

	public function login(string $name, string $password) : ?User
	{
		$dql = "SELECT a FROM {$this->objectName} a WHERE a.name = :name AND a.password = :password";
		$ret = $this->entityManager->createQuery($dql)
							->setParameter('name', $name)
							->setParameter('password', $password)
							->setMaxResults(1)
							->getResult();
		if ($this->isEmpty($ret))
		{
			return null;
		}
		return $ret[0];
	}

	public function getUserList() : ?array
	{
		$dql = "SELECT a FROM {$this->objectName} a";
		$ret = $this->entityManager->createQuery($dql)
							->getResult();
		if ($this->isEmpty($ret))
		{
			return null;
		}
		return $ret;
	}

	public function getUser(int $id) : ?User
	{
		$dql = "SELECT a FROM {$this->objectName} a WHERE a.id = :id";
		$ret = $this->entityManager->createQuery($dql)
							->setParameter('id', $id)
							->setMaxResults(1)
							->getResult();
		if ($this->isEmpty($ret))
		{
			return null;
		}
		return $ret[0];
	}

	public function changePassword(int $id, string $oldPassword, string $newPassword) : bool
	{
		$user = $this->entityManager->find($this->objectName, $id);

		if ($user === null)
		{
			return false;
		}
		if ($oldPassword !== $user->getPassword())
		{
			return false;
		}
		$user->setPassword($newPassword);
		$this->entityManager->flush();

		return true;
	}

	public function add(string $username, string $password, int $role) : ?int
	{
		$timestamp = time();
		$user = new User();
		$user->setName($username);
		$user->setPassword($password);
		$user->setRole($role);
		$user->setCreatetime($timestamp);
		$user->setUpdatetime($timestamp);

		$this->entityManager->persist($user);
		$this->entityManager->flush();

		return $user->getId();
	}

	public function del(int $id) : bool
	{
		$user = $this->entityManager->find($this->objectName, $id);
		$this->entityManager->remove($user);
		$this->entityManager->flush();
		return true;
	}
}

<?php
declare(strict_types=1);

class Container
{
	private $bind = [];

	public function set($className, $param = [], $alias = '') : void
	{
		// 判断类是否存在
		if (!class_exists($className))
		{
			return;
		}

		// 通过反射获取反射类
		$reflectionClass = new ReflectionClass($className);

		// 查看是否可以实例化
		if (!$reflectionClass->isInstantiable())
		{
			throw new \Exception($className . ' 类不可实例化');
		}

		$key = $alias === '' ? $className : $alias;
		$this->bind[$key] = $reflectionClass->newInstanceArgs($param);
	}

	public function get($key) : ?object
	{
		if ($this->has($key))
		{
			return $this->bind[$key];
		}
		return null;
	}

	public function has($key) : bool
	{
		if (isset($this->bind[$key]))
		{
			return true;
		}
		return false;
	}
}

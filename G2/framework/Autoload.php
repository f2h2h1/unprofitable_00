<?php

// 自动加载
$throw = true;
$prepend = true;
spl_autoload_register(function ($class) use ($config)
{
	$class = explode('\\', $class);
	$module = $class[1];
	$className = $class[2];

	if ($module === 'Controllers')
	{
		$folderPath = $config['path']['controller'];
	}
	else if ($module === 'Models')
	{
		$folderPath = $config['path']['model'];
	}
	else if ($module === 'Dao')
	{
		$folderPath = $config['path']['dao'];
	}
	else
	{
		return;
	}

	$file = $folderPath . $className . '.php';
	if (is_file($file))
	{
		require_once($file);
	}
}, $throw, $prepend);

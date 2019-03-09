<?php
namespace GPojectPHP;

class Route
{
	private $container;
	private $config;

	public function __construct(array $config, Container $container)
	{
		$this->config = $config;
		$this->container = $container;
	}

	public function getConfig() : array
	{
		return $this->config;
	}

	public function getContainer() : Container
	{
		return $this->container;
	}

	public function run()
	{
		$route = $_GET['r'] ?? 'Home/index';
		$route = explode('/', $route);

		$controller = empty($route[0]) ? 'Home' : $route[0];
		$action = empty($route[1]) ? 'index' : $route[1];

		$config = $this->getConfig();
		$controllerFolderPath = $config['path']['controller'];
		$controllerFilePath = $controllerFolderPath . $controller . '.php';

		if (!is_file($controllerFilePath))
		{
			$this->error('404');
			return;
		}

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

		$namespaceController = $config['namespace']['controller'];
		$controllerFull = $namespaceController.$controller;

		// 判断类是否存在
		if (!class_exists($controllerFull))
		{
			$this->error('500');
			return;
		}

		// 通过反射获取反射类
		$reflectionClass = new \ReflectionClass($controllerFull);

		$a = $reflectionClass->getParentClass();

		// 查看是否可以实例化
		if (!$reflectionClass->isInstantiable())
		{
			$this->error('500');
			return;
		}
		if (!$reflectionClass->hasMethod($action))
		{
			$this->error('500');
			return;
		}

		$response = ($reflectionClass->newInstanceArgs([$this->config, $this->container, $controller, $action]))->$action();
		echo $response;
	}

	public function error(string $code = '500') : void
	{
		if ($code === '500')
		{
			$str = $code.' Server Error';
		}
		else if ($code === '404')
		{
			$str = $code.' Not Found';
		}

		if (CLI)
		{
			echo PHP_EOL.$str.PHP_EOL;
		}
		else
		{
			header('HTTP/1.1 '.$str);
			header('status: '.$str);
			echo "<h1>{$str}<h1>";
		}
	}
}

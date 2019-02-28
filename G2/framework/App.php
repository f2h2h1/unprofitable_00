<?php
namespace GPojectPHP;

class App
{
	private $container;
	private $config;

	public function __construct(array $config, Container $container)
	{
		$this->config = $config;
		$this->container = $container;
	}

	public function run()
	{
		$route = $_GET['r'] ?? 'Home/index';
		$route = explode('/', $route);
		$controller = $route[1];
		$action = $route[2];

		if (empty($controller))
		{
			$controller = 'Home';
		}

		if (empty($action))
		{
			$action = 'index';
		}

		$controllerPath = CONTROLLER_FOLDER . $controller . '.php';

		if (!is_file($controllerPath))
		{
			header('HTTP/1.1 404 Not Found');
			header("status: 404 Not Found");
			return;
		}

		include($controllerPath);
	}
}
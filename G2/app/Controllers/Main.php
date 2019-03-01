<?php
namespace GPojectPHP\Controllers;

use \GPojectPHP\Container;
use \GPojectPHP\Models\Product;

class Main
{
	protected $config;
	protected $container;
	protected $controller;
	protected $action;

	public function __construct(array $config, Container $container, string $controller, string $action)
	{
		$this->config = $config;
		$this->container = $container;
		$this->controller = $controller;
		$this->action = $action;
	}

	protected function render(string $viewName, array $viewData) : string
	{
		$viewData['website'] = $this->config['website'];
		return $this->container->get('PhpRenderer')->fetch($viewName, $viewData);
	}

	protected function view(array $viewData, string $viewName = '') : string
	{
		if ($viewName === '')
		{
			$viewName = $this->action;
		}
		if (strpos($viewName, '/') === false)
		{
			$viewName = $this->controller.'/'.$viewName.'.php';
		}
		$mainView = '_layout.php';
		$viewData['tpl'] = $this->render($viewName, $viewData);
		return $this->render($mainView, $viewData);
	}
}

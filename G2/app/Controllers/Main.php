<?php
namespace GPojectPHP\Controllers;

use GPojectPHP\Container;

class Main
{
	protected $config;
	protected $container;
	protected $controller;
	protected $action;
	protected $user;

	public function __construct(array $config, Container $container, string $controller, string $action)
	{
		$this->config = $config;
		$this->container = $container;
		$this->controller = $controller;
		$this->action = $action;

		session_start();

		// 请求类型
		$REQUEST_METHOD = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';
		// get 请求
		defined('IS_GET')  OR define('IS_GET', $REQUEST_METHOD === 'GET' ? true : false);
		// post 请求
		defined('IS_POST') OR define('IS_POST', $REQUEST_METHOD === 'POST' ? true : false);
		// ajax 请求
		defined('IS_AJAX') OR define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

		$this->user = $_SESSION['user'] ?? null;

		if ($this->controller !== 'Home')
		{
			if (!$this->isLogin())
			{
				$this->redirect('Home/login');
				exit;
			}
		}
	}

	protected function isLogin() : bool
	{
		return isset($_SESSION['user']) ? true : false;
	}

	protected function render(string $viewName, array $viewData) : string
	{
		return $this->container->get('PhpRenderer')->fetch($viewName, $viewData);
	}

	protected function view(array $viewData = [], string $viewName = '') : string
	{
		if ($viewName === '')
		{
			$viewName = $this->action;
		}
		if (strpos($viewName, '/') === false)
		{
			$viewName = $this->controller.'/'.$viewName.'.php';
		}

		$scriptFullName = $_SERVER['SCRIPT_NAME'];
		$scriptNameLen = strlen($scriptFullName);
		$scriptName = substr($scriptFullName, $scriptNameLen - ($scriptNameLen-strripos($scriptFullName, '/') - 1));
		$urlPath = str_replace($scriptName, "", $scriptFullName);

		$baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' .$_SERVER['SERVER_NAME'] . $urlPath;
		$staticUrl = $baseUrl . 'static/';

		$viewData['baseUrl'] = $baseUrl;
		$viewData['staticUrl'] = $staticUrl;
		$viewData['website'] = $this->config['website'];

		$user = $_SESSION['user'] ?? '';
		if ($user !== '')
		{
			$viewData['userName'] = $user->getName();
			$viewData['userRole'] = $user->getRole();
		}

		if (isset($_SESSION['alertMsg']))
		{
			$viewData['alertMsg'] = $_SESSION['alertMsg'];
			$this->delAlertMsg();
		}

		$mainView = '_layout.php';
		$viewData['tpl'] = $this->render($viewName, $viewData);
		return $this->render($mainView, $viewData);
	}

	/**
	 * warning
	 * info
	 * success
	 */
	protected function setAlertMsg(string $msg, string $type = 'danger') : void
	{
		$_SESSION['alertMsg'] = ['type' => $type, 'msg' => $msg];
	}

	protected function delAlertMsg() : void
	{
		unset($_SESSION['alertMsg']);
	}

	protected function redirect(string $route, array $parameter = []) : void
	{
		if (strpos($route, '/') === false)
		{
			$route = $this->controller.'/'.$route;
		}
		$url = 'index.php?r='.$route;

		if (count($parameter) > 0)
		{
			$parameter = http_build_query($parameter);
			$url .= '&'.$parameter;
		}

		header('Location: '.$url);
	}

	protected function goback() : string
	{
		return '<script>history.back();</script>';
	}

	protected function json() : string
	{
		header('application/json; charset=utf-8');

	}
}

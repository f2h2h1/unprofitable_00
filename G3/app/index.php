<?php
namespace GPojectPHP;

// 项目根目录
define("POJECT_ROOT", dirname(__DIR__ ));
// 判断是否在命令行模式下运行
define("CLI", preg_match("/cli/i", php_sapi_name()) ? true : false);
// 加载 composer
require_once POJECT_ROOT."/vendor/autoload.php";
// doctrine 初始化
require_once POJECT_ROOT."/app/bootstrap.php";
// 加载用于依赖注入的容器
require_once POJECT_ROOT."/app/Container.php";
// 注册自动加载函数
// require_once POJECT_ROOT."/app/Autoload.php";
// 加载路由
require_once POJECT_ROOT."/app/Route.php";
// 加载渲染器
require_once POJECT_ROOT."/app/Renderer.php";

$config = include("config.php");

$container = new Container();
$container->add($entityManager, 'entityManager');
$container->set(__NAMESPACE__.'\Renderer', [$config['path']['view']], 'Renderer');
$container->set(__NAMESPACE__.'\Route', [$config, $container], 'Route');

$route = $container->get('Route');
unset($container);
$route->run();

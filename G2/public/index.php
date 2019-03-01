<?php
namespace GPojectPHP;

require_once dirname(__DIR__ )."/app/setting.php";

$config = include(dirname(__DIR__ )."/app/config.php");

$container = new Container();
$container->add($entityManager, 'entityManager');
$container->set('\Slim\Views\PhpRenderer', [$config['path']['view']], 'PhpRenderer');
$container->set(__NAMESPACE__.'\Route', [$config, $container], 'Route');

$route = $container->get('Route');
unset($container);
$route->run();

<?php
namespace GPojectPHP;

require_once "setting.php";

$config = include("config.php");

$container = new Container();
$container->add($entityManager, 'entityManager');
$container->set(__NAMESPACE__.'\Renderer', [$config['path']['view']], 'Renderer');
$container->set(__NAMESPACE__.'\Route', [$config, $container], 'Route');

$route = $container->get('Route');
unset($container);
$route->run();

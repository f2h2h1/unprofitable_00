<?php
namespace GPojectPHP;

return [
	'namespace' => [
		'controller' => __NAMESPACE__."\Controllers\\",
		'model' => __NAMESPACE__."\Models\\",
		'dao' => __NAMESPACE__."\Dao\\",
	],
	'path' => [
		'controller' => POJECT_ROOT.'/app/Controllers/',
		'model' => POJECT_ROOT.'/app/Models/',
		'view' => POJECT_ROOT."/app/Views/",
		'dao' => POJECT_ROOT.'/app/Dao/',
	],
	'doctrine' => [],
	'website' => [
		// 'name' => '某某管理系统',
		'name' => '远程教育在线考试系',
		'webroot' => POJECT_ROOT.'/public/',
	]
];

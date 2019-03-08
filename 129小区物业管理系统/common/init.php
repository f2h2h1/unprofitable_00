<?php
	header('Content-Type:text/html;charset=utf-8');
	error_reporting(0);//错误屏蔽
	//error_reporting(E_ERROR);
	if (__FILE__ == '')
	{
		die('error code: 0');
	}
	//取得网站所在根目录
	define('ROOT_PATH', str_replace('/common/init.php', '', str_replace('\\', '/', __FILE__)));
	date_default_timezone_set('PRC');//设置时区，其中PRC为“中华人民共和国”  
	include_once ROOT_PATH."/config.php";//包含
	include_once ROOT_PATH."/common/func_db.php";
	include_once ROOT_PATH."/common/function.php";
	include_once ROOT_PATH."/common/PageWeb.class.php";
	define('__BASE__', $CONFIG["url"]);//定义网站根目录
	define('__PUBLIC__', $CONFIG["url"]."/Public");//定义图片及样式文件夹
	session_start();//开启session
	db_connection();//连接数据库
?>
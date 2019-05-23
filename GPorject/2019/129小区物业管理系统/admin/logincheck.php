<?php 
	include_once("../common/init.php");

	if($_REQUEST["type"]=="logout"){
		session_destroy();
		session_start();
		urlMsg("退出成功", __BASE__."/admin/login.php");
		die;
	}
	if ($_POST) {
		
			$rsRow = db_get_row("select * from admin where username='". $_POST["account"] ."'");
			if ($rsRow['password'] == $_POST["password"]){
				$_SESSION["adminid"]	=	$rsRow['id'];
				$_SESSION['adminname']	=	$rsRow['username'];
				$_SESSION['type2']		=	$rsRow['type'];
				
				urlMsg("登录成功", "index.php");
			} else {
				goBakMsg("账号不存在或密码错误");
			}
	}
?>
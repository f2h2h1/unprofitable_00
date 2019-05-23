<?php
	//判断会员登录状态
	function check_loginuser(){
		if(!$_SESSION['id']) {
	
			urlMsg("请登录","login.php");die;
		}
	}
	//判断管理员登录状态
	function check_login(){
		if(!$_SESSION['adminid']) {
			urlMsg("请登录",__BASE__."/admin/login.php");die;
		}
	}
	//js弹出框
	function alertMsg($msg)
	{	
		echo "<script language='javascript'>alert('".$msg."');</script>";
	}
	function goBakMsg($msg)
	{	
		echo "<script language='javascript'>alert('".$msg."');history.go(-1);</script>";
	}
	
	function urlMsg($msg,$url)
	{	
		echo "<script language='javascript'>alert('".$msg."');location.href='$url';</script>";
	}

?>
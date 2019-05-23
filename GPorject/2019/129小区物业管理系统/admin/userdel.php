<?php
	include_once("inc.php");
	
	if ($_REQUEST["del"]) {
		db_del($_REQUEST["del"],$_REQUEST["id"]);
		db_dela("tousu","userid='".$_REQUEST["id"]);
		db_dela("weixiu","userid=".$_REQUEST["id"]);
		db_dela("message","userid=".$_REQUEST["id"]);
		goBakMsg("删除成功");
	} else {
		die;
	}

?>
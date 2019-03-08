<?php
	include_once("inc.php");
	
	if ($_REQUEST["del"]) {
		db_del($_REQUEST["del"],$_REQUEST["id"]);
		goBakMsg("删除成功");
	} else {
		die;
	}

?>
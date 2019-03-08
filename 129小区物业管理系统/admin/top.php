<?php include_once("inc.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<link rel="stylesheet" type="text/css" href="skin/index/themes/css/base.css">
<link rel="stylesheet" type="text/css" href="skin/index/themes/css/home.css">
<script type="text/javascript" src="skin/index/themes/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var menuParent = $('.menu > .ListTitlePanel > div');//menu div
        var menuList = $('.menuList');
        $('.menu > .menuParent > .ListTitlePanel > .ListTitle').each(function(i) { //list
            $(this).click(function(){
                if($(menuList[i]).css('display') == 'none'){
                    $(menuList[i]).slideDown(300);
                }
                else{
                    $(menuList[i]).slideUp(300);
                }
            });
        });
    });
</script>
</head>
<body>
<header id="finance-header">
	<div class="finance-header">
		<div class="finance-header-content clearfix">
			<div class="finance-header-content-fl">
				<h1><?php echo $CONFIG["webname"];?></h1>
			</div>
			<div class="finance-header-content-fr clearfix">
				<div class="finance-header-user">
					<em><?php echo $_SESSION['adminname'];?></em>
				</div>
				<a href="logincheck.php?type=logout" target="_top">注销退出</a>
			</div>
		</div>
	</div>
</header>
</body>
</html>
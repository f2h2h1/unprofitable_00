<?php 
	include_once("inc.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
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
<div class="finance-content-nav menu">
			<div class="menuParent">
				<div class="ListTitlePanel">
					<h3 class="ListTitle">系统设置</h3>
				</div>
				<div class="menuList">
					<a href='password.php' target='main'>修改密码</a>
                    <?php if($_SESSION['type2']=="超级管理员"){?>
					<a href='admin_edit.php' target='main'>添加管理员</a>
        			<a href='admin_list.php' target='main'>管理员管理</a>
        			<?php }?>
				</div>
			</div>
			<div class="menuParent">
				<div class="ListTitlePanel">
					<h3 class="ListTitle">楼号单元管理</h3>
				</div>
				<div class="menuList">
					<a href='category_list.php' target='main'>楼号管理</a>
                    <a href='danyuan_list.php' target='main'>单元管理</a>
				</div>
			</div>
            
            <div class="menuParent">
				<div class="ListTitlePanel">
					<h3 class="ListTitle">住户信息管理</h3>
				</div>
				<div class="menuList">
					<a href='user_list.php' target='main'>住户管理</a>
				</div>
			</div>
            
            <div class="menuParent">
				<div class="ListTitlePanel">
					<h3 class="ListTitle">车位管理</h3>
				</div>
				<div class="menuList">
					<a href="chewei_user.php" target='main'>添加车位</a>
					<a href="chewei_list.php" target='main'>户主车位</a>
				</div>
			</div>
			
            
			
		</div>
</body>
</html>

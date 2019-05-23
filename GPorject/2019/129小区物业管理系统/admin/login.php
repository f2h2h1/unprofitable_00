<?php 
	include_once("../common/init.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录<?php echo $CONFIG["webname"];?></title>
<link href="skin/login/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="skin/login/js/jquery.js"></script>
<script src="skin/login/js/cloud.js" type="text/javascript"></script>
<script language="javascript">
function checklogin()
{
  if(document.login.account.value=='')
     {alert('请输入帐户');
      document.login.account.focus();
      return false
    }
  if (document.login.password.value=='')
   {alert('请输入密码');
    document.login.password.focus();
    return false
   }
}
</script>
<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 

</head>

<body style="background-color:#1c77ac;overflow:hidden;">



    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  

    
    <div class="loginbody">
    
    <span class="systemlogo"><?php echo $CONFIG["webname"];?></span> 
    <form class="formname" action="logincheck.php" name="login" method="post" onSubmit="return checklogin();">
    <div class="loginbox">
    
    <ul>
    <li><input name="account" type="text" class="loginuser" value="admin" onclick="JavaScript:this.value=''"/></li>
    <li><input name="password" type="password" class="loginpwd" value="密码" onclick="JavaScript:this.value=''"/></li>
    <li><input name="" type="submit" class="loginbtn" value="登录"/></li>
    </ul>
    
    
    </div>
    </form>
    </div>
    
    
    
    <div class="loginbm">建议使用IE8以上版本或谷歌浏览器</div>
</body>
</html>

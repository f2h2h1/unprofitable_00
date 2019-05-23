<?php include_once("inc.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $CONFIG["webname"];?></title>
</head>
<frameset rows="82,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
<frameset cols="*,100%,*" frameborder="no" border="0" framespacing="0">
<frame src="about:blank"></frame>
  <frameset cols="167,*" frameborder="no" border="0" framespacing="0">
    <frame src="left.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="main.php" name="main" id="main" title="main" />
  </frameset>
  <frame src="about:blank"></frame>
</frameset>
</frameset>

<noframes><body>
</body></noframes>
</html>
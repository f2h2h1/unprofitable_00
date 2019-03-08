<?php 
	include_once("inc.php");
	$tb_name="admin";
	$rs = db_get_row("select * from $tb_name where id=".$_REQUEST["id"]);
	if ($_POST){
		if ($_REQUEST["id"]) {
		} else {
			$row = db_get_row("select * from $tb_name where username='". $_POST["username"] ."'");
			if ($row["id"]) {
				goBakMsg("用户名已存在");
				die;
			}
		}
		$data = array();
		$data["username"] = "'".$_POST["username"]."'";
		
		if($_POST["password"]){
			$data["password"] = "'".$_POST["password"]."'";
		}
		
		if ($_REQUEST["id"]) {
			db_mdf($tb_name,$data,$_REQUEST["id"]);
		} else {
			db_add($tb_name,$data);
		}
		urlMsg("操作成功", $tb_name."_list.php");
	}
?>
<?php include_once("base.php");?>
<script>
function check()
{
	if (document.form1.username.value=='')
	{
		alert('帐号不能为空');
		document.form1.username.focus();
		return false
	}
}
</script>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr class="topplace">
		<td width="17" rowspan="2" valign="top"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr><td height="31"><div class="title">添加/修改帐户</div></td></tr>
			</table>
		</td>
		<td width="16" rowspan="2"></td>
	</tr>
	<tr>
	<td valign="top" bgcolor="#F7F8F9">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr><td colspan="4" height="10"></td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<tr>
						  <td colspan="2">
								<form name="form1" method="post" action="?" onSubmit="return check()"  enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?php echo $rs["id"];?>" />
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td width="120" align="right">用户名：</td>
                                          <td width="200"><input name="username" type="text" class="text" size="30"  maxlength="20" value="<?php echo $rs["username"];?>" <?php if($_REQUEST["id"]){?>  readonly="readonly" <?php }?>required></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td align="right">密码：</td>
                                          <td><input name="password" type="password" class="text" size="30"  maxlength="20">
                                          </td>
                                            <td><?php if($_REQUEST["id"]){ echo "不修改请留空";} ?></td>
                                        </tr>
                                       
                                        <tr>
                                            <td align="right"></td>
                                            <td><input class="btn" type="submit" value="提交" />  <input name="button" type="button" class="btn" onClick="javascript:history.back();" value="返回"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
							</form>
						  </td>
							</tr>
						</table>
					</td>
					<td width="1%">&nbsp;</td>
				</tr>
				<tr><td height="20"></td></tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
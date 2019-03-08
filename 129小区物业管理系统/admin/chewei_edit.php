<?php 
	include_once("inc.php");
	$tb_name = "chewei";
	if ($_REQUEST["id"]) {
		$rs = db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
	}
	if ($_POST){
		$data = array();
		if ($_REQUEST["id"]) {
			if($_POST["title"]!=$_POST["title1"]){
				$row1 = db_get_row("select * from $tb_name where title='". $_POST["title"] ."'");
				if ($row1["id"]) {
					goBakMsg("车位已存在，请重新填写");
					die;
			}
			}
		} else {
			$row1 = db_get_row("select * from $tb_name where title='". $_POST["title"] ."'");
				if ($row1["id"]) {
					goBakMsg("车位已存在，请重新填写");
					die;
			}
		}
		$data["title"] = "'".$_POST["title"]."'";
		$data["userid"] = "'".$_POST["userid"]."'";
		$data["content"] = "'".$_POST["content"]."'";
		if ($_REQUEST["id"]) {
			db_mdf($tb_name,$data,$_REQUEST["id"]);
		} else {
			db_add($tb_name,$data);
		}
		urlMsg("操作成功", $tb_name."_list.php");
		die;
	}
?>
<?php include_once("base.php");?>
<script>
function checkadd()
{
	if (document.add.title.value=='')
	{
	alert('标题不能为空');
	document.add.title.focus;
	return false
	}
}
</script>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">添加/修改车位</div></td></tr>
			</table>
		</td>
		<td width="16" rowspan="2" bgcolor="#FFFFFF"></td>
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
								<form name="add" method="post" action="?" onSubmit="return checkadd()">
								<input type="hidden" name="id" value="<?php echo $rs["id"];?>" />
                                <input type="hidden" name="userid" value="<?php if($_REQUEST["userid"]){echo $_REQUEST["userid"];}else{echo $rs["userid"];}?>" />
                                <input type="hidden" name="title1" value="<?php echo $rs["title"];?>" />
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td width="120" align="right"> 用户：</td>
                                          <td width="200"><?php 
											   $user = db_get_row("select * from user where id=". $_REQUEST["userid"]);
											   ?><?php echo db_get_val("category",$user["categoryid"],"title")?>-<?php echo db_get_val("danyuan",$user["danyuanid"],"title")?>-<?php echo db_get_val("user",$_REQUEST["userid"],"number1");?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right"><span class="red">*</span> 车位号：</td>
                                          <td width="200"><input name="title" type="text" class="text" size="30" value="<?php echo $rs["title"];?>"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right"> 备注：</td>
                                          <td width="200"><textarea name="content" cols="30" class="text"><?php echo $rs["content"];?></textarea></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><input class="btn" type="submit" value="提交" /></td>
                                            <td>&nbsp;</td>
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

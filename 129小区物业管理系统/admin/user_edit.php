<?php 
	include_once("inc.php");
	$tb_name="user";
	$categoryA = db_get_all("select * from category");
	$categoryB = db_get_all("select * from danyuan");
	$rs = db_get_row("select * from user where id=".$_REQUEST["id"]);
	if ($_POST){
		$data = array();
		if(!$_REQUEST["id"]){
			$row = db_get_row("select * from user where number1='". $_POST["number1"] ."' and danyuanid=". $_POST["danyuanid"]." and categoryid=".$_POST["categoryid"]);
			if ($row["id"]) {
				goBakMsg("房间号已存在");
				die;
			}else{
				$data["number1"] = "'".$_POST["number1"]."'";
			}
		}
		$data["nickname"] = "'".$_POST["nickname"]."'";
		$data["categoryid"] = "'".$_POST["categoryid"]."'";
		$data["danyuanid"] = "'".$_POST["danyuanid"]."'";
		$data["mianji"] = "'".$_POST["mianji"]."'";
		$data["chaoxiang"] = "'".$_POST["chaoxiang"]."'";
		$data["tel"] = "'".$_POST["tel"]."'";	
		if(!empty($_FILES['img']['name'])){
			$file = $_FILES['img'];//得到传输的数据
			//得到文件名称
			$name = $file['name'];
			$type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
			$allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
			//判断文件类型是否被允许上传
			if(!in_array($type, $allow_type)){
			  //如果不被允许，则直接停止程序运行
			}
			//判断是否是通过HTTP POST上传的
			$upload_path = ROOT_PATH.'/Public/Upload/'; //上传文件的存放路径
			
			//开始移动文件到相应的文件夹
			$mu=mt_rand(1,10000000);
			if(move_uploaded_file($file['tmp_name'],$upload_path.$mu.".".$type)){
			  $fileName =$mu.".".$type;
			}else{
			  //echo "Failed!";
			}
			$data["img"] = "'".$fileName."'";	
		}	

		if ($_REQUEST["id"]) {
			db_mdf("user",$data,$_REQUEST["id"]);
		} else {
			db_add("user",$data);
		}
		urlMsg("操作成功", $tb_name."_list.php");
		die;
	}
?>
<?php include_once("base.php");?>
<script>
function check()
{
	if (document.form1.number1.value=='')
	{
		alert('房间号不能为空');
		document.form1.number1.focus();
		return false
	}
	if (document.form1.nickname.value=='')
	{
		alert('姓名不能为空');
		document.form1.nickname.focus();
		return false
	}
	if (document.form1.tel.value=='')
	{
		alert('电话不能为空');
		document.form1.tel.focus();
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
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">添加/修改用户</div></td></tr>
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
								<form name="form1" method="post" action="?" onSubmit="return check()"  enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?php echo $rs["id"];?>" />
                                    <table width="100%" class="cont">
                                        <tr>
                                          <td width="120" align="right"><span class="red">*</span> 房号：</td>
                                          <td width="200"><input class="text" name="number1" type="text" maxlength="18" value="<?php echo $rs["number1"];?>" <?php if($rs["id"]){echo "readonly";}?>></td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr>
                                          <td width="120" align="right"><span class="red">*</span> 所属楼层：</td>
                                          <td width="200"><select name="categoryid">
											  <?php foreach($categoryA as $row) {	?>
                                                <option value="<?php echo $row["id"];?>" <?php if($rs["categoryid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                                            <?php } ?>
                                          </select></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right"><span class="red">*</span> 所属单元：</td>
                                          <td width="200"><select name="danyuanid">
											  <?php foreach($categoryB as $row) {	?>
                                                <option value="<?php echo $row["id"];?>" <?php if($rs["danyuanid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                                            <?php } ?>
                                          </select></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right">房屋朝向：</td>
                                          <td width="200"><input class="text" name="chaoxiang" type="text" maxlength="18" value="<?php echo $rs["chaoxiang"];?>"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right">产权面积：</td>
                                          <td width="200"><input class="text" name="mianji" type="text" maxlength="18" value="<?php echo $rs["mianji"];?>"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right"><span class="red">*</span> 姓名：</td>
                                          <td width="200"><input class="text" name="nickname" type="text" maxlength="18" value="<?php echo $rs["nickname"];?>"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right"><span class="red">*</span> 电话：</td>
                                          <td width="200"><input class="text" name="tel" type="text" maxlength="18" value="<?php echo $rs["tel"];?>"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right"> 头像上传：</td>
                                          <td width="200"><input type="file" name="img" class="text" id="img"><?php if(!empty($rs['img'])){?><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $rs["img"];?>" height="50" width="50"/><?php }?></td>
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
<?php 
	include_once("inc.php");
	$categoryA = db_get_all("select * from category");
	$categoryB = db_get_all("select * from danyuan");
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = " 1=1 ";
	if ($_REQUEST["number1"]) {
		$where_sql .= " and B.number1= '". $_REQUEST["number1"]."'";
	} 
	if ($_REQUEST["categoryid"]) {
		$where_sql .= " and B.categoryid= ". $_REQUEST["categoryid"]."";
	} 
	if ($_REQUEST["danyuanid"]) {
		$where_sql .= " and B.danyuanid= ". $_REQUEST["danyuanid"]."";
	}
	//echo "select  A. * ,A.id as cheweiid, B. * FROM chewei A LEFT JOIN user B ON A.userid = B.id where $where_sql order by A.id desc";
	//die;
	$list = db_get_page("select  A. * ,A.id as cheweiid,B. * FROM chewei A LEFT JOIN user B ON A.userid = B.id where $where_sql order by A.id desc", $page,12);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&number1=".$_REQUEST["number1"]."&categoryid=".$_REQUEST["categoryid"]."&danyuanid=".$_REQUEST["danyuanid"], $page);
	$page_show = $Page->show(); 
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">车位查询</div></td></tr>
			</table>
		</td>
		<td width="16" rowspan="2" bgcolor="#FFFFFF"></td>
	</tr>
	<tr>
	<td valign="top" bgcolor="#F7F8F9">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr><td colspan="4" height="10"></td></tr>
            <tr><td width="1%">&nbsp;</td><td width="96%">
            <table width="100%" class="cont">
			<tr>
            <td>
              <form id="pagerForm" action="?" method="post">
                <select name="categoryid">
                  <option value="">-- 请选择楼号 --</option>
                  <?php
                    foreach($categoryA as $row) {
                    ?>
                  <option value="<?php echo $row["id"];?>" <?php if($_REQUEST["categoryid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                  <?php } ?>
                  </select>
                <select name="danyuanid">
                  <option value="">-- 请选择单元 --</option>
                  <?php
                    foreach($categoryB as $row) {
                    ?>
                  <option value="<?php echo $row["id"];?>" <?php if($_REQUEST["danyuanid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                  <?php } ?>
                  </select><input type="text" name="number1" class="text" value="<?php echo $_REQUEST["number1"]; ?>" placeholder="输入房号"/>
                <button type="submit"  id="chaxun" class="btn">查询</button>
              </form></td></tr></table>
          </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
							<table width="100%"  class="cont tr_color">
								<tr>
								  <th>车位</th>
								  <th>备注</th>
                                  <th width="200">所有人</th>
								  <th width="160">操作</th>
							  </tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
								  <td align="center"><?php echo $row['title'];?></td>
									<td align="center"><?php echo $row['content'];?></td>
                                    <td><?php echo db_get_val("category",$row["categoryid"],"title")?>-<?php echo db_get_val("danyuan",$row["danyuanid"],"title")?>-<?php echo $row['number1'];?></td>
									<td><a href="chewei_edit.php?id=<?php echo $row['cheweiid'];?>&userid=<?php echo $row['userid'];?>">修改</a>&nbsp;&nbsp;<a href="del.php?id=<?php echo $row['cheweiid'];?>&del=chewei" onclick='return confirm("真的要删除?不可恢复!");'>删除</a></td>
								</tr>
                                <?php } ?>
							</table>
						</td>
					</tr>
					</table>
					<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                        <tr>
                          <td align="center"><?php echo $page_show;?></td>
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
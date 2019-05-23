<h4>新建学生</h4>
<hr />
<div class="row">
	<div class="col-md-4">
		<form method="post">
		<input type="hidden" name="classid" value="<?=$classid?>"/>
			<div class="form-group">
				<label class="control-label"> 姓名
					<input class="form-control" name="name"/>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 登录名
					<input class="form-control" name="username"/>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 密码
					<input class="form-control" name="password"/>
				</label>
			</div>
			<div class="form-group">
				<input type="submit" value="新建" class="btn btn-default" />
			</div>
		</form>
	</div>
</div>

<div>
	<a href="index.php?r=Admin/studentList&id=<?=$classid?>">返回列表</a>
</div>

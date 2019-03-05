<h4>新建教师</h4>
<hr />
<div class="row">
	<div class="col-md-4">
		<form method="post">
			<div class="form-group">
				<label class="control-label"> 姓名
					<input class="form-control" name="name"/>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 任教学科
					<input class="form-control" name="subjectid"/>
				</label>
			</div>
			<div class="form-group">
				<label asp-for="Role" class="control-label"> 负责班级
					<input class="form-control" name="classid"/>
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
	<a href="index.php?r=Admin/userList">返回列表</a>
</div>

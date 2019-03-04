<h4>创建用户</h4>
<hr />
<div class="row">
	<div class="col-md-4">
		<form method="post">
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
				<label asp-for="Role" class="control-label"> 角色
					<select class="form-control" name="role">
						<option value="2">教师</option>
						<option value="3">学生</option>
					</select>
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

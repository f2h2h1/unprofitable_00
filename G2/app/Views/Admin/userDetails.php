<div>
	<h4>用户详细</h4>
	<hr />
	<dl class="dl-horizontal">
		<dt>id</dt>
		<dd>
			<?=$model->getId()?>
		</dd>
		<dt>登录名</dt>
		<dd>
			<?=$model->getName()?>
		</dd>
		<dt>角色</dt>
		<dd>
			<?php
				switch ($model->getRole())
				{
					case 1:echo '管理员';break;
					case 2:echo '教师';break;
					case 3:echo '学生';break;
				}
			?>
		</dd>
		<dt>创建时间</dt>
		<dd>
			<?=date('Y-m-d H:i:s', $model->getCreatetime())?>
		</dd>
		<dt>更新时间</dt>
		<dd>
			<?=date('Y-m-d H:i:s', $model->getUpdatetime())?>
		</dd>
	</dl>
</div>

<div>
	<!-- <a href="index.php?r=Admin/userEdit">编辑</a> | -->
	<a href="index.php?r=Admin/userList">返回列表</a>
</div>

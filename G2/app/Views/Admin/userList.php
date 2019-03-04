<h2>用户列表</h2>
<p>
	<a href="index.php?r=Admin/userCreate">新建</a>
</p>
<table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>登录名</th>
			<th>角色</th>
			<th>创建时间</th>
			<th>更新时间</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($modelList as $item):?>
		<tr>
			<td>
				<?=$item->getId()?>
			</td>
			<td>
				<?=$item->getName()?>
			</td>
			<td>
				<?php
					switch ($item->getRole())
					{
						case 1:echo '管理员';break;
						case 2:echo '教师';break;
						case 3:echo '学生';break;
					}
				?>
			</td>
			<td>
				<?=date('Y-m-d H:i:s', $item->getCreatetime())?>
			</td>
			<td>
				<?=date('Y-m-d H:i:s', $item->getUpdatetime())?>
			</td>
			<td>
				<!-- <a href="index.php?r=Admin/userEdit&id=<?=$item->getId()?>">编辑</a> | -->
				<a href="index.php?r=Admin/userDetails&id=<?=$item->getId()?>">详细</a> |
				<a href="index.php?r=Admin/userDelete" request-confirm="确定要删除此项吗" data-id="<?=$item->getId()?>">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>

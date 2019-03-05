<h2>班级列表</h2>
<p>
	<a href="index.php?r=Admin/classesCreate">新建</a>
</p>
<table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>班级</th>
			<th>人数</th>
			<th>创建时间</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php if (is_array($modelList) && count($modelList) > 0):?>
		<?php foreach($modelList as $item):?>
		<tr>
			<td>
				<?=$item->getId()?>
			</td>
			<td>
				<?=$item->getName()?>
			</td>
			<td>
				<?=$item->getNumber()?>
			</td>
			<td>
				<?=date('Y-m-d H:i:s', $item->getCreatetime())?>
			</td>
			<td>
				<!-- <a href="index.php?r=Admin/classesEdit&id=<?=$item->getId()?>">编辑</a> | -->
				<a href="index.php?r=Admin/studentList&id=<?=$item->getId()?>">学生列表</a> |
				<a href="index.php?r=Admin/classesDelete" request-confirm="确定要删除此项吗" data-id="<?=$item->getId()?>">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
	</tbody>
</table>

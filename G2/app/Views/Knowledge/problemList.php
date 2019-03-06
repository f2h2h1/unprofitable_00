<h2>习题列表</h2>
<p>
	<a href="index.php?r=Knowledge/problemCreate&knowledgeid=<?=$knowledgeid?>">新建</a>
</p>
<table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>题目</th>
			<th>类型</th>
			<th>创建时间</th>
			<th>更新时间</th>
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
				<?php
					switch ($item->getType())
					{
						case 1:echo '选择';break;
						case 2:echo '判断';break;
						case 3:echo '填空';break;
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
				<!-- <a href="index.php?r=Knowledge/problemEdit&id=<?=$item->getId()?>">编辑</a> | -->
				<a href="index.php?r=Knowledge/problemDetails&id=<?=$item->getId()?>">详细</a> |
				<a href="index.php?r=Knowledge/problemDelete" request-confirm="确定要删除此项吗" data-id="<?=$item->getId()?>">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
	</tbody>
</table>

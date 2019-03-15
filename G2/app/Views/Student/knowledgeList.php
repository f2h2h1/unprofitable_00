<h2>知识点列表</h2>
<p>
	<!-- <a href="index.php?r=Knowledge/knowledgeCreate">新建</a> -->
</p>
<table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>知识点</th>
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
			</td>
			<td>
				<?=date('Y-m-d H:i:s', $item->getCreatetime())?>
			</td>
			<td>
				<?=date('Y-m-d H:i:s', $item->getUpdatetime())?>
			</td>
			<td>
				<a href="index.php?r=Student/exercises&id=<?=$item->getId()?>">习题</a> |
				<!-- <a href="index.php?r=Knowledge/knowledgeEdit&id=<?=$item->getId()?>">编辑</a> | -->
				<!-- <a href="index.php?r=Knowledge/knowledgeDetails&id=<?=$item->getId()?>">详细</a> | -->
				<!-- <a href="index.php?r=Knowledge/knowledgeDelete" request-confirm="确定要删除此项吗" data-id="<?=$item->getId()?>">删除</a> -->
			</td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
	</tbody>
</table>

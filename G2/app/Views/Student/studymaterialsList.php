<h2>学习资料</h2>
<p>
	<a href="index.php?r=Knowledge/studymaterialsCreate">新建</a>
</p>
<table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>文件名</th>
			<th>学科</th>
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
				<?php
					foreach ($subjectList as $sub)
					{
						if ($sub->getId() === $item->getSubjectid())
						{
							echo $sub->getName();
							break;
						}
					}
				?>
			</td>
			</td>
			<td>
				<?=date('Y-m-d H:i:s', $item->getCreatetime())?>
			</td>
			<td>
				<a href="index.php?r=Knowledge/studymaterialsDownload&id=<?=$item->getId()?>">下载</a> |
				<!-- <a href="index.php?r=Knowledge/studymaterialsDelete" request-confirm="确定要删除此项吗" data-id="<?=$item->getId()?>">删除</a> -->
			</td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
	</tbody>
</table>

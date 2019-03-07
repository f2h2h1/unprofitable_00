<h2>考核列表</h2>
<p>
	<a href="index.php?r=Exam/examCreate">新建</a>
</p>
<table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>考核</th>
			<th>类型</th>
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
			<td>
				<?php
					switch ($item->getType())
					{
						case 1:echo '在线考核';break;
						case 2:echo '上传作业';break;
					}
				?>
			</td>
			<td>
				<?=date('Y-m-d H:i:s', $item->getCreatetime())?>
			</td>
			<td>
				<a href="index.php?r=Exam/examEdit&id=<?=$item->getId()?>">学生成绩</a> |
				<a href="index.php?r=Exam/examDetails&id=<?=$item->getId()?>">详细</a> |
				<a href="index.php?r=Exam/examDelete" request-confirm="确定要删除此项吗" data-id="<?=$item->getId()?>">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
	</tbody>
</table>

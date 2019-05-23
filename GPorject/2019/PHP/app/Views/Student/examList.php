<h2>考核列表</h2>
<p>
	<!-- <a href="index.php?r=Exam/examCreate">新建</a> -->
</p>
<table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>考核</th>
			<th>学科</th>
			<th>类型</th>
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
				<?php
				$flg = 0;
				$score = null;
				foreach ($scoreList as $scoreitem)
				{
					if ($scoreitem['examid'] == $item->getId())
					{
						$flg = 1;
						$score = $scoreitem['score'];
					}
				}
				?>
				<?php
					if ($score === null):
				?>
				<a href="index.php?r=Student/exam&id=<?=$item->getId()?>">进入考核</a> |
				<?php
					else:
				?>
					分数： <?=$score?>
				<?php
					endif;
				?>
			</td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
	</tbody>
</table>

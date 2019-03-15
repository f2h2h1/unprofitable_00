<h4>练习</h4>
<hr />
<div class="row">
	<div class="col-md-12">
		<p>正答率：<?=$correctProbability?></p>
		<p>错题：</p>
		<form method="post"  id="examForm">
			<?php if (is_array($modelList) && count($modelList) > 0):?>
			<?php foreach($modelList as $item):?>
				<?php
					$type = $item['type'];
					$id = $item['id'];
				?>
				<div class="form-group" data-question data-id="<?=$id?>" data-type="<?=$type?>">
				<?php if ($type === 1):?>
					<?php
						$describe = $item['describe'];
						$describe = json_decode($describe, true);
					?>
					<p><?=$describe['question']?></p>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer-<?=$id?>" value="1">
							<?=$describe['option'][0]?>
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer-<?=$id?>" value="2">
							<?=$describe['option'][1]?>
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer-<?=$id?>" value="3">
							<?=$describe['option'][2]?>
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer-<?=$id?>" value="4">
							<?=$describe['option'][3]?>
						</label>
					</div>
				<?php elseif ($type === 2):?>
					<p><?=$item['describe']?></p>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer-<?=$id?>" value="1">
							对
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer-<?=$id?>" value="2">
							错
						</label>
					</div>
				<?php elseif ($type === 3):?>
					<p><?=preg_replace("/\%s/", '<input type="text" value="">', $item['describe']);?></p>
				<?php endif;?>
				</div>
			<?php endforeach;?>
			<?php endif;?>
			<div class="form-group">
				<input type="submit" value="提交" class="btn btn-default" />
			</div>
		</form>
	</div>
</div>

<div>
	<a href="javascript:history.back();">返回</a>
</div>

<script>
	(function(){
		var questionList;

		$('#examForm').on('submit', function() {
			let questionList =  $('[data-question]');
			let answerList = [];
			for (let i = 0, len = questionList.length; i < len; i++) {
				let item = {
					'id':'',
					'type':'',
					'answer':'',
				};
				console.log(questionList[i]);
				let question = $(questionList[i]);
				console.log(question.data('type'));
				item.id = question.data('id');
				let type = question.data('type');
				item.type = type;
				console.log(item);

				if ( type == 1 || type == 2) {
					let answer = question.find('[type="radio"]:checked');
					if (answer.length == 0) {
						item.answer = 0;
					} else {
						item.answer = answer[0].value;
					}
				} else if (type == 3) {
					let answer = question.find('[type="text"]');
					item.answer = [];
					for (let j = 0; j < answer.length; j++) {
						item.answer.push(answer[j].value);
					}
				} else {
					continue;
				}

				answerList.push(item);
			}
			console.log(answerList);
			let answerJson = JSON.stringify(answerList);
			console.log(answerJson);

			var form = document.createElement("form");
			form.action = 'index.php?r=Student/result';
			form.method = "post";
			form.style = "display:none;";
			form.id = "tempFormPost";

			let input = document.createElement("input");
			input.name = 'answer';
			input.value = answerJson;
			form.appendChild(input);

			document.body.appendChild(form);
			document.getElementById("tempFormPost").submit();

			return false;
		});
	})();
</script>

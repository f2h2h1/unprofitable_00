<h4>练习</h4>
<hr />
<div class="row">
	<div class="col-md-12">
		<form method="post"  id="examForm">
			<?php if (is_array($modelList) && count($modelList) > 0):?>
			<?php foreach($modelList as $item):?>
				<?php
					$type = $item->getType();
					$id = $item->getId();
				?>
				<div class="form-group" data-question data-id="<?=$id?>" data-type="<?=$type?>">
				<?php if ($type === 1):?>
					<?php
						$describe = $item->getDescribe();
						$describe = json_decode($describe, true);
					?>
					<p><?=$describe['question']?></p>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer" value="1">
							<?=$describe['option'][0]?>
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer" value="2">
							<?=$describe['option'][1]?>
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer" value="3">
							<?=$describe['option'][2]?>
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer" value="4">
							<?=$describe['option'][3]?>
						</label>
					</div>
				<?php elseif ($type === 2):?>
					<p><?=$item->getDescribe()?></p>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer" value="1">
							对
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" name="answer" value="2">
							错
						</label>
					</div>
				<?php elseif ($type === 3):?>
					<p><?=preg_replace("/\%s/", '<input type="text" name="answer[]" value="">', $item->getDescribe());?></p>
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
	<a href="javascript:history.back();">返回列表</a>
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
				answerList.push(item);
			}

			// var form = document.createElement("form");
			// form.action = location.href;
			// form.method = "post";
			// form.style = "display:none;";
			// form.id = "tempFormPost";

			// for (let key in formdata) {
			// 	let input = document.createElement("input");
			// 	input.name = key;
			// 	input.value = formdata[key];
			// 	form.appendChild(input);
			// }
			// document.body.appendChild(form);
			// document.getElementById("tempFormPost").submit();

			return false;
		});
	})();
</script>

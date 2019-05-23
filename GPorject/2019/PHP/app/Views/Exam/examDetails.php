<h4>新建考核</h4>
<hr />
<div class="row">
	<div class="col-md-12">
		<form method="post"  id="examForm">
			<div class="form-group">
				<label class="control-label"> 考核
					<input class="form-control" name="name" value="<?=$exam->getName()?>" readonly/>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 学科
						<?php
							foreach ($subjectList as $sub)
							{
								if ($sub->getId() === $exam->getSubjectid())
								{
									$subject = $sub->getName();
									break;
								}
							}
						?>
						<input class="form-control" value="<?=$subject?>" readonly/>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 类型
					<?php
						$type = $exam->getType();
						$typeStr = '';
						switch ($type)
						{
							case 1:$typeStr = '在线考核';break;
							case 2:$typeStr = '上传作业';break;
						}
					?>
					<input class="form-control" value="<?=$typeStr?>" readonly/>
				</label>
			</div>
			<?php if ($type === 1):?>
			<!-- 在线考核 -->
				<div id="online">
					<div class="form-group" id="questionPreview">
					</div>
					<script>
						let questionList = '<?=json_encode($questionList, JSON_UNESCAPED_UNICODE)?>';
						for (let x in questionList) {
							// console.log(questionId + '\t' + questionList[x].id);

								// console.log(questionId + '\t' + questionList[x].id + 's');
								let questionType = questionList[x].type;
								let questionName = questionList[x].name;
								let questionDescribe = questionList[x].describe;

								$('#questionPreview').html('');
								let questionHtml = '';
								if (questionType === 1) { // 选择

									questionDescribe = JSON.parse(questionDescribe);
									// console.log(questionDescribe);

									questionHtml = '<p>' + questionDescribe.question + '</p>'+
													'<div class="form-check">'+
													'	<label class="form-check-label">'+
													'		<input type="radio" name="answer" value="1">'+
													'		' + questionDescribe.option[0] + ''+
													'	</label>'+
													'</div>'+
													'<div class="form-check">'+
													'	<label class="form-check-label">'+
													'		<input type="radio" name="answer" value="2">'+
													'		' + questionDescribe.option[1] + ''+
													'	</label>'+
													'</div>'+
													'<div class="form-check">'+
													'	<label class="form-check-label">'+
													'		<input type="radio" name="answer" value="3">'+
													'		' + questionDescribe.option[2] + ''+
													'	</label>'+
													'</div>'+
													'<div class="form-check">'+
													'	<label class="form-check-label">'+
													'		<input type="radio" name="answer" value="4">'+
													'		' + questionDescribe.option[3] + ''+
													'	</label>'+
													'</div>';
								} else if (questionType === 2) { // 判断
									questionHtml = '<p>' + questionDescribe + '</p>'+
													'<div class="form-check">'+
													'	<label class="form-check-label">'+
													'		<input type="radio" name="answer" value="1">'+
													'		对'+
													'	</label>'+
													'</div>'+
													'<div class="form-check">'+
													'	<label class="form-check-label">'+
													'		<input type="radio" name="answer" value="2">'+
													'		错'+
													'	</label>'+
													'</div>';
								} else if (questionType === 3) { // 填空
									questionHtml = '<p>' + questionDescribe + '</p>';
									questionHtml = questionHtml.replace(/%s/g, "<input type='text' name='answer[]'>");
								}
								$('#questionPreview').html(questionHtml);
						}
					</script>
				</div>
			<!-- end 在线考核 -->
			<?php elseif ($type === 2):?>
			<!-- 上传作业 -->
				<div id="offline">
					<div class="form-group">
						<label class="control-label"> 题目
							<textarea class="form-control" rows="8" name="question"><?=$exam->getQuestion()?></textarea>
						</label>
					</div>
				</div>
			<!-- end 上传作业 -->
			<?php endif;?>
			<!-- <div class="form-group">
				<input type="submit" value="新建" class="btn btn-default" />
			</div> -->
		</form>
	</div>
</div>

<div>
	<a href="index.php?r=Exam/examList">返回列表</a>
</div>

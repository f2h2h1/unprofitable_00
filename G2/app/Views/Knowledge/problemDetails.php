<h4>习题详细</h4>
<hr />
<div class="row">
	<div class="col-md-4">
		<form method="post" id="problemForm">
			<div class="form-group">
				<label class="control-label"> 题目
					<input class="form-control" name="name" value="<?=$model->getName()?>" readonly />
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 类型
					<?php
						$type = $model->getType();
						$typeStr = '';
						switch ($type)
						{
							case 1:$typeStr = '选择';break;
							case 2:$typeStr = '判断';break;
							case 3:$typeStr = '填空';break;
						}
					?>
					<input class="form-control" name="type" value="<?=$typeStr?>" readonly />
				</label>
			</div>
			<?php
				$describe = $model->getDescribe();
				$answer = $model->getAnswer();
			?>
			<?php if ($type === 1):?>
			<?php
				$describe = json_decode($describe, true);
				$question = $describe['question'];
				$option = $describe['option'];
			?>
			<!-- 选择题 -->
				<div id="choice">
					<div class="form-group">
						<label class="control-label"> 题干
							<textarea class="form-control" rows="8" name="describe"><?=$question?></textarea>
						</label>
					</div>
					<div class="form-group">
						<label class="control-label"> 选项一
							<input class="form-control" name="choiceOption[]" value="<?=$option[0]?>" />
						</label>
						<label class="control-label"> 选项二
							<input class="form-control" name="choiceOption[]" value="<?=$option[1]?>" />
						</label>
						<label class="control-label"> 选项三
							<input class="form-control" name="choiceOption[]" value="<?=$option[2]?>" />
						</label>
						<label class="control-label"> 选项四
							<input class="form-control" name="choiceOption[]" value="<?=$option[3]?>" />
						</label>
					</div>
					<div class="form-group">
						<label class="control-label"> 答案
							<select class="form-control" name="answer">
								<option value="1" <?=($answer === '1')?'selected':''?>>选项一</option>
								<option value="2" <?=($answer === '2')?'selected':''?>>选项二</option>
								<option value="3" <?=($answer === '3')?'selected':''?>>选项三</option>
								<option value="4" <?=($answer === '4')?'selected':''?>>选项四</option>
							</select>
						</label>
					</div>
				</div>
			<!-- end 选择题 -->
			<?php elseif ($type === 2):?>
			<!-- 判断题 -->
				<div id="truefalse">
					<div class="form-group">
						<label class="control-label"> 题目
							<textarea class="form-control" rows="8" name="describe"><?=$describe?></textarea>
						</label>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="answer" value="1" <?=($answer === '1')?'checked':''?> >
								对
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="answer" value="2"  <?=($answer === '2')?'checked':''?> >
								错
							</label>
						</div>
					</div>
				</div>
			<!-- end 判断题 -->
			<?php elseif ($type === 3):?>
			<!-- 填空题 -->
				<div id="blankfilling">
					<div class="form-group">
						<label class="control-label"> 题目
							<textarea class="form-control" rows="8" name="describe"><?=$describe?></textarea>
						</label>
						<small class="form-text text-muted">
							需要填空的位置，请使用这样的字符替代 %s 。例如，CPU由%s和%s组成
						</small>
					</div>
					<div class="form-group">
						<label class="control-label"> 答案
							<textarea class="form-control" rows="8" name="answer"><?=$answer?></textarea>
						</label>
						<small class="form-text text-muted">
							填空的答案请使用半角英文逗号隔开。例如，运算器,控制器
						</small>
					</div>
				</div>
			<!-- end 填空题 -->
			<?php endif;?>
			<!-- <div class="form-group">
				<input type="submit" value="新建" class="btn btn-default" />
			</div> -->
		</form>
	</div>
</div>

<div>
	<a href="javascript:history.back();">返回列表</a>
</div>

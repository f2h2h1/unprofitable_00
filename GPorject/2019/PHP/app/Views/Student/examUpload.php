<h4>习题详细</h4>
<hr />
<div class="row">
	<div class="col-md-4">
		<form method="post" action="index.php?r=Student/examResult"  enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?=$model->getId()?>" />
			<div class="form-group">
				<label class="control-label"> 题目
					<textarea class="form-control" rows="8" name="question"><?=$model->getQuestion()?></textarea>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 作业
					<input class="form-control" type="file" name="attachment"/>
				</label>
			</div>
			<div class="form-group">
				<input type="submit" value="提交" class="btn btn-default" />
			</div>
		</form>
	</div>
</div>

<div>
	<a href="javascript:history.back();">返回列表</a>
</div>

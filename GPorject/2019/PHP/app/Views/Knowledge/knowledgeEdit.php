<h4>编辑知识点</h4>
<hr />
<div class="row">
	<div class="col-md-4">
		<form method="post">
			<input hidden name="id" value="<?=$model->getId()?>" />
			<div class="form-group">
				<label class="control-label"> 学科
					<input class="form-control" value="<?=$subjectList->getName()?>" readonly />
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 知识点
					<input class="form-control" name="name" value="<?=$model->getName()?>" />
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 描述
					<input class="form-control" name="describe" value="<?=$model->getDescribe()?>" />
				</label>
			</div>
			<div class="form-group">
				<input type="submit" value="保存" class="btn btn-default" />
			</div>
		</form>
	</div>
</div>

<div>
	<a href="index.php?r=Knowledge/knowledgeList">返回列表</a>
</div>

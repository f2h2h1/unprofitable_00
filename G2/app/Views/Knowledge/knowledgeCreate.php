<h4>新建知识点</h4>
<hr />
<div class="row">
	<div class="col-md-4">
		<form method="post">
			<div class="form-group">
				<label class="control-label"> 学科
					<select class="form-control" name="subjetid">
						<?php foreach ($subjectList as $sub) :?>
						<option value="<?=$sub->getId()?>"><?=$sub->getName()?></option>
						<?php endforeach;?>
					</select>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 知识点
					<input class="form-control" name="name"/>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 描述
					<input class="form-control" name="describe"/>
				</label>
			</div>
			<div class="form-group">
				<input type="submit" value="新建" class="btn btn-default" />
			</div>
		</form>
	</div>
</div>

<div>
	<a href="index.php?r=Knowledge/knowledgeList">返回列表</a>
</div>

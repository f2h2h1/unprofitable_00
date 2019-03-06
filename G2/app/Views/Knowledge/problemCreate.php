<h4>新建习题</h4>
<hr />
<div class="row">
	<div class="col-md-4">
		<form method="post" id="problemForm">
			<div class="form-group">
				<label class="control-label"> 题目
					<input class="form-control" name="name"/>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label"> 类型
					<select class="form-control" name="type">
						<option value="1">选择题</option>
						<option value="2">判断题</option>
						<option value="3">填空题</option>
					</select>
				</label>
			</div>
			<!-- 选择题 -->
				<div id="choice" style="display:block;">
					<div class="form-group">
						<label class="control-label"> 题干
							<textarea class="form-control" rows="8" name="describe"></textarea>
						</label>
					</div>
					<div class="form-group">
						<label class="control-label"> 选项一
							<input class="form-control" name="choiceOption[]"/>
						</label>
						<label class="control-label"> 选项二
							<input class="form-control" name="choiceOption[]"/>
						</label>
						<label class="control-label"> 选项三
							<input class="form-control" name="choiceOption[]"/>
						</label>
						<label class="control-label"> 选项四
							<input class="form-control" name="choiceOption[]"/>
						</label>
					</div>
					<div class="form-group">
						<label class="control-label"> 答案
							<select class="form-control" name="answer">
								<option value="1">选项一</option>
								<option value="2">选项二</option>
								<option value="3">选项三</option>
								<option value="4">选项四</option>
							</select>
						</label>
					</div>
				</div>
			<!-- end 选择题 -->
			<!-- 判断题 -->
				<div id="truefalse" style="display:none;">
					<div class="form-group">
						<label class="control-label"> 题目
							<textarea class="form-control" rows="8" name="describe"></textarea>
						</label>
					</div>
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="answer" value="1" checked>
								对
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="answer" value="2">
								错
							</label>
						</div>
					</div>
				</div>
			<!-- end 判断题 -->
			<!-- 填空题 -->
				<div id="blankfilling" style="display:none;">
					<div class="form-group">
						<label class="control-label"> 题目
							<textarea class="form-control" rows="8" name="describe"></textarea>
						</label>
						<small class="form-text text-muted">
							需要填空的位置，请使用这样的字符替代 %s 。例如，CPU由%s和%s组成
						</small>
					</div>
					<div class="form-group">
						<label class="control-label"> 答案
							<textarea class="form-control" rows="8" name="answer"></textarea>
						</label>
						<small class="form-text text-muted">
							填空的答案请使用半角英文逗号隔开。例如，运算器,控制器
						</small>
					</div>
				</div>
			<!-- end 填空题 -->
			<div class="form-group">
				<input type="submit" value="新建" class="btn btn-default" />
			</div>
		</form>
	</div>
</div>

<div>
	<a href="index.php?r=Knowledge/problemList&knowledgeid=<?=$knowledgeid?>">返回列表</a>
</div>

<script>
	// blankfilling
	// truefalse
	// choice

	$("[name='type']").on("change", function() {
		problemType = this.value;
		if (problemType == 1) {
			$('#choice').css('display', 'block');
			$('#truefalse').css('display', 'none');
			$('#blankfilling').css('display', 'none');
		} else if (problemType == 2) {
			$('#choice').css('display', 'none');
			$('#truefalse').css('display', 'block');
			$('#blankfilling').css('display', 'none');
		} else if (problemType == 3) {
			$('#choice').css('display', 'none');
			$('#truefalse').css('display', 'none');
			$('#blankfilling').css('display', 'block');
		}
	});

	$('#problemForm').on('submit', function() {
		console.log(location.href);
		console.log(this);
		let problemName = $("[name='name']").val();
		let problemType = $("[name='type']").val();
		console.log(problemName);
		console.log(problemType);

		let describe = '';
		let answer = '';
		let formdata = {
			'knowledgeid':'<?=$knowledgeid?>',
			'name':problemName,
			'type':problemType,
			'describe':describe,
			'answer':answer
		}

		if (problemType == 1) {
			describe = $("#problemForm #choice [name='describe']").val();
			choiceOption = $("#problemForm #choice [name='choiceOption[]']");
			answer = $("#problemForm #choice [name='answer']").val();


			console.log(choiceOption);
			// for (key in choiceOption)  {
			// 	console.log("key="+key);
			// 	console.log("choiceOption="+choiceOption);
			// 	console.log(choiceOption[key].value);
			// }
			describe = {
				'question':$("#problemForm #choice [name='describe']").val(),
				'option':[]
			}
			for (let i = 0, len = choiceOption.length; i < len; i++) {
				console.log(choiceOption[i].value);
				describe.option.push(choiceOption[i].value);
			}
			describe = JSON.stringify(describe);
		} else if (problemType == 2) {
			describe = $("#problemForm #truefalse [name='describe']").val();
			answer = $("#problemForm #truefalse [name='answer']").val();
		} else if (problemType == 3) {
			describe = $("#problemForm #blankfilling [name='describe']").val();
			answer = $("#problemForm #blankfilling [name='answer']").val();
		}

		console.log(describe);
		console.log(answer);

		formdata.describe = describe;
		formdata.answer = answer;

		var form = document.createElement("form");
		form.action = location.href;
		form.method = "post";
		form.style = "display:none;";
		form.id = "tempFormPost";

		for (let key in formdata) {
			let input = document.createElement("input");
			input.name = key;
			input.value = formdata[key];
			form.appendChild(input);
		}
		document.body.appendChild(form);
		document.getElementById("tempFormPost").submit();

		return false;
	});

</script>

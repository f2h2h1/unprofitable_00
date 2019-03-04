<!DOCTYPE html>
<html>
<head>
	<title><?=$website['name']?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
	<style>
		.main {
			margin-top: 10px;
			padding-top: 10px;
		}
		input[type="date"].form-control,
		input[type="time"].form-control,
		input[type="datetime-local"].form-control,
		input[type="month"].form-control {
			line-height: 20px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
		<div class="container">
			<a class="navbar-brand" href="index.php?r=Admin/index">主页</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<?php if (isset($userName)):?>
				<ul class="navbar-nav flex-grow-1">
					<?php if ($userRole === 1):?>
						<li class="nav-item">
							<a class="nav-link" href="index.php?r=Admin/userList">用户管理</a>
						</li>
					<?php endif;?>
					<li class="nav-item">
						<a class="nav-link" href="#">链接</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">链接</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">链接</a>
					</li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link text-dark dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?=$userName?></a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="index.php?r=Admin/changePassword">修改密码</a>
							<a class="dropdown-item" href="index.php?r=Admin/logout">退出</a>
						</div>
					</li>
				</ul>
			<?php endif;?>
			</div>
		</div>
	</nav>
	<div class="main container">
		<?php if (isset($alertMsg)):?>
		<div class="alert alert-<?=$alertMsg['type']?> alert-dismissible fade show" role="alert">
			<?=$alertMsg['msg']?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php endif;?>
		<?=$tpl?>
	</div>
	<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script>
		$("[request-confirm]").on("click", function() {
			let message = $(this).attr("request-confirm");
			if (!confirm(message)) {
				return false;
			}
			let requestMethod = $(this).attr("request-method");
			if (requestMethod === "get") {
				location = $(this).attr("href");
				return false;
			} else {
				var form = document.createElement("form");
				form.action = $(this).attr("href");
				form.method = "post";
				form.style = "display:none;";
				form.id = "tempFormPost";
				var formdata = $(this).data();
				for (let key in formdata) {
					let input = document.createElement("input");
					input.name = key;
					input.value = formdata[key];
					form.appendChild(input);
				}
				document.body.appendChild(form);
				document.getElementById("tempFormPost").submit();
				return false;
			}
		});
	</script>
</body>
</html>

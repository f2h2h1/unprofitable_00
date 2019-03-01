<!DOCTYPE html>
<html>
<head>
	<title><?=$website['name']?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
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
			<a class="navbar-brand" href="#">主页</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
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
			</div>
		</div>
	</nav>
	<div class="main container">
		<?=$tpl?>
	</div>
</body>
</html>

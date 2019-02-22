<%@ page language="java" import="java.util.*" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ include file="/WEB-INF/views/tool.jsp" %>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<title><%=websiteName(request)%></title>
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="static/css/dashboard.css" rel="stylesheet">
</head>

<body>
	<div class="main">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
						aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><%=websiteName(request)%></a>
					<span class="navbar-brand sidebar-switch">>>></span>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Settings</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								aria-expanded="false">User<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li role="separator" class="divider"></li>
								<li class="dropdown-header">Nav header</li>
								<li><a href="#">Separated link</a></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
						<li><a href="#">Help</a></li>
					</ul>
					<form class="navbar-form navbar-right">
						<input type="text" class="form-control" placeholder="Search...">
						<button type="button" class="btn btn-link">search</button>
					</form>
				</div>
			</div>
		</nav>
		<div class="lower-part">
			<div class="sidebar">
				<div id="navigation" class="list-group">
					<a class="list-group-item" href="inedx.html">主页</a>
					<a class="list-group-item" href="form.html">表单</a>
					<a class="list-group-item" href="table.html">表格</a>
					<a class="list-group-item" href="chart.html">图表</a>
					<a class="list-group-item has-child" href="#navigation-1" data-toggle="collapse" data-parent="#navigation"
						aria-expanded="false">错误页面<b class="nav-icon"></b></a>
					<div id="navigation-1" class="submenu panel-collapse collapse" aria-expanded="false">
						<a class="list-group-item" href="404.html">404</a>
						<a class="list-group-item" href="403.html">403</a>
						<a class="list-group-item" href="500.html">500</a>
					</div>
					<a class="list-group-item has-child nav-show" href="#navigation-2" data-toggle="collapse" data-parent="#navigation"
						aria-expanded="true">其它页面<b class="nav-icon"></b></a>
					<div id="navigation-2" class="submenu panel-collapse collapse in" aria-expanded="true">
						<a class="list-group-item" href="signin.html">登录页</a>
						<a class="list-group-item active" href="empty.html">空页面</a>
					</div>
				</div>
			</div>
			<div class="content">
				<%=testMethod("这是中文")%>
				<%out.println("Hello World！");%>
				<%=testMethod("233")%>
				<%String body = (String)request.getAttribute("body");%>
				<jsp:include page="<%=body%>"/>
			</div>
		</div>
	</div>
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="static/js/dashboard.js"></script>
</body>

</html>
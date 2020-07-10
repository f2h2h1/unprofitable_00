<%@ page language="java" import="java.util.*" contentType="text/html;charset=gb2312"%>
<%
String path = request.getContextPath();
String basePath = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path+"/";
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<%=basePath %>images/css/bootstrap.css" />
<link rel="stylesheet" href="<%=basePath %>images/css/css.css" />
<script type="text/javascript" src="<%=basePath %>images/js/jquery1.9.0.min.js"></script>
<script type="text/javascript" src="<%=basePath %>images/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<%=basePath %>images/js/sdmenu.js"></script>
<script type="text/javascript" src="<%=basePath %>images/js/laydate/laydate.js"></script>
</HEAD>
<%
	String username=(String)session.getAttribute("user");  String sf=(String)session.getAttribute("sf");  
	if(username==null){
		response.sendRedirect(path+"index.jsp");
	}
	else{ 
%>
<body>
<div class="left">
     
<script type="text/javascript">
var myMenu;
window.onload = function() {
	myMenu = new SDMenu("my_menu");
	myMenu.init();
};
</script>

<div id="my_menu" class="sdmenu">
	
	<div class="collapsed">
		<span>密码信息管理</span>
		<a href="<%=basePath %>admin/system/editpwd.jsp" target="MainFrame">密码信息管理</a> 
	</div>
	<%if(sf.equals("管理员")){ %>
	<div class="collapsed">
		<span>厂家管理</span>
		<a href="<%=basePath %>admin/cw/index.jsp" target="MainFrame">厂家列表</a>  
		<a href="<%=basePath %>admin/cw/add.jsp?method=addcw" target="MainFrame">新增厂家信息</a> 
	</div> 
	<div class="collapsed">
		<span>商店管理</span>
		<a href="<%=basePath %>admin/cw/crime.jsp" target="MainFrame">商店列表</a> 
		<a href="<%=basePath %>admin/cw/addzx.jsp?method=addzx" target="MainFrame">增加商店信息</a> 
	</div> 
	<div class="collapsed">
		<span>商品管理</span>
		<a href="<%=basePath %>admin/cw/indexzf.jsp" target="MainFrame">商品列表</a> 
		<a href="<%=basePath %>admin/cw/addzf.jsp?method=addzf" target="MainFrame">增加商品信息</a> 
	</div> 
	<%} %>
 	<div class="collapsed">
		<span>注销退出系统</span>
		<a onclick="if (confirm('确定要退出吗？')) return true; else return false;" href="<%=basePath %>AdminServlet?method=adminexit" target="_top" >注销退出系统</a>
	</div> 
</div>
     </div>
     <div class="Switch"></div>
     <script type="text/javascript">
	$(document).ready(function(e) {
    $(".Switch").click(function(){
	$(".left").toggle();
	 
		});
});
</script> 
</body>
<%} %>

</html>
<%-- <div class="collapsed">
		<span>毕业要求管理</span>
		<a href="<%=basePath %>admin/byyq/index.jsp" target="MainFrame">毕业要求管理</a> 
		<a href="<%=basePath %>admin/byyq/add.jsp?method=addbyyq" target="MainFrame">增加毕业要求</a> 
		 <a href="<%=basePath %>admin/byyq/s.jsp" target="MainFrame">毕业要求查询</a>  
	</div> 
	<div class="collapsed">
		<span>学生毕业管理</span>
		<a href="<%=basePath %>admin/sf/index.jsp" target="MainFrame">学生毕业管理</a> 
		<a href="<%=basePath %>admin/sf/add.jsp?method=addsf" target="MainFrame">增加学生毕业</a> 
		 <a href="<%=basePath %>admin/sf/s.jsp" target="MainFrame">学生毕业查询</a>  
	</div>  --%>
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
	<%if(sf.equals("系统管理员")){ %>  
	<div class="collapsed">
		<span>教研室管理员</span>
		<a href="<%=basePath %>admin/jys/index.jsp" target="MainFrame">教研室管理员</a> 
		<a href="<%=basePath %>admin/jys/add.jsp?method=addjys" target="MainFrame">增加管理员</a> 
		 <a href="<%=basePath %>admin/jys/s.jsp" target="MainFrame">管理员查询</a>  
	</div> 
	<div class="collapsed">
		<span>教师用户管理</span>
		<a href="<%=basePath %>admin/system/index.jsp" target="MainFrame">教师用户管理</a> 
		<a href="<%=basePath %>admin/system/add.jsp?method=addm" target="MainFrame">增加教师用户</a> 
		 <a href="<%=basePath %>admin/system/s.jsp" target="MainFrame">教师用户查询</a>  
	</div>
	<div class="collapsed">
		<span>学生信息管理</span>
		<a href="<%=basePath %>admin/xs/index.jsp" target="MainFrame">学生信息管理</a> 
		<a href="<%=basePath %>admin/xs/add.jsp?method=addxs" target="MainFrame">增加学生信息</a>  
		<a href="<%=basePath %>admin/xs/s.jsp" target="MainFrame">学生信息查询</a> 
	</div> 
	
	<%}else if(sf.equals("教研室管理员")){ %>
	<div class="collapsed">
		<span>个人信息管理</span>
		<a href="<%=basePath %>admin/jys/index2.jsp" target="MainFrame">个人信息管理</a>  
	</div>
	<div class="collapsed">
		<span>教学任务书管理</span>
		<a href="<%=basePath %>admin/rws/index.jsp" target="MainFrame">教学任务书管理</a> 
		<a href="<%=basePath %>admin/rws/add.jsp?method=addrws" target="MainFrame">增加教学任务书</a> 
		 <a href="<%=basePath %>admin/rws/s.jsp" target="MainFrame">教学任务书查询</a>  
	</div>   
	<div class="collapsed">
		<span>课表信息管理</span>
		<a href="<%=basePath %>admin/kb/index.jsp" target="MainFrame">课表信息管理</a> 
		<a href="<%=basePath %>admin/kb/add.jsp?method=addkb" target="MainFrame">增加课表信息</a> 
		 <a href="<%=basePath %>admin/kb/s.jsp" target="MainFrame">课表信息查询</a>  
	</div> 
	<div class="collapsed">
		<span>授课计划管理</span>
		<a href="<%=basePath %>admin/sk/index2.jsp" target="MainFrame">授课计划管理</a>  
		 <a href="<%=basePath %>admin/sk/s2.jsp" target="MainFrame">授课计划查询</a>  
	</div>
	<div class="collapsed">
		<span>课程讲义管理</span>
		<a href="<%=basePath %>admin/jy/index2.jsp" target="MainFrame">课程讲义管理</a>  
		 <a href="<%=basePath %>admin/jy/s2.jsp" target="MainFrame">课程讲义查询</a>  
	</div> 
	
	<%}else if(sf.equals("教师")){ %> 
	<div class="collapsed">
		<span>个人信息管理</span>
		<a href="<%=basePath %>admin/system/index2.jsp" target="MainFrame">个人信息管理</a>  
	</div>
	<div class="collapsed">
		<span>课表信息查看</span>
		<a href="<%=basePath %>admin/kb/index2.jsp" target="MainFrame">课表信息查看</a>  
		 <a href="<%=basePath %>admin/kb/s2.jsp" target="MainFrame">课表信息查询</a>  
	</div> 
	<div class="collapsed">
		<span>授课计划管理</span>
		<a href="<%=basePath %>admin/sk/index.jsp" target="MainFrame">授课计划管理</a> 
		<a href="<%=basePath %>admin/sk/add.jsp?method=addsk" target="MainFrame">增加授课计划</a> 
		 <a href="<%=basePath %>admin/sk/s.jsp" target="MainFrame">授课计划查询</a>  
	</div>
	<div class="collapsed">
		<span>课程讲义管理</span>
		<a href="<%=basePath %>admin/jy/index.jsp" target="MainFrame">课程讲义管理</a> 
		<a href="<%=basePath %>admin/jy/add.jsp?method=addjy" target="MainFrame">增加课程讲义</a> 
		 <a href="<%=basePath %>admin/jy/s.jsp" target="MainFrame">课程讲义查询</a>  
	</div> 
	<div class="collapsed">
		<span>作业信息管理</span>
		<a href="<%=basePath %>admin/zy/index.jsp" target="MainFrame">作业信息管理</a> 
		<a href="<%=basePath %>admin/zy/add.jsp?method=addzy" target="MainFrame">增加作业信息</a> 
		 <a href="<%=basePath %>admin/zy/s.jsp" target="MainFrame">作业信息查询</a>  
	</div> 
	<div class="collapsed">
		<span>上交作业管理</span>
		<a href="<%=basePath %>admin/sc/index2.jsp" target="MainFrame">上交作业管理</a>  
		 <a href="<%=basePath %>admin/sc/s2.jsp" target="MainFrame">上交作业查询</a>  
	</div>
	<div class="collapsed">
		<span>实践任务管理</span>
		<a href="<%=basePath %>admin/rw/index.jsp" target="MainFrame">实践任务管理</a>  
		<a href="<%=basePath %>admin/rw/add.jsp?method=addrw" target="MainFrame">增加实践任务</a> 
		 <a href="<%=basePath %>admin/rw/s.jsp" target="MainFrame">实践任务查询</a>  
	</div>
	<div class="collapsed">
		<span>上交报告管理</span>
		<a href="<%=basePath %>admin/srw/index2.jsp" target="MainFrame">上交报告管理</a>  
		 <a href="<%=basePath %>admin/srw/s2.jsp" target="MainFrame">上交报告查询</a>  
	</div> 
	
	
	<%}else if(sf.equals("学生")){ %> 
	<div class="collapsed">
		<span>个人信息管理</span>
		<a href="<%=basePath %>admin/xs/index2.jsp" target="MainFrame">个人信息管理</a>  
	</div>
	<div class="collapsed">
		<span>课表信息查看</span>
		<a href="<%=basePath %>admin/kb/index2.jsp" target="MainFrame">课表信息查看</a>  
		 <a href="<%=basePath %>admin/kb/s2.jsp" target="MainFrame">课表信息查询</a>  
	</div> 
	<div class="collapsed">
		<span>作业信息查看</span>
		<a href="<%=basePath %>admin/zy/index2.jsp" target="MainFrame">作业信息查看</a>  
		 <a href="<%=basePath %>admin/zy/s2.jsp" target="MainFrame">作业信息查询</a>  
	</div> 
	<div class="collapsed">
		<span>上交作业管理</span>
		<a href="<%=basePath %>admin/sc/index.jsp" target="MainFrame">上交作业管理</a>   
		 <a href="<%=basePath %>admin/sc/s.jsp" target="MainFrame">上交作业查询</a>  
	</div>
	
	<div class="collapsed">
		<span>实践任务查看</span>
		<a href="<%=basePath %>admin/rw/index2.jsp" target="MainFrame">实践任务查看</a>  
		 <a href="<%=basePath %>admin/rw/s2.jsp" target="MainFrame">实践任务查询</a>  
	</div> 
	<div class="collapsed">
		<span>上交报告管理</span>
		<a href="<%=basePath %>admin/srw/index.jsp" target="MainFrame">上交报告管理</a>   
		 <a href="<%=basePath %>admin/srw/s.jsp" target="MainFrame">上交报告查询</a>  
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

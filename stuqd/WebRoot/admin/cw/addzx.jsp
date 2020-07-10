<%@ page language="java" import="java.util.*"  contentType="text/html;charset=gb2312"%>  
<jsp:useBean id="cb" scope="page" class="com.bean.ComBean" />  
<%
  	String path = request.getContextPath();
  	String basePath = request.getScheme() + "://"
  			+ request.getServerName() + ":" + request.getServerPort()
  			+ path + "/";
  	String htmlData = request.getParameter("content1") != null ? request
  			.getParameter("content1")
  			: "";
  %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<%=basePath%>images/css/bootstrap.css" />
<link rel="stylesheet" href="<%=basePath%>images/css/css.css" />
<script type="text/javascript" src="<%=basePath%>images/js/jquery1.9.0.min.js"></script>
<script type="text/javascript" src="<%=basePath%>images/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<%=basePath%>images/js/sdmenu.js"></script>
<script type="text/javascript" src="<%=basePath%>images/js/laydate/laydate.js"></script>
</head>
<%
	String message = (String) session.getAttribute("message");
	if (message == null) {
		message = "";
	}
	if (!message.trim().equals("")) {
		out.println("<script language='javascript'>");
		out.println("alert('" + message + "');");
		out.println("</script>");
	}
	session.removeAttribute("message");

	String admin = (String) session.getAttribute("user");
	if (admin == null) {
		response.sendRedirect(path + "index.jsp");
	} else {
		String method = request.getParameter("method");
		String id = "";
		String name = "";
		String phone = "";
		if (method.equals("upzx")) {
			id = request.getParameter("id");
			List jlist = cb.get1Com("select * from tb_shop where id='" + id+ "'", 3);
			name = jlist.get(1).toString();
			phone = jlist.get(2).toString();
			
		}
%>
<body>
<div class="right_cont">
<div class="title_right"><strong>商店信息</strong></div>  
<div style="width:900px;margin:auto;">
<form action="<%=basePath%>ComServlet" method="post" name="form1">
<table class="table table-bordered"> 
     <tr>
     <input type="hidden" name="method" value="<%=method%>" />
     <input type="hidden" name="id" value="<%=id%>" />
     
     
     <%if(method.equals("upcw")){ %>
     <td width="40%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">商店编号：</td>
     <td>
     <input type="text" name="jsbh" class="span4" value="<%=id%>" readonly="readonly"/>
     <%}else{ %>
     <%-- <input type="text" name="jsbh" class="span4" value="<%=id%>" required/> --%>
     <%} %>
     </td> 
     </tr> 
     <tr>
     <td width="40%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">商店名称：</td>
     <td><input type="text" name="name" class="span4" value="<%=name%>" required/></td> 
     </tr> 
     <tr>
     <td width="40%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">联系电话：</td>
     <td><input type="text" name="phone" class="span2" value="<%=phone%>" required/></td> 
     </tr> 
   
     <tr>
     	<td class="text-center" colspan="2"><input type="submit" value="确定" class="btn btn-info  " style="width:80px;" /></td>
     </tr>
     </table> 
</form>
   </div>  
 </div>  
</body>
<%
	}
%>
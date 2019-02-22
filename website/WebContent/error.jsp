<%@ page language="java" import="java.util.*" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>error - jsp</title>
</head>
<body>
<%
String errorMsg = (String)request.getAttribute("errorMsg");
%>
<h1>error</h1>
<p><%=errorMsg%></p>
</body>
</html>
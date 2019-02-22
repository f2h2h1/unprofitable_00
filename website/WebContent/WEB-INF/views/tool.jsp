<%@ page language="java" import="java.util.*" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%!
public String testMethod(String param)
{
	return param;
}
public String websiteName(HttpServletRequest request)
{
	return (String)request.getAttribute("websiteName");
}
%>
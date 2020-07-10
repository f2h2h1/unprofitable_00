<%@ page language="java" import="java.util.*"  contentType="text/html;charset=gb2312" %>
<%@ include file="iframe/head.jsp" %> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript">
<!--
function reload(){
	document.getElementById("image").src="<%=request.getContextPath() %>/imageServlet?date="+new Date().getTime();
	$("#checkcode").val("");   // 将验证码清空
} 
function verificationcode(){
 var text=$.trim($("#checkcode").val());
 $.post("${pageContext.request.contextPath}/verificationServlet",{op:text},function(data){
	 data=parseInt($.trim(data));
	 if(data>0){
		 $("#checklable").text("验证码正确!").css("color","green");
	 }else{
		 $("#checklable").text("验证码错误!").css("color","red");
 			$("#checkcode").val(""); // 将验证码清空
		    reload();  //验证失败后需要更换验证码
	 }
 });
}
//-->
</script>
<div class="main" style="">
 <div class="narea"><div>
</div></div>
<div class="rmain">        
<div class="tom"><div class="totitle"><span> </span></div></div>  
<div class="rlist">  
<FORM name="loginform" method="post" action="<%=basePath %>AdminServlet?method=one"> 
   <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="table">
	  <tbody>
	     <tr class="tr1">
            <td class="rldatee daslist"></td>
			<td class="rltitle daslist">&nbsp;&nbsp;&nbsp;&nbsp;登录界面</td> 
         </tr>
	     <tr class="tr1">
			<td class="rldatee daslist">登录帐号：</td> 
            <td class="rltitle dotlist"><input type="text" size="30" name="username" class="form-control" required /></td> 
         </tr> 
         <tr class="tr1">
			<td class="rldatee daslist">登录密码：</td>
            <td class="rltitle dotlist"><input type="password" size="30" class="form-control" name="password" required /></td> 
         </tr>
         <tr class="tr1">
			<td class="rldatee daslist">验证码：</td>
            <td class="rltitle dotlist">
            <input type="text" size="30" name="checkcode" id="checkcode"  class="form-control" onblur="javascript:verificationcode()" required />
            <label id="checklable"></label>
<br />
<img src="<%=request.getContextPath()%>/imageServlet" alt="验证码" id="image" />
<a href="javascript:reload();"><label>换一张</label>
</a>
<br>
            </td> 
         </tr>
         <tr class="tr1">
			<td class="rldatee daslist">身份：</td>
            <td class="rltitle dotlist">
            <label><input type="radio" name="sf" value="管理员" checked="checked"> 管理员</label>
             </td> 
         </tr> 
         <tr class="tr1">
            <td class="rldatee daslist"></td>
			<td class="rltitle daslist">
			<input type="submit" value="登录" style="width:80px;" />
			<input type="reset" value="重置" style="width:80px;" />
			<!-- <a href="reg.jsp">
			<input type="button" value="学生注册" style="width:80px;" />
			</a> -->
			</td> 
         </tr>
         <tr class="tr1">
            <td class="rldatee daslist"></td>
			<td class="rltitle daslist">&nbsp;</td> 
         </tr>  
         <tr class="tr1">
            <td class="rldatee daslist"></td>
			<td class="rltitle daslist">&nbsp;</td> 
         </tr>
      </tbody>
</table> 
</FORM> 
</div>
</div> 
</div>
<%-- <%@ include file="iframe/foot.jsp"%> --%>
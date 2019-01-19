package com.action;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import com.bean.ComBean;
import com.util.Constant;

public class ComServlet extends HttpServlet {

	/**
	 * Constructor of the object.
	 */
	public ComServlet() {
		super();
	}

	/**
	 * Destruction of the servlet. <br>
	 */
	public void destroy() {
		super.destroy(); // Just puts "destroy" string in log
		// Put your code here
	}

	/**
	 * The doGet method of the servlet. <br>
	 *
	 * This method is called when a form has its tag value method equals to get.
	 * 
	 * @param request the request send by the client to the server
	 * @param response the response send by the server to the client
	 * @throws ServletException if an error occurred
	 * @throws IOException if an error occurred
	 */
	public void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		doPost(request,response);
	}

	/**
	 * The doPost method of the servlet. <br>
	 *
	 * This method is called when a form has its tag value method equals to post.
	 * 
	 * @param request the request send by the client to the server
	 * @param response the response send by the server to the client
	 * @throws ServletException if an error occurred
	 * @throws IOException if an error occurred
	 */
	public void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		response.setContentType(Constant.CONTENTTYPE);
		request.setCharacterEncoding(Constant.CHARACTERENCODING);
		HttpSession session = request.getSession();
		ComBean cBean = new ComBean();
		String date=new SimpleDateFormat("yyyy-MM-dd").format(Calendar.getInstance().getTime());
		String date2=new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(Calendar.getInstance().getTime());
		String method = request.getParameter("method");
		
		if(method.equals("delrws")){//删除任务书
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from rws where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/rws/index.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/rws/index.jsp").forward(request, response);
			}
		} 
		else if(method.equals("delkb")){//删除课表
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from kb where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/kb/index.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/kb/index.jsp").forward(request, response);
			}
		} 
		else if(method.equals("delzy")){//删除作业
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from zy where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/zy/index.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/zy/index.jsp").forward(request, response);
			}
		}
		else if(method.equals("delrw")){//删除实践任务
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from rw where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/rw/index.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/rw/index.jsp").forward(request, response);
			}
		} 
		else if(method.equals("delsk")){//删除授课计划
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from sk where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/sk/index.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/sk/index.jsp").forward(request, response);
			}
		} 
		else if(method.equals("spsk")){ //审批授课计划 
			String id=request.getParameter("id");
			String tg = request.getParameter("tg");  
			String yj = request.getParameter("yj"); 
			int flag = cBean.comUp("update sk set tg='"+tg+"' ,yj='"+yj+"' where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/sk/index2.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/sk/index2.jsp").forward(request, response);
			}  
		} 
		else if(method.equals("delsk2")){//删除授课计划
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from sk where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/sk/index2.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/sk/index2.jsp").forward(request, response);
			}
		} 
		else if(method.equals("deljy")){//删除课程讲义
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from jy where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/jy/index.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/jy/index.jsp").forward(request, response);
			}
		} 
		else if(method.equals("deljy2")){//删除课程讲义
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from jy where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/jy/index2.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/jy/index2.jsp").forward(request, response);
			}
		} 
		else if(method.equals("spjy")){ //审批课程讲义 
			String id=request.getParameter("id");
			String tg = request.getParameter("tg");  
			String yj = request.getParameter("yj"); 
			int flag = cBean.comUp("update jy set tg='"+tg+"' ,yj='"+yj+"' where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/jy/index2.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/jy/index2.jsp").forward(request, response);
			}  
		} 
		
		else if(method.equals("delsc")){//删除上交作业
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from sc where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/sc/index.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/sc/index.jsp").forward(request, response);
			}
		} 
		else if(method.equals("spsc")){ //审批上交作业 
			String id=request.getParameter("id");
			String pf = request.getParameter("pf");  
			String py = request.getParameter("py"); 
			int flag = cBean.comUp("update sc set pf='"+pf+"' ,py='"+py+"' where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/sc/index2.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/sc/index2.jsp").forward(request, response);
			}  
		} 
		else if(method.equals("delsc2")){//删除上交作业
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from sc where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/sc/index2.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/sc/index2.jsp").forward(request, response);
			}
		} 
		
		
		
		else if(method.equals("delsrw")){//删除上交报告
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from srw where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/srw/index.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/srw/index.jsp").forward(request, response);
			}
		} 
		else if(method.equals("spsrw")){ //审批上交报告 
			String id=request.getParameter("id");
			String pf = request.getParameter("pf");  
			String py = request.getParameter("py"); 
			int flag = cBean.comUp("update srw set pf='"+pf+"' ,py='"+py+"' where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/srw/index2.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/srw/index2.jsp").forward(request, response);
			}  
		} 
		else if(method.equals("delsrw2")){//删除上交报告
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from srw where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				request.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/srw/index2.jsp").forward(request, response);
			}
			else{
				request.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/srw/index2.jsp").forward(request, response);
			}
		} 
	}

	/**
	 * Initialization of the servlet. <br>
	 *
	 * @throws ServletException if an error occure
	 */
	public void init() throws ServletException {
		// Put your code here
	}

}

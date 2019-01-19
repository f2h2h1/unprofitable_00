package com.action;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Calendar;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import com.bean.ComBean;
import com.util.Constant;
import com.util.SmartFile;
import com.util.SmartUpload;

public class UpServlet extends HttpServlet {

	private ServletConfig config;
	/**
	 * Constructor of the object.
	 */
	public UpServlet() {
		super();
	}

	final public void init(ServletConfig config) throws ServletException
    {
        this.config = config;  
    }

    final public ServletConfig getServletConfig()
    {
        return config;
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

		request.setCharacterEncoding(Constant.CHARACTERENCODING);
		response.setContentType(Constant.CONTENTTYPE);
		String date=new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(Calendar.getInstance().getTime());
		String date2=new SimpleDateFormat("yyyy-MM-dd").format(Calendar.getInstance().getTime());
		String method = "";;
		ComBean cb = new ComBean(); 
		SmartUpload mySmartUpload = new SmartUpload();//init
		int count = 0;
		HttpSession session = request.getSession();
		try{
			mySmartUpload.initialize(config,request,response);
            mySmartUpload.upload(); 
            method = mySmartUpload.getRequest().getParameter("method").trim();
            if(method.equals("addrws")){// 上传任务书 
            	String admin=(String)session.getAttribute("user"); 
            	String mc = mySmartUpload.getRequest().getParameter("mc");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path);   
				int flag=cb.comUp("insert into rws(mc,url,bz,yh) values('"+mc+"','"+path+"/"+file.getFileName()+"','"+bz+"' ,'"+admin+"')");
				if(flag == Constant.SUCCESS){ 
					request.setAttribute("message", "操作成功！");
					request.getRequestDispatcher("admin/rws/index.jsp").forward(request, response); 
				}
				else { 
					request.setAttribute("message", "操作失败！");
					request.getRequestDispatcher("admin/rws/index.jsp").forward(request, response); 
				}  
            } 					
            else if(method.equals("uprws")){//修改 任务书 
            	String id = mySmartUpload.getRequest().getParameter("id");
            	String mc = mySmartUpload.getRequest().getParameter("mc");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path); 
            	if(count==0){
            		int flag=cb.comUp("update rws set mc='"+mc+"',bz='"+bz+"' where id='"+id+"'");
    				if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/rws/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/rws/index.jsp").forward(request, response); 
    				}
            	}
            	else{ 
            		int flag = cb.comUp("update rws set mc='"+mc+"',url='"+path+"/"+file.getFileName()+"',bz='"+bz+"' where id='"+id+"' ");
            		if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/rws/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/rws/index.jsp").forward(request, response); 
    				}
            	}                    
            }
            
            
             
            else if(method.equals("addkb")){// 上传 课表
            	String admin=(String)session.getAttribute("user"); 
            	String mc = mySmartUpload.getRequest().getParameter("mc");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path);   
				int flag=cb.comUp("insert into kb(mc,url,bz,yh) values('"+mc+"','"+path+"/"+file.getFileName()+"','"+bz+"' ,'"+admin+"')");
				if(flag == Constant.SUCCESS){ 
					request.setAttribute("message", "操作成功！");
					request.getRequestDispatcher("admin/kb/index.jsp").forward(request, response); 
				}
				else { 
					request.setAttribute("message", "操作失败！");
					request.getRequestDispatcher("admin/kb/index.jsp").forward(request, response); 
				}  
            } 					
            else if(method.equals("upkb")){//修改 课表
            	String id = mySmartUpload.getRequest().getParameter("id");
            	String mc = mySmartUpload.getRequest().getParameter("mc");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path); 
            	if(count==0){
            		int flag=cb.comUp("update kb set mc='"+mc+"',bz='"+bz+"' where id='"+id+"'");
    				if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/kb/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/kb/index.jsp").forward(request, response); 
    				}
            	}
            	else{ 
            		int flag = cb.comUp("update kb set mc='"+mc+"',url='"+path+"/"+file.getFileName()+"',bz='"+bz+"' where id='"+id+"' ");
            		if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/kb/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/kb/index.jsp").forward(request, response); 
    				}
            	}                    
            }
            
            else if(method.equals("addzy")){// 上传 作业
            	String admin=(String)session.getAttribute("user"); 
            	String mc = mySmartUpload.getRequest().getParameter("mc");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path);   
				int flag=cb.comUp("insert into zy(mc,url,bz,yh) values('"+mc+"','"+path+"/"+file.getFileName()+"','"+bz+"' ,'"+admin+"')");
				if(flag == Constant.SUCCESS){ 
					request.setAttribute("message", "操作成功！");
					request.getRequestDispatcher("admin/zy/index.jsp").forward(request, response); 
				}
				else { 
					request.setAttribute("message", "操作失败！");
					request.getRequestDispatcher("admin/zy/index.jsp").forward(request, response); 
				}  
            } 					
            else if(method.equals("upzy")){//修改 作业
            	String id = mySmartUpload.getRequest().getParameter("id");
            	String mc = mySmartUpload.getRequest().getParameter("mc");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path); 
            	if(count==0){
            		int flag=cb.comUp("update zy set mc='"+mc+"',bz='"+bz+"' where id='"+id+"'");
    				if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/zy/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/zy/index.jsp").forward(request, response); 
    				}
            	}
            	else{ 
            		int flag = cb.comUp("update zy set mc='"+mc+"',url='"+path+"/"+file.getFileName()+"',bz='"+bz+"' where id='"+id+"' ");
            		if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/zy/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/zy/index.jsp").forward(request, response); 
    				}
            	}                    
            }
            
            else if(method.equals("addrw")){// 上传 实践任务
            	String admin=(String)session.getAttribute("user"); 
            	String mc = mySmartUpload.getRequest().getParameter("mc");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path);   
				int flag=cb.comUp("insert into rw(mc,url,bz,yh) values('"+mc+"','"+path+"/"+file.getFileName()+"','"+bz+"' ,'"+admin+"')");
				if(flag == Constant.SUCCESS){ 
					request.setAttribute("message", "操作成功！");
					request.getRequestDispatcher("admin/rw/index.jsp").forward(request, response); 
				}
				else { 
					request.setAttribute("message", "操作失败！");
					request.getRequestDispatcher("admin/rw/index.jsp").forward(request, response); 
				}  
            } 					
            else if(method.equals("uprw")){//修改 实践任务
            	String id = mySmartUpload.getRequest().getParameter("id");
            	String mc = mySmartUpload.getRequest().getParameter("mc");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path); 
            	if(count==0){
            		int flag=cb.comUp("update rw set mc='"+mc+"',bz='"+bz+"' where id='"+id+"'");
    				if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/rw/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/rw/index.jsp").forward(request, response); 
    				}
            	}
            	else{ 
            		int flag = cb.comUp("update rw set mc='"+mc+"',url='"+path+"/"+file.getFileName()+"',bz='"+bz+"' where id='"+id+"' ");
            		if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/rw/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/rw/index.jsp").forward(request, response); 
    				}
            	}                    
            }
            
            else if(method.equals("addsk")){// 上传 授课计划 
            	String admin=(String)session.getAttribute("user"); 
            	String mc = mySmartUpload.getRequest().getParameter("mc");   
            	String fs = mySmartUpload.getRequest().getParameter("fs");  
            	String xs = mySmartUpload.getRequest().getParameter("xs");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path);   
				int flag=cb.comUp("insert into sk(mc,fs,xs,url,bz,yh,tg,yj) values('"+mc+"','"+fs+"','"+xs+"','"+path+"/"+file.getFileName()+"','"+bz+"' ,'"+admin+"','暂无','暂无')");
				if(flag == Constant.SUCCESS){ 
					request.setAttribute("message", "操作成功！");
					request.getRequestDispatcher("admin/sk/index.jsp").forward(request, response); 
				}
				else { 
					request.setAttribute("message", "操作失败！");
					request.getRequestDispatcher("admin/sk/index.jsp").forward(request, response); 
				}  
            } 					
            else if(method.equals("upsk")){//修改 授课计划
            	String id = mySmartUpload.getRequest().getParameter("id");
            	String mc = mySmartUpload.getRequest().getParameter("mc"); 
            	String fs = mySmartUpload.getRequest().getParameter("fs");
            	String xs = mySmartUpload.getRequest().getParameter("xs");   
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path); 
            	if(count==0){
            		int flag=cb.comUp("update sk set mc='"+mc+"',fs='"+fs+"',xs='"+xs+"',bz='"+bz+"' where id='"+id+"'");
    				if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/sk/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/sk/index.jsp").forward(request, response); 
    				}
            	}
            	else{ 
            		int flag = cb.comUp("update sk set mc='"+mc+"',fs='"+fs+"',xs='"+xs+"',url='"+path+"/"+file.getFileName()+"',bz='"+bz+"' where id='"+id+"' ");
            		if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/sk/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/sk/index.jsp").forward(request, response); 
    				}
            	}                    
            }
            
            
            else if(method.equals("addjy")){// 上传 课程讲义
            	String admin=(String)session.getAttribute("user"); 
            	String mc = mySmartUpload.getRequest().getParameter("mc");    
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path);   
				int flag=cb.comUp("insert into jy(mc,url,bz,yh,tg,yj) values('"+mc+"','"+path+"/"+file.getFileName()+"','"+bz+"' ,'"+admin+"','暂无','暂无')");
				if(flag == Constant.SUCCESS){ 
					request.setAttribute("message", "操作成功！");
					request.getRequestDispatcher("admin/jy/index.jsp").forward(request, response); 
				}
				else { 
					request.setAttribute("message", "操作失败！");
					request.getRequestDispatcher("admin/jy/index.jsp").forward(request, response); 
				}  
            } 					
            else if(method.equals("upjy")){//修改 课程讲义
            	String id = mySmartUpload.getRequest().getParameter("id");
            	String mc = mySmartUpload.getRequest().getParameter("mc");  
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path); 
            	if(count==0){
            		int flag=cb.comUp("update jy set mc='"+mc+"',bz='"+bz+"' where id='"+id+"'");
    				if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/jy/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/jy/index.jsp").forward(request, response); 
    				}
            	}
            	else{ 
            		int flag = cb.comUp("update jy set mc='"+mc+"',url='"+path+"/"+file.getFileName()+"',bz='"+bz+"' where id='"+id+"' ");
            		if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/jy/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/jy/index.jsp").forward(request, response); 
    				}
            	}                    
            }
            
            
            else if(method.equals("sjzy")){// 上传 上交作业
            	String admin=(String)session.getAttribute("user"); 
            	String zyid = mySmartUpload.getRequest().getParameter("zyid");  
            	String mc = mySmartUpload.getRequest().getParameter("mc");    
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	String js=cb.getString("select yh from zy where id='"+zyid+"'");
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path);   
            	String str=cb.getString("select id from sc where yh='"+admin+"' and zyid='"+zyid+"'");
            	if(str==null){
            		int flag=cb.comUp("insert into sc(mc,url,bz,yh,pf,py,js,zyid) " +
    						"values('"+mc+"','"+path+"/"+file.getFileName()+"','"+bz+"' ,'"+admin+"','暂无','暂无','"+js+"','"+zyid+"')");
    				if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/sc/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/sc/index.jsp").forward(request, response); 
    				}  
            	}
            	else{
            		request.setAttribute("message", "请不要重复上交！");
					request.getRequestDispatcher("admin/sc/index.jsp").forward(request, response); 
            	} 
            } 	
            else if(method.equals("sjrw")){// 上传  
            	String admin=(String)session.getAttribute("user"); 
            	String rwid = mySmartUpload.getRequest().getParameter("rwid");  
            	String mc = mySmartUpload.getRequest().getParameter("mc");    
            	String bz = mySmartUpload.getRequest().getParameter("bz");   
            	String js=cb.getString("select yh from rw where id='"+rwid+"'");
            	SmartFile file = mySmartUpload.getFiles().getFile(0); 
            	String fileExt=file.getFileExt();	            
            	String path="upfile";
            	count = mySmartUpload.save(path);  
            	String str=cb.getString("select id from srw where yh='"+admin+"' and rwid='"+rwid+"'");
            	if(str==null){
            		int flag=cb.comUp("insert into srw(mc,url,bz,yh,pf,py,js,rwid) " +
    						"values('"+mc+"','"+path+"/"+file.getFileName()+"','"+bz+"' ,'"+admin+"','暂无','暂无','"+js+"','"+rwid+"')");
    				if(flag == Constant.SUCCESS){ 
    					request.setAttribute("message", "操作成功！");
    					request.getRequestDispatcher("admin/srw/index.jsp").forward(request, response); 
    				}
    				else { 
    					request.setAttribute("message", "操作失败！");
    					request.getRequestDispatcher("admin/srw/index.jsp").forward(request, response); 
    				}  
            	}
            	else{
            		request.setAttribute("message", "请不要重复上交！");
					request.getRequestDispatcher("admin/srw/index.jsp").forward(request, response); 
            	}  
            } 	
		}catch(Exception e){
			e.printStackTrace();
			request.getRequestDispatcher("error.jsp").forward(request, response);
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

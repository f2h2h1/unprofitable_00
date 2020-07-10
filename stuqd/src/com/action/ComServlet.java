package com.action;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
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
		//String date2=new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(Calendar.getInstance().getTime());
		String method = request.getParameter("method");
		if(method.equals("addcw")){  //  添加厂家
			String id=request.getParameter("id");
			String address = request.getParameter("address"); 
			String phone = request.getParameter("phone");   
			String str=cBean.getString("select id from tb_factory where id='"+id+"'");
			if(str==null){
				int flag = cBean.comUp("insert into tb_factory(address,phone)  values('"+address+"','"+phone+"')");
				if(flag == Constant.SUCCESS){ 
					session.setAttribute("message", "操作成功！");
					request.getRequestDispatcher("admin/cw/index.jsp").forward(request, response);
				}
				else{
					session.setAttribute("message", "操作失败！");
					request.getRequestDispatcher("admin/cw/index.jsp").forward(request, response);
				} 
			}
			
		} 
		else if(method.equals("upcw")){ //修改厂家 
			String id=request.getParameter("id");
			String address = request.getParameter("address"); 
			String phone = request.getParameter("phone");  
			int flag = cBean.comUp("update tb_factory set address='"+address+"',phone='"+phone+"' where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				session.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/cw/index.jsp").forward(request, response);
			}
			else{
				session.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/cw/index.jsp").forward(request, response);
			}  
			
		} 
		else if(method.equals("addzf")){  //  添加商品
			String id=request.getParameter("id");
			String name = request.getParameter("name"); 
			String gclass = request.getParameter("gclass"); 
			String stock = request.getParameter("stock"); 
		
			String str=cBean.getString("select id from tb_goods where id='"+id+"'");
			if(str==null){
				int flag=cBean.comUp("insert into tb_goods(goods_name,goods_class,stock) " +
						"values('"+name+"','"+gclass+"','"+stock+"' )");
				if(flag == Constant.SUCCESS){ 
					session.setAttribute("message", "操作成功！");
					request.getRequestDispatcher("admin/cw/indexzf.jsp").forward(request, response);
				}
				else{
					session.setAttribute("message", "操作失败！");
					request.getRequestDispatcher("admin/cw/indexzf.jsp").forward(request, response);
				} 
			}
		
		}
		else if(method.equals("upzf")){  //  修改商品
			String id=request.getParameter("id");
			String name = request.getParameter("name"); 
			String gclass = request.getParameter("gclass"); 
			String stock = request.getParameter("stock"); 
			int flag = cBean.comUp("update  tb_goods  set goods_name='"+name+"',goods_class='"+gclass+"',stock='"+stock+"' where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				session.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/cw/indexzf.jsp").forward(request, response);
			}
			else{
				session.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/cw/indexzf.jsp").forward(request, response);
			} 
			
		} else if(method.equals("addzx")){  //  添加商店信息
			String id=request.getParameter("id");
			String name = request.getParameter("name"); 
			String phone = request.getParameter("phone"); 
		 
			
			SimpleDateFormat form = new SimpleDateFormat("yyyy-MM-dd HH:dd:ss");
			String str=cBean.getString("select id from tb_shop where id='"+id+"'");
			if(str==null){
				int flag=cBean.comUp("insert into tb_shop(shop_name,phone) " +
						"values('"+name+"','"+phone+"' )");
				if(flag == Constant.SUCCESS){ 
					session.setAttribute("message", "操作成功！");
					request.getRequestDispatcher("admin/cw/crime.jsp").forward(request, response);
				}
				else{
					session.setAttribute("message", "操作失败！");
					request.getRequestDispatcher("admin/cw/crime.jsp").forward(request, response);
				} 
			}
		
		}else if(method.equals("upzx")){  //  修改商店信息
			String id=request.getParameter("id");
			String name = request.getParameter("name"); 
			String phone = request.getParameter("phone");
			int flag = cBean.comUp("update  tb_shop  set shop_name='"+name+"',phone='"+phone+"' where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				session.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/cw/crime.jsp").forward(request, response);
			}
			else{
				session.setAttribute("message", "操作失败！");
				request.getRequestDispatcher("admin/cw/crime.jsp").forward(request, response);
			} 
			
		}
		else if(method.equals("deljy")){//删除 厂家
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from tb_factory where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				session.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/cw/index.jsp").forward(request, response);
			}
			else{
				session.setAttribute("message", "系统维护中，请稍后再试！");
				request.getRequestDispatcher("admin/cw/index.jsp").forward(request, response);
			}
		}  
		else if(method.equals("delzf")){//删除商品
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from tb_goods where id='"+id+"'");
			if(flag == Constant.SUCCESS){ 
				session.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/cw/indexzf.jsp").forward(request, response);
			}
			else{
				session.setAttribute("message", "系统维护中，请稍后再试！");
				request.getRequestDispatcher("admin/cw/crime.jsp").forward(request, response);
			}
		}  
		else if(method.equals("delzx")){//删除商店
			String id = request.getParameter("id"); 
			int flag = cBean.comUp("delete from tb_shop where id="+id);
			if(flag == Constant.SUCCESS){ 
				session.setAttribute("message", "操作成功！");
				request.getRequestDispatcher("admin/cw/crime.jsp").forward(request, response);
			}
			else{
				session.setAttribute("message", "系统维护中，请稍后再试！");
				request.getRequestDispatcher("admin/cw/indexzf.jsp").forward(request, response);
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

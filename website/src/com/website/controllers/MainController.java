package com.website.controllers;

import java.io.PrintWriter;
import java.io.IOException;
import java.io.File;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.servlet.ServletException;

public class MainController {

	public static final String METHOD_POST = "POST";

	protected HttpServletRequest req;
	protected HttpServletResponse resp;
	protected String webRoot;
	public String viewFolderPath = "WEB-INF/views/";
	public String method;
	public HttpSession session;

	public MainController(HttpServletRequest req, HttpServletResponse resp, String webRoot)
	{
		this.req = req;
		this.resp = resp;
		this.webRoot = webRoot;
		this.method = req.getMethod();
		this.session = req.getSession();
	}

	protected void view(String viewName) throws ServletException, IOException
	{
		String controllerName = getControllerName();
		if (controllerName == null || controllerName.isEmpty())
		{
			error("控制器错误");
		}

		String viewPath = viewFolderPath + controllerName + "/" + viewName +".jsp";
		if (!isFileExists(viewPath))
		{
			error("视图文件不存在 " + viewPath);
		}

		// req.setAttribute("body", viewName +".jsp");
		req.setAttribute("body", controllerName + "/" + viewName +".jsp");
		// viewPath = viewFolderPath + controllerName + "/include_main.jsp";
		viewPath = viewFolderPath + "_layout.jsp";
		req.getRequestDispatcher(viewPath).forward(req, resp);
	}

	protected void error(String errorMsg) throws ServletException, IOException
	{
		req.setAttribute("errorMsg", errorMsg);
		req.getRequestDispatcher("error.jsp").forward(req, resp);
	}

	protected String getControllerName()
	{
		String className = this.getClass().getSimpleName();
		try
		{
			return className.substring(0, className.length()-10);
		}
		catch (Exception e)
		{
			return null;
		}
	}

	// 判断文件是否存在
	public Boolean isFileExists(String filePath)
	{
		File file = new File(webRoot + filePath);
		System.out.println(file.exists());
		if (file.exists())
		{
			return true;
		}
		return false;
	}

	// 判断是否为 post 请求
	public Boolean isPost()
	{
		if (method.equals(METHOD_POST))
		{
			return true;
		}
		return false;
	}

	public void redirect(String route, HttpServletResponse resp) throws IOException
	{
		resp.sendRedirect("/Bootstrap?r=" + route);
	}
}

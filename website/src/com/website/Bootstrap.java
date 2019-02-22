package com.website;

import java.io.PrintWriter;
import java.io.IOException;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.lang.String.*;
// import org.apache.commons.lang3.*;
import java.lang.reflect.Method;
import java.lang.reflect.Constructor;
import java.lang.NoSuchMethodException;
import java.lang.ClassNotFoundException;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.Properties;

@WebServlet(
	name = "Bootstrap",
	urlPatterns = {"/Bootstrap"}
)
public class Bootstrap extends HttpServlet {

	private String webRoot;
	public String websiteName;


	@Override
	public void init() throws ServletException {
		webRoot = this.getServletContext().getRealPath("/");
		// InputStream inputStream = Bootstrap.class.getClassLoader().getResourceAsStream("/website.properties");
		// Properties prop = new Properties();
		// prop.load(inputStream);
		// websiteName = prop.getProperty("name");
		// System.out.println(websiteName);
	}

	@Override
	protected void doGet(HttpServletRequest req, HttpServletResponse resp)
		throws ServletException, IOException
	{
		// String controller = req.getParameter("c");
		// String method = req.getParameter("m");

		InputStream inputStream = Bootstrap.class.getClassLoader().getResourceAsStream("/website.properties");
		Properties prop = new Properties();
		prop.load(new InputStreamReader(inputStream, "utf-8"));
		websiteName = prop.getProperty("name");
		System.out.println(websiteName);

		System.out.println(req.getContextPath());

		req.setCharacterEncoding("UTF-8");
		resp.setCharacterEncoding("UTF-8");

		String route = req.getParameter("r");
		// if (StringUtils.isEmpty(route)) {
		//     route = "index/index";
		// }
		if (route == null || route.isEmpty())
		{
			route = "index/index";
		}
		String[] routeArr = route.split("/");
		String controller;
		String method;
		if (routeArr.length == 0)
		{
			controller = "index";
			method = "index";
		}
		else if (routeArr.length == 1)
		{
			controller = routeArr[0];
			method = "index";
		}
		else
		{
			controller = routeArr[0];
			method = routeArr[1];
		}

		// 设置响应内容类型
		resp.setContentType("text/html");

		// 实际的逻辑是在这里
		PrintWriter out = resp.getWriter();
		out.println("<h1>Bootstrap get</h1>");
		out.println("<h2>controller " + controller + "</h2>");
		out.println("<h2>method " + method + "</h2>");


		req.setAttribute("websiteName", websiteName);
		try
		{

			controller = "com.website.controllers." + controller + "Controller";
			Class<?> clz2 = Class.forName(controller);
			Constructor c1 = clz2.getDeclaredConstructor(new Class[]{HttpServletRequest.class, HttpServletResponse.class, String.class});
			c1.setAccessible(true);
			Object a1 = c1.newInstance(new Object[]{req, resp, webRoot});

			// 获取方法
			Method m1 = a1.getClass().getDeclaredMethod(method);
			// 调用方法
			m1.invoke(a1);
			// // 调用方法
			// String result1 = (String)m1.invoke(a1, "aaaaa2");
			// System.out.println(result1);

			// Method m2 = a1.getClass().getDeclaredMethod("test2");
			// m2.invoke(a1);
		}
		catch (Exception e)
		{
			e.printStackTrace();
			out.println("<pre>" + e.getMessage() + e.toString() + "</pre>");
		}

	}

	@Override
	protected void doPost(HttpServletRequest req, HttpServletResponse resp)
		throws ServletException, IOException
	{
		String action = req.getParameter("action");

		// // 设置响应内容类型
		// resp.setContentType("text/html");

		// // 实际的逻辑是在这里
		// PrintWriter out = resp.getWriter();
		// out.println("<h1>Bootstrap post</h1>");

		doGet(req, resp);
	}

	@Override
	public void destroy()
	{
		// 什么也不做
	}
}

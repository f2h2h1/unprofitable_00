package com.website.controllers;

import java.io.PrintWriter;
import java.io.IOException;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.ServletException;

import com.website.dao.UserDao;
import com.website.models.User;

public class TestController extends MainController
{

	// private HttpServletRequest req;
	// private HttpServletResponse resp;

	public TestController(HttpServletRequest req, HttpServletResponse resp, String webRoot)
	{
		super(req, resp, webRoot);
	}

	public void test1() throws IOException
	{
		PrintWriter out = resp.getWriter();
		out.println("<h3>from test</h3>");
	}

	public void test2() throws ServletException, IOException
	{

		User user = new User();
		user.setName("tony7");

		String list = user.getName();
		req.setAttribute("list", list);

		User user2 = new User();
		user2.setName("admin");
		user2.setPassword("123456");
		user2.setRole(1);
		UserDao userDao = new UserDao();
		userDao.addUser(user2);

		view("test");
	}

	public void test3() throws ServletException, IOException
	{
		String str1 = "str1";
		String str2 = "str2";
		String str3 = "str3";
		req.setAttribute("str1", str1);
		req.setAttribute("str2", str2);
		req.setAttribute("str3", str3);

		String arr1[] = {"22", "33"};
		String arr2[] = {"44", "55"};
		String arr3[] = {"66", "77"};
		req.setAttribute("arr1", arr1);
		req.setAttribute("arr2", arr2);
		req.setAttribute("arr3", arr3);

		// req.setAttribute("body", "include_page.jsp");
		view("include_page2");
	}
}

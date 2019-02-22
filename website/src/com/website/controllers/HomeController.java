package com.website.controllers;

import java.io.PrintWriter;
import java.io.IOException;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.servlet.ServletException;

import java.lang.Throwable;
import java.lang.Thread;

import com.website.dao.UserDao;
import com.website.models.User;
import com.website.dao.UserDao;

public class HomeController extends MainController
{

	// private HttpServletRequest req;
	// private HttpServletResponse resp;

	public HomeController(HttpServletRequest req, HttpServletResponse resp, String webRoot)
	{
		super(req, resp, webRoot);
	}

	public void login() throws ServletException, IOException
	{
		if (isPost())
		{
			String username = req.getParameter("username");
			String password = req.getParameter("password");
			// redirect("Admin/index", resp);
			UserDao userDao = new UserDao();
			userDao.login(username, password);
			// session.setAttribute("user", varietyInfo);
		}
		else
		{
			String controllerName = super.getControllerName();
			String viewName = "login";
			String viewPath = viewFolderPath + controllerName + "/" + viewName +".jsp";
			req.getRequestDispatcher(viewPath).forward(req, resp);
		}
	}
}

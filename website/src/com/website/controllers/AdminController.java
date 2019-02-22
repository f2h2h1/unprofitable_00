package com.website.controllers;

import java.io.PrintWriter;
import java.io.IOException;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.ServletException;

import java.lang.Throwable;
import java.lang.Thread;

import com.website.dao.UserDao;
import com.website.models.User;

public class AdminController extends MainController
{

	// private HttpServletRequest req;
	// private HttpServletResponse resp;

	public AdminController(HttpServletRequest req, HttpServletResponse resp, String webRoot)
	{
		super(req, resp, webRoot);
	}

	public void index() throws ServletException, IOException
	{
		view("index");
	}
}

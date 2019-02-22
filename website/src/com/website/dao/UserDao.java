package com.website.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.Date;

import org.apache.commons.dbutils.ResultSetHandler;
import org.apache.commons.dbutils.handlers.BeanHandler;
import org.apache.commons.dbutils.handlers.BeanListHandler;
import org.apache.commons.dbutils.QueryRunner;
import com.website.util.DbUtil;
import com.website.models.User;

public class UserDao
{
	private Connection connection;
	public String tableName = "[java].[dbo].[user]";

	public UserDao()
	{
		connection = DbUtil.getConnection();
	}

	public void addUser(User user)
	{
		try
		{
			java.sql.Timestamp timestamp = new java.sql.Timestamp(new Date().getTime());
			System.out.println(timestamp);
			String sqlStr = "insert into " + tableName + " (username,password,role,createtime,updatetime) values (?, ?, ?, ?, ? )";
			PreparedStatement preparedStatement = connection.prepareStatement(sqlStr);
			preparedStatement.setString(1, user.getName());
			preparedStatement.setString(2, user.getPassword());
			preparedStatement.setInt(3, user.getRole());
			preparedStatement.setTimestamp(4, timestamp);
			preparedStatement.setTimestamp(5, timestamp);
			preparedStatement.executeUpdate();
		}
		catch (SQLException e)
		{
			e.printStackTrace();
		}
	}

	public List<User> login(String username, String password)
	{
		try
		{
			String sql = "select * from " + tableName + " where username = '" + username + "' and password = '" + password + "'";
			QueryRunner qr = new QueryRunner();
			List<User> userList = qr.query(connection, sql, new BeanListHandler<User>(User.class));
			System.out.println(userList.get(0).getId() + userList.get(0).getName() + userList.get(0).getRole());
			System.out.println(sql);
			return userList;
		}
		catch (SQLException e)
		{
			e.printStackTrace();
		}

		return null;
	}
}

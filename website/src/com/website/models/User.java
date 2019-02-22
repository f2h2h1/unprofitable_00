package com.website.models;

public class User implements java.io.Serializable
{
	private int id;
	private String name;
	private String password;
	private int role;
	private int createtime;
	private int updatetime;

	public User() {}

	public int getId()
	{
		return id;
	}

	public String getName()
	{
		return name;
	}	
	public void setName(String name)
	{
		this.name = name;
	}

	public String getPassword()
	{
		return password;
	}	
	public void setPassword(String password)
	{
		this.password = password;
	}


	public int getRole()
	{
		return role;
	}
	public void setRole(int role)
	{
		this.role = role;
	}
}

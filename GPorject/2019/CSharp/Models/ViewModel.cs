using System;

using Microsoft.EntityFrameworkCore;
using System.Collections.Generic;
// 数据验证
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
// 数据验证

// select
using Microsoft.AspNetCore.Mvc.Rendering;
// select

using System.Linq;

namespace GPorject.Models
{
	public enum AlertMsgType
	{
		success,
		info,
		warning,
		danger,
		primary,
		secondary,
		dark,
		light
	}

	// struct AlertMsg
	// {
	//     public AlertMsgType Type;
	//     public string Content;
	// };
	public class AlertMsg
	{
		public AlertMsgType Type;
		public string Content;
	}

	public class ViewChangePassWord : User
	{
		[Display(Name="新密码")]
		[DataType(DataType.Password)]
		[Required(ErrorMessage = "请输入新密码")]
		[MaxLength(16, ErrorMessage = "请输入6-16位的密码")]
		[MinLength(6, ErrorMessage = "请输入6-16位的密码")]
		public string newPassWord { get; set; }
	}

	public class ViewCreateUser : User
	{
		public ViewCreateUser()
		{
		}

		public ViewCreateUser(DbSet<Role> roles)
		{
			SetCountries(roles);
		}

		public void SetCountries(DbSet<Role> roles)
		{
			List<SelectListItem> _countires = new List<SelectListItem>();
			var ret = from m in roles select m;
			foreach (var item in ret)
			{
				if (item.ID == 1)
				{
					continue;
				}
				_countires.Add(
					new SelectListItem
					{
						Value = item.ID.ToString(),
						Text = item.RoleName
					}
				);
			}
			Countries = _countires;
		}

		public List<SelectListItem> Countries { get; set; }
	}

	public class ViewEditUser : ViewCreateUser
	{
		public ViewEditUser()
		{
		}

		public new string PassWord { get; set; }
	}

	public class ViewSpecialty : Specialty
	{
		[Display(Name="系")]
		[Required(ErrorMessage = "请选择系")]
		public new int FacultyID { get; set; }

		public List<SelectListItem> Facultys { get; set; }

		public ViewSpecialty()
		{
		}

		public ViewSpecialty(DbSet<Faculty> facultys)
		{
			SetFacultys(facultys);
		}

		public void SetFacultys(DbSet<Faculty> facultys)
		{
			List<SelectListItem> _facultys = new List<SelectListItem>();
			var ret = from m in facultys select m;
			foreach (var item in ret)
			{
				_facultys.Add(
					new SelectListItem
					{
						Value = item.ID.ToString(),
						Text = item.Name
					}
				);
			}
			Facultys = _facultys;
		}
	}

	public class ViewExercise : Exercise
	{
		[Display(Name="学科名称")]
		public string SubjectName { get; set; }
	}

	public class ViewExam : Exam
	{
		[Display(Name="考试名称")]
		public string ExerciseName { get; set; }

		[Display(Name="学科名称")]
		public string SubjectName { get; set; }

		public List<SelectListItem> Subjects { get; set; }

		public List<SelectListItem> Exercises { get; set; }

		public ViewExam()
		{
		}

		public ViewExam(DbSet<Subject> subjects, DbSet<Exercise> exercises)
		{
			SetSubjects(subjects);
			SetExercises(exercises);
		}

		public void SetSubjects(DbSet<Subject> subjects)
		{
			List<SelectListItem> _subjects = new List<SelectListItem>();
			var ret = from m in subjects select m;
			foreach (var item in ret)
			{
				_subjects.Add(
					new SelectListItem
					{
						Value = item.ID.ToString(),
						Text = item.Name
					}
				);
			}
			Subjects = _subjects;
		}

		public void SetExercises(DbSet<Exercise> exercises)
		{
			List<SelectListItem> _exercises = new List<SelectListItem>();
			var ret = from m in exercises where m.Type == 1 select m ;
			foreach (var item in ret)
			{
				_exercises.Add(
					new SelectListItem
					{
						Value = item.ID.ToString(),
						Text = item.Name
					}
				);
			}
			Exercises = _exercises;
		}
	}
}

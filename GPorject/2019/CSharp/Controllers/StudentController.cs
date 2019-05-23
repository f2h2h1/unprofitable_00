using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Http;
using GPorject.Models;
using Microsoft.AspNetCore.Mvc.Filters;

using Microsoft.Extensions.Configuration;
using Microsoft.EntityFrameworkCore;

namespace GPorject.Controllers
{
	public class StudentController : BaseController
	{
		public StudentController(PorjectContext context, IConfiguration Configuration) : base(context, Configuration)
		{
		}

		#region 练习

		/**
		 * 练习列表
		 */
		public IActionResult PracticeIndex()
		{
			var query = from A in _context.Exercises
						join B in _context.Subjects on A.SubjectID equals B.ID into temp from t in temp.DefaultIfEmpty()
						where A.Type == (int)ExerciseType.Practice
						select new ViewExercise
						{
							ID = A.ID,
							Name = A.Name,
							SubjectID = A.SubjectID,
							SubjectName = t.Name,
							CreateTime = A.CreateTime,
							UpdateTime = A.UpdateTime
						};

			return View(query.ToList());
		}

		/**
		 * 练习
		 */
		public IActionResult Practice([FromRoute]int id)
		{
			var query = from A in _context.Exercises
						where A.ID == id
						select A.ProblemList;
			String[] problemListStr = query.ToList().First().Split(",");
			int[] problemList = Array.ConvertAll<string, int>(problemListStr , s => int.Parse(s));

			var query2 = from A in _context.Problems
						where problemList.Contains(A.ID)
						select A;

			return View(query2.ToList());
		}

		/**
		 * 练习结果
		 */
		[HttpPost]
		[ValidateAntiForgeryToken]
		public IActionResult PracticeResult()
		{
			return View();
		}

		#endregion

		#region 考试
		#endregion

		#region 学习日志
		#endregion
	}
}

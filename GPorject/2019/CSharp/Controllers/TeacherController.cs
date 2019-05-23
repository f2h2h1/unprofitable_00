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
	public class TeacherController : BaseController
	{
		private int facultyID;

		public TeacherController(PorjectContext context, IConfiguration Configuration) : base(context, Configuration)
		{
		}

		/**
		 * 在控制器方法执行之前，获取老师所属 系/学院 的ID
		 */
		public override void OnActionExecuting(ActionExecutingContext filterContext)
		{
			var testid = HttpContext.Session.GetInt32("ID");
			Console.WriteLine(testid);
			var UserID = HttpContext.Session.GetInt32("ID");
			var teacherList = from m in _context.Teachers
						where m.UserID == UserID
						select m;
			Teacher teacher = teacherList.ToList().First();
			facultyID = teacher.FacultyID;
			Console.WriteLine(facultyID);
			base.OnActionExecuting(filterContext);
		}

		#region 知识点

		public IActionResult KnowledgePointIndex()
		{
			var query = from m in _context.KnowledgePoints
						where m.FacultyID == facultyID
						select m;
			return View(query.ToList());
		}

		public IActionResult KnowledgePointCreate()
		{
			return View();
		}

		[HttpPost]
		[ValidateAntiForgeryToken]
		public IActionResult KnowledgePointCreate([Bind("Name, Describe")]KnowledgePoint knowledgePoint)
		{
			knowledgePoint.FacultyID = facultyID;
			knowledgePoint.CreateTime = DateTime.Now;
			knowledgePoint.UpdateTime = DateTime.Now;
			_context.KnowledgePoints.Add(knowledgePoint);
			_context.SaveChanges();
			SetAlertMsg("新建成功", AlertMsgType.success);

			return RedirectToAction(nameof(KnowledgePointIndex));
		}

		public IActionResult ProblemIndex(int id)
		{
			var query = from m in _context.Problems
						where m.KnowledgePointID == id
						select m;
			return View(query.ToList());
		}

		public IActionResult ProblemCreate()
		{
			return View();
		}

		[HttpPost]
		[ValidateAntiForgeryToken]
		public IActionResult ProblemCreate([Bind("Name, KnowledgePointID, Type, Describe, Answer")]Problem problem, [FromRoute]int id)
		{
			problem.KnowledgePointID = id;
			problem.CreateTime = DateTime.Now;
			problem.UpdateTime = DateTime.Now;
			_context.Problems.Add(problem);
			_context.SaveChanges();
			SetAlertMsg("新建成功", AlertMsgType.success);

			return RedirectToAction(nameof(ProblemIndex), new {id = id});
		}

		public IActionResult ProblemDetails(int id)
		{
			var query = from m in _context.Problems
						where m.ID == id
						select m;
			return View(query.ToList().First());
		}

		#endregion

		#region 组卷

		/**
		 * 组卷列表
		 */
		public IActionResult ExerciseIndex()
		{
			var query = from A in _context.Exercises
						join B in _context.Subjects on A.SubjectID equals B.ID into temp
						from t in temp.DefaultIfEmpty()
						where t.FacultyID == facultyID
						select new Exercise
						{
							ID = A.ID,
							Name = A.Name,
							Type = A.Type,
							CreateTime = A.CreateTime,
							UpdateTime = A.UpdateTime
						};
			return View(query.ToList());
		}

		/**
		 * 创建组卷
		 */
		public IActionResult ExerciseCreate(int? id)
		{
			var subjects = (from m in _context.Subjects
						where m.FacultyID == facultyID
						select m).ToList();
			ViewData["subjects"] = subjects;
			if (id == null)
			{
				id = subjects.First().ID;
			}
			var query = from m in _context.Problems
						where m.KnowledgePointID == id
						select m;

			return View(query.ToList());
		}

		/**
		 * 创建组卷
		 */
		[HttpPost]
		[ValidateAntiForgeryToken]
		public IActionResult ExerciseCreate(
				[FromForm] int SubjectID,
				[FromForm] int ExerciseType,
				[FromForm] String Name,
				[FromForm] int[] ProblemID,
				[FromRoute]int id
			)
		{
			Exercise exercise = new Exercise();

			exercise.SubjectID = SubjectID;
			exercise.Name = Name;
			exercise.Type = ExerciseType;
			exercise.ProblemList =  string.Join(",", ProblemID);

			exercise.CreateTime = DateTime.Now;
			exercise.UpdateTime = DateTime.Now;

			_context.Exercises.Add(exercise);
			_context.SaveChanges();

			SetAlertMsg("新建成功", AlertMsgType.success);
			return RedirectToAction(nameof(ExerciseIndex), new {id = id});
		}

		#endregion
	
		#region 考试

		/**
		 * 考试列表
		 */
		public IActionResult ExamIndex()
		{
			var query = from A in _context.Exams
						join B in _context.Exercises on A.ExercisesID equals B.ID into temp1 from t1 in temp1.DefaultIfEmpty()
						join C in _context.Subjects on A.SubjectID equals C.ID into temp2 from t2 in temp2.DefaultIfEmpty()
						select new ViewExam
						{
							ID = A.ID,
							Name = A.Name,
							SubjectID = A.SubjectID,
							ExercisesID = A.ExercisesID,
							ExerciseName = t1.Name,
							SubjectName = t2.Name,
							StartTime = A.StartTime,
							EndTime = A.EndTime,
							CreateTime = A.CreateTime,
							UpdateTime = A.UpdateTime
						};

			return View(query.ToList());
		}

		/**
		 * 创建考试
		 */
		public IActionResult ExamCreate()
		{
			return View(new ViewExam(_context.Subjects, _context.Exercises));
		}

		/**
		 * 创建考试
		 */
		[HttpPost]
		[ValidateAntiForgeryToken]
		public IActionResult ExamCreate(Exam exam)
		{
			if (ModelState.IsValid)
			{
				exam.CreateTime = DateTime.Now;
				exam.UpdateTime = DateTime.Now;
				_context.Exams.Add(exam);
				_context.SaveChanges();
			}
			SetAlertMsg("新建成功", AlertMsgType.success);
			return RedirectToAction(nameof(ExamIndex));
		}

		/**
		 * 评卷
		 */

		/**
		 * 成绩分析
		 */

		#endregion
	}
}

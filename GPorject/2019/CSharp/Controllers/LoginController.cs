using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using GPorject.Models;
using Microsoft.AspNetCore.Http;

using Microsoft.Extensions.Configuration;
using Microsoft.EntityFrameworkCore;

namespace GPorject.Controllers
{
	public class LoginController : BaseController
	{
		public LoginController(PorjectContext context, IConfiguration Configuration) : base(context, Configuration)
		{
		}

		[HttpGet]
		public IActionResult Index() => View();

		[HttpPost]
		[ValidateAntiForgeryToken]
		public IActionResult Index([Bind("UserName, PassWord")] User user)
		{
			var ret = from m in _context.Users
						where m.UserName == user.UserName && m.PassWord == user.PassWord
						select m;
			// foreach (var item in ret)
			// {
			//     Console.WriteLine(item.Role);
			// }
			if (ret.Count() > 0)
			{
				user = ret.First();
				HttpContext.Session.SetString("UserName", user.UserName);
				HttpContext.Session.SetInt32("ID", user.ID);
				HttpContext.Session.SetInt32("Role", ret.First().Role);
				return new RedirectResult("/Home/Index");
			}
			// AlertMsg alertMsg = new AlertMsg();
			// alertMsg.Type = AlertMsgType.danger;
			// alertMsg.Content = "用户名或密码错误";
			// ViewData["AlertMsg"] = alertMsg;
			SetAlertMsg("用户名或密码错误", AlertMsgType.danger);
			return View();
		}

		public IActionResult Quit()
		{
			HttpContext.Session.Clear();
			return new RedirectResult("/Login/Index");
		}
	}
}

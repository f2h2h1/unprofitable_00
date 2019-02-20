using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

using Microsoft.Extensions.Configuration;
using Microsoft.AspNetCore.Http;
using GPorject.Models;
using Newtonsoft.Json;

namespace GPorject.Controllers
{
    public class HomeController : BaseController
    {
        public HomeController(PorjectContext context, IConfiguration Configuration) : base(context, Configuration)
        {
        }

        public IActionResult Index()
        {
            return View();
        }

        public IActionResult Privacy()
        {
            return View();
        }

        [HttpGet]
        public IActionResult ChangePassWord()
        {
            var ret = from m in _context.Users
                        where m.ID == HttpContext.Session.GetInt32("ID")
                        select m;

            var user = ret.First();

            ViewChangePassWord viewChangePassWord = new ViewChangePassWord();
            viewChangePassWord.ID = user.ID;

            return View(viewChangePassWord);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult ChangePassWord(ViewChangePassWord viewChangePassWord)
        {
            var ret = from m in _context.Users
                        where m.ID == viewChangePassWord.ID && m.PassWord.Equals(viewChangePassWord.PassWord)
                        select m;

            AlertMsg alertMsg = new AlertMsg();
            if (ret.Count() == 0)
            {
                // alertMsg.Type = AlertMsgType.danger;
                // alertMsg.Content = "原密码错误";
                // ViewData["AlertMsg"] = alertMsg;
                SetAlertMsg("原密码错误", AlertMsgType.danger);
                return View(viewChangePassWord);
            }

            var user = ret.First();
            user.PassWord = viewChangePassWord.newPassWord;
            user.UpdateTime = DateTime.Now;
            _context.Update(user);
            _context.SaveChanges();

            // alertMsg.Type = AlertMsgType.success;
            // alertMsg.Content = "修改成功";
            // string alertMsgStr = JsonConvert.SerializeObject(alertMsg);
            // HttpContext.Session.SetString("AlertMsg", alertMsgStr);
            
            SetAlertMsg("修改成功", AlertMsgType.success);

            return new RedirectResult("/Home/Index");
        }
    }
}

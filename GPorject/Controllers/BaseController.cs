using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using GPorject.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc.Filters;

using Microsoft.Extensions.Configuration;
using Newtonsoft.Json;
using GPorject.BLL;
using Microsoft.AspNetCore.Mvc.ModelBinding;

namespace GPorject.Controllers
{
    public class BaseController : Controller
    {
        protected readonly PorjectContext _context;

        public IConfiguration _configuration { get; }

        public BaseController() : base()
        {
        }

        public BaseController(PorjectContext context, IConfiguration Configuration) : base()
        {
            _context = context;
            _configuration = Configuration;
        }

        public override void OnActionExecuting(ActionExecutingContext filterContext)
        {
            ViewData["PojectName"] = _configuration["PojectName"];

            string controllerName = (filterContext.RouteData.Values["controller"]).ToString();
            string actionName = (filterContext.RouteData.Values["action"]).ToString();
            string route = "/" + controllerName + "/" + actionName;

            string loginRoute = "/Login/Index";
            int? role = HttpContext.Session.GetInt32("Role");
            ViewData["Role"] = "";
            if (role == null)
            {
                if (route.Equals(loginRoute))
                {
                    base.OnActionExecuting(filterContext);
                }
                else
                {
                    filterContext.Result = new RedirectResult(loginRoute);
                    return;
                }
            }
            else
            {
                var routeList = (from m in _context.Roles
                            where m.ID == role
                            select m).First().RouteList;

                int[] routeListArr = Helper.ToIntArray(routeList);
                var ret = from m in _context.Routes 
                    where routeListArr.Contains(m.ID)
                    select m;
                
                Boolean Flg = false;
                foreach (var item in ret)
                {
                    if (("/" + item.RouteName).Equals(route))
                    {
                        Flg = true;
                        break;
                    }
                }
                if (Flg == false)
                {
                    SetAlertMsg("没有权限", AlertMsgType.danger);
                    filterContext.Result = new RedirectResult("/Home/Index");
                    return;
                }

                string userName = HttpContext.Session.GetString("UserName");
                ViewData["Role"] = role;
                ViewData["UserName"] = userName;
                if (route.Equals(loginRoute))
                {
                    filterContext.Result = new RedirectResult("/Home/Index");
                    return;
                }
                else
                {
                    base.OnActionExecuting(filterContext);
                }
            }
        }

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }

        protected void SetAlertMsg(string content, AlertMsgType type)
        {
            AlertMsg alertMsg = new AlertMsg();
            alertMsg.Type = type;
            alertMsg.Content = content;
            string alertMsgStr = JsonConvert.SerializeObject(alertMsg);
            HttpContext.Session.SetString("AlertMsg", alertMsgStr);
        }

        private void GetAlertMsg()
        {
            string alertMsgStr = HttpContext.Session.GetString("AlertMsg");
            HttpContext.Session.Remove("AlertMsg");
            if (!string.IsNullOrEmpty(alertMsgStr))
            {
                AlertMsg alertMsg = JsonConvert.DeserializeObject<AlertMsg>(alertMsgStr);
                ViewData["AlertMsg"] = alertMsg;
            }
        }

        public void ModelStateIsFalse(string msg, ModelStateDictionary ModelState)
        {
            SetAlertMsg(msg + " " + GetModelErrorMessage(ModelState.Values), AlertMsgType.danger);
        }

        public string GetModelErrorMessage(ModelStateDictionary.ValueEnumerable ModelStateValues)
        {
            var msg = string.Empty;
            foreach(var value in ModelStateValues)
            {
                if(value.Errors.Count > 0)
                {
                    foreach(var error in value.Errors)
                    {
                        msg = msg + error.ErrorMessage + ", ";
                    }
                }
            }
            return msg;
        }

        public override ViewResult View(string viewName)
        {
            GetAlertMsg();
            return base.View(viewName);
        }

        public override ViewResult View(string viewName, object model)
        {
            GetAlertMsg();
            return base.View(viewName, model);
        }

        public override ViewResult View()
        {
            GetAlertMsg();
            return base.View();
        }

        public override ViewResult View(object model)
        {
            GetAlertMsg();
            return base.View(model);
        }
    }
}

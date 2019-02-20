using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using GPorject.Models;

using Microsoft.Extensions.Configuration;
using Microsoft.EntityFrameworkCore;

namespace GPorject.Controllers
{
    public class SystemManagementController : BaseController
    {
        public SystemManagementController(PorjectContext context, IConfiguration Configuration) : base(context, Configuration)
        {
        }

        // private readonly PorjectContext _context;

        // public SystemManagementController(PorjectContext context)
        // {
        //     _context = context;
        // }

        #region 用户管理

        [Route("UserManagement/Index")]
        public IActionResult UserManagementIndex()
        {
            List<Role> roles = _context.Roles.ToList();
            List<User> users = _context.Users.ToList();

            ViewData["Roles"] = roles;
            return View(users);
        }

        [Route("UserManagement/Create")]
        public IActionResult UserManagementCreate()
        {

            var model = new ViewCreateUser(_context.Roles);
            model.Role = 1;
            return View(model);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        [Route("UserManagement/Create")]
        public IActionResult UserManagementCreate([Bind("UserName, PassWord, Role")] User user)
        {
            if (ModelState.IsValid)
            {
                user.CreateTime = DateTime.Now;
                user.UpdateTime = DateTime.Now;
                _context.Users.Add(user);
                _context.SaveChanges();
            }
            SetAlertMsg("新建成功", AlertMsgType.success);

            return new RedirectResult("/UserManagement/Index");
        }

        [Route("UserManagement/Delete/{id:int}")]
        public IActionResult UserManagementDelete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }
            var ret = from m in _context.Users
                        where m.ID == id
                        select m;
            if (ret.Count() == 0)
            {
                return NotFound();
            }

            var user = ret.First();
            _context.Users.Remove(user);
            _context.SaveChanges();
            SetAlertMsg("删除成功", AlertMsgType.success);

            return new RedirectResult("/UserManagement/Index");
        }

        [Route("UserManagement/Details/{id:int}")]
        public IActionResult UserManagementDetails(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }
            var userList = from m in _context.Users
                        where m.ID == id
                        select m;
            if (userList.Count() == 0)
            {
                return NotFound();
            }

            User user = userList.First();

            var roleList = from m in _context.Roles
                        where m.ID == user.Role
                        select m;
            user.RoleName = roleList.First().RoleName;

            return View(user);
        }

        [Route("UserManagement/Edit/{id:int}")]
        public IActionResult UserManagementEdit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var ret = from m in _context.Users
                        where m.ID == id
                        select m;
            if (ret.Count() == 0)
            {
                return NotFound();
            }

            User user = ret.First();
            ViewEditUser model = new ViewEditUser();
            model.SetCountries(_context.Roles);
            model.ID = user.ID;
            model.UserName = user.UserName;
            model.PassWord = user.PassWord;
            model.Role = user.Role;
            // model = (ViewCreateUser)user;
            return View(model);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        [Route("UserManagement/Edit/{id:int}")]
        public IActionResult UserManagementEdit(int id, [Bind("ID, UserName, Role")] ViewEditUser viewEditUser)
        {
            if (id != viewEditUser.ID)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                var ret = from m in _context.Users
                            where m.ID == viewEditUser.ID
                            select m;
                if (ret.Count() == 0)
                {
                    return NotFound();
                }
                var user = ret.First();
                user.UserName = viewEditUser.UserName;
                user.Role = viewEditUser.Role;
                user.UpdateTime = DateTime.Now;
                _context.Users.Update(user);
                _context.SaveChanges();
                SetAlertMsg("保存成功", AlertMsgType.success);
            }
            else
            {
                ModelStateIsFalse("保存失败", ModelState);
            }

            ViewEditUser model = new ViewEditUser();
            model.SetCountries(_context.Roles);
            model.ID = viewEditUser.ID;
            model.UserName = viewEditUser.UserName;
            model.Role = viewEditUser.Role;
            // model = (ViewCreateUser)user;

            return View(model);
        }

        #endregion
    }
}

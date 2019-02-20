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
    public class AdminController : BaseController
    {
        public AdminController(PorjectContext context, IConfiguration Configuration) : base(context, Configuration)
        {
        }

        #region 系

        public IActionResult FacultyIndex()
        {
            return View(_context.Facultys.ToList());
        }

        public IActionResult FacultyCreate()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult FacultyCreate([Bind("Name")]Faculty faculty)
        {
            if (!ModelState.IsValid)
            {
                ModelStateIsFalse("新建失败", ModelState);
                return View();
            }

            faculty.CreateTime = DateTime.Now;
            faculty.UpdateTime = DateTime.Now;
            _context.Facultys.Add(faculty);
            _context.SaveChanges();
            SetAlertMsg("新建成功", AlertMsgType.success);

            return RedirectToAction(nameof(FacultyCreate));
        }

        public IActionResult FacultyDetails(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }
            var facultyList = from m in _context.Facultys
                        where m.ID == id
                        select m;
            if (facultyList.Count() == 0)
            {
                return NotFound();
            }

            return View(facultyList.First());
        }

        public IActionResult FacultyDelete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }
            var ret = from m in _context.Facultys
                        where m.ID == id
                        select m;
            if (ret.Count() == 0)
            {
                return NotFound();
            }

            var faculty = ret.First();
            _context.Facultys.Remove(faculty);
            _context.SaveChanges();
            SetAlertMsg("删除成功", AlertMsgType.success);

            return RedirectToAction(nameof(FacultyIndex));
        }

        public IActionResult FacultyEdit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }
            var facultyList = from m in _context.Facultys
                        where m.ID == id
                        select m;
            if (facultyList.Count() == 0)
            {
                return NotFound();
            }

            return View(facultyList.First());
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult FacultyEdit(int id, Faculty faculty)
        {
            if (id != faculty.ID)
            {
                return NotFound();
            }
            if (ModelState.IsValid)
            {
                var facultyList = from m in _context.Facultys
                            where m.ID == id
                            select m;
                if (facultyList.Count() == 0)
                {
                    return NotFound();
                }
                var newFaculty = facultyList.First();
                newFaculty.Name = faculty.Name;
                newFaculty.UpdateTime = DateTime.Now;
                _context.Facultys.Update(newFaculty);
                _context.SaveChanges();
                SetAlertMsg("保存成功", AlertMsgType.success);
                return View(newFaculty);
            }
            else
            {
                ModelStateIsFalse("保存失败", ModelState);
                return View();
            }
        }

        #endregion

        #region 专业

        public IActionResult SpecialtyIndex()
        {
            var query = from A in _context.Specialtys
            join B in _context.Facultys on A.FacultyID equals B.ID into temp
            from t in temp.DefaultIfEmpty()
            select new Specialty
            {
                ID = A.ID,
                FacultyID = A.FacultyID,
                Name = A.Name,
                CreateTime = A.CreateTime,
                UpdateTime = A.UpdateTime,
                FacultyName = t.Name
                // line = t ==null?"":t.line //判断第二集合中可能为空
            };
            // DbSet<Faculty> facultys = (DbSet<Faculty>)query;

            // return View(_context.Specialtys.ToList());
            // return View(facultys.ToList());

            return View(query.ToList());
        }

        public IActionResult SpecialtyCreate()
        {
            return View(new ViewSpecialty(_context.Facultys));
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult SpecialtyCreate([Bind("Name, FacultyID")]Specialty specialty)
        {
            if (!ModelState.IsValid)
            {
                ModelStateIsFalse("新建失败", ModelState);
                return View();
            }

            specialty.CreateTime = DateTime.Now;
            specialty.UpdateTime = DateTime.Now;
            _context.Specialtys.Add(specialty);
            _context.SaveChanges();
            SetAlertMsg("新建成功", AlertMsgType.success);

            return RedirectToAction(nameof(SpecialtyCreate));
        }

        public IActionResult SpecialtyDetails(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }
            var query = from A in _context.Specialtys
                        join B in _context.Facultys on A.FacultyID equals B.ID into temp
                        from t in temp.DefaultIfEmpty()
                        where A.ID == id
                        select new Specialty
                        {
                            ID = A.ID,
                            FacultyID = A.FacultyID,
                            Name = A.Name,
                            CreateTime = A.CreateTime,
                            UpdateTime = A.UpdateTime,
                            FacultyName = t.Name
                        };
            if (query.Count() == 0)
            {
                return NotFound();
            }

            return View(query.First());
        }

        public IActionResult SpecialtyDelete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }
            var ret = from m in _context.Specialtys
                        where m.ID == id
                        select m;
            if (ret.Count() == 0)
            {
                return NotFound();
            }

            _context.Specialtys.Remove(ret.First());
            _context.SaveChanges();
            SetAlertMsg("删除成功", AlertMsgType.success);

            return RedirectToAction(nameof(SpecialtyIndex));
        }

        public IActionResult SpecialtyEdit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }
            var ret = from m in _context.Specialtys
                        where m.ID == id
                        select m;
            if (ret.Count() == 0)
            {
                return NotFound();
            }

            Specialty specialty = ret.First();
            ViewSpecialty model = new ViewSpecialty();
            model.SetFacultys(_context.Facultys);
            model.FacultyID = specialty.FacultyID;
            model.Name = specialty.Name;
            // model.FacultyName = specialty.FacultyName;

            return View(model);
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult SpecialtyEdit([Bind("ID, Name, FacultyID")]Specialty specialtyNew)
        {
            if (ModelState.IsValid)
            {
                var ret = from m in _context.Specialtys
                            where m.ID == specialtyNew.ID
                            select m;
                if (ret.Count() == 0)
                {
                    return NotFound();
                }
                
                var specialty = ret.First();
                specialty.Name = specialtyNew.Name;
                specialty.FacultyID = specialtyNew.FacultyID;
                specialty.UpdateTime = DateTime.Now;
                _context.Specialtys.Update(specialty);
                _context.SaveChanges();
                SetAlertMsg("保存成功", AlertMsgType.success);
            }
            else
            {
                ModelStateIsFalse("保存失败", ModelState);
            }

            ViewSpecialty model = new ViewSpecialty();
            model.SetFacultys(_context.Facultys);
            model.FacultyID = specialtyNew.FacultyID;
            model.Name = specialtyNew.Name;

            return View(model);
        }

        #endregion

        #region 班级

        public IActionResult ClassesIndex()
        {
            return View();
        }

        public IActionResult ClassesCreate()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult ClassesCreate(Classes classes)
        {
            return View();
        }

        public IActionResult ClassesDetails(int? id)
        {
            return View();
        }

        public IActionResult ClassesDelete(int? id)
        {
            return View();
        }

        public IActionResult ClassesEdit()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult ClassesEdit(Classes classes)
        {
            return View();
        }

        #endregion

        #region 学科

        public IActionResult SubjectIndex()
        {
            var query = from A in _context.Subjects
            join B in _context.Facultys on A.FacultyID equals B.ID into temp
            from t in temp.DefaultIfEmpty()
            select new Subject
            {
                ID = A.ID,
                FacultyID = A.FacultyID,
                Name = A.Name,
                CreateTime = A.CreateTime,
                UpdateTime = A.UpdateTime,
                FacultyName = t.Name
            };

            return View(query.ToList());
        }

        public IActionResult SubjectCreate()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult SubjectCreate(Subject subject)
        {
            return View();
        }

        public IActionResult SubjectDetails(int? id)
        {
            return View();
        }

        public IActionResult SubjectDelete(int? id)
        {
            return View();
        }

        public IActionResult SubjectEdit()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult SubjectEdit(Subject subject)
        {
            return View();
        }

        #endregion

        #region 老师

        public IActionResult TeacherIndex()
        {
            return View();
        }

        public IActionResult TeacherCreate()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult TeacherCreate(Teacher teacher)
        {
            return View();
        }

        public IActionResult TeacherDetails(int? id)
        {
            return View();
        }

        public IActionResult TeacherDelete(int? id)
        {
            return View();
        }

        public IActionResult TeacherEdit()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult TeacherEdit(Teacher teacher)
        {
            return View();
        }

        #endregion

        #region 学生

        public IActionResult StudentIndex()
        {
            return View();
        }

        public IActionResult StudentCreate()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult StudentCreate(Student student)
        {
            return View();
        }

        public IActionResult StudentDetails(int? id)
        {
            return View();
        }

        public IActionResult StudentDelete(int? id)
        {
            return View();
        }

        public IActionResult StudentEdit()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public IActionResult StudentEdit(Student student)
        {
            return View();
        }

        #endregion
    }
}

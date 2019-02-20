using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.ChangeTracking;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Metadata;
using Microsoft.EntityFrameworkCore.ValueGeneration;
using System;
using System.Collections.Generic;

using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Threading;

namespace GPorject.Models
{
    public class PorjectContext : DbContext
    {
        public PorjectContext(DbContextOptions<PorjectContext> options)
            : base(options)
        { }

        public DbSet<User> Users { get; set; }

        public DbSet<Role> Roles { get; set; }

        public DbSet<Route> Routes { get; set; }

        public DbSet<Faculty> Facultys { get; set; }

        public DbSet<Specialty> Specialtys { get; set; }

        public DbSet<Classes> Classess { get; set; }

        public DbSet<Subject> Subjects { get; set; }

        public DbSet<KnowledgePoint> KnowledgePoints { get; set; }

        public DbSet<Teacher> Teachers { get; set; }

        public DbSet<Student> Students { get; set; }
    }

    /// <summary>
    /// 用户
    /// </summary>
    public class User
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="用户名")]
        [Required(ErrorMessage = "请输入用户名")]
        public string UserName { get; set; }

        [Display(Name="密码")]
        [DataType(DataType.Password)]
        [Required(ErrorMessage = "请输入密码")]
        [MaxLength(16, ErrorMessage = "请输入6-16位的密码")]
        [MinLength(6, ErrorMessage = "请输入6-16位的密码")]
        public string PassWord { get; set; }

        [Display(Name="角色")]
        public int Role { get; set; }

        [Display(Name="创建时间")]
        public DateTime CreateTime { get; set; }

        [Display(Name="更新时间")]
        public DateTime UpdateTime { get; set; }

        [NotMapped]
        public string RoleName { get; set;}
    }

    /// <summary>
    /// 角色
    /// </summary>
    public class Role
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="角色名")]
        public string RoleName { get; set; }

        [Display(Name="路由列表")]
        public string RouteList { get; set; }
    }

    /// <summary>
    /// 路由
    /// </summary>
    public class Route
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="路由名")]
        public string RouteName { get; set; }
    }

    // public class Menu
    // {
    //     public int ID { get; set; }

    //     public string Name { get; set; }

    //     public string Route { get; set; }

    //     public List<Menu> Dropdown { get; set;}
    // }

    /// <summary>
    /// 系
    /// </summary>
    public class Faculty
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="系")]
        [Required(ErrorMessage = "请输入系")]
        public string Name { get; set; }

        // [EmailAddress]
        // [Required(ErrorMessage = "请输入Email")]
        // public string email { get; set;}

        [Display(Name="创建时间")]
        public DateTime CreateTime { get; set; }

        [Display(Name="更新时间")]
        public DateTime UpdateTime { get; set; }
    }

    /// <summary>
    /// 专业
    /// </summary>
    public class Specialty
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="系ID")]
        public int FacultyID { get; set; }

        [Display(Name="专业")]
        public string Name { get; set; }

        [Display(Name="创建时间")]
        public DateTime CreateTime { get; set; }

        [Display(Name="更新时间")]
        public DateTime UpdateTime { get; set; }

        [NotMapped]
        [Display(Name="系")]
        public string FacultyName { get; set; }
    }

    /// <summary>
    /// 班级
    /// </summary>
    public class Classes
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="系ID")]
        public int FacultyID { get; set; }

        [Display(Name="班级")]
        public string Name { get; set; }

        [Display(Name="创建时间")]
        public DateTime CreateTime { get; set; }

        [Display(Name="更新时间")]
        public DateTime UpdateTime { get; set; }

        [NotMapped]
        [Display(Name="系")]
        public string FacultyName { get; set; }
    }

    /// <summary>
    /// 学科
    /// </summary>
    public class Subject
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="系ID")]
        public int FacultyID { get; set; }

        [Display(Name="专业ID")]
        public int SpecialtyID { get; set; }

        [Display(Name="学科")]
        public string Name { get; set; }

        [Display(Name="创建时间")]
        public DateTime CreateTime { get; set; }

        [Display(Name="更新时间")]
        public DateTime UpdateTime { get; set; }

        [NotMapped]
        [Display(Name="系")]
        public string FacultyName { get; set; }

        [NotMapped]
        [Display(Name="专业")]
        public string SpecialtyName { get; set; }
    }

    /// <summary>
    /// 知识点
    /// </summary>
    public class KnowledgePoint
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="系ID")]
        public int FacultyID { get; set; }

        [Display(Name="专业ID")]
        public int SpecialtyID { get; set; }

        [Display(Name="学科ID")]
        public int SubjectID { get; set; }

        [Display(Name="知识点")]
        public string Name { get; set; }

        [Display(Name="创建时间")]
        public DateTime CreateTime { get; set; }

        [Display(Name="更新时间")]
        public DateTime UpdateTime { get; set; }
    }

    /// <summary>
    /// 老师
    /// </summary>
    public class Teacher
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="系ID")]
        public int FacultyID { get; set; }

        [Display(Name="专业ID")]
        public int SpecialtyID { get; set; }

        [Display(Name="学科ID")]
        public int SubjectID { get; set; }

        [Display(Name="姓名")]
        public string Name { get; set; }

        [Display(Name="创建时间")]
        public DateTime CreateTime { get; set; }

        [Display(Name="更新时间")]
        public DateTime UpdateTime { get; set; }
    }

    /// <summary>
    /// 学生
    /// </summary>
    public class Student
    {
        [KeyAttribute]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int ID { get; set; }

        [Display(Name="系ID")]
        public int FacultyID { get; set; }

        [Display(Name="专业ID")]
        public int SpecialtyID { get; set; }

        [Display(Name="班级ID")]
        public int ClassesID { get; set; }

        [Display(Name="姓名")]
        public string Name { get; set; }

        [Display(Name="创建时间")]
        public DateTime CreateTime { get; set; }

        [Display(Name="更新时间")]
        public DateTime UpdateTime { get; set; }
    }
}

using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.DependencyInjection;
using System;
using System.Linq;

using GPorject.BLL;
using Microsoft.EntityFrameworkCore.ChangeTracking;
using System.Threading;
using Microsoft.EntityFrameworkCore.ValueGeneration;
using Microsoft.EntityFrameworkCore.Metadata;
using Microsoft.EntityFrameworkCore.Infrastructure;
using System.Reflection;

namespace GPorject.Models
{
    public static class DbContextExtensions
    {
        public static void ResetValueGenerators(this DbContext context, string modelName, int num)
        {
            var cache = context.GetService<IValueGeneratorCache>();

            var keyProperty = (from m in context.Model.GetEntityTypes()
            where m.FindPrimaryKey().Properties[0].ClrType == typeof(int)
                && m.FindPrimaryKey().Properties[0].ValueGenerated == ValueGenerated.OnAdd
                && m.Name == modelName
            select m).First();

            var generator = (ResettableValueGenerator)cache.GetOrAdd(
                keyProperty.FindPrimaryKey().Properties[0],
                keyProperty.FindPrimaryKey().Properties[0].DeclaringEntityType,
                (p, e) => new ResettableValueGenerator());
            generator.Reset(num);
        }
    }

    public class ResettableValueGenerator : ValueGenerator<int>
    {
        private int _current;

        public override bool GeneratesTemporaryValues => false;

        public override int Next(EntityEntry entry)
            => Interlocked.Increment(ref _current);

        public void Reset(int num) => _current = num;
    }

    public static class SeedData
    {
        public static void Initialize(IServiceProvider serviceProvider)
        {
            using (var context = new PorjectContext(
                serviceProvider.GetRequiredService<DbContextOptions<PorjectContext>>()))
            {
                // Look for any movies.
                // Console.WriteLine(context.Users.Any());
                // if (context.Users.Any())
                // {
                //     return;   // DB has been seeded
                // }

                string Namespace = MethodBase.GetCurrentMethod().DeclaringType.Namespace;

                context.Users.AddRange(
                    new User
                    {
                        ID = 1,
                        UserName = "admin",
                        PassWord = "123456",
                        Role = 1,
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    },

                    new User
                    {
                        ID = 2,
                        UserName = "management",
                        PassWord = "123456",
                        Role = 2,
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    }
                );

                context.Roles.AddRange(
                    new Role
                    {
                        ID = 1,
                        RoleName = "超级管理员",
                        RouteList = "1,2,3,4,5,6,7,8,9"
                    },
                    new Role
                    {
                        ID = 2,
                        RoleName = "管理员",
                        RouteList = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39"
                    },
                    new Role
                    {
                        ID = 3,
                        RoleName = "老师",
                        RouteList = "1,2,3,4"
                    },
                    new Role
                    {
                        ID = 4,
                        RoleName = "学生",
                        RouteList = "1,2,3,4"
                    }
                );

                context.Routes.AddRange(
                    new Route
                    {
                        ID = 1,
                        RouteName = "Home/Index",
                    },
                    new Route
                    {
                        ID = 2,
                        RouteName = "Home/Privacy",
                    },
                    new Route
                    {
                        ID = 3,
                        RouteName = "Home/ChangePassWord",
                    },
                    new Route
                    {
                        ID = 4,
                        RouteName = "Login/Quit",
                    },
                    new Route
                    {
                        ID = 5,
                        RouteName = "SystemManagement/UserManagementIndex",
                    },
                    new Route
                    {
                        ID = 6,
                        RouteName = "SystemManagement/UserManagementCreate",
                    },
                    new Route
                    {
                        ID = 7,
                        RouteName = "SystemManagement/UserManagementDelete",
                    },
                    new Route
                    {
                        ID = 8,
                        RouteName = "SystemManagement/UserManagementDetails",
                    },
                    new Route
                    {
                        ID = 9,
                        RouteName = "SystemManagement/UserManagementEdit",
                    },
                    new Route
                    {
                        ID = 10,
                        RouteName = "Admin/FacultyIndex",
                    },
                    new Route
                    {
                        ID = 11,
                        RouteName = "Admin/FacultyCreate",
                    },
                    new Route
                    {
                        ID = 12,
                        RouteName = "Admin/FacultyDetails",
                    },
                    new Route
                    {
                        ID = 13,
                        RouteName = "Admin/FacultyDelete",
                    },
                    new Route
                    {
                        ID = 14,
                        RouteName = "Admin/FacultyEdit",
                    },
                    new Route
                    {
                        ID = 15,
                        RouteName = "Admin/SpecialtyIndex",
                    },
                    new Route
                    {
                        ID = 16,
                        RouteName = "Admin/SpecialtyCreate",
                    },
                    new Route
                    {
                        ID = 17,
                        RouteName = "Admin/SpecialtyDetails",
                    },
                    new Route
                    {
                        ID = 18,
                        RouteName = "Admin/SpecialtyDelete",
                    },
                    new Route
                    {
                        ID = 19,
                        RouteName = "Admin/SpecialtyEdit",
                    },
                    new Route
                    {
                        ID = 20,
                        RouteName = "Admin/ClassesIndex",
                    },
                    new Route
                    {
                        ID = 21,
                        RouteName = "Admin/ClassesCreate",
                    },
                    new Route
                    {
                        ID = 22,
                        RouteName = "Admin/ClassesDetails",
                    },
                    new Route
                    {
                        ID = 23,
                        RouteName = "Admin/ClassesDelete",
                    },
                    new Route
                    {
                        ID = 24,
                        RouteName = "Admin/ClassesEdit",
                    },
                    new Route
                    {
                        ID = 25,
                        RouteName = "Admin/SubjectIndex",
                    },
                    new Route
                    {
                        ID = 26,
                        RouteName = "Admin/SubjectCreate",
                    },
                    new Route
                    {
                        ID = 27,
                        RouteName = "Admin/SubjectDetails",
                    },
                    new Route
                    {
                        ID = 28,
                        RouteName = "Admin/SubjectDelete",
                    },
                    new Route
                    {
                        ID = 29,
                        RouteName = "Admin/SubjectEdit",
                    },
                    new Route
                    {
                        ID = 30,
                        RouteName = "Admin/TeacherIndex",
                    },
                    new Route
                    {
                        ID = 31,
                        RouteName = "Admin/TeacherCreate",
                    },
                    new Route
                    {
                        ID = 32,
                        RouteName = "Admin/TeacherDetails",
                    },
                    new Route
                    {
                        ID = 33,
                        RouteName = "Admin/TeacherDelete",
                    },
                    new Route
                    {
                        ID = 34,
                        RouteName = "Admin/TeacherEdit",
                    },
                    new Route
                    {
                        ID = 35,
                        RouteName = "Admin/StudentIndex",
                    },
                    new Route
                    {
                        ID = 36,
                        RouteName = "Admin/StudentCreate",
                    },
                    new Route
                    {
                        ID = 37,
                        RouteName = "Admin/StudentDetails",
                    },
                    new Route
                    {
                        ID = 38,
                        RouteName = "Admin/StudentDelete",
                    },
                    new Route
                    {
                        ID = 39,
                        RouteName = "Admin/StudentEdit",
                    }
                );

                Faculty[] FacultyArr = new Faculty[]{
                    new Faculty
                    {
                        ID = 1,
                        Name = "信息工程系",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    },
                    new Faculty
                    {
                        ID = 2,
                        Name = "会计系",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    }
                };
                context.Facultys.AddRange(FacultyArr);
                context.ResetValueGenerators(Namespace + "." + nameof(Faculty), FacultyArr.Count());

                Specialty[] SpecialtyArr = new Specialty[]{
                    new Specialty
                    {
                        ID = 1,
                        FacultyID = 1,
                        Name = "电子商务",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    },
                    new Specialty
                    {
                        ID = 2,
                        FacultyID = 1,
                        Name = "计算机",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    },
                    new Specialty
                    {
                        ID = 3,
                        FacultyID = 2,
                        Name = "会计",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    },
                    new Specialty
                    {
                        ID = 4,
                        FacultyID = 2,
                        Name = "财务管理",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    }
                };
                context.ResetValueGenerators(Namespace + "." + nameof(Specialty), SpecialtyArr.Count());
                context.Specialtys.AddRange(SpecialtyArr);

                Subject[] SubjectArr = new Subject[]{
                    new Subject
                    {
                        ID = 1,
                        FacultyID = 1,
                        Name = "电子商务概论",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    },
                    new Subject
                    {
                        ID = 3,
                        FacultyID = 1,
                        Name = "计算机网络",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    },
                    new Subject
                    {
                        ID = 4,
                        FacultyID = 2,
                        Name = "西方经济学",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    },
                    new Subject
                    {
                        ID = 5,
                        FacultyID = 2,
                        Name = "管理学",
                        CreateTime = DateTime.Now,
                        UpdateTime =  DateTime.Now
                    }
                };
                context.ResetValueGenerators(Namespace + "." + nameof(Subject), SubjectArr.Count());
                context.Subjects.AddRange(SubjectArr);

                context.SaveChanges();
            }
        }
    }
}

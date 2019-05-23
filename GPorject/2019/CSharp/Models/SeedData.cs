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
				if (context.Users.Any())
				{
				    return;   // DB has been seeded
				}

				string Namespace = MethodBase.GetCurrentMethod().DeclaringType.Namespace;

				User[] UserArr = new User[]{
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
					},
					new User
					{
						ID = 3,
						UserName = "杨老师",
						PassWord = "123456",
						Role = 3,
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new User
					{
						ID = 4,
						UserName = "许老师",
						PassWord = "123456",
						Role = 3,
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new User
					{
						ID = 5,
						UserName = "王小明",
						PassWord = "123456",
						Role = 4,
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new User
					{
						ID = 6,
						UserName = "韩小梅",
						PassWord = "123456",
						Role = 4,
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					}
				};
				context.ResetValueGenerators(Namespace + "." + nameof(User), UserArr.Count());
				context.Users.AddRange(UserArr);

				Role[] RoleArr = new Role[]{
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
				};
				context.ResetValueGenerators(Namespace + "." + nameof(Role), RoleArr.Count());
				context.Roles.AddRange(RoleArr);

				Route[] RouteArr = new Route[]{
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
				};
				context.ResetValueGenerators(Namespace + "." + nameof(Route), RouteArr.Count());
				context.Routes.AddRange(RouteArr);

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
						ID = 2,
						FacultyID = 1,
						Name = "计算机网络",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new Subject
					{
						ID = 3,
						FacultyID = 2,
						Name = "西方经济学",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new Subject
					{
						ID = 4,
						FacultyID = 2,
						Name = "管理学",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					}
				};
				context.ResetValueGenerators(Namespace + "." + nameof(Subject), SubjectArr.Count());
				context.Subjects.AddRange(SubjectArr);

				Teacher[] TeacherArr = new Teacher[]{
					new Teacher
					{
						ID = 1,
						UserID = 3,
						FacultyID = 1,
						Name = "杨老师",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new Teacher
					{
						ID = 2,
						UserID = 4,
						FacultyID = 2,
						Name = "许老师",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					}
				};
				context.ResetValueGenerators(Namespace + "." + nameof(Teacher), TeacherArr.Count());
				context.Teachers.AddRange(TeacherArr);

				Classes[] ClassesArr = new Classes[]{
					new Classes
					{
						ID = 1,
						FacultyID = 1,
						Name = "15计算机班",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new Classes
					{
						ID = 2,
						FacultyID = 2,
						Name = "15会计班",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					}
				};
				context.ResetValueGenerators(Namespace + "." + nameof(Classes), ClassesArr.Count());
				context.Classess.AddRange(ClassesArr);

				Student[] StudentArr = new Student[]{
					new Student
					{
						ID = 1,
						UserID = 5,
						ClassesID = 1,
						Name = "王小明",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new Student
					{
						ID = 2,
						UserID = 6,
						ClassesID = 1,
						Name = "韩小梅",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					}
				};
				context.ResetValueGenerators(Namespace + "." + nameof(Student), StudentArr.Count());
				context.Students.AddRange(StudentArr);

				KnowledgePoint[] KnowledgePointArr = new KnowledgePoint[]{
					new KnowledgePoint
					{
						ID = 1,
						FacultyID = 1,
						SubjectID = 1,
						Name = "网络七层协议",
						Describe = "OSI是一个开放性的通信系统互连参考模型，他是一个定义得非常好的协议规范。OSI模型有7层结构，每层都可以有几个子层。 OSI的7层从上到下分别是 7 应用层 6 表示层 5 会话层 4 传输层 3 网络层 2 数据链路层 1 物理层 ；其中高层（即7、6、5、4层）定义了应用程序的功能，下面3层（即3、2、1层）主要面向通过网络的端到端的数据流。",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new KnowledgePoint
					{
						ID = 2,
						FacultyID = 1,
						SubjectID = 1,
						Name = "RSA算法",
						Describe = "RSA加密算法是一种非对称加密算法。在公开密钥加密和电子商业中RSA被广泛使用。RSA是1977年由罗纳德·李维斯特（Ron Rivest）、阿迪·萨莫尔（Adi Shamir）和伦纳德·阿德曼（Leonard Adleman）一起提出的。当时他们三人都在麻省理工学院工作。RSA就是他们三人姓氏开头字母拼在一起组成的。",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					}
				};
				context.ResetValueGenerators(Namespace + "." + nameof(KnowledgePoint), KnowledgePointArr.Count());
				context.KnowledgePoints.AddRange(KnowledgePointArr);

				Problem[] ProblemArr = new Problem[]{
					new Problem
					{
						ID = 1,
						KnowledgePointID = 1,
						Name = "这是选择题",
						Type = (int)ProblemType.Choice,
						Describe = "{\"problem\":\"网络七层协议的第三层的名称是\",\"option\":[\"链路层\",\"网络层\",\"物理层 \",\"应用层\"]}",
						Answer = "1",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new Problem
					{
						ID = 2,
						KnowledgePointID = 1,
						Name = "这是判断题",
						Type = (int)ProblemType.Judge,
						Describe = "网络七层协议的第三层的名称是网络层",
						Answer = "1",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new Problem
					{
						ID = 3,
						KnowledgePointID = 1,
						Name = "这是填空题",
						Type = (int)ProblemType.Fill,
						Describe = "网络七层协议的第三层的名称是%s",
						Answer = "网络层",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new Problem
					{
						ID = 4,
						KnowledgePointID = 1,
						Name = "这是简答题",
						Type = (int)ProblemType.ShortAnswer,
						Describe = "请写出网络七层协议每一层的名称",
						Answer = "7 应用层 6 表示层 5 会话层 4 传输层 3 网络层 2 数据链路层 1 物理层",
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					}
				};
				context.ResetValueGenerators(Namespace + "." + nameof(Problem), ProblemArr.Count());
				context.Problems.AddRange(ProblemArr);

				Exercise[] PExerciseArr = new Exercise[]{
					new Exercise
					{
						ID = 1,
						SubjectID = 1,
						Name = "这是练习",
						Type = (int)ExerciseType.Practice,
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					},
					new Exercise
					{
						ID = 2,
						SubjectID = 1,
						Name = "这是试卷",
						Type = (int)ExerciseType.TextPaper,
						CreateTime = DateTime.Now,
						UpdateTime =  DateTime.Now
					}
				};
				context.ResetValueGenerators(Namespace + "." + nameof(Exercise), PExerciseArr.Count());
				context.Exercises.AddRange(PExerciseArr);

				context.SaveChanges();
			}
		}
	}
}

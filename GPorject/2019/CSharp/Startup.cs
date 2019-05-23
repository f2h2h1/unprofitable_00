using System;
using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Hosting;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.DependencyInjection;

using GPorject.Models;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.ValueGeneration;
using Microsoft.EntityFrameworkCore.Metadata;

namespace GPorject
{
	class InMemoryValueGeneratorCache : ValueGeneratorCache
	{
		public InMemoryValueGeneratorCache(ValueGeneratorCacheDependencies dependencies) : base(dependencies)
		{
		}

		public new virtual ValueGenerator GetOrAdd(
			IProperty property, IEntityType entityType, Func<IProperty, IEntityType, ValueGenerator> factory)
		{
			return base.GetOrAdd(property, entityType, factory);

			// return _cache.GetOrAdd(new CacheKey(property, entityType, factory), ck => ck.Factory(ck.Property, ck.EntityType));
		}
	}

	public class Startup
	{
		public Startup(IConfiguration configuration)
		{
			Configuration = configuration;
		}

		public IConfiguration Configuration { get; }

		// This method gets called by the runtime. Use this method to add services to the container.
		public void ConfigureServices(IServiceCollection services)
		{
			services.Configure<CookiePolicyOptions>(options =>
			{
				// This lambda determines whether user consent for non-essential cookies is needed for a given request.
				options.CheckConsentNeeded = context => true;
				options.MinimumSameSitePolicy = SameSiteMode.None;
			});

			// MVC 服务
			services.AddMvc().SetCompatibilityVersion(CompatibilityVersion.Version_2_2);

			// 数据库服务
			String DefaultDBType = Configuration["DefaultDBType"];
			if (DefaultDBType.Equals("") || DefaultDBType.Equals("InMemoryDatabase"))
			{
				// 使用内存数据库
				var connection = Configuration["ConnectionStrings:InMemoryDatabase"];
				services.AddDbContext<PorjectContext>
					(options => options.UseInMemoryDatabase(connection)
						.ReplaceService<IValueGeneratorCache, InMemoryValueGeneratorCache>());
			}
			else if (DefaultDBType.Equals("Sqlite"))
			{
				// 使用 Sqlite
				var connection = Configuration["ConnectionStrings:Sqlite"];
				services.AddDbContext<PorjectContext>
					(options => options.UseSqlite(connection));
			}
			else if (DefaultDBType.Equals("SqlServer"))
			{
				// 使用 SqlServer
				var connection = Configuration["ConnectionStrings:SqlServer"];
				services.AddDbContext<PorjectContext>
					(options => options.UseSqlServer(connection));
			}
			else if (DefaultDBType.Equals("MySql"))
			{
				// 使用 MySql
				var connection = Configuration["ConnectionStrings:MySql"];
				services.AddDbContext<PorjectContext>
					(options => options.UseMySQL(connection));
			}

			// Session 服务
			services.AddDistributedMemoryCache();
			services.AddSession(options =>
			{
				options.IdleTimeout = TimeSpan.FromSeconds(3600);
				options.Cookie.HttpOnly = true;
			});
		}

		// This method gets called by the runtime. Use this method to configure the HTTP request pipeline.
		public void Configure(IApplicationBuilder app, IHostingEnvironment env)
		{
			if (env.IsDevelopment())
			{
				app.UseDeveloperExceptionPage();
			}
			else
			{
				app.UseExceptionHandler("/Home/Error");
				// The default HSTS value is 30 days. You may want to change this for production scenarios, see https://aka.ms/aspnetcore-hsts.
				app.UseHsts();
			}

			app.UseHttpsRedirection();
			app.UseStaticFiles();
			app.UseCookiePolicy();

			// Session
			app.UseSession();

			app.UseMvc(routes =>
			{
				routes.MapRoute(
					name: "default",
					template: "{controller=Home}/{action=Index}/{id?}");
			});
		}
	}
}

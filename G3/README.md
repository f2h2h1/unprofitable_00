# 这是一个简单的 PHP 框架
- 实现了一个简单的 MVC
- 实现了一个简单的容器管理
- 实现了一个简单的路由
- 实现了一个简单的渲染器
- 使用 Doctine 作为 ORM
- 前端使用了 Bootstrap4
- 使用 sqlite 作为默认数据库
- 需要 PHP 7.2 或以上版本

## 为什么要做这么一个框架
- 这个框架是为了应付毕业设计而做的
- 根据作者多年做毕业设计的经验，总结了一些毕业设计的需求
1. 毕业设计的代码必须足够的简单，因为要让 小白 短时间内看懂
2. 毕业设计的项目往往只会在毕业答辩时运行一次，所以不需要考虑拓展性，安全性，SEO
3. 开发体验要尽可能地接近当下流行的框架，这样开发效率才会高
4. 使用 sqlite 作为默认数据库可以减少不必要的依赖，只需装上 PHP 就能运行。因为使用 Doctine 作为 ORM ，所以也可以很轻松地迁移到 MySQL 或 SQL Server

## 目录结构
```
├─app                     应用目录
│  ├─Controllers          控制器目录
│  ├─Dao                  数据访问对象层目录
│  ├─Models               模型目录
│  ├─Views                视图目录
│  ├─bootstrap.php        Doctine 初始化
│  ├─config.php           应用配置文件
│  ├─Container.php        容器管理
│  ├─db.sqlite            sqlite 数据库文件
│  ├─index.php            实际入口
│  ├─Renderer.php         渲染器
│  ├─Route.php            路由
├─bin                     脚本目录
│  ├─cli-config.php       Doctine cli 配置文件
│  ├─db.bat
│  ├─opencmd.bat          打开 cmd
│  ├─startserver.bat      启用 PHP 内置服务器
│  ├─update_database.bat
├─public                  网站对外访问目录
│  ├─static               放置静态资源的目录
│  ├─favicon.ico          网站图标
│  ├─index.php            入口文件
├─upload                  上文目录
├─vendor                  composer 依赖目录
├─.gitignore              git 相关文件 用于设置需要忽略的文件
├─composer.json           composer 配置文件
├─composer.lock           composer 锁文件
├─README.md               自述文件
```

## 为什么不单独开一个仓库
因为作者觉得这个框架还不够成熟

## GPojectPHP 的含义
Graduation Project PHP

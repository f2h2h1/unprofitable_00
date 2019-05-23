:: 迁移数据库
REM %cd%\..\vendor\bin\doctrine.bat orm:schema-tool:create
php ../vendor/doctrine/orm/bin/doctrine orm:schema-tool:create
:: 插入 admin 的记录
REM php ../vendor/doctrine/orm/bin/doctrine dbal:run-sql "INSERT INTO `user` (`id`, `name`, `password`, `role`, `createtime`, `updatetime`) VALUES ('1', 'admin', 'admin', '1', UNIX_TIMESTAMP(), UNIX_TIMESTAMP());"
php ../vendor/doctrine/orm/bin/doctrine dbal:run-sql "INSERT INTO `user` (`id`, `name`, `password`, `role`, `createtime`, `updatetime`) VALUES ('1', 'admin', '123456', '1', '1441418400', '1441418400');"
pause
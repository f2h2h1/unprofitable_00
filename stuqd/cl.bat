chcp 936
set CURRENT_PATH=%cd%
set TOMCAT_HOME=O:\apache-tomcat-9.0.36
set JAVA_COMPILEC_PATH=src\com\action\*.java src\com\bean\*.java src\com\util\*.java
set TOMCAT_LIB=%TOMCAT_HOME%\lib
set USER_LIB=WebRoot\WEB-INF\lib
set CLASSES=WebRoot\WEB-INF\classes

REM 删除之前已经编译好的 class
rd /Q /S %CLASSES%\com

REM 编译
REM javac -Xlint:deprecation -Xlint:unchecked -Djava.ext.dirs=%TOMCAT_LIB%;%USER_LIB% -d %CLASSES%  --source 8 --target 8 %JAVA_COMPILEC_PATH%
javac -Xlint:deprecation -Xlint:unchecked -Djava.ext.dirs=%TOMCAT_LIB%;%USER_LIB% -d %CLASSES% %JAVA_COMPILEC_PATH%

REM 删除之前生成的 war
del /Q test.war

REM 打包 war jar -cvf test.war -C WebRoot/ .
jar -cf test.war -C WebRoot/ .

REM 停止 tomcat
REM %TOMCAT_HOME%\
O:
cd %TOMCAT_HOME%\bin
REM 通过判断窗口名为tomcat的进程是否存在，来判断tomcat是否有启动，如果有启动就先运行停止tomcat的脚本
tasklist /FI "WINDOWTITLE eq tomcat" && call shutdown.bat

REM 删除在 tomcat 目录下的 war
rd /Q /S %TOMCAT_HOME%\webapps\test
del /Q %TOMCAT_HOME%\webapps\test.war

REM 把新生成的 war 复制到 tomcat 目录下
copy "%CURRENT_PATH%\test.war" %TOMCAT_HOME%\webapps\test.war

REM 运行 tomcat
O:
cd %TOMCAT_HOME%\bin
call %TOMCAT_HOME%\bin\startup.bat
C:
cd CURRENT_PATH

REM 等待 3 秒，确保 tomcat 已经启动
TIMEOUT /T 3 /NOBREAK

REM 用默认浏览器打开网址
REM rundll32 url.dll,FileProtocolHandler "http://127.0.0.1:8080/test/index.jsp"
start iexplore "http://127.0.0.1:8080/test/index.jsp"

pause
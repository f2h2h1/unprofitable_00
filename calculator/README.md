## 一个简单的四则运算计算器

写了 C 和 Java 两个版本，基本都是从网上~~抄袭~~借鉴，原本只想写一个 Java ，但网上的搜到的都是 C 的，于是就先写了 C 的版本，再根据 C 的版本写一遍 Java 的，除了基本的四则运算外还实现了括号

### C
编译器版本
```
gcc version 8.1.0 (x86_64-posix-sjlj-rev0, Built by MinGW-W64 project)
```
编译和运行命令
```
gcc main.c -o main.exe && main.exe
```

### Java
编译器版本
```
openjdk version "13.0.1" 2019-10-15
```
编译和运行命令
```
javac -encoding utf-8 -d bin src\calculator\*.java
java -Dfile.encoding=UTF-8 -cp ".;bin" calculator.App
```

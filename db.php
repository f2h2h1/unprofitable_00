<?php
//Mysql 数据库连接配置

$dbms = 'mysql';
$host = 'localhost';
$port = '3306';
$dbname = 'ershoushu';
$charset = 'utf8';
$user = 'root';
$pwd = '';
$dsn = "$dbms:host=$host;port=$port;dbname=$dbname;charset=$charset";

try{
    $con = new PDO($dsn,$user,$pwd);
    return $con;
}catch(PDOException $e){
    echo $e->getMessage().'<br>';
    die;
}


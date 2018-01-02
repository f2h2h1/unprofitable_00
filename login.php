<?php

//valid the user login
session_start();
$email = $_POST["username"];
$password = $_POST["password"];
$pass = md5($password);
$con = include 'db.php';
$sql = "SELECT email,password,sid FROM tbllogin WHERE email='{$email}' AND password = '{$pass}'";
$res = $con->query($sql);
$r = $res->fetch(PDO::FETCH_ASSOC);
$sid = $r['sid'];
if ($res != false && $r) {

    if ($r['email'] == $_POST['username']) {
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        $_SESSION["sid"] = $r['sid'];
        header("location: index.php?user=" . $email.'&sid='."$sid");
        $con = null;
    }

}else{

    header("location: login.html");
}


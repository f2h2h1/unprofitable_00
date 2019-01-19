<?php
/**
 * Created by PhpStorm.
 * User: AN
 * Date: 2017-12-31
 * Time: 16:01
 */

$bookname = $_POST['bookname'];
$price = $_POST['price'];
$author = $_POST['author'];
$year = $_POST['year'];
$price = $_POST['price'];
$publish = $_POST['publisher'];
$ISBN = $_POST['ISBN'];
$tag = $_POST['tag'];
$count = $_POST['count'];

if ($_FILES["file"]["name"]== "") {
    echo "<script> alert ('Select pic error')</script>";
    exit();
} else{
    move_uploaded_file($_FILES["file"]["tmp_name"],
        "img/" . $_FILES["file"]["name"]);
}

session_start();



if (isset($_SESSION['email'])) {
    try {
        $image_name = $_FILES["file"]["name"];

        $sid = $_SESSION['sid'];
        $con = include 'db.php';
        $sql = "INSERT INTO tblbook (`title`, `author`, `publisher`, `yearOfPublish`, `ISBN`, `price`, `tag`, `inStock`,`sid`) 
        VALUES ('".$bookname."' , '".$author."', '".$publish."', '".$year."', '".$ISBN."', '".$price."', '".$tag."', '".$count."', '".$sid."');";
       // print_r($sql);
        print_r($con->errorinfo());
        $e = $con->exec($sql);
        $bid = $con->lastInsertId();
        $img = "img/$image_name";
        $sql = "INSERT INTO tblbookImage(sourcePath,bid) 
                VALUES ('".$img."', '".$bid."');";

        $res = $con->exec($sql);
        print_r($e);
        print_r($con->errorinfo());

        if ($e == 1 &&  $res==1) {
            echo "<script> alert ('Add Success,Now return to index.html')</script>";
            header("Location: index.php");
        } else {
            header("Location: login.html");

        }
    } catch (Exception $e) {
        print $e->getMessage();
        header("Location: login.html");
        exit();
    }
}

?>
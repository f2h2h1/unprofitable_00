<?php
// 拉取数据库中的信息

session_start();
//$_SESSION['email'];
$action = $_POST['action'];
$what = $_POST['what'];
if($action == 'getBooks'){
    getBooks();
}else if($action == 'getBook'){
    getBook();
}else if($action == 'getMyBooks') {
    getMyBooks();
}else if($action == 'searchBooks'){
    searchBooks();
}

function getBooks(){
    //get all the books from the database
    $con = include 'db.php';

    $sql ="SELECT  b.bid, b.title, b.author, b.yearOfPublish, b.publisher, b.ISBN, b.price, b.inStock, b.sid, im.sourcePath, c.phone

    FROM tblbook b, tblbookImage im, tblstudent s , tblcontact c

    WHERE b.bid = im.bid AND b.sid = s.sid AND c.sid=b.sid ";

    $books = $con->query($sql);
    $con = null;
    echo json_encode($books->fetchAll());

}


function getBook(){
    //get the book requrested
    $con = include 'db.php';

    $sql = "SELECT DISTINCT b.bid, b.title, b.author, b.yearOfPublish, b.publisher, b.ISBN, b.price, b.inStock, b.sid, im.sourcePath, c.phone

    FROM tblbook b, tblbookImage im, tblstudent s , tblcontact c

    WHERE b.tag='{$GLOBALS['what']}' AND b.bid = im.bid AND b.sid = s.sid group by b.bid";
    $books = $con->query($sql);
    $con = null;
    echo json_encode($books->fetchAll());
}

function getMyBooks(){
    // get all the books belongs to the current login user
    $con = include 'db.php';
    $email =  $_SESSION["email"];

    $sql = "SELECT DISTINCT b.bid, b.title, b.author, b.yearOfPublish, b.publisher, b.ISBN, b.price, b.inStock, b.sid, im.sourcePath, c.email, c.phone

    FROM tblbook b, tblbookImage im, tblstudent s, tblcontact c

    WHERE  c.email='{$email}' AND c.sid = s.sid AND b.sid = s.sid AND b.bid = im.bid ";

    $mybooks = $con->query($sql);
    $con = null;
    echo json_encode($mybooks->fetchAll());
}


function searchBooks(){
    $con = include 'db.php';

    global $what;
    $sql = "SELECT DISTINCT b.bid, b.title, b.author, b.yearOfPublish, b.publisher, b.ISBN, b.price, b.inStock, b.sid, im.sourcePath, c.phone

    FROM tblbook b, tblbookImage im, tblstudent s, tblcontact c

    WHERE b.bid = im.bid AND b.sid = s.sid AND b.title REGEXP '.*{$what}.*' group by b.bid";
    $books = $con->query($sql);
    $con = null;
    echo json_encode($books->fetchAll());
}

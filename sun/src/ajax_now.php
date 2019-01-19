<?php
require 'cache.php';
//$number_span = $_POST['number'];
//$status = $_POST['status'];

//$number_span = $_GET['number'];
//$status = $_GET['status'];

$obj = init_cache();
$cache_key = "sun@001";
$number = get_cache($obj, $cache_key);

if(empty($number)) {
    $number = 100;
    add_cache($obj, $cache_key, $number);
}

echo $number;

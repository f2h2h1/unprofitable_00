<?php
require 'cache.php';
//$number_span = $_POST['number'];
//$status = $_POST['status'];

$number_span = $_GET['number'];
$status = $_GET['status'];

if ($number_span > 80) {
    $number_span = 80;
}

$cache_obj = init_cache();
$cache_key = "sun@001";
$number = get_cache($cache_obj, $cache_key);//获取缓存

if(empty($number)) {
    $number = 100;
}

if ($status == "minus") {
    $number = $number - $number_span;
    add_cache($cache_obj, $cache_key, $number);
}

echo $number;

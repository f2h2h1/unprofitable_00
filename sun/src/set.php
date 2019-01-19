<?php
require 'cache.php';

$cache_obj = init_cache();
$cache_key = "sun@001";
$number = get_cache($cache_obj, $cache_key);//»ñÈ¡»º´æ

$number = 3000000;

add_cache($cache_obj, $cache_key, $number);


echo $number;
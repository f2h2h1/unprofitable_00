<?php

//初始化缓存_memcache
function init_cache()
{
    $mem = new Memcache();
    $mem->connect("localhost", 11211); 
    
    return $mem;
}

//获取缓存里的值_mamcache
function get_cache($obj, $cache_key)
{
    $cache = $obj->get($cache_key);
    return $cache; 
}

//往缓存里添加值_mamcache
function add_cache($obj, $cache_key, $cache_value)
{
    $obj->set($cache_key, $cache_value, 0, 0);
}
/*
//初始化缓存_kvdb
function init_cache()
{
    $kv = new SaeKV();
    $ret = $kv->init();
    
    return $kv;
}

//获取缓存里的值_kvdb
function get_cache($obj, $cache_key)
{
    $cache = $obj->get($cache_key);
    //echo $cache;echo $cache_key;
    return $cache; 
}

//往缓存里添加值_kvdb
function add_cache($obj, $cache_key, $cache_value)
{
    $ret = $obj->set($cache_key, $cache_value);
}
*/
    
<?php
    $redis = new \Redis();
    $redis->connect('127.0.0.1', 6379);
    $ip = $_SERVER['REMOTE_ADDR'];
    $redis->set($ip,0);
    $redis->expire($ip,1);
    echo $redis->get($ip);
?>
<?php
    $redis = new \Redis();
    $redis->connect('127.0.0.1', 6379);
    $ip = $_SERVER['REMOTE_ADDR'];
    echo $redis->get($ip);
?>
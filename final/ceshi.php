<?php
$redis = new \Redis();
$redis->connect('127.0.0.1', 6379);
$redis->incr("username");
$redis->expire("username",20);
$ip = $_SERVER['REMOTE_ADDR'];
echo $ip."<br>";
echo $redis->get("username");
?>
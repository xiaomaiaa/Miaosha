<?php
    $url=$_GET['url'];
    echo "<h1>操作成功，即将跳转！</h1>";
    header("Refresh:2;url=".$url);
?>
<?php
    $conn = mysqli_connect("localhost", "mhy", "xiaomai","project");
    $sql="select id,name,price,volumn,maxbuy from goods";
    $result=mysqli_query($conn,$sql);
    $ref = mysqli_fetch_row($result);
    echo json_encode($ref);
    mysqli_close($conn);
?>
<?php
    $conn = mysqli_connect("localhost", "mhy", "xiaomai","project");
    $sql="select id,name,price,volumn from goods";
    $result=mysqli_query($conn,$sql);
    $ref = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($ref);
    mysqli_close($conn);
?>
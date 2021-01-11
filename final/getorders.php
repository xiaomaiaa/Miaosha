<?php
    $username=$_GET['username'];
    $conn = mysqli_connect("localhost", "mhy", "xiaomai","project");
    $sql="select userid from md5psw where username = '$username'";
    $result=mysqli_query($conn,$sql);
    $ref = mysqli_fetch_row($result);
    $userid=$ref[0];
    $sql="select goodid,buynum from ordering where userid=$userid";
    $result=mysqli_query($conn,$sql);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $sql="select id,name from goods";
    $result=mysqli_query($conn,$sql);
    $goods = mysqli_fetch_all($result, MYSQLI_ASSOC);
    for ($x=0;$x<count($orders);$x++){
        //echo $orders[$x]['goodid'];
        $orders[$x]['goodname']=$goods[$orders[$x]['goodid']-1]['name'];
    }
    echo json_encode($orders);
    mysqli_close($conn);
?>
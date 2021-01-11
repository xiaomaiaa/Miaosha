<?php
    $goodid=$_GET['goodid'];
    $buynum=$_GET['buynum'];
    $username=$_GET['username'];
    $conn = mysqli_connect("localhost", "mhy", "xiaomai","project");
    $sql="select userid from md5psw where username = '$username'";
    $result=mysqli_query($conn,$sql);
    $ref = mysqli_fetch_row($result);
    $userid=$ref[0];

    $sql="select count(*) from goods where id='$goodid' and volumn>='$buynum' and maxbuy>='$buynum'";
    $result=mysqli_query($conn,$sql);
    $ref = mysqli_fetch_row($result);
    if ($ref[0]==0){
        echo json_encode(array('result'=>"FAIL",'reason'=>'对不起，购买出现错误！可能是商品已经无货，请返回重新查看！'));
        return ;
    }
    $url='http://localhost:9001/?userid='.$userid.'&goodid='.$goodid.'&buynum='.$buynum;
    $fp = fopen($url, 'r') or exit('Open url faild!'); 
    $file="";
    if($fp){  
        while(!feof($fp)) {    
        $file .= fgets($fp) . "";  
        }  
        fclose($fp);    
    } 
    //echo $file;
    if ($file=='<h1>Query sent.</h1>'){
        echo json_encode(array('result'=>"SUCCESS",'reason'=>'已经成功发送订单！请稍等一段时候之后查看情况！'));
        return ;
    } else{
        echo json_encode(array('result'=>"FAIL",'reason'=>'订单发送错误！请返回重新尝试！'));
        return ;
    }
?>
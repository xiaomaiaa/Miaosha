<?php
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
    //-----------------check username--------------
    if (!preg_match('/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u',$username)){
        echo json_encode(array('result'=>"FAIL",'reason'=>'用户名由2-16位数字或字母、汉字、下划线组成！'));
        return ;
    }
    $conn = mysqli_connect("localhost", "mhy", "xiaomai","project");
    $sql="select count(*) from md5psw where username = '$username'";
    $result=mysqli_query($conn,$sql);
    $ref = mysqli_fetch_row($result);
    if ($ref[0]==1){
        echo json_encode(array('result'=>"FAIL",'reason'=>'用户名已存在！'));
        return ;
    }
    #-------------------check password--------------------------
    if ($password!=$password2){
        echo json_encode(array('result'=>"FAIL",'reason'=>'两次密码不一致！'));
        return ;
    }
    if (!preg_match('/(?=.*[0-9])(?=.*[A-Za-z]).{6,16}$/', $password)){
        echo json_encode(array('result'=>"FAIL",'reason'=>'密码不符合要求！'));
        return ;
    }
    $md5psw=md5($password);
    $id=mysqli_fetch_row(mysqli_query($conn,"select count(*)+1 from md5psw"))[0];
    $sql="INSERT INTO md5psw(userid,username, password) VALUES ($id, '$username','$md5psw')";
    $result=mysqli_query($conn,$sql);
    if ($result){
        echo json_encode(array('result'=>"SUCCESS"));
        return ;
    }
    echo json_encode(array('result'=>"FAIL",'reason'=>'数据库暂时出错，请稍后重试！'));
    return ;
?>
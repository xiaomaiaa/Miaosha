<?php
    $token=$_POST['token'];
    require_once 'jwt.php';
    $jwt=new Jwt;
    $getPayload=$jwt->verifyToken($token);
    if ($getPayload==false){
        echo json_encode(array('result'=>"FAIL"));
    } else{
        echo json_encode(array('result'=>"SUCCESS",'userid'=>$getPayload['userid'],'username'=>$getPayload['username']));
    }
?>
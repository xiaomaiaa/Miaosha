<?php
    function checkidpsw($id,$password){
        if ($id==NULL || $password==NULL){
            return false;
        }
        if (!preg_match('/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u',$id)){
            return false;
        }
        $conn = mysqli_connect("localhost", "mhy", "xiaomai","project");
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        } 
        #$sql="select count(*) from exppsw where id = '$id' and password = '$password'";
        $sql="select count(*) from md5psw where username = '$id' and password = '$password'";
        $result=mysqli_query($conn,$sql);
        $ref = mysqli_fetch_row($result);
        if ($ref[0] == 1)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    	mysqli_close($conn);
    }


    $username=$_POST['username'];
    $password=md5($_POST['password']);
    if (checkidpsw($username,$password)){
        require_once 'jwt.php';
        $conn = mysqli_connect("localhost", "mhy", "xiaomai","project");
        $sql="select userid from md5psw where username = '$username'";
        $result=mysqli_query($conn,$sql);
        $ref = mysqli_fetch_row($result);
        $userid=$ref[0];
        $payload=array('userid'=>$userid,'username'=>$username,'iat'=>time(),'exp'=>time()+7200);
        $jwt=new Jwt;
        $token=$jwt->getToken($payload);
        mysqli_close($conn);
        echo json_encode(array('result'=>"SUCCESS",'token'=>$token));
    } else{
        echo json_encode(array('result'=>"FAIL"));
    }
?>
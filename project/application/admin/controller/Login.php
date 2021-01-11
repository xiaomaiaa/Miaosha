<?php

/**
 *  登陆页
 * @file   Login.php  
 * @date   2016-8-23 19:52:46 
 * @author Zhenxun Du<5552123@qq.com>  
 * @version    SVN:$Id:$ 
 */

namespace app\admin\controller;

use think\Controller;
use think\Loader;
use think\Db;
use think\Cookie;
use think\Session;

class Login extends Controller {
    /**
     * 登入
     */
    public function index() {
        Session::init();
        /*print_r($_COOKIE);
        echo "<br>";
        print_r($_SESSION);
        echo session_id();
        echo "<br>";*/
        if (Cookie::has('sid') && Session::has('sid') && Cookie::get('sid')==Session::get('sid')){
            $this->success('您已经登陆，即将跳转主页','main/index');
        } else {
            return $this->fetch();
        }
    }
    
    public function checkidpsw($id,$password){
        if ($id==NULL || $password==NULL){
            return false;
        }
        $result=Db::query('select count(*) from admin_user where username=? and password=?',[$id,$password]);
        if ($result[0]['count(*)']==1)
            return true;
        else
            return false;
    }
    
    public function dologin() {
        //验证密码流程
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        if ($this->checkidpsw($username,$password)){
            Session::init();
            $sid=session_id();
            Session::set('sid',$sid);
            Cookie::set('sid',$sid,7*24*3600);
            Cookie::set('username',$username,7*24*3600);
            $this->success('登陆成功，正在进入主页','main/index');
        } else
        {
            #echo "登录失败！用户名或密码错误！<br>";
            $this->success('登录失败！用户名或密码错误！', 'login/index');
        }
    }

    /**
     * 登出
     */
    public function logout() {
        Cookie::delete('sid');
        Cookie::delete('username');
        session(null);
        
        $this->success('退出成功', 'login/index');
    }

}

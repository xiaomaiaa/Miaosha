<?php

/**
 *  登陆页
 * @file   Login.php  
 * @date   2016-8-23 19:52:46 
 * @author Zhenxun Du<5552123@qq.com>  
 * @version    SVN:$Id:$ 
 */

namespace app\index\controller;

use think\Controller;
use think\Loader;
use think\Db;
use think\Cookie;
use think\Session;

class Index extends Controller {
    public function checklogin(){
        if (Cookie::has('sid')){
            $sid=Cookie::get('sid');
            $result=Db::query('select username from logininfo where sid=?',[$sid]);
            if (count($result)==0 || $result[0]['username'] != Cookie::get('username'))
        	{
        		return false;
        	}
        	else
        	{
        		return true;
        	}
        	
        } else
        {
            return false;
        }
    }
    
    public function makesession(){
        $username=Cookie::get('username');
        $result=Db::query('select userid from md5psw where username = ?',[$username]);
        $userid=$result[0]['userid'];
        Session::set('userid',$userid);
        $result=Db::query("select roleid from role_user where userid=?",[$userid]);
        $roleids=array();
        foreach ($result as $ref){
            $roleids[count($roleids)]=$ref['roleid'];
        }
        Session::set('roleids',$roleids);
        $result=Db::query('select * from role_node');
        $availnodeids=array();
        foreach ($roleids as $roleid){
            foreach ($result as $role_node){
                if ($roleid==$role_node['roleid']){
                    $availnodeids[count($availnodeids)]=$role_node['nodeid'];
                }
            }
        }
        Session::set('availnodeids',array_unique($availnodeids));
    }
    
    /**
     * 登入
     */
    public function index() {
        Session::init();
        print_r($_COOKIE);
        echo "<br>";
        print_r($_SESSION);
        echo session_id();
        echo "<br>";
        if (Cookie::has('sid') && Session::has('sid') && Cookie::get('sid')==Session::get('sid')){
            #$this->makesession();
            $this->success('您已经登陆，即将跳转主页','main/index');
        } else {
            return $this->fetch();
        }
    }
    
    public function checkidpsw($id,$password){
        if ($id==NULL || $password==NULL){
            return false;
        }
        $result=Db::query('select count(*) from md5psw where username=? and password=?',[$id,$password]);
        if ($result[0]['count(*)']==1)
            return true;
        else
            return false;
    }
    
    /**
     * 处理登录
     */
    public function dologin() {
        //验证密码流程
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        echo $username.$password."<br>";
        if ($this->checkidpsw($username,$password)){
            Session::init();
            $sid=session_id();
            echo "sid:".$sid."<br>";
            Session::set('sid',$sid);
            Cookie::set('sid',$sid,7*24*3600);
            Cookie::set('way','user',7*24*3600);
            Cookie::set('username',$username,7*24*3600);
            #$this->makesession();
            $this->success('登陆成功，正在进入主页','main/index');
        } else
        {
            #echo "登录失败！用户名或密码错误！<br>";
            $this->success('登录失败！用户名或密码错误！', 'index/index');
        }
    }

    public function register(){
        return $this->fetch();
    }
    public function doregister(){
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        $result=Db::query('select count(*) from md5psw where username=?',[$username]);
        if ($result[0]['count(*)']==1)
            return $this->error("用户名已存在，请重新注册！");
        else{
            $id=Db::query("select count(*)+1 from md5psw")[0]['count(*)+1'];
            Db::execute("insert into md5psw(userid,username,password) VALUES (?,?,?)",[$id,$username,$password]);
            return $this->success("注册成功！即将返回主界面重新登录","index/index");
        }
    }

    /**
     * 登出
     */
    public function logout() {
        Cookie::delete('sid');
        Cookie::delete('username');
        session(null);
        $this->success('退出成功', 'index/index');
    }

}

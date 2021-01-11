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

class Public1 extends Controller {
    public function leftmenu(){
        return $this->fetch();
    }
    public function upmenu(){
        $username=Cookie::get('username');
        $this->assign('username',$username);
        return $this->fetch();
    }

}

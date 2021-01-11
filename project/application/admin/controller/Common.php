<?php

/**
 * 后台公共文件 
 * @file   Common.php  
 * @date   2016-8-24 18:28:34 
 * @author Zhenxun Du<5552123@qq.com>  
 * @version    SVN:$Id:$ 
 */

namespace app\admin\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Session;

class Common extends Controller {
    private function _addLog() {
        $data = array();
        $data['querystring'] = request()->query()?'?'.request()->query():'';
        $data['m'] = request()->module();
        $data['c'] = request()->controller();
        $data['a'] = request()->action();
        #$data['userid'] = $this->user_id;
        $data['username'] = Cookie::get('username');
        $data['ip'] = ip2long(request()->ip());
        $data['time'] = time();
        if ($data['a']!='images')
            db('admin_log')->insert($data);
    }
    
    public function _initialize() {
        /*echo "Common<br>";*/
        #print_r(Cookie::has('sid'));
        if (!Cookie::has('sid') || !Session::has('sid')){
            $this->success('您还没有登陆！请回到登录页面', 'login/index');
        }
        $username=Cookie::get('username');
        $this->assign("username",$username);
        $c = request()->controller();
        $a = request()->action();
        $url=strtolower('../'.$c.'/'.$a);
        //echo "admin init,url=".$url."<br>";
        $urlrole=Db::query('select noderole from admin_nodes where nodeurl=?',[$url]);
        if (count($urlrole)>0){
            $urlrole=$urlrole[0]['noderole'];
            $userrole=Db::query('select role from admin_user where username=?',[Cookie::get('username')])[0]['role'];
            if ($userrole>=$urlrole){
                $this->error("您没有权限访问该网页！");
            }
        }
        $role=Db::query('select role from admin_user where username=?',[$username])[0]['role'];
        $lists=Db::query('select nodename,nodeurl from admin_nodes where ?<noderole and noderole<4',[$role]);
        #var_dump($lists);
        $this->assign('menulists',$lists);
        $this->_addLog();
    }

}
<?php

/**
 *  登陆页
 * @file   
 * @date    
 * @author   
 * @version     
 */

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Cookie;


class Admin extends Common {
    public function usermanage(){
        $users=Db::query('select * from md5psw');
        $this->assign('users',$users);
        $this->assign('availdelusers',$users);
        return $this->fetch();
    }
    public function useradd(){
        $newusername=$_GET['username'];
        $newpassword=md5('newuser2021');
        $checkexist=Db::query('select count(*) from md5psw where username=?',[$newusername])[0]['count(*)'];
        if ($checkexist>0){
            $this->error('添加失败，用户名已存在！');
        }
        $userid=Db::query("select count(*)+1 from md5psw")[0]['count(*)+1'];
        Db::execute('insert into md5psw (userid,username,password) values (?,?,?)',[$userid,$newusername,$newpassword]);
        $this->success('添加新用户'.$newusername.'成功，初始密码为newuser2021，即将返回','admin/usermanage');
    }
    public function userdel(){
        $user=$_GET['deluser'];
        $userid=Db::query("select userid from md5psw where username=?",[$user])[0]['userid'];
        $orders=Db::query('select * from ordering where userid=?',[$userid]);
        foreach ($orders as $order){
            $goodid=$order['goodid'];
            $buynum=$order['buynum'];
            Db::execute('update goods set volumn=volumn+? where id=?',[$buynum,$goodid]);
        }
        Db::execute('delete from md5psw where username=?',[$user]);
        Db::execute('delete from ordering where userid=?',[$userid]);
        $this->success('用户'.$user.'删除成功，即将返回','admin/usermanage');
    }

    public function ordermanage(){
        $orders=Db::query('select orderid,ordering.userid,goodid,username,buynum,name as goodname from (ordering,md5psw,goods) where ordering.userid=md5psw.userid and ordering.goodid=goods.id');
        //var_dump($orders);
        $this->assign('orders',$orders);
        return $this->fetch();
    }
    public function ordercancel(){
        $orderid=$_GET['orderid'];
        $order=Db::query('select * from ordering where orderid=?',[$orderid])[0];
        Db::execute('update goods set volumn=volumn+? where id=?',[$order['buynum'],$order['goodid']]);
        Db::execute('delete from ordering where orderid=?',[$orderid]);
        return $this->success('订单取消成功！即将返回','admin/ordermanage');
    }

    public function goodmanage(){
        $goods=Db::query('select * from goods');
        $this->assign('goods',$goods);
        return $this->fetch();
    }
    public function goodchange(){
        $goodid=$_GET['goodid'];
        $good=Db::query('select * from goods where id=?',[$goodid]);
        $this->assign('good',$good);
        return $this->fetch();
    }
    public function goodchanging(){
        $id=$_GET['goodid'];
        $name=$_GET['name'];
        $price=$_GET['price'];
        $volumn=$_GET['volumn'];
        $maxbuy=$_GET['maxbuy'];
        $good=Db::query('select * from goods where id=?',[$id])[0];
        if ($name=="") $name=$good['name'];
        if ($price=="") $price=$good['price'];
        if ($volumn=="") $volumn=$good['volumn'];
        if ($maxbuy=="") $maxbuy=$good['maxbuy'];
        Db::execute('update goods set name=?,price=?,volumn=?,maxbuy=? where id=?',[$name,$price,$volumn,$maxbuy,$id]);
        return $this->success('商品信息修改成功，即将返回','admin/goodmanage');
    }

    public function changepassword(){
        return $this->fetch();
    }
    public function dochangepassword(){
        //echo "dochangepassword";
        $username=Cookie::get('username');
        $oldpassword=md5($_GET['oldpassword']);
        $newpassword1=md5($_GET['newpassword1']);
        $newpassword2=md5($_GET['newpassword2']);
        $password=Db::query('select password from admin_user where username=?',[$username])[0]['password'];
        if ($oldpassword!=$password){
            return $this->success('修改密码失败！旧密码错误','user/changepassword');
        }
        if ($newpassword1!=$newpassword2){
            return $this->success('修改密码失败！两次密码不一致','user/changepassword');
        }
        Db::execute('update admin_user set password=? where username=?',[$newpassword1,$username]);
        Cookie::delete('sid');
        Cookie::delete('username');
        session(null);
        return $this->success('密码修改成功！请重新登录','login/index');
    }

    public function managermanage(){
        $managers=Db::query('select username,role from admin_user');
        for($i=0;$i<count($managers);$i++){
            if ($managers[$i]['role']==0){
                $managers[$i]['role']="超级管理员";
            } else if ($managers[$i]['role']==1){
                $managers[$i]['role']="普通管理员";
            } else{
                $managers[$i]['role']="普通用户";
            }
        }
        $this->assign('managers',$managers);
        $this->assign('changemanagers',$managers);
        return $this->fetch();
    }
    public function managerchange(){
        $manager=$_GET['changemanager'];
        $role=$_GET['changerole'];
        if ($role==-1){
            $total=Db::query('select role from admin_user where username=?',[$manager])[0]['role'];
        }
        //echo $manager.' '.$role.'<br>';
        Db::execute('update admin_user set role=? where username=?',[$role,$manager]);
        $this->success('用户信息修改成功，即将返回首页','main/index');
    }
    public function manageradd(){
        $manager=$_GET['manager'];
        $role=$_GET['setrole'];
        $cnt=Db::query('select count(*) from admin_user where username=?',[$manager])[0]['count(*)'];
        if ($cnt!=0){
            $this->error('该用户名已经存在，无法添加！');
        }
        $userid=Db::query("select count(*)+1 from admin_user")[0]['count(*)+1'];
        $password=md5($manager);
        Db::execute('insert into admin_user (userid,username,role,password) values (?,?,?,?)',[$userid,$manager,$role,$password]);
        $this->success('用户'.$manager.'添加成功，初始密码与用户名相同，即将返回','admin/managermanage');
    }

    public function log() {
        $where = array();
        $lists = db("admin_log")->where($where)->order('id desc')->limit(20)->select();
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    public function _initialize() {
        parent::_initialize();
        
    }

}

<?php

/**
 *  登陆页
 * @file    
 * @date    
 * @author  
 * @version    
 */

namespace app\index\controller;

use think\Request;
use think\Db;
use think\Cookie;

class Main extends Common {

    /**
     * 主页面
     */
    public function index() {
        $goods=Db::query("select * from goods");
        var_dump($goods);
        $this->assign("goods",$goods);
        return $this->fetch();
        
    }
    public function goodinfo(){
        $goodid=$_GET['goodid'];
        echo $goodid;
        $goodinfo=Db::query("select * from goods where id=?",[$goodid]);
        $this->assign('goodid',$goodid);
        $this->assign('goodname',$goodinfo[0]['name']);
        $this->assign('goodprice',$goodinfo[0]['price']);
        $this->assign('goodvolumn',$goodinfo[0]['volumn']);
        $this->assign('goodmaxbuy',$goodinfo[0]['maxbuy']);
        $gooditr=array();
        for ($i=1; $i<=min($goodinfo[0]['maxbuy'],$goodinfo[0]['volumn']); $i++){
            $gooditr[count($gooditr)]=array('num'=>$i);
            //$gooditr[count($gooditr)-1]['num']=$i;
        }
        $this->assign('gooditr',$gooditr);
        var_dump($gooditr);
        var_dump($goodinfo);
        //if ($goodinfo[0]['volumn']==0)
            //return $this->fetch('nogood');
        return $this->fetch('goodinfo');
    }
    public function buy(){
        $goodid=$_GET['goodid'];
        $buynum=$_GET['buynum'];
        $username=Cookie::get('username');
        $userid=Db::query('select userid from md5psw where username=?',[$username])[0]['userid'];
        $canbuy=Db::query('select count(*) from goods where id=? and volumn>=? and maxbuy>=?',[$goodid,$buynum,$buynum]);
        if ($canbuy[0]['count(*)']==0){
            return $this->error('对不起，购买出现错误！可能是商品已经无货，请返回重新查看！');
        }
        $url='http://localhost:9001/?userid='.$userid.'&username='.$username.'&goodid='.$goodid.'&buynum='.$buynum;
        $fp = fopen($url, 'r') or exit('Open url faild!'); 
        $file="";
        if($fp){  
            while(!feof($fp)) {    
               $file .= fgets($fp) . "";  
            }  
            fclose($fp);    
           } 
        echo $file;
        if ($file=='<h1>Query sent.</h1>'){
            return $this->success('已经成功发送订单！请稍等一段时候之后查看情况','index');
        } else{
            return $this->error('订单发送错误！请返回重新尝试！');
        }
    }
    public function checkorder(){
        $username=Cookie::get('username');
        $userid=Db::query('select userid from md5psw where username=?',[$username])[0]['userid'];
        $myorder=Db::query('select * from ordering where userid=?',[$userid]);
        for($i=0;$i<count($myorder);$i++){
            $myorder[$i]['goodname']=Db::query('select name from goods where id=?',[$myorder[$i]['goodid']])[0]['name'];
        }
        $this->assign('myorder',$myorder);
        var_dump($myorder);
        return $this->fetch();
    }
}

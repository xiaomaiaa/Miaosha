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

class Main extends Common {

    /**
     * 主页面
     */
    public function index() {
            return $this->fetch();
        
    }

}

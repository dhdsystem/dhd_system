<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	/*用户*/
    public function user_index(){
       $this->display();
    }

    // 用户添加
    public function add(){
    	$post = I('post.');
    	var_dump($post);
    	$user_time = time();
    }

}
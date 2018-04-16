<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends CommonController {
	/*用户*/
    public function user_index(){
       $this->display();
    }

    // 用户添加页面
    public function add(){
        $role = M('role')->select();
        // var_dump($role);die;
        $roletree = $this->GetTree($role,0,0);
        $this->assign('volist',$roletree);
    	$this->display('User/user_add');
    }

    // 用户添加
    public function useradd_do(){
        $post = I('post.');
        // return $post;
        print_r( json_encode($post));

        // var_dump($post);die;
    }
}
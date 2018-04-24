<?php
namespace Home\Controller;
use Think\Controller;
class AuditController extends CommonController {
	/*审核*/
    public function audit_index(){
       	$this->display();
    }

    //添加页面
    public function audit_add(){

    	$compet = M('node')->select();
    	// var_dump($compet);die;
    	$role = M('role')->select();
    	// var_dump($role);die;
    	$raaa =$this->GetTree($role,0,0);
    	// var_dump($raaa);die;
    	$this->assign('compet',$compet);
    	$this->assign('role',$raaa);
       	$this->display();
    }

    // 添加方法
    public function audit_add_do(){
    	$data = I('post.');
    	
    	
    	
    }
}
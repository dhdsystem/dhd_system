<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
	/*首页*/
    public function index(){
		$role_id = get_role_id();
		if($role_id!=1){
			$listmain=M('node')->join('dhd_role_node on dhd_role_node.o_id=dhd_node.id')->where(array('p_id'=>0,'r_id'=>$role_id))->select();
		}
    	$listmain=M('node')->where(array('p_id'=>0))->select();
		//二级栏目
		foreach($listmain as $key=>$vo){
				$where['p_id']=$vo['id'];
				$volists=M('node')->where($where)->select();
				$listmain[$key]['san']=$volists;
			
		}
		// print_r($listmain);die;
		$this->assign('list',$listmain);
    	$this->display();
    }
}
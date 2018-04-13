<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	/*首页*/
    public function index(){

    	// echo session('username');
  //   	$role_id = get_role_id();
  //   	// echo $role_id;
  //   	$where['p_id']=0;
		// 	if($role_id!=1){
		// 		$where['r_id']=$role_id;
		// 	}

  //   	$listmain=M('role_opera')->join('tp_compet on tp_role_opera.o_id=tp_compet.id','right')->where($where)->group('tp_compet.id')->order('grade desc')->select();
  //   	// echo M('role_opera')->GetLastSql();
		// //二级栏目
		// foreach($listmain as $key=>$vo){
		// 		$where['p_id']=$vo['id'];
		// 	    $volists=M('role_opera')->join('tp_compet on tp_role_opera.o_id=tp_compet.id','right')->where($where)->group('tp_compet.id')->order('grade desc')->select();

		// 		// $volists=$module->where('p_id ='.$vo['id'])->order('grade asc')->select();
		// 		$volist[]=$volists;
			
		// }
		// $res = M('Contractinfo')->where('con_state=2')->count();
		// $this->assign('count', $res);
		// $this->assign('list', $listmain);
		// $this->assign('volist', $volist);
    	$this->display();

    }
}
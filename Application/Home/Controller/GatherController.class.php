<?php
namespace Home\Controller;
use Think\Controller;
class GatherController extends Controller {
   /*收款*/
    public function gather_index(){
    	$data = M('gather as g')
    			->field('a.name,g.company,g.firststep,g.detail,g.money,g.gathertiem,u.real_name,g.id')
    			->join('dhd_account as a on g.gather = a.id')
    			->join('dhd_user as u on g.u_id = u.id')
    			->where('gather_state=0')
    			->select();
    			// var_dump($data);die;
   		$this->assign('data',$data);

       $this->display();
    }


    // 添加页面
    public function gather_add(){


   		$bank = M('account')->select();
   		$this->assign('bank',$bank);
    	$this->display();
    }

    // 添加方法
    public function gatheradd_do(){

    	$data = I('post.');
   		$data['u_id'] = get_user_id();
   		$data['deteofcollect'] = date("Y-m-d");
    	// var_dump($data);die;
    	$add = M('gather')->data($data)->add();
        if($add){
            $this->success('新增成功', U('Gather/gather_index'));
        }else{
            $this->error('新增失败',U('Gather/gather_add'));
        }

    }










}
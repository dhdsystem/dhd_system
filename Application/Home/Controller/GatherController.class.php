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
        $list = M('account')->field('id,name')->select();
    			// var_dump($data);die;
        $this->assign('data',$data);
   		$this->assign('list',$list);
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
   		$data['deteofcollect'] = time();
    	// var_dump($data);die;
    	$add = M('gather')->data($data)->add();
        if($add){
            $this->success('新增成功', U('Gather/gather_index'));
        }else{
            $this->error('新增失败',U('Gather/gather_add'));
        }

    }


    // 删除
    public function gather_del(){
    	$id = I('get.id');
    	// var_dump($id);die;
    	$data['gather_state'] = '1';
        $del = M('gather')->where(array('id'=>$id))->save($data);
        if($del){
            $this->success('删除成功', U('Gather/gather_index'));
        }else{
            $this->error('删除失败',U('Gather/gather_index'));
        }
    }


    // 修改页面
    public function gather_save(){
    	$id = I('get.id');
    	$data = M('gather')->where(array('id'=>$id))->find();
   		$bank = M('account')->select();
   		$this->assign('bank',$bank);
    	// var_dump($data);die;
   		$this->assign('data',$data);
    	$this->display();

    }





    // 修改方法
    public function gathersave_do(){
    	$data = I('post.');
    	// var_dump($data);die;
        $save = M('gather')->where(array('id'=>$data['id']))->save($data);
        if($save){
            $this->success('修改成功', U('Gather/gather_index'));
        }else{
            $this->error('修改失败',U('Gather/gather_save?id='.$data['id']));
        }
    	
    }

    // 业绩查询
    public function gather_outstanding(){
        $starttime = I('post.starttime');
        $endtime = I('post.endtime');
        $data['starttime'] = strtotime("$starttime");
        $data['endtime'] = strtotime("$endtime");
        print_r($data);
    }








}
<?php
namespace Home\Controller;
use Think\Controller;
class GatherController extends Controller {
   /*收款*/
    public function gather_index(){
    	$data = M('gather as g')
    			->field('a.name,g.company,g.firststep,g.detail,g.money,g.gathertiem,c.client_name,c.nuddke_id,u.real_name,g.id')
    			->join('dhd_account as a on g.gather = a.id')
                ->join('dhd_client as c on g.company = c.id')
    			->join('dhd_user as u on g.u_id = u.id')
    			->where('gather_state=0')
    			->select();
        foreach($data as $k => $v){
            if($v['nuddke_id'] == '0'){
                $data[$k]['nuddke_id'] = '直接客户';
            }else{
                $data[$k]['nuddke_id'] = '中间商客户';
            }
        }
        // $data['gathertiem'] = date("Y-m-d ",$data['gethertime']);
        $list = M('account')->field('id,name')->select();
    			// print_r($data);die;
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


    // 键盘抬起事件
    public function gather_ajax(){
        $company = I('post.company');
        $where['client_name']=array('like',"%$company%");
        $data = M('client')->where($where)->select();
        if($data){
            print_r( json_encode($data));
        }else{
            print_r( json_encode(''));
        }

    }

    // 添加方法
    public function gatheradd_do(){

        $data = I('post.');
   		$data['u_id'] = get_user_id();
        $gathertiem = I('post.gathertiem');
   		$data['gathertiem'] = strtotime("$gathertiem");
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
    	$data = M('gather as g')->join('dhd_client as c on g.company = c.id')->where("g.id=$id")->field('g.id,firststep,detail,money,gather,gathertiem,company,client_name')->find();
   		$bank = M('account')->select();
   		$this->assign('bank',$bank);
    	// var_dump($data);die;
   		$this->assign('data',$data);
    	$this->display();

    }





    // 修改方法
    public function gathersave_do(){
    	$data = I('post.');
    	// print_r($data);die;
        $gathertiem = I('post.gathertiem');
        $data['gathertiem'] = strtotime("$gathertiem");
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
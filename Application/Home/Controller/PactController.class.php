<?php
namespace Home\Controller;
use Think\Controller;
class PactController extends Controller {
   /*合同*/
    public function pact_index(){
       $this->display();
    }
    /**
     * 
     * @return [type] [出合同页面]
     */
    public function pact_add()
    {
    	$id =I('get.id');
    	$client = M('client as c')->field('middle_name,middle_man,middle_tel,middle_address,middle_is,middle_state,c.id,client_name,nuddke_id,client_man,client_tel,client_address,client_money,legalperson,legaltel,legalidnum,other_man,other_tel,client_state,taxstyle')->join('left join dhd_middle as m on c.nuddke_id = m.id')->where(array('c.id'=>$id))->find();
    	foreach ($client as $k => $v) {
    		if(empty($v)){
    			unset($client[$k]);
    		}
    	}
    	$account = M('account')->field('id,acc_name')->select();
    	$role = M('role')->field('id,role_name')->where(array('pid'=>0,'state'=>0))->select();
    	if(!empty($client['middle_state'])){
	    	if($client['middle_state'] == 0){
	    		$client['middle_state'] = '中间商';
	    	}
	    	if($client['middle_state'] == 1){
	    		$client['middle_state'] = '中介';
	    	}
	    	if($client['middle_state'] == 2){
	    		$client['middle_state'] = '平台';
	    	}
    	}else{
    		$client['middle_state'] = '直接客户';
    	}

    	$this->assign('client',$client);
    	$this->assign('account',$account);
    	$this->assign('role',$role);
    	$this->display();
    }
    /**
     * /
     * @return [type] 返回银行账户信息
     */
    public function account()
    {
    	$id = I('post.id');
    	$res = M('account')->where(array('id'=>$id))->find();
    	returnajax($res);
    }
    /**
     * /
     * @return [type] [业务员联动返回职位信息]
     */
    public function role_sel()
    {
    	$id = I('post.id');
    	$role = M('role')->where(array('pid'=>$id,'state'=>0))->select();
    	returnajax($role);
    }
    /**
     * /
     * @return [type] [业务员联动返回人员信息]
     */
    public function user_sel()
    {
    	$id = I('post.id');
    	$user = M('user')->field('username,id')->where(array('r_id'=>$id))->select();
    	returnajax($user);
    }
    // public function damianji()
    // {
    // 	$this->display();
    // }















}
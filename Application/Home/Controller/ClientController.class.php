<?php
namespace Home\Controller;
use Think\Controller;
class ClientController extends Controller {
   /*客户*/
    public function client_index(){
    	// $data = M('client')->select();
    	// $this->assign('client',$data);
       	$this->display();
    }

    // 客户添加页面
    public function client_add(){
    	$data['menuname'] = '客户分组';
    	$data['submenu'] = '渠道客户';
    	$this->assign('data',$data);
    	$this->display();
    }

    // 客户添加方法
    public function clientadd_do(){
    	$data = I('post.');
    	var_dump($data);die;
    }



    // 客户删除
    public function client_del(){
    	$id = I('get.id');
    	var_dump($id);die;

    }







}
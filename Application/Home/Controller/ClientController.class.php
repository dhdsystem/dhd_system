<?php
namespace Home\Controller;
use Think\Controller;
class ClientController extends Controller {
   /*客户*/
    public function client_index(){
    	$data = M('client')->select();
    	$this->assign('volist',$data);
       	$this->display();
    }

    // 客户添加页面
    public function client_add(){
    	$this->display();
    }

    // 客户添加ajax
    public function clientadd_ajax(){
        $middleman = I('post.middleman');
        $data = M('middle')->where('middle_name='.$middleman)->select();
        if($data){
            print_r( json_encode($data));
        }else{
            print_r( json_encode(''));
        }

    }





    // 客户添加方法
    public function clientadd_do(){
    	$data = I('post.');
    	// var_dump($data);die;
    	$data['sales_id'] = get_user_id();
    	$add = M('client')->data($data)->add();
		if($add){
			$this->success('新增成功', U('client/client_index'));
		}else{
			$this->error('新增失败',U('client/client_add'));
		}
    }



    // 客户删除
    public function client_del(){
    	$id = I('get.id');
    	// var_dump($id);die;

    }







}
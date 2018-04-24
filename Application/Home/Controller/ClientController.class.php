<?php
namespace Home\Controller;
use Think\Controller;
class ClientController extends Controller {
   /*客户*/
    public function client_index(){
    	$data = M('client')->where('client_state=0')->select();
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
        $where['middle_name']=array('like',"%$middleman%");
        $data = M('middle')->where($where)->select();
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
        $data['client_state'] = '1';
        $del = M('client')->where("id=$id")->save($data); 
        if($del){
            $this->success('删除成功', U('Client/client_index'));
        }else{
            $this->error('删除失败',U('Client/client_index'));
        }

    }

    // 客户修改页面
    public function client_save(){
        $id = I('get.id');
        $data = M('client as c')
                ->join('dhd_middle as m on c.nuddke_id = m.id')
                ->where('c.id='.$id)
                ->find();
        // var_dump($data);die;
        // $data['middelid'] = 1; 
        $this->assign('list',$data);
        $this->display();
    }

    // 客户修改方法
    public function clientsave_do(){
        $data = I('post.');
        var_dump($data);die;
    }







}
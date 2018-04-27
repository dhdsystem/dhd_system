<?php
namespace Home\Controller;
use Think\Controller;
class AccountController extends Controller {
   /*财务账户*/
    public function account_index(){
    	$data = M('account')->where("state=0")->select();
    	$this->assign('data',$data);
       	$this->display();
    }


    // 账户新增页面
    public function account_add(){
    	$this->display();
    }


    // 账户新增方法
    public function accountadd_do(){
        $data = I('post.');
    	$addtime = I('post.addtime');
        $data['addtime'] =  strtotime("$addtime");
        // var_dump($data);die;
        $add = M('account')->data($data)->add();
        if($add){
            $this->success('新增成功', U('Account/account_index'));
        }else{
            $this->error('新增失败',U('Account/account_add'));
        }
    }


    // 删除
    public function account_del(){
        $delid = I('post.id');
        $data['state'] = '1';
        $del = M('account')->where("id=$delid")->save($data);
        if($del){
            $post['s'] = 'ok';
            print_r( json_encode($post));
        }else{
            $post['s'] = '删除失败';
            print_r( json_encode($post));
        }
    }







    // 修改账户页面
    public function account_save(){
    	$id = I('get.id');
    	$where = array('id'=>$id);
    	$data = M('account')->where($where)->find();
    	$this->assign('data',$data);
    	$this->display();
    }

    // 修改方法
    public function accountsave_do(){
    	$data = I('post.');
        $addtime = I('post.addtime');
        $data['addtime'] =  strtotime("$addtime");
        $where = array('id'=>$data['id']);
        // var_dump($data);die;
        $save = M('account')->where($where)->save($data);
        if($save){
            $this->success('修改成功', U('Account/account_index'));
        }else{
            $this->error('修改失败',U('Account/account_save?id='.$data['id']));
        }
    }




}
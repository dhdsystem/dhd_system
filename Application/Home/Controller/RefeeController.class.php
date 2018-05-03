<?php
namespace Home\Controller;
use Think\Controller;
class RefeeController extends Controller {
   	   /*返退*/
    public function refee_index(){
       $data=M('cashier')->where('state=4')->order('id desc')->select();
       $this->assign('data',$data);
       $this->display();
    }
       /*返退添加*/
    public function refee_add(){
    	if(IS_POST){
    	  $data=I('post.');
          $data['charge_time']=strtotime($data['charge_time']);
          $data['declare']=time();
          $res=M('middle')->where(array('id'=>$data['middleman']))->find();
          $data['middleman']=$res['middle_name'];
          $data['m_name']=$res['middle_man'];
          $data['m_tel']=$res['middle_tel'];
          $data['state']='4';
          $re=M('cashier')->add($data);
          if ($re) {
            $this->success('添加成功',U('refee_index'));
          }else{
            $this->error('添加失败');
          }
    	}else{
    	  $acontname = M('account')->field('id,name,contnum,owner')->select();        //银行收款账户
          $this->assign('acontname',$acontname);
          $this->display();
    	}
      
    }
       /*返退展示*/
    public function refee_list(){
    	 $id = I('get.id');
      	 $data = M('cashier')->where(array('id'=>$id))->find();
         $this->assign('data',$data);
         $this->display();
    }
       /*返退修改*/
    public function refee_save(){
         
    	if(IS_POST){
		  $data=I('post.');
          $data['charge_time']=strtotime($data['charge_time']);
          $data['declare']=time();
          $res=M('middle')->where(array('id'=>$data['middleman']))->find();
          $data['middleman']=$res['middle_name'];
          $data['m_name']=$res['middle_man'];
          $data['m_tel']=$res['middle_tel'];
          $re=M('cashier')->where(array('id'=>$data['id']))->save($data);
          // echo M('cashier')->getlastsql();die;
        if ($re) {
            $this->success('修改成功',U('refee_index'));
          }else{
            $this->error('修改失败');
          }
    	}else{
         $id = I('get.id');
         $acontname = M('account')->field('id,name,contnum,owner')->select();        //银行收款账户
         $this->assign('acontname',$acontname);
      	 $data = M('cashier')->where(array('id'=>$id))->find();
         $this->assign('data',$data);
         $this->display();

    	}
    }

        /*搜索*/
    public function refee_search(){
        $data=I('post.keyword');
        $data=M('cashier')->where("state=4 and company like '%$data%'")->order('id desc')->select();
        $this->assign('data',$data);
        $this->display('refee_index');
    }
}
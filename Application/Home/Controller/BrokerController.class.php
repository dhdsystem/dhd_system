<?php
namespace Home\Controller;
use Think\Controller;
class BrokerController extends Controller {
   /*佣金*/
    public function broker_index(){
       $data=M('cashier')->where('state=3')->order('id desc')->select();
       $this->assign('data',$data);
       $this->display();
    }
      /*佣金添加*/
    public function broker_add(){
      if(IS_POST){
          // print_r(I('post.'));die;
          $data=I('post.');
          $data['charge_time']=strtotime($data['charge_time']);
          $data['declare']=time();
          $res=M('middle')->where(array('id'=>$data['middleman']))->find();
          $data['middleman']=$res['middle_name'];
          $data['m_name']=$res['middle_man'];
          $data['m_tel']=$res['middle_tel'];
          $data['state']='3';
          $re=M('cashier')->add($data);
          if ($re) {
            $this->success('添加成功',U('broker_index'));
          }else{
            $this->error('添加失败');
          }
      }else{
          $acontname = M('account')->field('id,name,contnum,owner')->select();        //银行收款账户
          $this->assign('acontname',$acontname);
          $this->display();
      }   
    }
      /*佣金修改*/
    public function broker_save(){
      if(IS_POST){
        $data=I('post.');
          $res=M('middle')->where(array('id'=>$data['middleman']))->find();
          $data['middleman']=$res['middle_name'];
          $data['m_name']=$res['middle_man'];
          $data['m_tel']=$res['middle_tel'];
          $re=M('cashier')->where(array('id'=>$data['id']))->save($data);
          if($re){
            $this->success('修改成功',U('broker_index'));
          }else{
            $this->error('修改失败');
          }
      }else{
        $id = I('get.id');
        $data = M('cashier')->where(array('id'=>$id))->find();
        $acontname = M('account')->field('id,name,contnum,owner')->select();        //银行收款账户
        $this->assign('acontname',$acontname);
        $this->assign('data',$data);
        $this->display();
      }
    }
      /*佣金展示详情*/
    public function broker_list(){
      $id = I('get.id');
      $data = M('cashier')->where(array('id'=>$id))->find();
      $this->assign('data',$data);
      $this->display();
    }
    // 佣金添加ajax
    public function broker_ajax(){
        $middleman = I('post.middleman');
        $where['class_name']=array('like',"%$middleman%");
        $data = M('class')->where($where)->select();
        if($data){
            print_r( json_encode($data));
        }else{
            print_r( json_encode(''));
        }

    }
    //获取中介
    public function broker_zajax(){
        $middleman = I('post.middleman');
        // $where['middle_state']='2';
        $where['class_name']=array('like',"%$middleman%");
        $data = M('middle')->where($where)->select();
       // echo M('middle')->getlastsql();die;
        if($data){
            print_r( json_encode($data));
        }else{
            print_r( json_encode(''));
        }

    }
    /*搜索*/
    public function broker_search(){
        $data=I('post.keyword');
        $data=M('cashier')->where("state=3 and company like '%$data%'")->order('id desc')->select();
        $this->assign('data',$data);
        $this->display('broker_index');
    }
}
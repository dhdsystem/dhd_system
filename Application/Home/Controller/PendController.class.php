<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class PendController extends CommonController {

    /*待审核合同 展示*/
    public function pend_index(){
        $p=!empty($_GET['page'])?$_GET['page']:0;
        $num="20";
        $list = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->where(array('account_audit'=>1))
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->page($p,$num)
        ->select();
        $count_no = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where('account_audit = 3')
        ->count();
        $count=M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->where(array('account_audit'=>1))
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->count();;
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show(); 
        $this->assign('count',$count);
        $this->assign('page',$show);
        $this->assign('count_no',$count_no);
        $this->assign('list',$list);
       	$this->display();
    }
  
    /*未通过合同 展示*/
    public function pend_list(){
        $p=!empty($_GET['page'])?$_GET['page']:0;
        $num="20";
        $list = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where('account_audit = 3')
        ->page($p,$num)
        ->select();
        // echo M('contract as c')->getLastSql();die;
        $count_no = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where('account_audit = 3')
        ->count();
        $show1 = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->where(array('account_audit'=>1))
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->select();
        $Page=new \Think\Page($count_no,$num);
        $show       = $Page->show(); 
        $count=count($show1);
        $this->assign('count',$count);
        $this->assign('count_no',$count_no);
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display('pend_list');
 
    }

    /*搜索*/
    public function pend_search(){
         $data=I('get.company');
         $p=!empty($_GET['page'])?$_GET['page']:0;
         $num="20";
         $list = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where("account_audit = 1 and client_name like '%$data%'")
        ->page($p,$num)
        ->select();
        // echo M('contract as c')->getLastSql();die;
         $count = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where("account_audit = 1 and client_name like '%$data%'")
        ->count();
         //echo M('contract as c')->getLastSql();die;
        // print_r($count);die;
        $count_no = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where("account_audit = 3")
        ->count();
        // $count=count($list);
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show(); 
        $this->assign('count',$count);
        $this->assign('count_no',$count_no);
        $this->assign('list',$list);
        $this->assign('page',$show);
        // $this->assign('data',$data);
        $this->display('pend_index');
    }

     /*搜索*/
    public function pend_searchn(){
         $data=I('get.company');
         $p=!empty($_GET['page'])?$_GET['page']:0;
         $num="20";
         $list = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where("account_audit = 3 and client_name like '%$data%'")
        ->page($p,$num)
        ->select();
        // echo M('contract as c')->getLastSql();die;
         $count = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where("account_audit = 3 and client_name like '%$data%'")
        ->count();
         //echo M('contract as c')->getLastSql();die;
        // print_r($count);die;
        $count_no = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where("account_audit = 3")
        ->count();
        // $count=count($list);
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show(); 
        $this->assign('count',$count);
        $this->assign('count_no',$count_no);
        $this->assign('list',$list);
        $this->assign('page',$show);
        // $this->assign('data',$data);
        $this->display('pend_list');
    }
    //审核合同删除
    public function pend_del(){
        $id=I('get.id');
        $re=M('contract')->where("id = $id")->delete();
        if($re){
           $this->success('删除成功',U('pend_index'));

        }else{
            $this->error('删除失败');
        }
    }
}
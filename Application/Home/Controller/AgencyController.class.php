<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class AgencyController extends CommonController {

    /*待审核合同 展示*/
    public function agency_index(){
        $p=!empty($_GET['page'])?$_GET['page']:0;
        $num="20";
        $list = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->where(array('account_audit'=>2))
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->page($p,$num)
        ->select();
        $count = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where('account_audit = 2')
        ->count();
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show(); 
        $this->assign('count',$count);
        $this->assign('page',$show);
        $this->assign('list',$list);
       	$this->display();
    }
  
   

    /*搜索*/
    public function agency_search(){
         $data=I('get.company');
         $p=!empty($_GET['page'])?$_GET['page']:0;
         $num="20";
         $list = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where("account_audit = 2 and client_name like '%$data%'")
        ->page($p,$num)
        ->select();
        // echo M('contract as c')->getLastSql();die;
         $count = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->where("account_audit = 2 and client_name like '%$data%'")
        ->count();
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show(); 
        $this->assign('count',$count);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display('agency_index');
    }

    
    //审核合同删除
    public function pend_del(){
        $id=I('get.id');
        $re=M('contract')->where("id = $id")->delete();
        if($re){
           $this->success('删除成功',U('agency_index'));

        }else{
            $this->error('删除失败');
        }
    }

    /*收款*/
     public function agency_save(){
        if(IS_POST){
                  $data = I('post.');
                    // print_r($data);die;
                    $data['u_id'] = get_user_id();
                    $gathertiem = I('post.gathertiem');
                    $c_id = M('client')->field('id')->where(array('client_name'=>$data['client_name']))->select();
                    $data['company'] = $c_id[0]['id'];
                    $data['gathertiem'] = strtotime("$gathertiem");
                    // print_r($data);die;
                    $save = M('contract')->where(array('id'=>$data['contract']))->save(array('account_audit'=>4));
                    $det_id = M('contract')->field('det_id')->where(array('id'=>$data['contract']))->select();
                    $save = M('details')->where(array('id'=>$det_id[0]['det_id']))->save(array('det_advance'=>3));
                    $add = M('gather')->data($data)->add();
                    if($add && $save){
                        $this->success('收款成功', U('Gather/gather_index'));
                    }else{
                        $this->error('收款失败',U('out/out_rece?id='.$data['.id.']));
                    }
        }
        else{
            $id = I('get.id');
            $data=M('contract')->join('dhd_client on dhd_contract.client_id=dhd_client.id')
            ->where(array('dhd_contract.id'=>$id))->field('dhd_contract.id,client_name')->find();
            $bank = M('account')->select();
            $this->assign('bank',$bank);
            $this->assign('id',$id);
            $this->assign('name',$data['client_name']);
            $this->display();
        }
    }
}
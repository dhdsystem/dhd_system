<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class ExpiryController extends CommonController {

    /*到期合同 展示*/
    public function expiry_index(){
        $list = M('contract as c')
        ->field('c.id,contractnumber,c.contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,u.real_name,legalperson,legaltel,credit_code,middle_name,middle_man,middle_tel,paytype')
        ->where(array('account_audit'=>4))
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('left join  dhd_middle as m on k.nuddke_id = m.id')
        ->join('dhd_collection as co on co.contract = c.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->select();
        // print_r($list);die;
        $user = M('user')->field('id,real_name')->select();
        $this->assign('user',$user);
        $this->assign('list',$list);
        $this->display();
    }


    // 分配
    public function expiry_allot(){
        $user_id=I('post.user_id');
        $rece_id=I('post.rece_id');
        $save = M('contract')->where("id=$rece_id")->save(array('user_id' => $user_id));
        if($save){
             $this->success('分配成功', U('Expiry/expiry_index'));
        }else{
            $this->error('分配失败',U('Expiry/expiry_index'));
        }
        
        // print_r($id);die;
        // $this->display();
    }

    // 停租
    public function expiry_ting(){
        $id = I('post.id');
        // print_r($id);die;
        $data['account_audit'] = '6';
        $dd = M('contract')->where("id=$id")->save($data);
        if($dd){
            print_r( json_encode('ok'));
        }else{
            $post['s'] = '停租操作失败';
            print_r( json_encode($post));
        }
    }

    // 查看
    public function expiry_sel(){
        $id=I('get.id');
        $da=M('contract')->where(array('id'=>$id))->find();
        // echo M('contract')->getlastsql();
        // print_r($da['contracttype']);die;
        if($da['contracttype']=='大面积出租'){
                $list = M('contract as c')
                ->where(array('c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_largearea as lar on lar.contract =c.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
                 //echo M('contract as c')->getlastsql();
                $this->assign('data',$list);
                $this->display();
        }
        if($da['contracttype']=='mini房间'){
                 $list = M('contract as c')
                ->where(array('c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_houselet as lar on lar.contract =c.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
                // print_r($list);die;
                // echo M('contract as c')->getlastsql();die;
                $this->assign('data',$list);
                $this->display();
        }
        if($da['contracttype']=='工位注册办公'){
              $list = M('contract as c')
                ->where(array('c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_registration as lar on lar.contract =c.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
             // print_r($list);die;
               // echo M('contract as c')->getlastsql();
                $this->assign('data',$list);
                $this->display();
        }if($da['contracttype']=='注册地址'){
                  $list = M('contract as c')
                ->where(array('c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_register as lar on lar.contract =c.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
             // print_r($list);die;
               // echo M('contract as c')->getlastsql();
                $this->assign('data',$list);
                $this->display();   
        }
        if($da['contracttype']=='代理记账'){
                 $list = M('contract as c')
                ->where(array('c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_tally as lar on lar.contract=c.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
             // print_r($list);die;
               // echo M('contract as c')->getlastsql();
                $this->assign('data',$list);
                $this->display();   
        }
        if($da['contracttype']=='工位不注册办公'){
             $list = M('contract as c')
                    ->where(array('c.id'=>$id))
                    ->join('dhd_details as d on c.det_id = d.id')
                    ->join('dhd_client as k on c.client_id = k.id')
                    ->join('dhd_product as p on d.pro_id = p.id')
                    ->join('dhd_middle as m on k.nuddke_id = m.id')
                    ->join('dhd_stencil as s on c.stencil_id = s.id')
                    ->join('dhd_user as u on u.id = c.user_id')
                    ->join('dhd_class as cl on cl.id = p.class_id')
                    ->join('dhd_collection as col on col.contract = c.id')
                    ->join('dhd_regclosed as lar on lar.contract =c.id')
                    ->join('dhd_account as a on a.id=c.account_id')
                    ->join('dhd_role on dhd_role.id = u.r_id')
                    ->field('*,c.contracttype as cont')
                    ->find();
                 // print_r($list);die;
                    // echo M('contract as c')->getlastsql();
                    $this->assign('data',$list);
                    $this->display();
        } 
        if($da['contracttype']=='工商代理'){
                $list = M('contract as c')
                    ->where(array('c.id'=>$id))
                    ->join('dhd_details as d on c.det_id = d.id')
                    ->join('dhd_client as k on c.client_id = k.id')
                    ->join('dhd_product as p on d.pro_id = p.id')
                    ->join('dhd_middle as m on k.nuddke_id = m.id')
                    ->join('dhd_stencil as s on c.stencil_id = s.id')
                    ->join('dhd_user as u on u.id = c.user_id')
                    ->join('dhd_class as cl on cl.id = p.class_id')
                    ->join('dhd_collection as col on col.contract = c.id')
                    ->join('dhd_industrial as lar on lar.contract =c.id')
                    ->join('dhd_account as a on a.id=c.account_id')
                    ->join('dhd_role on dhd_role.id = u.r_id')
                    ->field('*,c.contracttype as cont')
                    ->find();
                 //print_r($list);die;
                   //  echo M('contract as c')->getlastsql();
                    $this->assign('data',$list);
                    $this->display();
        }
    }
  
    
}
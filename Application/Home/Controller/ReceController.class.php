<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class ReceController extends CommonController {

    /*应收款合同 展示*/
    public function rece_index(){
        $list = M('contract as c')
    	->field('c.id,contractnumber,c.contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,u.real_name,legalperson,legaltel,credit_code,middle_name,middle_man,middle_tel,paytype')
    	->where(array('account_audit'=>8))
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
    public function rece_allot(){
        $user_id=I('post.user_id');
        $rece_id=I('post.rece_id');
        $save = M('contract')->where("id=$rece_id")->save(array('user_id' => $user_id));
        if($save){
             $this->success('分配成功', U('Rece/rece_index'));
        }else{
            $this->error('分配失败',U('Rece/rece_index'));
        }
        
        // print_r($id);die;
        // $this->display();
    }

 /*应收合同 详情*/
    public function rece_sel(){
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


    // 应收款页面
    public function rece_print_recei(){
        $id = I('get.id');
        $name = I('get.name');
        // print_r($id);die;
        // print_r($name);die;
        $bank = M('account')->select();
        $this->assign('bank',$bank);
        $this->assign('id',$id);
        $this->assign('name',$name);
        $this->display();
    }

    // 应收款方法
    public function rece_print_recei_do(){
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
            $this->error('收款失败',U('Rece/rece_print_recei?id='.$data['.id.'].'&name='.$data['client_name']));
        }
    }

    // 停租
    public function rece_ting(){
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









  
    
}
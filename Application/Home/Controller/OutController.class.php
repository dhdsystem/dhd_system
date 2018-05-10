<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class OutController extends CommonController {

    /*已出合同 展示*/
    public function out_index(){

    	$list = M('contract as c')
    	->field('c.id,contractnumber,c.contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username,legalperson,legaltel,credit_code,signcompany,middle_name,middle_man,middle_tel')
    	->where(array('account_audit'=>4))
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_middle as m on k.nuddke_id = m.id')
        ->join('dhd_stencil as s on c.stencil_id = s.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->select();
         // print_r($list);die;
        $this->assign('list',$list);
       	$this->display();
    }
    /*已出合同 详情*/
    public function out_list(){
        $id=I('get.id');
        $da=M('contract')->where(array('id'=>$id))->find();
        // echo M('contract')->getlastsql();
        // print_r($da['contracttype']);die;
        if($da['contracttype']=='大面积出租'){
                $list = M('contract as c')
                ->where(array('account_audit'=>4,'c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_largearea as lar on lar.contract=c.id')
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
                ->where(array('account_audit'=>4,'c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_houselet as lar on lar.contract=c.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
                // print_r($list);die;
                //echo M('contract as c')->getlastsql();die;
                $this->assign('data',$list);
                $this->display();
        }
        if($da['contracttype']=='工位注册办公'){
              $list = M('contract as c')
                ->where(array('account_audit'=>4,'c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_registration as lar on lar.contract=c.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
             // print_r($list);die;
               // echo M('contract as c')->getlastsql();
                $this->assign('data',$list);
                $this->display();
        }
        if($da['contracttype']=='注册地址'){
                  $list = M('contract as c')
                ->where(array('account_audit'=>4,'c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_register as lar on lar.contract=c.id')
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
                ->where(array('account_audit'=>4,'c.id'=>$id))
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
                    ->where(array('account_audit'=>4,'c.id'=>$id))
                    ->join('dhd_details as d on c.det_id = d.id')
                    ->join('dhd_client as k on c.client_id = k.id')
                    ->join('dhd_product as p on d.pro_id = p.id')
                    ->join('dhd_middle as m on k.nuddke_id = m.id')
                    ->join('dhd_stencil as s on c.stencil_id = s.id')
                    ->join('dhd_user as u on u.id = c.user_id')
                    ->join('dhd_class as cl on cl.id = p.class_id')
                    ->join('dhd_collection as col on col.contract = c.id')
                    ->join('dhd_regclosed as lar on lar.contract=c.id')
                    ->join('dhd_account as a on a.id=c.account_id')
                    ->join('dhd_role on dhd_role.id = u.r_id')
                    ->field('*,c.contracttype as cont')
                    ->find();
                 //print_r($list);die;
                    // echo M('contract as c')->getlastsql();
                    $this->assign('data',$list);
                    $this->display();
        } 
        if($da['contracttype']=='工商代理'){
                $list = M('contract as c')
                    ->where(array('account_audit'=>4,'c.id'=>$id))
                    ->join('dhd_details as d on c.det_id = d.id')
                    ->join('dhd_client as k on c.client_id = k.id')
                    ->join('dhd_product as p on d.pro_id = p.id')
                    ->join('dhd_middle as m on k.nuddke_id = m.id')
                    ->join('dhd_stencil as s on c.stencil_id = s.id')
                    ->join('dhd_user as u on u.id = c.user_id')
                    ->join('dhd_class as cl on cl.id = p.class_id')
                    ->join('dhd_collection as col on col.contract = c.id')
                    ->join('dhd_industrial as lar on lar.contract=c.id')
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
    /*搜索*/
    public function out_search()
    {
        $data=I('get.company');
        $list = M('contract as c')
        ->field('c.id,contractnumber,c.contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username,legalperson,legaltel,credit_code,signcompany,middle_name,middle_man,middle_tel')
        ->where(array('account_audit'=>4))
        ->where("client_name like '%$data%'")
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_middle as m on k.nuddke_id = m.id')
        ->join('dhd_stencil as s on c.stencil_id = s.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->select();
        // echo M('contract as c')->getlastsql();die;
        $this->assign('list',$list);
        $this->display('out_index');

    }

     // 停租
    public function out_ting(){
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
    /*续签*/
    public function out_save(){
        $id=I('get.id');
        $da=M('contract')->where(array('id'=>$id))->find();
        // print_r($da);die;
        if($da['contracttype']=='大面积出租'){
                $list = M('contract as c')
                ->where(array('account_audit'=>4,'c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_largearea as lar on lar.details_id=d.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
                 //echo M('contract as c')->getlastsql();
                $this->assign('data',$list);
                $this->display('out_update');
        }

        if($da['contracttype']=='mini房间'){
                 $list = M('contract as c')
                ->where(array('account_audit'=>4,'c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_houselet as lar on lar.details_id=d.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
                // print_r($list);die;
                //echo M('contract as c')->getlastsql();die;
                $this->assign('data',$list);
                $this->display('out_update');
        }
        if($da['contracttype']=='工位注册办公'){
              $list = M('contract as c')
                ->where(array('account_audit'=>4,'c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_registration as lar on lar.details_id=d.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
             // print_r($list);die;
               // echo M('contract as c')->getlastsql();
                $this->assign('data',$list);
                $this->display('out_update');
        }
        if($da['contracttype']=='注册地址'){
                  $list = M('contract as c')
                ->where(array('account_audit'=>4,'c.id'=>$id))
                ->join('dhd_details as d on c.det_id = d.id')
                ->join('dhd_client as k on c.client_id = k.id')
                ->join('dhd_product as p on d.pro_id = p.id')
                ->join('dhd_middle as m on k.nuddke_id = m.id')
                ->join('dhd_stencil as s on c.stencil_id = s.id')
                ->join('dhd_user as u on u.id = c.user_id')
                ->join('dhd_class as cl on cl.id = p.class_id')
                ->join('dhd_collection as col on col.contract = c.id')
                ->join('dhd_register as lar on lar.details_id=d.id')
                ->join('dhd_account as a on a.id=c.account_id')
                ->join('dhd_role on dhd_role.id = u.r_id')
                ->field('*,c.contracttype as cont')
                ->find();
             // print_r($list);die;
               // echo M('contract as c')->getlastsql();
                $this->assign('data',$list);
                $this->display('out_update');   
        }
        if($da['contracttype']=='代理记账'){
            // echo 'qweqwe';
                $id =I('get.id');
                $client = M('client as c')->field('middle_name,middle_man,middle_tel,middle_address,middle_is,middle_state,c.id,client_name,nuddke_id,client_man,client_tel,client_address,client_money,legalperson,legaltel,legalidnum,other_man,other_tel,client_state,taxstyle')
                ->join('left join dhd_middle as m on c.nuddke_id = m.id')->where(array('c.id'=>$id))->find();
                // print_r($client);die;
                
                foreach ($client as $k => $v) {
                    if(empty($v)){
                        unset($client[$k]);
                    }
                }
                // 预留地址信息
                $reserved = M('reserved as r')->field('d.id,d.detailscoll,p.pro_address,c.class_name')
                ->join('dhd_details as d on d.id = r.details_id')->join('dhd_product as p on p.id = d.pro_id')
                ->join('dhd_class as c on c.id = p.class_id')
                ->where(array('client_id'=>$client['id']))
                ->find();
                
                // 财务账户
                $account = M('account')->field('id,acc_name')->select();
                // 业务员信息
                $role = M('role')->field('id,role_name')->where(array('pid'=>0,'state'=>0))->select();
                // 产品项目信息
                $project = M('class')->field('id,class_name')->where(array('class_is'=>0))->select();
                // print_r($project);
    
                if(empty($reserved)){
                    $reserved = 1;
                }
                // print_r($client);die;
                 $list = M('contract as c')
                ->where(array('account_audit'=>4,'c.id'=>$id))
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
                if(!empty($list['middle_state'])){
                    if($list['middle_state'] == 0){
                        $list['middle_state'] = '中间商';
                    }
                    if($list['middle_state'] == 1){
                        $list['middle_state'] = '中介';
                    }
                    if($list['middle_state'] == 2){
                        $list['middle_state'] = '平台';
                    }
                    }else{
                        $list['middle_state'] = '直接客户';
                }
                $this->assign('reserved',json_encode($reserved));
                $this->assign('project',json_encode($project));
                $this->assign('client',$client);
                $this->assign('account',$account);
                $this->assign('role',$role);
                $this->assign('data',$list);
                $this->display('out_update');   
        }
        if($da['contracttype']=='工位不注册办公'){
             $list = M('contract as c')
                    ->where(array('account_audit'=>4,'c.id'=>$id))
                    ->join('dhd_details as d on c.det_id = d.id')
                    ->join('dhd_client as k on c.client_id = k.id')
                    ->join('dhd_product as p on d.pro_id = p.id')
                    ->join('dhd_middle as m on k.nuddke_id = m.id')
                    ->join('dhd_stencil as s on c.stencil_id = s.id')
                    ->join('dhd_user as u on u.id = c.user_id')
                    ->join('dhd_class as cl on cl.id = p.class_id')
                    ->join('dhd_collection as col on col.contract = c.id')
                    ->join('dhd_regclosed as lar on lar.details_id=d.id')
                    ->join('dhd_account as a on a.id=c.account_id')
                    ->join('dhd_role on dhd_role.id = u.r_id')
                    ->field('*,c.contracttype as cont')
                    ->find();
                 //print_r($list);die;
                    // echo M('contract as c')->getlastsql();
                    $this->assign('data',$list);
                    $this->display('out_update');
        } 
        if($da['contracttype']=='工商代理'){
                $list = M('contract as c')
                    ->where(array('account_audit'=>4,'c.id'=>$id))
                    ->join('dhd_details as d on c.det_id = d.id')
                    ->join('dhd_client as k on c.client_id = k.id')
                    ->join('dhd_product as p on d.pro_id = p.id')
                    ->join('dhd_middle as m on k.nuddke_id = m.id')
                    ->join('dhd_stencil as s on c.stencil_id = s.id')
                    ->join('dhd_user as u on u.id = c.user_id')
                    ->join('dhd_class as cl on cl.id = p.class_id')
                    ->join('dhd_collection as col on col.contract = c.id')
                    ->join('dhd_industrial as lar on lar.contract=c.id')
                    ->join('dhd_account as a on a.id=c.account_id')
                    ->join('dhd_role on dhd_role.id = u.r_id')
                    ->field('*,c.contracttype as cont')
                    ->find();
                 //print_r($list);die;
                   //  echo M('contract as c')->getlastsql();
                    $this->assign('data',$list);
                    $this->display('out_update');
        }

    }
     /*退款*/
    public function out_in(){
            if(IS_POST){
                $data=I('post.');
                M('contract')->where(array('id'=>$data['id']))->save(array('account_audit'=>6));
                $data['charge_time']=strtotime($data['charge_time']);
                $data['state']="2";
                $re = M('account')->where(array('id'=>$data['charge_bank']))->find();
                $data['charge_bank']=$re['owner'].'-'.$re['name'].'-'.$re['contnum'];
                // print_r($data);die;
                $res=M('cashier')->add($data);
                if($res){
                    $this->success('添加成功',U('out_index'));
                }else{
                    $this->error('添加失败');
                }
        }else{
               $id=I('get.id');
               $acontname = M('account')->field('id,name,owner,contnum')->select();        //银行收款账户
               $this->assign('acontname',$acontname);
               $this->assign('id',$id);
               $this->display();
        }
    }
    /*开发票*/
    public function out_on(){
        if(IS_POST){
            $data=I('post.');
            $re=M('invoice')->add($data);
            if($re){
                $this->success('开发票成功',U('out_index'));
            }else{
                $this->error('开发票失败');
            }
        }else{
        $id=I('get.id');
        $re=M('collection')->where(array('contract'=>$id))->find();
        // print_r($re);die;
        if(empty($re['id'])){
            $this->error('请先收款');
        }
        $this->assign('id',$id);
        $this->display();
        }
    }
    /*收款*/
     /*public function out_rece(){
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
    }*/
}
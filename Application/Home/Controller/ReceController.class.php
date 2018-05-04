<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class ReceController extends CommonController {

    /*应收款合同 展示*/
    public function rece_index(){
        $list = M('contract as c')
    	->field('c.id,contractnumber,c.contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,u.real_name,legalperson,legaltel,credit_code,signcompany,middle_name,middle_man,middle_tel,paytype')
    	->where(array('account_audit'=>8))
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('left join  dhd_middle as m on k.nuddke_id = m.id')
        ->join('dhd_stencil as s on c.stencil_id = s.id')
        ->join('dhd_collection as co on co.contract = c.id')
        ->join('dhd_user as u on u.id = c.user_id')
        ->select();
        // print_r($list);die;
        $this->assign('list',$list);
        $this->display();
    }


    // 查看
    public function rece_sel(){
        $id = I('get.id');
        // print_r($id);die;

        $this->display();
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
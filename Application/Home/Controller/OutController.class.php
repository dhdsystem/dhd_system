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
        ->join('dhd_user as u on u.id = c.user_id')->select();
        // print_r($list);die;
        $this->assign('list',$list);
       	$this->display();
    }
  
    
}
<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class PendController extends CommonController {

    /*待审核合同 展示*/
    public function pend_index(){
       
        $list = M('contract as c')->field('c.id,contractnumber,contracttype,ac_time,pro_address,detailscoll,client_name,actual_amount,username')->where(array('account_audit'=>1))
        ->join('dhd_details as d on c.det_id = d.id')
        ->join('dhd_client as k on c.client_id = k.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('dhd_user as u on u.id = c.user_id')->select();
        // echo $list;die;
        $this->assign('list',$list);
       	$this->display();
    }
  
    
}
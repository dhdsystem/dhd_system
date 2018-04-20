<?php
namespace Home\Controller;
use Think\Controller;
class ChannelController extends CommonController {
 /*渠道商*/
    public function channel_index(){
      $data = M('middle')->select();
      // print_r($data);die;
      $this->assign('volist',$data);
      $this->display();
    }



   	public function channel_add()
   	{
   		$this->display();
   	}


   	public function channeladd_do()
   	{
   	  $data = I('post.');
      var_dump($data);
   	}
}
<?php
namespace Home\Controller;
use Think\Controller;
class ChannelController extends Controller {
 /*渠道商*/
    public function channel_index(){
      $data = M('middle as m')
      ->field('m.id,middle_name,middle_man,middle_tel,middle_address,real_name')
      ->join('dhd_user as u on u.id = m.sales_id')
      ->select();
      // print_r($data);die;
      $this->assign('volist',$data);
      $this->display();
    }


    // 添加页面
   	public function channel_add()
   	{
   		$this->display();
   	}

    // 添加方法
   	public function channeladd_do()
   	{
   	  $data = I('post.');
      $data['sales_id'] = get_user_id();
      // var_dump($data);die;
      $add = M('middle')->data($data)->add();
      // var_dump($add);die;
      if($add){
        $this->success('新增成功', U('channel/channel_index'));
      }else{
        $this->error('新增失败',U('channel/channel_add'));
      }
   	}


    // 修改页面
    public function channel_save(){
      $this->display();
    }





}
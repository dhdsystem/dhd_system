<?php
namespace Home\Controller;
use Think\Controller;
class DeductController extends Controller {
  // 业绩提成管理
  public function deduct_index()
  {
  	$list = M('ticheng')->select();
  	$this->assign('list',$list);
  	$this->display();
  }
  public function Deduct_save()
  {
  	$section = I('post.section');
	$data['target_norm'] = I('post.target_norm');
	$data['expire_norm'] = I('post.expire_norm');
	$data['receiv_norm'] = I('post.receiv_norm');
	M('ticheng')
  }
}
<?php
namespace Home\Controller;
use Think\Controller;
class StencilController extends Controller {
   /*模板管理*/
    public function stencil_index(){
      $list = M('stencil')->field('dhd_stencil.id,stencil_name,stencil_type,stencil_remark,stencil_addtime,username')->join('dhd_user on dhd_stencil.user_id=dhd_user.id')->select();
      $this->assign('list',$list);
      $this->display();
    }
   	public function stencil_add()
   	{
   		$this->display();
   	}
   	public function stenciladd_do()
   	{
      $stencil_name = I('post.stencil_name');
      $stencil_type = I('post.stencil_type');
   		$stencil_remark = I('post.stencil_remark');
      if($stencil_type==1){
        $uplode = A('Word');
      }
      $file = $_FILES['file'];
      $stencil_url = $uplode->word_add($file,$stencil_name);

      if(!empty($stencil_url)){
        $user_id = get_user_id();
        $arr = array('stencil_url'=>$stencil_url,'stencil_type'=>$stencil_type,'stencil_name'=>$stencil_name,'user_id'=>$user_id,'stencil_addtime'=>time());
        $re = M('stencil')->add($arr);
        if($re){
          $this->success('模板文件添加成功',U('Stencil/stencil_index'));
        }
      }
   	}

    public function stencil_save()
    {
      $id = I('get.id');
      $data = M('stencil')->where(array('id'=>$id))->find();
      $this->assign('data',$data);
      $this->display();
    }
    public function stencilsave_do()
    {

      $id = I('post.id');
      $stencil_name = I('post.stencil_name');
      $stencil_type = I('post.stencil_type');
      $stencil_remark = I('post.stencil_remark');
      if($stencil_type==1){
        $uplode = A('Word');
      }
      $file = $_FILES['file'];
      if(!empty($file)){
        $stencil_url = $uplode->word_add($file,$stencil_name);
        if(!empty($stencil_url)){
          $user_id = get_user_id();
          $arr = array('stencil_url'=>$stencil_url,'stencil_type'=>$stencil_type,'stencil_name'=>$stencil_name);
          $re = M('stencil')->where(array('id'=>$id))->save($arr);
          if($re){
            $this->success('模板文件添加成功',U('Stencil/stencil_index'));
          }
        }
      }
      


    }
}
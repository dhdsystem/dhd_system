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
    /*模板添加*/
    public function stencil_add()
    {
      $this->display();
    }
    /*执行模板添加*/
    public function stenciladd_do()
    {
      $stencil_name = I('post.stencil_name');
      $stencil_type = I('post.stencil_type');
      $stencil_remark = I('post.stencil_remark');
      $signcompany = I('post.signcompany');
      $contracttype = I('post.contracttype');
      $file = $_FILES['file'];
      if($stencil_type==1){
        $uplode = A('Word');
        $stencil_url = $uplode->word_add($file,$stencil_name);
      }
      if($stencil_type == 2){
       
        $uplode = A('Excel');
        $stencil_url = $uplode->stencil_up($file,$stencil_name);
      }

      if(!empty($stencil_url)){
        $user_id = get_user_id();
        $arr = array('stencil_url'=>$stencil_url,'signcompany'=>$signcompany,'contracttype'=>$contracttype,'stencil_type'=>$stencil_type,'stencil_remark'=>$stencil_remark,'stencil_name'=>$stencil_name,'user_id'=>$user_id,'stencil_addtime'=>time());
        $re = M('stencil')->add($arr);
        if($re){
          $this->success('模板文件添加成功',U('Stencil/stencil_index'));
        }else{
          $this->error('模板文件添加失败',U('Stencil/stencil_index'));
        }
      }else{
        $this->error('模板文件新增失败',U('Stencil/stencil_index'));
      }
    }
    /*模板修改*/
    public function stencil_save()
    {
      $id = I('get.id');
      $data = M('stencil')->where(array('id'=>$id))->find();
      $this->assign('data',$data);
      $this->display();
    }
    /*执行模板修改*/
    public function stencilsave_do()
    {

      $id = I('post.id');
      $stencil_name = I('post.stencil_name');
      $stencil_type = I('post.stencil_type');
      $stencil_remark = I('post.stencil_remark');
     
      $file = $_FILES['file'];
      if(!empty($file)){
        $url = M('stencil')->where(array('id'=>$id))->find();
        $res =  unlink($url['stencil_url']);

        if($res){
          if($stencil_type == 1){
            $uplode = A('Word');
            $stencil_url = $uplode->word_add($file,$stencil_name);
          }
          if($stencil_type == 2){
            $uplode = A('Excel');
            $stencil_url = $uplode->stencil_up($file,$stencil_name);
          }
          
          if(!empty($stencil_url)){
            $user_id = get_user_id();
            $arr = array('stencil_url'=>$stencil_url,'stencil_remark'=>$stencil_remark,'stencil_type'=>$stencil_type,'stencil_name'=>$stencil_name,'stencil_addtime'=>time());
            $re = M('stencil')->where(array('id'=>$id))->save($arr);
            if($re){
              $this->success('模板文件修改成功',U('Stencil/stencil_index'));
            }else{
              $this->error('模板文件修改失败',U('Stencil/stencil_index'));
            }
          }
        }else{
          $this->error('操作失败请联系技术人员',U('Stencil/stencil_index'));
        }
      }else{
        $arr = array('stencil_remark'=>$stencil_remark,'stencil_type'=>$stencil_type,'stencil_name'=>$stencil_name,'stencil_addtime'=>time());
        $re = M('stencil')->where(array('id'=>$id))->save($arr);
        if($re){
          $this->success('模板文件修改成功',U('Stencil/stencil_index'));
        }else{
          $this->error('模板文件修改失败或未作出任何更改',U('Stencil/stencil_index'));
        }
      }
    }
    public function stencil_del()
    {
      $id = I('get.id');
      $url = M('stencil')->where(array('id'=>$id))->find();
      $res =  unlink($url['stencil_url']);
      if($res){
        $re = M('stencil')->where(array('id'=>$id))->delete();
        if($re){
          $this->success('删除成功');
        }else{
          $this->error('删除失败');
        }
      }else{
        $this->error('模板文件删除失败');
      }
    }
}
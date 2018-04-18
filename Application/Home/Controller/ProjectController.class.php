<?php
namespace Home\Controller;
use Think\Controller;
class ProjectController extends Controller {
   /*项目*/
    public function project_index(){
    	$data = M('class')->where('class_is=0')->select();
    	$this->assign('volist',$data);
       	$this->display();
    }


    // 项目添加页面
    public function project_add(){
    	$this->display();
    }


    // 项目添加方法
    public function project_add_do(){
    	$data = I('post.');
    	$data['class_addtime'] = time();
    	// var_dump($data);die;
    	$add = M('class')->data($data)->add();
    	if($add){
    		$this->success('新增成功', U('Project/project_index'));
    	}else{
    		$this->error('新增失败',U('Project/project_add'));
    	}
    }

    // 项目删除
    public function project_del(){
    	$id = I('get.id');
    	// var_dump($id);die;
    	$del = M('class')->where('id='.$id)->save(array('class_is'=>1));
    	// print_r($del);die;
    	if($del){
    		$this->success('新增成功', U('Project/project_index'));
    	}else{
    		$this->error('新增失败',U('Project/project_index'));
    	}
    }

}
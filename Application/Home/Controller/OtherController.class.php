<?php
namespace Home\Controller;
use Think\Controller;
class OtherController extends Controller {
   /*其他*/
    public function other_index(){
        $data=M('cashier')->where('state=6')->order('id desc')->select();
        $this->assign('data',$data);
        $this->display();
    }
    /*添加其他*/
    public function other_add(){
    	if(IS_POST){
    		$data=I('post.');
    		$data['state']='6';
            $data['declare']=time();
            $re=M('cashier')->add($data);
            if ($re) {
                $this->success('添加成功',U('other_index'));
            }else{
                $this->error('添加失败');
            }
        }else{
    	    $this->display();
    	}
    }
    /*查看详情*/
    public function other_list(){
        $id=I('get.id');
        $data=M('cashier')->where(array('id'=>$id))->find();
        $this->assign('data',$data);
        $this->display();
    }
    /*修改*/
    public function other_save(){
        if(IS_POST){
            $data=I('post.');
            $re=M('cashier')->where(array('id'=>$data['id']))->save($data);
            if($re){
                $this->success('修改成功',U('other_index'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $id=I('get.id');
            $data=M('cashier')->where(array('id'=>$id))->find();
            $this->assign('data',$data);
            $this->display();
        }
    }

    /*搜索*/  
    public function other_search(){
        $data=I('post.keyword');
        $data=M('cashier')->where("state=6 and erjikemu like '%$data%'")->select();
        $this->assign('data',$data);
        $this->display('other_index');
    }
}
<?php
namespace Home\Controller;
use Think\Controller;
class RepayController extends Controller {
   /*报销管理*/
    public function repay_index(){
       $data=M('cashier')->where('state=1')->select();
       $this->assign('data',$data);
       $this->display();
    }
    /*报销添加*/
     public function repay_add(){
     	if(IS_POST){
     		$data=I('post.');
     		$data['state']="1";
     		$data['declare']=time();
     		$res=M('cashier')->add($data);
     		if($res){
     			$this->success('添加成功',U('repay_index'));
     		}else{
     			$this->error('添加失败');
     		}
     	}else{
      	
      		 $this->display();

     	}
    }
    public function repay_save(){
    	if(IS_POST){
    		$data=I('post.');
	    	$res=M('cashier')->where(array('id'=>$data['id']))->save($data);
	    		if($res){
	    			$this->success('修改成功',U('repay_index'));
	    		}else{
	    			$this->error('修改失败');
	    		}
    	}else{
    		$id = I('get.id');
	 		$data = M('cashier')->where(array('id'=>$id))->find();
		    $this->assign('data',$data);
		    $this->display();
    	}
    	
    }
    /*查看详情*/
    public function repay_list(){
    	$id = I('get.id');
 		$data = M('cashier')->where(array('id'=>$id))->find();
	    $this->assign('data',$data);
	    $this->display();
    }
}
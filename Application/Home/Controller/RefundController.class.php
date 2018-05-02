<?php
namespace Home\Controller;
use Think\Controller;
class RefundController extends Controller {
   /*退款*/
    public function refund_index(){
    	$res=M('cashier')->where('state=2')->select();
       	$this->assign('volist',$res);
       	$this->display();
    }


    /*添加*/
       public function refund_add(){
       	if(IS_POST){
       			$data=I('post.');
       			$data['charge_time']=strtotime($data['charge_time']);
       			$data['state']="2";
       			$re = M('account')->where(array('id'=>$data['charge_bank']))->find();
       			$data['charge_bank']=$re['owner'].'-'.$re['name'].'-'.$re['contnum'];
       			// print_r($data);die;
 				$res=M('cashier')->add($data);
 				if($res){
 					$this->success('添加成功',U('refund_index'));
 				}else{
 					$this->error('添加失败');
 				}
       	}else{
		       $acontname = M('account')->field('id,name')->select();        //银行收款账户
		       $this->assign('acontname',$acontname);
		       $this->display();
       	}
       
    }
    /*查看*/
    	public function refund_list(){
    		$id['id'] = I('get.id');
			$data = M('cashier')->where($id)->find();
    		$this->assign('data',$data);
    		$this->display();
    	}

    /*修改*/
    	public function refund_save(){
    		if(IS_POST){
	    			$data=I('post.');
	    			$res=M('cashier')->where(array('id'=>$data['id']))->save($data);
	    			//echo M('cashier')->getlastsql();die;
	    			if($res){
	    				$this->success('修改成功',U('refund_index'));
	    			}else{
	    				$this->error('修改失败');
	    			}
    		}else{
	    		$id = I('get.id');
	    		$acontname = M('account')->field('id,name')->select();        //银行收款账户
		      $this->assign('acontname',$acontname);
				  $data = M('cashier')->where(array('id'=>$id))->find();
	    		$this->assign('data',$data);
	    		$this->display();
    			}
    	}
      /*搜索*/
      public function refund_search(){
        $data=I('post.keyword');
        $data=M('cashier')->where("state=2 and company like '%$data%'")->select();
        $this->assign('data',$data);
        $this->display('refee_index');
      }

}
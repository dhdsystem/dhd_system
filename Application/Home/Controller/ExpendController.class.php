<?php
namespace Home\Controller;
use Think\Controller;
class ExpendController extends Controller {
   /*支出*/
   // 支出展示页面
    public function expend_index(){
    	$data = M('expenditure as e')
    			->field('a.name,e.company,e.firststep,e.detail,e.money,e.deteofcollect,u.real_name,e.id')
    			->join('dhd_account as a on e.account = a.id')
    			->join('dhd_user as u on e.u_id = u.id')
    			->where('expend_state=0')
    			->select();
      // print_r($data);die;
    	$this->assign('data',$data);
       	$this->display();
    }

    // 支出添加页面
   	public function expend_add(){
      $bank = M('account')->select();
      $this->assign('bank',$bank);
   		$this->display();
   	}


    // 支出添加方法
   	public function expendadd_do(){
   		$data =I('post.');
   		$data['u_id'] = get_user_id();
      $deteofcollect = $data['deteofcollect'];
   		$data['deteofcollect'] = strtotime("$deteofcollect");
   		// print_r($data);die;
   		$add = M('expenditure')->data($data)->add();
        if($add){
            $this->success('新增成功', U('Expend/expend_index'));
        }else{
            $this->error('新增失败',U('Expend/expend_add'));
        }
   	}


   	// 支出修改页面
   	public function expend_save(){
   		$id = I('get.id');
   		$list = M('account')->select();
   		$data = M('expenditure as e')->where(array('id'=>$id))->find();
   		// print_r($data);die;
   		$this->assign('list',$list);
   		$this->assign('data',$data);
   		$this->display();

   	}

   	// 支出修改方法
   	public function expendsave_do(){
   		$data = I('post.');
      $deteofcollect = $data['deteofcollect'];
      $data['deteofcollect'] = strtotime("$deteofcollect");
      // print_r($data);die;
      $save = M('expenditure')->where(array('id'=>$data['id']))->save($data);
      if($save){
          $this->success('修改成功', U('Expend/expend_index'));
      }else{
          $this->error('修改失败',U('Expend/expend_save?id='.$data['id']));
      }
   	}


   	// 支出删除
   	public function expend_del(){
   		$id = I('get.id');
    	// var_dump($id);die;
        $data['expend_state'] = '1';
        $del = M('expenditure')->where(array('id'=>$id))->save($data);
        if($del){
            $this->success('删除成功', U('Expend/expend_index'));
        }else{
            $this->error('删除失败',U('Expend/expend_index'));
        }
   	}


}
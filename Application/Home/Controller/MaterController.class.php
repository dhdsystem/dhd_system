<?php
namespace Home\Controller;
use Think\Controller;
class MaterController extends Controller {
   /*材料*/
    public function mater_index(){
       $where=array('m_type'=>0);
       $page=pagess('material',$where,'',10);
       $data=M('material')->alias('m')
             ->join('dhd_class as c on c.id=m.class_id')
             ->field('m.id,m_address,c.class_name,m_time,m_number')
             ->limit($page['firstRow'],$page['listRows'])
             ->order('m.id desc')
             ->where('m_type=0')
             ->select();
       $this->assign('show',$page['show']);
       $this->assign('data',$data);
       $this->display();
    }
    /*材料添加*/
	public function mater_add(){
		if(IS_POST){
			$data=I('post.');
			$data['m_time']=time();
			$res=M('material')->add($data);
			if($res){
				$this->success('材料添加成功',U('mater/mater_index'));
			}else{
				$this->error('材料添加失败',U('mater/mater_add'));
			}
		}else{
			$class=M('Class')->field('id,class_name')->select();
			$this->assign('class',$class);
			$this->display();
		}
		
	}
	/*获取注册地址*/
	public function mater_address(){
		$id=I('post.class_id');
		$data=M('details')->where(array('class_id'=>$id))->field('id,det_address')->select();
		// print_r($data);die;
		echo json_encode($data);
	}
	/*材料删除*/
	public function mater_del(){
		$id=I('post.id');
		$res=M('material')->where(array('id'=>$id))->save(array('m_type'=>1));
		if($res){
			echo 1;
		}else{
			echo 2;
		}
	}
	/*修改*/
	public function mater_save(){
		if(IS_POST){
			$id=I('post.id');
			$res=M('material');
			$num=$res->where("id = $id ")->field('m_number')->find();
			$num=$num['m_number']+I('post.m_number');
			$res->where(array('id'=>$id))->save(array('m_number'=>$num));
			if($res){
				$this->success('修改成功',U('mater/mater_index'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$id=I('get.id');
			$data=M('material')->alias('m')->where("m.id=$id")
			->join('dhd_class as c on c.id=m.class_id')
            ->field('m.id as mid,m_address,c.id as cid,c.class_name,m_time,m_number')
            ->find();  
			$this->assign('data',$data);
			$this->display();
		}
		
	}

}
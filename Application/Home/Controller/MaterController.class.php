<?php
namespace Home\Controller;
use Think\Controller;
class MaterController extends Controller {
   /*材料*/
    public function mater_index(){
       $where=array('m_type'=>0);
       $page=pagess('material',$where,'',10);
       $data=M('material')->alias('m')
             ->join('dhd_product as c on c.id=m.m_address')
             ->join('dhd_class  on dhd_class.id=m.class_id')
             ->field('m.id,pro_address,class_name,m_time,m_number')
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
		$data=M('product')->where(array('class_id'=>$id))->field('id,pro_address')->select();
		// echo M('class')->getlastsql();
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
			 $data=M('material')->alias('m')
			 ->where("m.id=$id")
			 ->join('dhd_product as c on c.id=m.m_address')
             ->join('dhd_class on dhd_class.id=m.class_id')
             ->field('m.id as mid,pro_address,dhd_class.id as cid,dhd_class.class_name,m_time,m_number')
             ->find();  
			$this->assign('data',$data);
			$this->display();
		}
		
	}

	/*材料客户信息*/
	public function mater_clientInfor(){
    	$id =I('get.id');
    	$data=M('material_contract')
    	->where(array('dhd_material_contract.m_id'=>$id))
    	->join('dhd_contract on dhd_contract.id=dhd_material_contract.con_id')
		->join('dhd_client on dhd_client.id=dhd_contract.client_id')
		->join('dhd_details on dhd_details.id=dhd_material_contract.det_id')
		->join('dhd_product on dhd_product.id=dhd_details.pro_id')
		->join('dhd_class on dhd_class.id=dhd_product.class_id')
		->field('dhd_material_contract.id,class_name,pro_address,detailscoll,client_name')
		->select();
		//print_r($data);die;
		$this->assign('data',$data);
		$this->display();
	}

}
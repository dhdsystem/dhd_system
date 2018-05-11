<?php
namespace Home\Controller;
use Think\Controller;
class FlowController extends Controller
{
	public function index()
	{
		$flow = M('flow');					// 审核表
		$compet = M('node');				// 权限表
		$role = M('role');					// 角色表
		$cost_id_info = $flow->field('cost_id')->group('cost_id')->select();
		foreach ($cost_id_info as $k => $v) {
			$cost_arr = $compet->field('opera_name')->where("id=$v[cost_id]")->find();
			$arr[$k]['id'] = $v['cost_id'];
			$arr[$k]['cost'] = $cost_arr['opera_name'];
			$r_id_arr = $flow->field('r_id')->where("cost_id=$v[cost_id]")->select();
			foreach ($r_id_arr as $key => $val) {
				if($val['r_id']==0)
				{
					$ro['role_name'] = "本部审核";
				}else
				{
					$ro = $role->field('role_name')->where("id=$val[r_id]")->find();
				}
				$role_arr[$k][$key] = $ro['role_name'];
			}
			$arr[$k]['role'] = implode('——>',$role_arr[$k]);
		}
		// print_r($arr);die;	
		$this->assign('volist',$arr);
		$this->display();
	}
	// 流程添加
	public function flow_add()
	{
		$role = M('role')->select();
		$newarr = $this->GetTree($role, 0, 0);				// 职位
		$node = M('node')->where('state=1')->order('id')->select();	// 权限
		$this->assign('node',$node);
		$this->assign('role',$newarr);
		$this->display();
	}

	public function flow_add_do()
	{
		$data = I('post.');
		$flow = M('flow');
		$in = $flow->where('cost_id='.$data['cost_id'])->find();
		if(!$in)
		{
			foreach ($data['r_id'] as $k => $v) {
				$arr[$k]['cost_id'] = $data['cost_id'];
				$arr[$k]['r_id'] = $v;
				$arr[$k]['lv'] = $k+1;
			}
			$res = $flow->addAll($arr);
			if($res)
			{
				$this->success("添加成功！",U('index'));
			}else{
				$this->error("添加失败！",U('index'));
			}
		}
		else
		{
			$this->error("对不起，流程已存在，请勿重复添加！",U('index'));
		}
	}

	// 删除
	public function del()
	{
		$id = I('post.id');
		$res = M('flow')->where("cost_id=$id")->delete();
		if($res)
		{
			echo json_encode(array('s'=>'ok'));
		}else
		{
			echo json_encode(array('s'=>'删除失败'));
		}
	}


	// 无限极循环展示
	private function GetTree($arr,$pid,$step){
	    global $tree;
	    foreach($arr as $key=>$val) {
	        if($val['pid'] == $pid) {
	            $flg = str_repeat('|__',$step);
	            $val['name'] = $flg.$val['name'];
	            $tree[] = $val;
	            $this->GetTree($arr , $val['id'] ,$step+1);
	        }
	    }
	    return $tree;
	}
}
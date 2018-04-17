<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class RoleController extends CommonController {

    /*职业 角色 展示*/
    public function role_index(){
        $role = M('Role')->where(array('state'=>1))->select();
        $roletree=$this->GetTree($role,0,0);
        //print_r($roletree);die;
        $this->assign('role',$roletree);
        $this->display();
    }
    /*添加角色*/
    public function  role_add()
    {
        if(IS_POST){
            //print_r($_POST);die;
            $roledata['role_name']=I('post.role_name','');
            $roledata['description']=I('post.description','');
            $roledata['dtime']=time();
            $roledata['state']='1';
            $roledata['pid']=I('post.pid');
            $res=M('role')->data($roledata)->add();
            if(!$res){
                return $this->error(json_encode('角色创建失败'));
            }
            $operalist=I('one','');//获取角色下的权限
            foreach ($operalist as $key => $val) {
                $arr[$key]['o_id']=$val;
                $arr[$key]['r_id']=$res;
                $arr[$key]['time']=time();

            }
            $re=M('role_node')->addAll($arr);

            if(!$re){

                 $this->error('角色创建失败');
            }
             $this->success('角色创建成功',U('role/role_index'));
        }else{
            $role = M('Role')->select();
            $node = M('Node')->select();
            $roletree=$this->GetTree($role,0,0);
            $node=$this->get_attr($node);
            $data=json_encode($node);
            $this->assign('role',$roletree);
            $this->assign('volist',$data);
            $this->display('role_add');
        }

    }

    /*删除*/
    public function roledel(){
        $id=I('post.id');
        $res=M('role')->where(array('id'=>$id))->save(array('state'=>2));
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /*修改展示*/
    public function  roleedit(){

    }
}
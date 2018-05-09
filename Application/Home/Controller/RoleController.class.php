<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class RoleController extends CommonController {

    /*职业 角色 展示*/
    public function role_index(){
        $role = M('Role')->where(array('state'=>1))->select();
        $roletree=$this->GetTree($role,0,0);
        //print_r($role);die;
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
            $role = M('role')->select();
            $node = M('node')->select();
            $roletree=$this->GetTree($role,0,0);
            $node=$this->get_attr($node);
            $data=json_encode($node);
            // print_r($role);die;
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
    public function  role_save(){
        if(IS_POST){
                    $id=I('post.id');
                    M('role_node')->where(array('r_id'=>$id))->delete();
                    $roledata['role_name']=I('post.role_name','');
                    $roledata['description']=I('post.description','');
                    $roledata['dtime']=time();
                    $roledata['state']='1';
                    $roledata['pid']=I('post.pid');
                    $res=M('role')->where(array('id'=>$id))->save($roledata);
             
                    if(!$res){
                        return $this->error(json_encode('角色修改失败'));
                    }
                    $operalist=I('one','');//获取角色下的权限
                    foreach ($operalist as $key => $val) {
                        $arr[$key]['o_id']=$val;
                        $arr[$key]['r_id']=$id;
                        $arr[$key]['time']=time();

                    }
                    $re=M('role_node')->addAll($arr);

                    if(!$re){

                         $this->error('角色修改权限失败');
                    }
                     $this->success('角色修改权限成功',U('role/role_index'));
                        // print_r(json_encode($data));die;
                
            }else{
                $id=I('get.id');
                // print_r($id);die;
                $datas=M('role')->where('id='.$id)->find();
                // 获取用户所有权限
                $user_role = M('role_node')->field('o_id')->where(array('r_id' =>$id))->select();
                // print_r($user_role);die;
                /*权限名称展示*/
                $role = M('role')->select();
                $node = M('node')->select();
                $result = array();
                array_walk_recursive($user_role, function($value) use (&$result) {
                    array_push($result, $value);
                });
                // 
                foreach ($node as $key => $val) {
                    if(in_array($val['id'], $result)){
                        $node[$key]['is_p'] = 1;
                    }
                }
                // print_r($node);die;
                $roletree=$this->GetTree($role,0,0);
                $node=$this->get_attr($node);
                $data=json_encode($node);
                $this->assign('role',$roletree);
                $this->assign('datas',$datas);
                $this->assign('volist',$data);
                $this->display('role_save');
            }
        }
    
}
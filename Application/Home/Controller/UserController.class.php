<?php


// 2018.4.16
// dingxinjaing
// User用户管理中心

namespace Home\Controller;
use Think\Controller;
class UserController extends CommonController {
	/*用户*/
    public function user_index(){
        $p=!empty($_GET['page'])?$_GET['page']:0;
        $num='2';
        $volist = M('user as u')
        ->field('u.id,u.username,u.password,u.state,u.description,u.logincount,u.dtime,u.real_name,u.real_name,u.ztime,r.role_name,r.description')
        ->join('dhd_role as r on u.r_id = r.id')
        ->where('u.state=0')
        ->order('u.id desc')
        ->page($p,$num)
        ->select();
        $count = M('user as u')
        ->field('u.id,u.username,u.password,u.state,u.description,u.logincount,u.dtime,u.real_name,u.real_name,u.ztime,r.role_name,r.description')
        ->join('dhd_role as r on u.r_id = r.id')
        ->where('u.state=0')
        ->order('u.id desc')
        ->count();
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->assign('volist',$volist);
        $this->display();
    }

    // 用户添加页面
    public function user_add(){
        $role = M('role')->select();
        // var_dump($role);die;
        $roletree = $this->GetTree($role,0,0);
        $this->assign('volist',$roletree);
    	$this->display();
    }

    // 用户添加
    public function useradd_do(){
        $post = I('post.');
        $post['password'] = md5(I('post.password'));
        $post['ztime'] = time();
        // return $post;
        $add = M('user')->data($post)->add();
        if($add){
            print_r( json_encode('ok'));
        }else{
            $post['s'] = '添加失败';
            print_r( json_encode($post));
        }

        // var_dump($post);die;
    }


    // 用户单删除
    public function userdel(){
        $delid = I('post.id');
        $data['state'] = '1';
        $del = M('user')->where("id=$delid")->save($data);
        if($del){
            $post['s'] = 'ok';
            print_r( json_encode($post));
        }else{
            $post['s'] = '删除失败';
            print_r( json_encode($post));
        }
    }

    // 用户多删除
    public function in_user_del(){
        $delid = I('post.delid');
        $map['id']=array('in',$delid );
        $data['state'] = '1';
        $del = M('user')->where($map)->save($data);
        if($del){
            $post['s'] = 'ok';
            print_r( json_encode($post));
        }else{
            $post['s'] = '删除失败';
            print_r( json_encode($post));
        }

    }

    // 用户修改页面
    public function saveuser(){
        $u_id = I('get.id');
        $result = M('user')->where('id='.$u_id)->find();
        $role = M('role')->select();
        // var_dump($role);die;
        $volist = $this->GetTree($role,0,0);
        $this->assign('volist',$volist);
        $this->assign('result',$result);
        $this->display('User/user_save');
    }

    // 用户修改方法
    public function usersave_do(){
        $data = I('post.');
        // print_r( json_encode($data));
        $data['password'] = md5(I('post.password'));
        $save = M('user')->where('id='.$data['id'])->save($data);
        if($save){
            $post['s'] = 'ok';
            print_r( json_encode($post));
        }else{
            $post['s'] = '修改失败';
            print_r( json_encode($post));
        }
    }

}
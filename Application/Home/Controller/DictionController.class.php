<?php
/*shanzezhao*/
namespace Home\Controller;
use Think\Controller;
class DictionController extends CommonController {
	/*权限展示*/
    public function diction_index(){          
            $node = M('Node')->where('state = 1')->select();
            $nodetree=$this->GetTrees($node,0,0);
            // print_r($nodetree);die;
            $this->assign('node',$nodetree);
            return $this->display();
 		
    }
    /*添加权限*/
    public function diction_add(){
        if(IS_POST){
            $data=I('post.');
            $res=M('Node')->data($data)->add();
            if($res){
                echo '1';
            }else{
                echo '0';
            }
            }else{
        	$node = M('Node')->select();
            $nodetree=$this->GetTrees($node,0,0);
            $this->assign('node',$nodetree);
            return $this->display();
        }

        }

    /*删除*/
        public function cdel(){
            $id=I('post.id');
            $data=M('node')->where(array('p_id'=>$id))->find();
            if($data){
                echo 3;die;
            }
            $res=M('node')->where(array('id'=>$id))->save(array('state'=>2));
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }
    /*按权限名称搜索*/
        public function diction_search(){
              $name=I('get.name');
              $node = M('Node');
              $data=$node->where("state = 1 and opera_name like '%$name%'")->select();
              //echo $node->getLastSql();
              //print_r($node);die;
              $this->assign('node',$data);
              $this->display('diction_index');
        }
    /*修改*/
        public function diction_save(){
            if(IS_POST){
                $data=I('post.');
                //print_r(json_encode($data));die;
                 $id=I('post.id');
                 $res=M('Node')->where( array('id'=>$id))->save($data);
                 if($res){
                    echo 1;
                 }else{
                    echo 2;
                 }
            }else{
                $id=I('get.id');
                // print_r($id);die;
                $data=M('Node')->where('id='.$id)->find();
                //print_r($data);die;
                /*权限名称展示*/
                $node = M('Node')->select();
                $nodetree=$this->GetTrees($node,0,0);
                $this->assign('node',$nodetree);
                $this->assign('data',$data);
                return $this->display();
            }
        }
}
<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    /**
     * 
     * 验证登录
     * sy
     */
    function __construct() {
        parent::__construct();
        set_time_limit(0);

        if($id= get_user_id()) {
            // echo $id;die;
            $role_id = get_role_id();
            // echo $role_id;die;
            if($role_id!=1){
                $controller=CONTROLLER_NAME;
                $action=ACTION_NAME;
                if($controller!='Index'){
                    $opera_list=M('role_node')->field('controller,action')->join('dhd_node on dhd_role_node.o_id=dhd_node.id')->where('r_id='.$role_id)->select();
                    foreach($opera_list as $k=>$v){
                        foreach($v as $key=>$val){
                            $arr2[]=$val;
                        }
                    }
                    if(!in_array($controller,$arr2)){
                        $this->error("抱歉，您没有权限访问该控制器");
                    }
                    if($action!='index'){
                        // $arrs = $this->arr();
                        if(in_array($action,$arrs)){
                            if(!in_array($action,$arr2)){
                                $this->error("抱歉，您不能进行该操作");
                            }
                        }
                    }
                    
                }
                
            }
        }else{
            
            if(IS_AJAX){
                $this->error("您还没有登录！", U("Login/login"));
            }else{
                $this->redirect('Login/login');
            }
        }

    }

   /*公共*/
    public function common_index(){
       $this->display();
    }
    // 无限极循环展示
    public function GetTree($arr,$pid,$step){
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
        // 无限极循环展示
    public function GetTrees($arr,$pid,$step){
        global $tree;
        foreach($arr as $key=>$val) {
            if($val['p_id'] == $pid) {
                $flg = str_repeat('|__',$step);
                $val['name'] = $flg.$val['name'];
                $tree[] = $val;
                $this->GetTrees($arr , $val['id'] ,$step+1);
            }
        }
        return $tree;
    }
    public function get_attr($a,$pid=0)
    {
        $tree = array();                                //每次都声明一个新数组用来放子元素
        foreach($a as $v){
            if($v['p_id'] == $pid){                      //匹配子记录
                $v['children'] = $this->get_attr($a,$v['id']); //递归获取子记录
                if($v['children'] == null){
                    unset($v['children']);             //如果子元素为空则unset()进行删除，说明已经到该分支的最后一个元素了（可选）
                }
                $tree[] = $v;                           //将记录存入新数组
            }
        }
        return $tree;                                  //返回新数组
    }

}
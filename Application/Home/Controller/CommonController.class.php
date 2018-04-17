<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
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
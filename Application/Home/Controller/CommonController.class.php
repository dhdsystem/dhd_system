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
}
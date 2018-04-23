<?php
namespace Home\Controller;
use Think\Controller;
class ExcelController extends Controller {
   /*excel*/
    public function excel_index(){
       $this->display();
    }
    public function stencil_up($file,$file_name)
    {
		$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','xlsx' ,'xls');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/Excel/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录 
        $upload->saveName =     md5($file_name);
        $upload->replace = true ;
        $info   =   $upload->upload();
        if($info) {
          	return './Uploads/Excel/'.$info['file']['savepath'].$info['file']['savename'];
         
        }
	   

    }
}
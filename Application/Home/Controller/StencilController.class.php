<?php
namespace Home\Controller;
use Think\Controller;
class StencilController extends Controller {
   /*模板管理*/
    public function stencil_index(){
       $this->display();
    }
   	public function stencil_add()
   	{
   		$this->display();
   	}
   	public function stenciladd_do()
   	{
   		print_r($_POST);
      print_r($_FILES['file']);
   	}
}
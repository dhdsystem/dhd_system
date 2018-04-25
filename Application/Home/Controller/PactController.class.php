<?php
namespace Home\Controller;
use Think\Controller;
class PactController extends Controller {
   /*合同*/
    public function pact_index(){
       $this->display();
    }
    public function pact_add()
    {
    	$id =I('get.id');

    	$this->display();
    }
















}
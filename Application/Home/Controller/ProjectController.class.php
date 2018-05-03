<?php
namespace Home\Controller;
use Think\Controller;
class ProjectController extends Controller {
   
   /*项目*/
    public function project_index(){
    	$data = M('class')->where('class_is=0')->select();
    	$this->assign('volist',$data);
       	$this->display();
    }


   
    // 项目添加页面
    public function project_add(){
    	$this->display();
    }


   
    // 项目添加方法
    public function project_add_do(){
    	$data = I('post.');
    	$data['class_addtime'] = time();
    	// var_dump($data);die;
    	$add = M('class')->data($data)->add();
    	if($add){
    		$this->success('新增成功', U('Project/project_index'));
    	}else{
    		$this->error('新增失败',U('Project/project_add'));
    	}
    }

    
    // 项目删除
    public function project_del(){
    	$id = I('get.id');
    	$del = M('class')->where('id='.$id)->save(array('class_is'=>1));
    	if($del){
    		$this->success('删除成功', U('Project/project_index'));
    	}else{
    		$this->error('删除失败',U('Project/project_index'));
    	}
    }


   
    // 项目修改 
    public function project_save(){
        if(IS_POST){
            $data=I('post.');
            $res=M('class')->where(array('id'=>$data['id']))->save($data);
            if($res){
                
                $this->success('修改成功', U('Project/project_index'));
            }else{
                $this->error('修改失败', U('Project/project_index'));
            }
        }else{
          $class_id=I('get.class_id');
          $data=M('class')->where("id=$class_id")->find();
          $this->assign('data',$data);
          $this->display();
        }
    }

   



     /*商品详情查看*/
    public function project_detail(){
        $class_id=I('get.pro_id');//项目id
        // print_r($class_id);die;
        $data=M('product');
        //项目 产品的数据
        $na=$data->where("class_id=$class_id and class_is=0 and pro_del=1")
        ->join("dhd_class on dhd_product.class_id = dhd_class.id")
        ->field('dhd_product.id,class_id,class_name,pro_address,pro_sum')
        ->select();

        foreach ($na as $key => $value) {
           // 1：大面积；2：普通注册号；3：工位；4：小房间；5销售注册号；//总数据
            $na[$key]['count1']=M('product')->join('dhd_details on dhd_details.pro_id = dhd_product.id')->where(array('det_type'=>1,'pro_id'=>$value['id'],'pro_del'=>1,'det_del'=>0))->count();
            $na[$key]['count2']=M('product')->join('dhd_details on dhd_details.pro_id = dhd_product.id')->where(array('det_type'=>2,'pro_id'=>$value['id'],'pro_del'=>1,'det_del'=>0))->count();
            $na[$key]['count3']=M('product')->join('dhd_details on dhd_details.pro_id = dhd_product.id')->where(array('det_type'=>3,'pro_id'=>$value['id'],'pro_del'=>1,'det_del'=>0))->count();
            $na[$key]['count4']=M('product')->join('dhd_details on dhd_details.pro_id = dhd_product.id')->where(array('det_type'=>4,'pro_id'=>$value['id'],'pro_del'=>1,'det_del'=>0))->count();
            $na[$key]['count5']=M('product')->join('dhd_details on dhd_details.pro_id = dhd_product.id')->where(array('det_type'=>5,'pro_id'=>$value['id'],'pro_del'=>1,'det_del'=>0))->count();
            // echo M('product')->getLastSql();die;
           // 1：大面积；2：普通注册号；3：工位；4：小房间；5销售注册号；//总数据
            $na[$key]['c1']=M('largearea')
                ->join('dhd_details on dhd_details.id=dhd_largearea.details_id')
                ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
                ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
                ->join('dhd_contract on dhd_contract.id=dhd_largearea.contract')
                ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
                ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
                ->where("det_del=0 and det_type=1 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
                ->where(array('dhd_product.id' => $value['id']))
                ->count();
              
            $na[$key]['c2']=M('houselet')
                ->join('dhd_details on dhd_details.id=dhd_houselet.details_id')
                ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
                ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
                ->join('dhd_contract on dhd_contract.id=dhd_houselet.contract')
                ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
                ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
                ->where("det_del=0 and det_type=4 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
                ->where(array('dhd_product.id' => $value['id']))
                ->count();  
            $na[$key]['c3']=M('register')
                ->join('dhd_details on dhd_details.id=dhd_register.details_id')
                ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
                ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
                ->join('dhd_contract on dhd_contract.id=dhd_register.contract')
                ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
                ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
                ->where("det_del=0 and det_type=2 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
                ->where(array('dhd_product.id' => $value['id']))
                ->count(); 
            $na[$key]['c4']=M('register')
                ->join('dhd_details on dhd_details.id=dhd_register.details_id')
                ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
                ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
                ->join('dhd_contract on dhd_contract.id=dhd_register.contract')
                ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
                ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
                ->where("det_del=0 and det_type=5 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
                ->where(array('dhd_product.id' => $value['id']))
                ->count(); 
            $na[$key]['c5']=M('registration')
                ->join('dhd_details on dhd_details.id=dhd_registration.details_id')
                ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
                ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
                ->join('dhd_contract on dhd_contract.id=dhd_registration.contract')
                ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
                ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
                ->where("det_del=0 and det_type=3 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
                ->where(array('dhd_product.id' => $value['id']))
                ->count(); 
        }
        //print_r($na);die;
        $this->assign('volist',$na);
        $this->assign('class_id',$class_id);
        $this->display();
    }
     
    /*产品详情修改*/
     public function product_detail_save(){
        if(IS_POST){
            $data=I('post.');
            // print_r($data);die;
            $id=M('product')->where(array('id'=>$data['id']))->find();
            $res=M('product')->where(array('id'=>$data['id']))->save($data);
            
            if($res){
                $this->success('修改成功', U('Project/project_detail',array('pro_id'=>$id['class_id'])));
            }else{
                $this->error('修改失败', U('Project/project_detail',array('pro_id'=>$id['class_id'])));
            }
        }else{
          $product_id=I('get.product_id');
          $data=M('product')->where("id=$product_id")->find();
          $this->assign('data',$data);
          $this->display('project_detail_save');
        }
     }
    

    //产品详情类型、1：大面积；2：普通注册号；3：工位；4：小房间；5销售注册号'
    
    /*商品详情大面积*/
     public function project_detail_bign(){
        $class_id=I('get.class_id');
        $data=M('details');
        $na=$data->where(array('pro_id'=>$class_id,'det_type'=>1,'pro_del'=>1,'det_del'=>0))
        ->where("det_advance !=3")
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id')
        ->field('dhd_details.id,big_sum,det_type,detailscoll,pro_address,class_id')
        ->select();    
        $this->assign('class_id',$class_id); 
        $this->assign('volist',$na);
        $this->display();
    }
    

    /*商品详情大面积已使用*/
    public function project_detail_big(){
        $class_id=I('get.class_id');
        $p=!empty($_GET['page'])?$_GET['page']:0;
        $num="2";
        $list=M('largearea')
        ->join('dhd_details on dhd_details.id=dhd_largearea.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_largearea.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=1 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
        ->field("dhd_largearea.id,rates,detailscoll,big_sum,client_name,rentstarttime,rentendtime,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->page($p,$num)//($Page->firstRow,$Page->listRows)
        ->select();   
        //echo M('largearea')->getLastSql();die;
        $count=M('largearea')
        ->join('dhd_details on dhd_details.id=dhd_largearea.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_largearea.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=1 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
        ->field("dhd_largearea.id,rates,detailscoll,big_sum,client_name,rentstarttime,rentendtime,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->count();
        //echo M('largearea')->getLastSql();die;
        // $count=count($list);
        
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $Page->setConfig('prev','上一页');
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('class_id',$class_id);// 赋值分页输出
        $this->display();
   }
   
    /*商品详情大面积已使用--删除*/
    public function project_big_del(){
      $id=I('get.id');
      $class_id=I('get.class_id');
      $res=M('largearea')->where(array('id'=>$id))->save(array('is_del'=>1));
      if($res){
        $this->success('删除成功',U('project/project_detail_big',array('class_id'=>$class_id)));
      }else{
        $this->error('删除失败',array('class_id'=>$class_id));
      }
    }
    /*商品详情大面积删除*/
    public function project_bign_del(){
        $id = I('get.did');
        $del = M('details')->where('id='.$id)->save(array('det_del'=>1));
        $data=M('details')->where('dhd_details.id='.$id)->join('dhd_product on dhd_product.id=dhd_details.pro_id')->field('class_id')->find();//产品id
        // var_dump($data);die;
        if($del){
            $this->success('删除成功', U('Project/project_detail',array('pro_id'=>$data['class_id'])));
        }else{
            $this->success('删除失败', U('Project/project_detail',array('pro_id'=>$data['class_id'])));
        }
    }
    

    /*商品详情大面积修改*/
    public function project_bign_save(){
        if(IS_POST){
             $data=I('post.');
             $res=M('details')->where(array('id'=>$data['id']))->save($data);
             $id=M('details')->where(array('id'=>$data['id']))->find();
             $cid=M('product')->where(array('id'=>$id['pro_id']))->find();
            // print_r($id);die;
             if($res){
                $this->success('修改成功',U('project/project_detail',array('pro_id'=>$cid['class_id'])));
             }else{
                $this->error('修改失败',U('project/project_detail_bign',array('class_id'=>$id['pro_id'])));
             }
        }else{
          $det_id=I('get.det_id');
          $data=M('details')->where(array('dhd_details.id'=>$det_id))
          ->join('dhd_product on dhd_product.id=dhd_details.pro_id')
          ->field('pro_address,big_sum,det_type,dhd_details.id,detailscoll')
          ->find();          
           // print_r($data);die;
          $this->assign('data',$data);
          $this->display('project_bign_save');
        }
    }


    /*商品详情小房间*/
     public function project_detail_smln(){
        $class_id=I('get.class_id');
        $data=M('details');
        $na=$data->where(array('pro_id'=>$class_id,'det_type'=>4,'det_del'=>0))->where('det_advance !=3')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id')
        ->field('dhd_details.id,big_sum,det_type,detailscoll,pro_address,class_id')
        ->select();
        $this->assign('volist',$na);
        $this->assign('class_id',$class_id);
        $this->display();
    }
     /*商品详情小面积已使用*/
    public function project_detail_sml(){
        $class_id=I('get.class_id');
        $p=!empty($_GET['page'])?$_GET['page']:0;
        $num="2";
        $list=M('houselet')
        ->join('dhd_details on dhd_details.id=dhd_houselet.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_houselet.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=4 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
        ->field("dhd_houselet.id,rates,detailscoll,big_sum,client_name,rentstarttime,rentendtime,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->page($p,$num)
        ->select();   
        //echo M('houselet')->getLastSql();die;
        $count=M('houselet')
        ->join('dhd_details on dhd_details.id=dhd_houselet.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_houselet.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=4 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
        ->field("dhd_houselet.id,rates,detailscoll,big_sum,client_name,rentstarttime,rentendtime,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->count();
  
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $Page->setConfig('prev','上一页');
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('class_id',$class_id);// 赋值分页输出
        $this->display();
   }
   
    /*商品详情小面积已使用--删除*/
    public function project_sml_del(){
      $id=I('get.id');
      $class_id=I('get.class_id');
      // print_r($id);die;
      $res=M('houselet')->where(array('id'=>$id))->save(array('is_del'=>1));
      if($res){
        $this->success('删除成功',U('project/project_detail_sml',array('class_id'=>$class_id)));
      }else{
        $this->error('删除失败',U('project/project_detail_sml',array('class_id'=>$class_id)));
      }
    }
   
   

    /*商品详情普通注册号*/
     public function project_detail_adm(){

        $class_id=I('get.class_id');
        $data=M('details');
        $na=$data->where("pro_id=$class_id and det_type = 2 and det_del=0 and det_advance !=3")
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id')
        ->field('dhd_details.id,det_type,detailscoll,pro_address,class_id,det_advance')
        ->select();
        //echo $data->getLastSql();die;
        $name='普通注册号';
        $state='2';
        $this->assign('name',$name);
        $this->assign('state',$state);
        $this->assign('volist',$na);
        $this->assign('class_id',$class_id);
        $this->display('project_detail_adrn');
    }

     /*商品详情普通号已使用*/
    public function project_detail_adr(){
        $class_id=I('get.class_id');
        $state=I('get.state');
        $p=!empty($_GET['page'])?$_GET['page']:0;
        $num="2";
        $list=M('register')
        ->join('dhd_details on dhd_details.id=dhd_register.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_register.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=$state and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
        ->field("dhd_register.id,pro_address,detailscoll,client_name,rentstarttime,rentendtime,business,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->page($p,$num)
        ->select();   
        // echo M('register')->getLastSql();die;
        $count=M('register')
        ->join('dhd_details on dhd_details.id=dhd_register.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_register.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=$state and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
        ->field("dhd_register.id,pro_address,detailscoll,client_name,rentstarttime,rentendtime,business,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->count();
  
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $Page->setConfig('prev','上一页');
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('class_id',$class_id);// 赋值分页输出
        $this->assign('state',$state);// 赋值分页输出
        $this->display();
   }
   
    /*商品详情普通号已使用--删除*/
    public function project_adr_del(){
      $id=I('get.id');
      $state=I('get.state');
      $class_id=I('get.class_id');
      // print_r($id);die;
      $res=M('register')->where(array('id'=>$id))->save(array('is_del'=>1));
      if($res){
        $this->success('删除成功',U('project/project_detail_adr',array('class_id'=>$class_id,'state'=>$state)));
      }else{
        $this->error('删除失败',U('project/project_detail_adr',array('class_id'=>$class_id,'state'=>$state)));
      }
    }

   
   /*商品详情销售注册号*/
    public function project_detail_xsz(){
        $class_id=I('get.class_id');
        $data=M('details');
        $na=$data->where("pro_id = $class_id and det_type = 5 and det_del=0 and det_advance !=3")
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id')
        ->field('dhd_details.id,det_type,detailscoll,pro_address,class_id,det_advance')
        ->select();
        // echo $data->getLastSql();die;
        $name='销售注册号';
        $state='5';
        $this->assign('state',$state);
        $this->assign('volist',$na);
        $this->assign('name',$name);
        $this->assign('class_id',$class_id);
        $this->display('project_detail_adrn');
    }

   
    /*商品详情注册号修改*/
        public function project_adrn_save(){
            if(IS_POST){
                 $data=I('post.');
                 $res=M('details')->where(array('id'=>$data['id']))->save($data);
                 $id=M('details')->where(array('id'=>$data['id']))->find();
                 $cid=M('product')->where(array('id'=>$id['pro_id']))->find();
                 if($res){
                    $this->success('修改成功',U('project/project_detail',array('pro_id'=>$cid['class_id'])));
                 }else{
                    $this->error('修改失败',U('project/project_detail_bign',array('class_id'=>$id['pro_id'])));
                 }
            }else{

              $det_id=I('get.det_id');
              $data=M('details')->where(array('dhd_details.id'=>$det_id))
              ->join('dhd_product on dhd_product.id=dhd_details.pro_id')
              ->field('pro_address,dhd_details.id,detailscoll,det_type')
              ->find();          
              // print_r($data);die;
              $this->assign('data',$data);
              $this->display();
            }
        }
    
   
    /*商品详情注册号预出*/
        public function project_adrn_type(){
            $det_id=I('post.det_id');
            $data=M('details')->where(array('id'=>$det_id))->save(array('det_advance'=>1));
            if($data){
                echo 1;
            }else{
                echo 2;
            }
        }


    /*商品详情工位*/
     public function project_detail_gw(){
        $class_id=I('get.class_id');
        $data=M('details');
        $na=$data->where(array('pro_id'=>$class_id,'det_type'=>3,'pro_del'=>1,'det_del'=>0))
        ->where('det_advance !=3')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id')
        ->field('dhd_details.id,big_sum,det_type,detailscoll,pro_address,class_id')
        ->select();     
        $this->assign('volist',$na);
        $this->assign('class_id',$class_id);
        $this->display('project_detail_gwn');
    }
     /*商品详情工位已使用--工位办公*/
    public function project_detail_sta(){
        $class_id=I('get.class_id');
        $p=!empty($_GET['page'])?$_GET['page']:0;
        $num="2";
        $list=M('registration')
        ->join('dhd_details on dhd_details.id=dhd_registration.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_registration.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=3 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
        ->field("station,pro_address,detailscoll,client_name,rentstarttime,rentendtime,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->page($p,$num)
        ->select();   
         //echo M('registration')->getLastSql();die;
        $count=M('registration')
        ->join('dhd_details on dhd_details.id=dhd_registration.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_registration.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=3 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 and is_del=0")
        ->field("station,pro_address,detailscoll,client_name,rentstarttime,rentendtime,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->count();
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show();
        $state="1";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $Page->setConfig('prev','上一页');
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('class_id',$class_id);// 赋值分页输出*/
        $this->assign('state',$state);// 赋值分页输出*/
        $this->display();
   }
   public function project_detail_stn(){
        $class_id=I('get.class_id');
        $p=!empty($_GET['page'])?$_GET['page']:0;
        $num="2";
        $list=M('regclosed')
        ->join('dhd_details on dhd_details.id=dhd_regclosed.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_regclosed.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=3 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 ")
        ->field("station,pro_address,detailscoll,client_name,rentstarttime,rentendtime,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->page($p,$num)
        ->select();   
        //echo M('registration')->getLastSql();die;
        $count=M('regclosed')
        ->join('dhd_details on dhd_details.id=dhd_regclosed.details_id')
        ->join('dhd_product on dhd_product.id=dhd_details.pro_id') 
        ->join('dhd_class on dhd_class.id=dhd_product.class_id') 
        ->join('dhd_contract on dhd_contract.id=dhd_regclosed.contract')
        ->join('dhd_client on dhd_client.id=dhd_contract.client_id')
        ->join('dhd_collection on dhd_collection.contract=dhd_contract.id')
        ->where(" dhd_product.id=$class_id and det_del=0 and det_type=3 and pro_del=1 and class_is=0 and client_state=0 and det_advance =3 ")
        ->field("station,pro_address,detailscoll,client_name,rentstarttime,rentendtime,legalperson,legaltel,taxstyle,credit_code,paytype")
        ->count();
        $Page=new \Think\Page($count,$num);
        $show       = $Page->show();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $Page->setConfig('prev','上一页');
        $state='2';
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('class_id',$class_id);// 赋值分页输出*/
        $this->assign('state',$state);// 赋值分页输出*/
        $this->display('project_detail_sta');
   }

    /*商品详情工位修改*/
    public function project_gw_save(){

            if(IS_POST){
                 $data=I('post.');
                 $res=M('details')->where(array('id'=>$data['id']))->save($data);
                 $id=M('details')->where(array('id'=>$data['id']))->find();
                 $cid=M('product')->where(array('id'=>$id['pro_id']))->find();
                 if($res){
                    $this->success('修改成功',U('project/project_detail',array('pro_id'=>$cid['class_id'])));
                 }else{
                    $this->error('修改失败',U('project/project_gw_save',array('class_id'=>$id['pro_id'])));
                 }
            }else{

              $det_id=I('get.det_id');
              $data=M('details')->where(array('dhd_details.id'=>$det_id))
              ->join('dhd_product on dhd_product.id=dhd_details.pro_id')
              ->field('pro_address,dhd_details.id,detailscoll,det_type')
              ->find();          
              $this->assign('data',$data);
              $this->display();
            }


       }
     

     // 产品详情删除   
    public function product_del(){
        $id = I('get.pid');
        $class_id = I('get.class_id');
        // print_r($class_id);die;
      
        $del = M('product')->where('id='.$id)->save(array('pro_del'=>0));
        // print_r($del);die;
        if($del){
            $this->success('删除成功', U('Project/project_detail',array('pro_id'=>$class_id)));
        }else{
            $this->error('删除失败',U('Project/project_detail',array('pro_id'=>$class_id)));
        }
    }
 

      /*产品详情添加*/
    public function project_detail_add(){
       if(IS_POST){
            $datas['class_id']=I('post.class_id');//print_r($datas['class_id']);die;
            $datas['pro_address']=I("post.det_address");  //注册地址
            $datas['pro_sum']=I("post.det_sum");          //房间面积
            $datas['pro_desc']=I("post.detailscoll");     //备注
            
            $datas['det_start']=I("post.det_start");     //最小注册号
            $datas['det_end']=I("post.det_end");          //最大注册号
            $datas['num_start']=I("post.num_start");      //销售最小注册号
            $datas['num_end']=I("post.num_end");          //销售最大注册号 
            $datas['det_time']=time();          //销售最大注册号 

            $arr['det_station']=I("post.det_station");  //工位    
            $arr['small_num']=I("post.small_num");       //小房间号
            $arr['small_sum']=I("post.small_sum");       //小房间面积
            $arr['big_sum']=I("post.big_sum");        //大房间号
            $arr['big_num']=I("post.big_num");        //大房间面积
            
            //print_r($arr);die;
            $product = M('product');
            $details = M('details');
       
            foreach ($datas as $key => $val) {
                foreach ($val as $k => $v) {
                        $dat[$k][$key]=$v;
                      }
               }             
            
              foreach ($dat as $key => $val) {
                $re=$product->add($val);
                $id=$product->getLastInsID();
                if($id){
                        //普通注册号
                        if(!empty($val['det_start'])){
                          for($i=$val['det_start'];$i<=$val['det_end'];$i++){
                                $start['det_type']=2;
                                $start['detailscoll']=$i;
                                $start['pro_id']=$id; 
                                $start['det_time']=time(); 
                                $details->add($start);
                           }
                         
                        }
                        //销售注册号
                        if(!empty($val['num_start'])){
                          for($i=$val['num_start'];$i<=$val['num_end'];$i++){
                                $start['det_type']=5;
                                $start['detailscoll']=$i;
                                $start['pro_id']=$id; 
                                $start['det_time']=time(); 
                                $details->add($start);
                           }
                         
                        }
                        //工号
                        /*if(!empty($val['det_station'])){
                             $start['det_type']=3;
                             $start['detailscoll']=$val['det_station'];
                             $start['pro_id']=$id; 
                             $details->add($start);
                        }*/
                        if(!empty($arr['det_station'])){
                            foreach ($arr['det_station'][$key] as $ke => $va) {
                                $ear[$key][$ke]['detailscoll']=$va;
                                $ear[$key][$ke]['pro_id']=$id;
                                $ear[$key][$ke]['det_type']='3';
                                $ear[$key][$ke]['det_time']=time();

                                
                            }
                             $details->addAll($ear[$key]);
                          }
                        //小房间
                        if(!empty($arr['small_num'])){
                            foreach ($arr['small_num'][$key] as $ke => $va) {
                                $ar[$key][$ke]['detailscoll']=$va;
                                $ar[$key][$ke]['big_sum']=$arr['small_sum'][$key][$ke];
                                $ar[$key][$ke]['pro_id']=$id;
                                $ar[$key][$ke]['det_type']='4';
                                $ar[$key][$ke]['det_time']=time();

                                
                            }
                        //print_r($ar[$key]);echo "<br>";
                        $details->addAll($ar[$key]);
                        }
                        //大面积
                        if(!empty($arr['big_num'])){
                            foreach ($arr['big_num'][$key] as $ke => $va) {
                                $big[$key][$ke]['detailscoll']=$va;
                                $big[$key][$ke]['big_sum']=$arr['big_sum'][$key][$ke];
                                $big[$key][$ke]['pro_id']=$id;
                                $big[$key][$ke]['det_type']='1';
                                $big[$key][$ke]['det_time']=time();                               
                            }
                        //print_r($big[$key]);
                        $details->addAll($big[$key]);
                        }                      
                  }           
            } 
           
            $this->success('添加成功', U('Project/project_detail',array('pro_id'=>$datas['class_id'][0])));
        }else{
            $class_id=I('get.class_id');
            $this->assign('class_id',$class_id);
            $this->display();
        }
    }
    

    /*一键预留*/
    public function project_one(){
        $data=I('post.det_id');
        $nn['id']=array('in',$data);
        M('details')->where($nn)->save(array('det_advance'=>2));
        $data=explode(",",$data);
        foreach ($data as $key => $value) {
                $arr[$key]['det_id']=$value;
                $arr[$key]['middle_id']=I('post.y_id');
                $arr[$key]['res_state']=1;
                $arr[$key]['add_time']=time();
        }
        $res=M('reserved')->addAll($arr);
        if($res){
          $this->success('添加成功');
        }else{
          $this->error('添加失败');
        }
      }

      
}
<?php
namespace Home\Controller;
use Think\Controller; 
class PactController extends Controller {
   /*合同*/
    public function pact_wait(){


    }
    /**
     * 
     * @return [type] [出合同页面]
     */
    public function pact_add()
    {
    	$id =I('get.id');
    	$client = M('client as c')
        ->field('middle_name,middle_man,middle_tel,middle_address,middle_is,middle_state,c.id,client_name,nuddke_id,client_man,client_tel,client_address,client_money,legalperson,legaltel,legalidnum,other_man,other_tel,client_state,taxstyle')
        ->join('left join dhd_middle as m on c.nuddke_id = m.id')
        ->where(array('c.id'=>$id))->find();
    	foreach ($client as $k => $v) {
    		if(empty($v)){
    			unset($client[$k]);
    		}
    	}
    	// 预留地址信息
    	$reserved = M('reserved as r')
        ->field('d.id,d.detailscoll,p.pro_address,c.class_name')
        ->join('dhd_details as d on d.id = r.details_id')
        ->join('dhd_product as p on p.id = d.pro_id')
        ->join('dhd_class as c on c.id = p.class_id')
        ->where(array('client_id'=>$client['id']))->find();
    	// print_r($reserved);die;
    	// 财务账户
    	$account = M('account')->field('id,acc_name')->select();
    	// 业务员信息
    	$role = M('role')->field('id,role_name')->where(array('pid'=>0,'state'=>0))->select();
    	// 产品项目信息
    	$project = M('class')->field('id,class_name')->where(array('class_is'=>0))->select();
    	// print_r($project);
    	if(!empty($client['middle_state'])){
	    	if($client['middle_state'] == 0){
	    		$client['middle_state'] = '中间商';
	    	}
	    	if($client['middle_state'] == 1){
	    		$client['middle_state'] = '中介';
	    	}
	    	if($client['middle_state'] == 2){
	    		$client['middle_state'] = '平台';
	    	}
    		}else{
    			$client['middle_state'] = '直接客户';
    	}
    	if(empty($reserved)){
    		$reserved = 1;
    	}
    	$this->assign('reserved',json_encode($reserved));
    	$this->assign('project',json_encode($project));
    	$this->assign('client',$client);
    	$this->assign('account',$account);
    	$this->assign('role',$role);
    	$this->display();
    }
    public function pactadd_do()
    {
    	$contracttype = I('post.contracttype');
    	$data = I('post.');
        // print_r(I('post.paynext2'));die;
    		// 合同表信息添加数据
			// echo $contracttype;die;
    	if($contracttype != '0' || $contracttype != '会议室出租'){
    		$contract['client_id'] = I('post.client_id');
		    $contract['ac_time'] = inttime(I('post.ac_time'));
		    $contract['contractnature'] = I('post.contractnature');
		    $contract['contracttype'] = I('post.contracttype');
		    $contract['account_id'] = I('post.account_id');
		    $contract['stencil_id'] = I('post.stencil');
            $contract['det_id'] = I('post.details_id');
            $contract['actual_amount'] = I('post.actual_amount');
		    $contract['res_id'] = I('post.res_id');
		    $contract['user_id'] = get_user_id();
	    	$res = M('contract')->add($contract);	
	    	
	    	if($res){
		    	if($contracttype=='大面积出租'){
		    		// 大面积合同信息添加内容
		    		$largearea['details_id'] = I('post.details_id');
		    		$largearea['contract'] = $res;
		    		$largearea['rentdatetime'] = I('post.rentdatetime');
		    		$largearea['rentstarttime'] = inttime(I('post.rentstarttime'));
		    		$largearea['rentendtime'] = inttime(I('post.rentendtime'));
		    		$largearea['freetime'] = I('post.freetime');
		    		$largearea['freestarttime'] = inttime(I('post.freestarttime'));
		    		$largearea['freeendtime'] = inttime(I('post.freeendtime'));
		    		$largearea['increasing'] = I('post.increasing');
		    		$largearea['increayear'] = I('post.increayear');
		    		$largearea['rates'] = I('post.rates');
		    		$largearea['zjistax'] = I('post.zjistax');
		            $re = M('largearea')->add($largearea);
		        }
		        if($contracttype=='mini房间'){
		        	// 小房间合同信息添加内容
		        	$houselet['details_id'] = I('post.details_id');
		        	$houselet['contract'] = $res;
		        	$houselet['rentdatetime'] = I('post.rentdatetime');
		        	$houselet['rentstarttime'] = inttime(I('post.rentstarttime'));
		        	$houselet['rentendtime'] = inttime(I('post.rentendtime'));
		        	$houselet['business'] = I('post.business');
		        	$houselet['swistax'] = I('post.swistax');
		        	$houselet['rates'] = I('post.rates');
		        	$houselet['zjistax'] = I('post.zjistax');

		            $re = M('houselet')->add($houselet);
		        }
		        if($contracttype=='工位注册办公'){
		        	// 工位注册办公合同信息内容
		        	$registration['contract'] = $res;
		        	$registration['business'] = I('post.business');
		        	$registration['station'] = I('post.station');
		        	$registration['rentdatetime'] = I('post.rentdatetime');
		        	$registration['rentstarttime'] = inttime(I('post.rentstarttime'));
		        	$registration['rentendtime'] = inttime(I('post.rentendtime'));
		        	$registration['details_id'] = I('post.details_id');
		        	$registration['ggistax'] = I('post.ggistax');

		            $re = M('registration')->add($registration);
		        }
		        if($contracttype=='注册地址'){
		        	// 工位注册合同信息内容
		        	$register['contract'] = $res;
		        	$register['details_id'] = I('post.details_id');
		        	$register['station'] = I('post.station');
		        	$register['ggistax'] = I('post.ggistax');
		        	$register['business'] = I('post.business');
		        	$register['rentdatetime'] = I('post.rentdatetime');
		        	$register['rentstarttime'] = inttime(I('post.rentstarttime'));
		        	$register['rentendtime'] = inttime(I('post.rentendtime'));
		  
		            $re = M('register')->add($register);
		        }
		        if($contracttype=='代理记账'){

		        	// 代理记账合同信息内容
		        	$tally['contract']= $res;
		        	$tally['details_id'] = 1;
		        	$tally['rentstarttime']= inttime(I('post.rentstarttime'));
		        	$tally['rentendtime']= inttime(I('post.rentendtime'));
		        	$tally['ta_kmoney']= I('post.ta_kmoney');
		        	$tally['ta_kis']= I('post.ta_kis');
		        	$tally['ta_gmoney']= I('post.ta_gmoney');
		        	$tally['ta_gis']= I('post.ta_gis');
		        	$tally['ta_istaxcontrol']= I('post.ta_istaxcontrol');
		        	$tally['ta_skistax']= I('post.ta_skistax');
		        	$tally['ta_skmoney']= I('post.ta_skmoney');
		        	$tally['skstarttime']= inttime(I('post.skstarttime'));
		        	$tally['skendtime']= inttime(I('post.skendtime'));

		            $re = M('tally')->add($tally);
		        }
		        if($contracttype=='工位不注册办公'){
		        	// 工位不注册办公合同信息内容
		        	$regclosed['contract']= $res;
		        	$regclosed['station']= I('post.station');
		        	$regclosed['ggistax']= I('post.ggistax');
		        	$regclosed['rentdatetime']= I('post.rentdatetime');
		        	$regclosed['rentstarttime']= inttime(I('post.rentstarttime'));
		        	$regclosed['rentendtime']= inttime(I('post.rentendtime'));
		        	$regclosed['details_id']= I('post.details_id');
		            $re = M('regclosed')->add($regclosed);
		        }
		        if($contracttype=='工商代理'){

		        	$industrial['contract'] = $res;
		        	$tally['details_id'] = 2;
		        	$industrial['entrust'] = I('post.entrust');
		        	$industrial['business'] = I('post.business');
		        	$industrial['swistax'] = I('post.swistax');
		            $re = M('industrial')->add($industrial);
		        }		        
		       
		       
	       		if($re){

	       			$collection['contract'] = $res;
	       			$collection['appoint'] = I('post.appoint');
	       			$collection['overdue'] = I('post.overdue');
	       			$collection['paytype'] = I('post.paytype');
	       			$collection['monthly_rent'] = I('post.monthly_rent');
	       			$collection['year_rent'] = I('post.year_rent');
	       			$collection['deposit'] = I('post.deposit');
	       			$collection['each'] = I('post.each');
	       			$collection['paynext1'] = inttime(I('post.paynext1'));
                    $paynext2 = I('post.paynext2');
                    foreach ($paynext2 as $k => $v) {
                        $time[] = inttime($v);
                    }
                    $paynext = implode(',',$time);
                    // print_r($paynext);die;
	       			$collection['paynext2'] = $paynext;
	       			$r = M('collection')->add($collection);
	       			if($r){
                        // die;
	       				$this->success('合同新增成功', U('Pend/pend_index'));
			        }else{
			            $this->error('合同新增失败',U('Pend/pend_index'));
			        }
	       		}else{
	       			$this->error('合同添加失败',U('Pend/pend_index'));
	       		}
       		}else{
       			$this->error('合同信息录入失败',U('Pend/pend_index'));
       		}
            
        }

    }
    public function pact_audit()
    {
    	$id =I('get.id');
    	$contract = M('contract')->where(array('id'=>$id))->find();
    	$client = M('client as c')->field('middle_name,middle_man,middle_tel,middle_address,middle_is,middle_state,c.id,client_name,nuddke_id,client_man,client_tel,client_address,client_money,legalperson,legaltel,legalidnum,other_man,other_tel,client_state,taxstyle')->join('left join dhd_middle as m on c.nuddke_id = m.id')->where(array('c.id'=>$contract['client_id']))->find();
    	$contracttype = $contract['contracttype'];
    	$contractid['contract'] = $contract['id']; 
    	if($contracttype=='大面积出租'){
    		// 大面积合同信息添加内容
            $matter = M('largearea')->where($contractid)->find();
        }
        if($contracttype=='mini房间'){
        	// 小房间合同信息添加内容
            $matter = M('houselet')->where($contractid)->find();
        }
        if($contracttype=='工位注册办公'){
        	// 工位注册办公合同信息内容
            $matter = M('registration')->where($contractid)->find();
        }
        if($contracttype=='注册地址'){
        	// 工位注册合同信息内容
            $matter = M('register')->where($contractid)->find();
        }
        if($contracttype=='代理记账'){

        	// 代理记账合同信息内容
            $matter = M('tally')->where($contractid)->find();
        }
        if($contracttype=='工位不注册办公'){
        	// 工位不注册办公合同信息内容
            $matter = M('regclosed')->where($contractid)->find();
        }
        if($contracttype=='工商代理'){
			// 工商代理合同信息内容
            $matter = M('industrial')->where($contractid)->find();
        }
        $collection = M('collection')->where($contractid)->find();
        $paty = explode(',',$collection['paytype']);
        $ya = numToWord($paty[0]);
        $fu = numToWord($paty[1]);
        $collection['paytypehan'] = '押'.$ya.'付'.$fu;
        $collection['paynext2'] = explode(',' , $collection['paynext2']);
        $prod = M('details as d ')
        ->field('d.detailscoll,d.big_sum,p.pro_address,c.class_name,d.id')
        ->join('dhd_product as p on d.pro_id = p.id')
        ->join('left join dhd_class as c on p.class_id = c.id')
        ->where(array('d.id'=>$matter['details_id']))
        ->find();
        // print_r($prod);die;
    	
    	// // 财务账户
        $account = M('account')->field('id,acc_name')->select();
        // // 合同收款账户
    	$shoukuan = M('account')->where(array('id' => $contract['account_id']))->find();
    	// // 产品项目信息
    	$project = M('class')->field('id,class_name')->where(array('class_is'=>0))->select();
    	// 客户中间商情况处理
    	if(!empty($client['middle_state'])){
	    	if($client['middle_state'] == 0){
	    		$client['middle_state'] = '中间商';
	    	}
	    	if($client['middle_state'] == 1){
	    		$client['middle_state'] = '中介';
	    	}
	    	if($client['middle_state'] == 2){
	    		$client['middle_state'] = '平台';
	    	}
    	}else{
			$client['middle_state'] = '直接客户';
    	}
        // 合同模板信息
        $stencil = M('stencil')
        ->where(array('id'=>$contract['stencil_id']))->find();
        // 预留地址信息
        $reserved = M('reserved as r')
        ->field('d.id,d.detailscoll,p.pro_address,c.class_name')
        ->join('dhd_details as d on d.id = r.details_id')
        ->join('dhd_product as p on p.id = d.pro_id')
        ->join('dhd_class as c on c.id = p.class_id')
        ->where(array('client_id'=>$client['id']))->find();
    	
    	// print_r($shoukuan);die;
        $this->assign('stencil',$stencil);
        $this->assign('shoukuan',$shoukuan);
    	$this->assign('reserved',$reserved);
    	$this->assign('client',$client);
    	$this->assign('contract',$contract);
    	$this->assign('matter',$matter);
        $this->assign('collection',$collection);
    	$this->assign('prod',$prod);
    	$this->assign('account',$account);
        $this->assign('project',$project);
    	$this->display();
    }
    public function pactaudit_do()
    {
        $data = I('post.');

        
        // print_r($data);die;
            // 合同表信息添加数据
            $contracttype = I('post.contracttype');
        
            $where['contract_id'] = I('post.contract_id');
            // print_r($where);die;
            $contract['ac_time'] = inttime(I('post.ac_time'));
            $contract['contractnumber'] = I('post.contractnumber');
            $contract['contractnature'] = I('post.contractnature');
            $contract['account_id'] = I('post.account_id');
            $contract['stencil_id'] = I('post.stencil_id');
            
            $contract['account_audit'] = 2;
            $contract['actual_amount'] = I('post.actual_amount');
            $contract['user_id'] = get_user_id();
            $res = M('contract')->where(array('id' =>  $where['contract_id']))->save($contract);   
            
            if($res){
                if($contracttype=='大面积出租'){
                    // 大面积合同信息添加内容
                   
                    $largearea['rentdatetime'] = I('post.rentdatetime');
                    $largearea['rentstarttime'] = inttime(I('post.rentstarttime'));
                    $largearea['rentendtime'] = inttime(I('post.rentendtime'));
                    $largearea['freetime'] = I('post.freetime');
                    $largearea['freestarttime'] = inttime(I('post.freestarttime'));
                    $largearea['freeendtime'] = inttime(I('post.freeendtime'));
                    $largearea['increasing'] = I('post.increasing');
                    $largearea['increayear'] = I('post.increayear');
                    $largearea['rates'] = I('post.rates');
                    $largearea['zjistax'] = I('post.zjistax');
                    $re = M('largearea')->where($where)->save($largearea);
                }
                if($contracttype=='mini房间'){
                    // 小房间合同信息添加内容
                    $houselet['rentdatetime'] = I('post.rentdatetime');
                    $houselet['rentstarttime'] = inttime(I('post.rentstarttime'));
                    $houselet['rentendtime'] = inttime(I('post.rentendtime'));
                    $houselet['business'] = I('post.business');
                    $houselet['swistax'] = I('post.swistax');
                    $houselet['rates'] = I('post.rates');
                    $houselet['zjistax'] = I('post.zjistax');

                    $re = M('houselet')->where($where)->save($houselet);
                }
                if($contracttype=='工位注册办公'){
                    // 工位注册办公合同信息内容
                    $registration['business'] = I('post.business');
                    $registration['station'] = I('post.station');
                    $registration['rentdatetime'] = I('post.rentdatetime');
                    $registration['rentstarttime'] = inttime(I('post.rentstarttime'));
                    $registration['rentendtime'] = inttime(I('post.rentendtime'));
                    $registration['ggistax'] = I('post.ggistax');

                    $re = M('registration')->where($where)->save($registration);
                }
                if($contracttype=='注册地址'){
                    // 工位注册合同信息内容
                    $register['station'] = I('post.station');
                    $register['ggistax'] = I('post.ggistax');
                    $register['business'] = I('post.business');
                    $register['rentdatetime'] = I('post.rentdatetime');
                    $register['rentstarttime'] = inttime(I('post.rentstarttime'));
                    $register['rentendtime'] = inttime(I('post.rentendtime'));
          
                    $re = M('register')->where($where)->save($register);
                }
                if($contracttype=='代理记账'){

                    // 代理记账合同信息内容
                    $tally['rentstarttime']= inttime(I('post.rentstarttime'));
                    $tally['rentendtime']= inttime(I('post.rentendtime'));
                    $tally['ta_kmoney']= I('post.ta_kmoney');
                    $tally['ta_kis']= I('post.ta_kis');
                    $tally['ta_gmoney']= I('post.ta_gmoney');
                    $tally['ta_gis']= I('post.ta_gis');
                    $tally['ta_istaxcontrol']= I('post.ta_istaxcontrol');
                    $tally['ta_skistax']= I('post.ta_skistax');
                    $tally['ta_skmoney']= I('post.ta_skmoney');
                    $tally['skstarttime']= inttime(I('post.skstarttime'));
                    $tally['skendtime']= inttime(I('post.skendtime'));

                    $re = M('tally')->where($where)->save($tally);
                }
                if($contracttype=='工位不注册办公'){
                    // 工位不注册办公合同信息内容
                    $regclosed['station']= I('post.station');
                    $regclosed['ggistax']= I('post.ggistax');
                    $regclosed['rentdatetime']= I('post.rentdatetime');
                    $regclosed['rentstarttime']= inttime(I('post.rentstarttime'));
                    $regclosed['rentendtime']= inttime(I('post.rentendtime'));
                    $re = M('regclosed')->where($where)->save($regclosed);
                }
                if($contracttype=='工商代理'){

                    $industrial['entrust'] = I('post.entrust');
                    $industrial['business'] = I('post.business');
                    $industrial['swistax'] = I('post.swistax');
                    $re = M('industrial')->where($where)->save($industrial);
                }               
               
               
                if($re!==false){

                    $collection['appoint'] = I('post.appoint');
                    $collection['overdue'] = I('post.overdue');
                    $collection['paytype'] = I('post.paytype');
                    $collection['monthly_rent'] = I('post.monthly_rent');
                    $collection['year_rent'] = I('post.year_rent');
                    $collection['deposit'] = I('post.deposit');
                    $collection['each'] = I('post.each');
                    $collection['paynext1'] = inttime(I('post.paynext1'));
                    $paynext2 = I('post.paynext2');
                    foreach ($paynext2 as $k => $v) {
                        $time[] = inttime($v);
                    }
                    $paynext = implode(',',$time);
                    // print_r($paynext);die;
                    $collection['paynext2'] = $paynext;
                    $r = M('collection')->where($where)->save($collection);
                    if($r!== false){
                        // die;
                        $this->success('合同审核成功', U('Pend/pend_index'));
                    }else{
                        $this->error('合同审核失败',U('Pend/pend_index'));
                    }
                }else{
                    $this->error('合同审核有误',U('Pend/pend_index'));
                }
            }else{
                $this->error('合同信息审核失败',U('Pend/pend_index'));
            }
            
        

    }
    /**
     * /
     * @return [type] 返回银行账户信息
     */
    public function account()
    {
    	$id = I('post.id');
    	$res = M('account')->where(array('id'=>$id))->find();
    	returnajax($res);
    }
    /**
     * /
     * @return [type] [业务员联动返回职位信息]
     */
    public function role_sel()
    {
    	$id = I('post.id');
    	$role = M('role')->where(array('pid'=>$id,'state'=>0))->select();
    	returnajax($role);
    }
    /**
     * /
     * @return [type] [业务员联动返回人员信息]
     */
    public function user_sel()
    {
    	$id = I('post.id');
    	$user = M('user')->field('username,id')->where(array('r_id'=>$id))->select();
    	returnajax($user);
    }
    /**
     * 
     * @return [type] 返回合同模板
     */
    public function stencil()
    {
    	$ordercate = I('post.ordercate');
    	$remarks = I('post.remarks');
    	$list = M('stencil')->field('id,stencil_name')->where(array('signcompany'=>$remarks ,'contracttype'=>$ordercate))->select();
    	returnajax($list);
    }
    /**
     * /
     * @return [type] [返回产品信息]
     */
    public function product()
    {	
    	$class_id = I('post.class_id');
    	$list = M('product')->field('id,pro_address')->where(array('class_id'=>$class_id,'pro_del'=>1))->select();
    	returnajax($list);
    }
    /**
     * /
     * @param string $value 返回产品详细信息
     */
    public function details()
    {
    	$where['pro_id'] = I('post.id');
    	$contracttype = I('post.contracttype');
    	if($contracttype == '大面积出租'){
    		$where['det_type'] = 1;
    	}
    	if($contracttype == 'mini房间'){
    		$where['det_type'] = 4;
    	}
    	if($contracttype == '工位不注册办公'){
    		$where['det_type'] = 3;
    	}
    	if($contracttype == '工位注册办公'){
    		$where['det_type'] = 3;
    	}
    	$list = M('details')->field('id,detailscoll')->where($where)->select();
    	returnajax($list);
    }
    /**
     * /
     * @param string  返回房间面积
     */
    public function room_area()
    {
    	$id = I('post.id');
    	$list = M('details')->field('big_sum')->where(array('id'=>$id))->find();
    	returnajax($list);
    }

    public function terminus()
    {
        $long=ceil(I('post.year')*12);
        $time=I('post.time');
        // echo $long;die;
        $arr = date_parse_from_format ( "Y年m月d日" , $time );
        $timestamp = mktime(0,0,0,$arr['month'],$arr['day'],$arr['year']);
        $strtime=strtotime("+$long month",$timestamp)-3600*24;
        $endtime = date("Y年m月d日",$strtime);
        returnajax($endtime);
    }
        /**
     * 免租期
     */
    public function freetime()
    {
        $time=I('post.time');
        $day=I('post.day');
        $arr = date_parse_from_format ( "Y年m月d日" , $time );
        $strtime = mktime(0,0,0,$arr['month'],$arr['day'],$arr['year']);
        $day=3600*24*($day+1);
        $data['end']=date('Y年m月d日',$strtime-3600*24);
        $data['start']=date('Y年m月d日',$strtime-$day);
        echo json_encode($data);
    }
    public function paytype()
    {

        $description = I('post.id');
        $appoint = I('post.appoint');                   //提前天数
        $monthly_rent = I('post.monthly_rent');         //月租金
        $rentendtime = I('post.rentendtime');         //租赁结束日期
        $rentstarttime = I('post.rentstarttime');       //租赁开始日期
        $tax_printer = I('post.tax_printer');       //数控机费
        $servemeny = I('post.servemeny');       //商务服务费

        $arr1 = date_parse_from_format ( "Y年m月d日" , $rentendtime );
        $rentendtime = mktime(0,0,0,$arr1['month'],$arr1['day'],$arr1['year']);//租赁结束日期
        $arr2 = date_parse_from_format ( "Y年m月d日" , $rentstarttime );
        $rentstarttime = mktime(0,0,0,$arr2['month'],$arr2['day'],$arr2['year']);//租赁开始日期
        if(!empty($appoint))
        {
            $rentendtime = $rentendtime-$appoint*86400;
            $rentstarttime = $rentstarttime-$appoint*86400;
        }
        $rentdatetime = $rentendtime-$rentstarttime;
        $number=$rentdatetime/86400/365;                            //服务期限
        $rentdatetime = round($number,1);
        if($description =="0,0")
        {
            $info['total'] = $rentdatetime*12*$monthly_rent;
        }
        else
        {
            $res = explode(',',$description);       //压几付几
            if(!empty($servemeny)){
                $info['deposit'] = $monthly_rent * $res[0];     // 押金
            }else{
                $info['deposit'] = $monthly_rent * $res[0];     // 押金
            }
           
            $info['fu'] = $monthly_rent * $res[1];          // 每期租金
            $info['total'] = $monthly_rent * $res[1]+$monthly_rent * $res[0]+$tax_printer;       // 总金额
            $num = $rentdatetime * 12 / $res[1];            // 付款期数
            $num=round($num);

            for($i=1;$i<$num;$i++)
            {
                $r = $res[1]*$i;
                $arr[$i] = date('Y年m月d日',strtotime("+$r month",$rentstarttime));
            }  
            $info['nexttime'] = $arr;
            $info['trs'] = ceil($num/2);
        
        }

        returnajax($info);
    }













}
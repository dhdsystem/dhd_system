<?php
namespace Home\Controller;
use Think\Controller;
class PactController extends Controller {
   /*合同*/
    public function pact_index(){
       $this->display();
    }
    /**
     * 
     * @return [type] [出合同页面]
     */
    public function pact_add()
    {
    	$id =I('get.id');
    	$client = M('client as c')->field('middle_name,middle_man,middle_tel,middle_address,middle_is,middle_state,c.id,client_name,nuddke_id,client_man,client_tel,client_address,client_money,legalperson,legaltel,legalidnum,other_man,other_tel,client_state,taxstyle')->join('left join dhd_middle as m on c.nuddke_id = m.id')->where(array('c.id'=>$id))->find();
    	foreach ($client as $k => $v) {
    		if(empty($v)){
    			unset($client[$k]);
    		}
    	}
    	$account = M('account')->field('id,acc_name')->select();
    	$role = M('role')->field('id,role_name')->where(array('pid'=>0,'state'=>0))->select();
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

    	$this->assign('project',json_encode($project));
    	$this->assign('client',$client);
    	$this->assign('account',$account);
    	$this->assign('role',$role);
    	$this->display();
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
        }

        returnajax($info);
    }













}
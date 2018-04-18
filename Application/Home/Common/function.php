<?php

function get_user_id() { //获取当前登录用户的ID
    return intval(session('user_id'));
}
function get_role_id() { //获取当前登录用户的ID
    return intval(session('role_id'));
}
/**
 * /操作成功ajax调用
 * @person 史炎
 * @param  [type] $info [返回值]
 * @param  [type] $data [返回数据]
 * @return [type]       [json字符串]
 * @time 2018/4/18 11:09
 */

function success_ajax($info='', $data='') { //成功提示
    exit(json_encode(array('info' => $info, 'data' => $data, 's' => 'ok')));
}


/**
 * /操作失败ajax调用
 * @person sy
 * @param  [type] $info [返回值]
 * @param  [type] $data [返回数据]
 * @return [type]       [json字符串]
 * @time 2018/4/18 11:11
 */

function error_ajax($info,  $data='') { //失败提示
     exit(json_encode(array('info' => $info, 'data' => $data, 's' => 'no')));
}

//密钥生成，用于接口校验以及前台用户密码生成
function token($data=array(), $state=false) { 
	$token = '';
	if(is_array($data)) {
		unset($data['token']);
		unset($data['user_token']);	
		$token = array_string($data);
		$token = hash_hmac('sha256', $token, C('APIKEY'));
	} else {
		$token = hash_hmac('sha256', $data, ''); 
	}
	
	if($state) $token = hash_hmac('sha256', $token, time().'_'.mt_rand(100000,999999));
	
	return $token;
}
function curls($url, $ispg='get' ,$data, $type=false, $time=120) {
	
	$data['token_time'] = time();
	$data['token'] = token($data);
	if(get_user_token()) {
		$data['user_token'] = get_user_token();
	}

	if($ispg == 'get') {
		$url = $url.'?'.http_build_query($data);
	}
	
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);								
    curl_setopt($ch, CURLOPT_HEADER, false);							
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, false); 
	
	if($ispg == 'post') {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	}
    
	$ret = curl_exec($ch);
    curl_close($ch);
	$data = json_decode($ret, true);
	
	$info = '';
	$status = false;
	if($data['status'] == 0) {
		$status = true;
	} else if($data['status'] == '-2') { //接口数据调试用参数
		$ret = json_decode($ret, true);
		$ret = $ret['data'];
		echo '<pre>';print_r($ret);exit;
    } else if($data['status'] == '10002') {
        unset_user_token();
        unset_user_info();
        unset_user_menu();
        $status = false;
        $info = C('ERRORKEY')[$data['status']];
	} else {
		$status = false;
		$info = C('ERRORKEY')[$data['status']];
	}
	
	$data = array('info' => $info, 'data' => $data['data'], 'status' => $status, 'code'=>$data['status']); 
	if(!$type) $data = json_encode($data);
	return $data;
}


/**
     * Action: 分页方法
     * User: sy
     * Date: 2017/12/7
     * Time: 上午 9:34
     */
    function pagess($table,$where="1=1",$pattern,$size=15)
    {
        $User = M($table); // 实例化User对象
        $count = $User->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,$size,$pattern);// 实例化分页类 传入总记录数和每页显示的记录数(25)

        // $Page->setConfig('header','<li class="disabled hwh-page-info"><a>共<em>%TOTAL_ROW%</em>条  <em>%NOW_PAGE%</em>/%TOTAL_PAGE%页</a><>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
       

        // print_r($Page);die;
        $show = $Page->show();// 分页显示输出
        return array('show'=>$show,'firstRow'=>$Page->firstRow,'listRows'=>$Page->listRows);
    }

 
   

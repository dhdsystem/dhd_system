<?php
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
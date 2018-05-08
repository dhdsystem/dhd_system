<?php
namespace Home\Controller;
use Think\Controller;
class WordController extends Controller {
   /*word*/
    public function word_add($file,$stencil_name){
    	$str = file_get_contents($file['tmp_name']);
    	$data = $this->stencilarray();
			foreach ($data as $k => $v) {

				$str=str_replace($k,$v,$str);

			}
			$files=md5($stencil_name).'.xml';
			$paths="./Uploads/Word/".$files;
			$dir = dirname($paths);
			if(!is_dir($dir)){
				mkdir($dir,0777,true);
			}

			$fp = fopen($paths,'w+');
			$re=fwrite($fp, $str);
			fclose($fp);
			if($re){
				return $paths;
			}else{
				return false;
			}
	}
	private  function stencilarray()
	 {
	 	$array=array(
	 		'*注册资金*'=>'client_money',
	 		'*客户公司*'=>'client_name',
	 		'*法人姓名*'=>'legalperson',
	 		'*身份证号*'=>'legalidnum',
	 		'*联系电话*'=>'legaltel',
	 		'*合同性质*'=>'contracttype',
	 		'*信用代码*'=>'contractnature',
	 		'*注册地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		'*办公地址*'=>'client_address',
	 		);
	 	return $array;
	 } 
		
}
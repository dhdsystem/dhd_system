<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
   /*登录*/
    public function login(){
       $this->display();
    }
    public function verify() {
		$Verify =     new \Think\Verify();
		$Verify->fontSize = 13;
		$Verify->useNoise = false;
		$Verify->fontttf = '6.ttf';
		$Verify->imageW = 97;
		$Verify->imageH = 36;
		$Verify->length   = 4;
		$Verify->useNoise = false;
		ob_clean();
		echo $Verify->entry();

	}
	public function login_do(){
		$code=I('post.code','');
		$res=$this->check_verify($code);
		if($res!=1){
			error_ajax('验证码填写错误',11,22);
		}

		$name = I("post.username",'');
    	if(empty($name)){
    		error_ajax("用户名或邮箱不能为空！");
    	}

    	$pass = I("post.password",'');
    	if(empty($pass)){
    		error_ajax("密码不能为空！");
    	}
	    $user = M('user');

		$where['username']=$name;
		$result = $user->where($where)->find();
		
		if($result) {
            if($result['password'] == md5($pass)) { //登入成功页面跳转
				session('user_id', $result["id"]);
				session('username', $result["username"]);
				session('role_id', $result["r_id"]);
                success_ajax('登录成功');
    		}else{
                error_ajax("密码错误！");
    		}
    	}else{
    		error_ajax("用户名不存在！");
    	}
	}
	private function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
	}
	public function quit() {
		session('[destroy]');	//销毁所有SESSION
		$this->redirect('Login/Login');
	}

}
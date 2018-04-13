<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>东辉达财务系统</title>
<link rel="stylesheet" type="text/css" href="/dhdSystem/dhd_system/Public/home/css/main.css"  />
<link rel="stylesheet" type="text/css" href="/dhdSystem/dhd_system/Public/home/css/public.css"  />
<style>
.wrap{padding: 26px; border: 1px solid #ddd; background: #fff;width: 18%;font-family: '微软雅黑';box-shadow: 0px 35px 30px -31px rgba(0, 0, 0, 0.44);position: fixed;bottom: 20px;right: 14px;}
.wrap .hide-a{color: #444;text-decoration: none;float: right;}
.wrap .hide-a:hover{color: red;}
.wrap .dowebok{clear: both;margin: 0 auto; line-height: 34px; height:200px !important;font-size: 14px;}
.dowebok li { overflow: hidden; zoom: 1;}
.dowebok a { color: #333; text-decoration: none;}
.dowebok a:hover { color: #000;}
</style>
<script type="text/javascript" src="/dhdSystem/dhd_system/Public/home/js/jquery.js"></script>
<script type="text/javascript" src="/dhdSystem/dhd_system/Public/home/js/Public.js"></script>
<script type="text/javascript" src="/dhdSystem/dhd_system/Public/home/js/winpop.js"></script>
<script src="/dhdSystem/dhd_system/Public/home/js/jquery.vticker.min.js"></script>
<script>
window.onload=function() {
	//退出登录
	function quit() {
		$('body #quit').click(function(event) {
			event.preventDefault();
			if (confirm('确定要退出吗？')) {
				window.top.location.href='/dhdSystem/dhd_system/?s=Home/Login/quit';
			}
		});
	}
	quit();
	$('#home').click(function() {
		window.top.location.href='/dhdSystem/dhd_system/?s=Home/Index/main';
	});
    $('#main #user_save').click(function() {
		popload('修改密码',800,300,'/dhdSystem/dhd_system/?s=Home/Index/uedit/');
		addDiv($('#iframe_pop'));
	});
	//一键清空缓存
	$('#main #cache').click(function() {
		if (confirm('确定要清空所有缓存吗？')) {
			wintq('正在清除缓存，请稍后...',4,60000,0,'');
			$.ajax({
				url:'/dhdSystem/dhd_system/?s=Home/Common/clearcache/',
				dataType:'JSON',
				type:'POST',
				data:'clear=ok',
				success: function(data) {
					if (data.s=='ok') {
						wintq('更新缓存成功！',1,1000,1,'');
					}else {
						wintq(data.s,3,1000,1,'');
					}
				}
			});
		}
	});
	
}
$(function() {
	// 导航效果显示
	for (i=0; i<$('#left dl').size(); i++) {
		$dldd=$('#left dl').eq(i);
		if ($dldd.find('dd').size() < 1) {
			$dldd.remove();
		}
	}
	$('#ul li .a').click(function() {
		$('#ul li .a').removeClass('lia');
		$(this).addClass('lia');
		$('#ul li dl').stop().slideUp('fast');
		var $dl = $(this).parents('li').find('dl');
		$dl.stop().slideToggle('fast');
		$dl.find('a').click(function() {
			$('#ul li dl dd a').removeClass('dla');
			$(this).addClass('dla');
		});
	});

	// 过期提醒
	$('.dowebok').vTicker({
		showItems: 5,
		pause: 3000
	});
	$('.hide-a').click(function(){
		$('.wrap').hide(1000);
	})
});

</script>
</head>
<body>
<div id="main">
    <div id="top">
    	<div class="top_left">
        	<div class="top_left1">
				<a href="" class="logo_img">
					<img alt="68051257880" class="" src="/dhdSystem/dhd_system/Public/home/images/home/logo.jpg">
					<a href="#" title="东辉达财务管理系统" style="font-size: 18px;color: #fff;text-decoration: none;margin-left: 6px;">东辉达财务管理系统</a>
				</a>
				<p>欢迎您：<font><?php echo session('username'); ?></font></p>	
            </div>
        </div>
        <div class="top_right">
        	<span id="user_save"><img src="/dhdSystem/dhd_system/Public/home/images/home/mima.png" border="0"  height="23" style="top: 6px;" />修改密码</span>&nbsp;&nbsp;&nbsp;&nbsp;
			<span id="quit"><img src="/dhdSystem/dhd_system/Public/home/images/home/tuichu.png" border="0"   height="26" />退出登录</span>
        </div>
    </div>
    <div id="left">
    	<ul id="ul">
        	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li>
	               	<a class="a" href="<?php if($li["controller"] == ''): ?>javascript:;<?php else: ?>/dhdSystem/dhd_system/?s=Home/<?php echo ($li["controller"]); endif; ?>" target="c"><?php echo ($li["opera_name"]); if ($li['opera_name']=='财务管理'): ?>
	                		<font color="#fff"><span class="flush"><?php echo ($count); ?></span></font>
	                	<?php endif ?></a>
	            	<dl>
	            		<?php if(is_array($volist)): foreach($volist as $key=>$va): if(is_array($va)): foreach($va as $key=>$vo): if($li['id'] == $vo['p_id']): if($vo['action'] == ''): $vo['action']='index'; endif; ?>

			                		<dd>
			                			<a href="<?php if($vo["controller"] == ''): ?>javascript:;<?php else: ?>/dhdSystem/dhd_system/?s=Home/<?php echo ($vo["controller"]); ?>/<?php echo ($vo['action']); endif; ?>" target="c"><?php echo ($vo["opera_name"]); ?> <?php if ($vo['opera_name']=='合同管理'): ?>
			                		<font color="#fff"><span class="flush"><?php echo ($count); ?></span></font>
			                	<?php endif ?></a>
			                		</dd><?php endif; endforeach; endif; endforeach; endif; ?>
	                </dl>
	            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
	<div class="wrap">
		预留号码过期提醒
		<a href="#" class="hide-a">×</a>
		<div class="dowebok">
			<ul id="ull">
				<!-- <li>1、<a href="/dhdSystem/dhd_system/?s=Home/Client/index" target="c">123123</a></li> -->
			</ul>
		</div>
	</div>
    <div id="right">
    	<iframe id="ifdd" name="c" height="100%" width="100%" border="0" frameborder="0" src="/dhdSystem/dhd_system/?s=Home/Index/content/">浏览器不支持嵌入式框架，或被配置为不显示嵌入式框架。</iframe>
    </div>
</div>
</body>

</html>
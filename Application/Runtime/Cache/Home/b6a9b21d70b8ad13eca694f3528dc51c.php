<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>添加新权限</title>
<link rel="stylesheet" type="text/css" href="/dhdSystem/dhd_system/Public/home/css/content.css"  />
<link rel="stylesheet" type="text/css" href="/dhdSystem/dhd_system/Public/home/css/public.css"  />
<script type="text/javascript" src="/dhdSystem/dhd_system/Public/home/js/jquery.js"></script>
<script type="text/javascript" src="/dhdSystem/dhd_system/Public/home/js/Public.js"></script>
<script type="text/javascript" src="/dhdSystem/dhd_system/Public/home/js/winpop.js"></script>
<script type="text/javascript" src="/dhdSystem/dhd_system/Public/home/js/jquery.validate.js"></script>
<!-- <script type="text/javascript" src="/dhdSystem/dhd_system/Public/home/js/check.js"></script> -->
<style>	
	.error{float: left;color:red;line-height: 40px;}
</style>
<script>
function validform(){
	jQuery.validator.addMethod("english", function(value, element) {
	    var chrnum = /^([a-zA-Z]+)$/;
	    return this.optional(element) || (chrnum.test(value));
	}, "只能输入字母");
	

	return  $("#add").validate({
            rules : {
                sid : {required:true },
                cname : { required : true},
                controller : { required : true, english:["a","f"]},
                // action : { required : true, english:["a","f"] },
                grade : {required : true,number:true}
            },
            messages : {
                sid : {required:'请选择权限分类' },
                cname : { required : '权限名称不得为空！'   },
                controller : { required : '控制器不得为空！', },
                // action : { required : '方法不得为空！' },
                grade : {required : '不能为空',number:'请输入合法的数字' }  
            },
            	});
            }
        $(document).ready(function(){
        $(validform());
        $(".button").click(function(){
         if(validform().form()) {
            
            	var sid=$('#dl dd .select').val();
				var cname=$('#cname').val();
				var controller=$('#controller').val();
				var action=$('#action').val();
				var grade=$('#grade').val();
				var description=$('#dl dd .textarea').val();

				wintq('正在添加，请稍后...',4,20000,0,'');
				$.ajax({
					url:'/dhdSystem/dhd_system/?s=Home/Diction/diction_add',
					dataType:'json',
					type:'POST',
					data:'p_id='+sid+'&opera_name='+cname+'&explain='+description+'&controller='+controller+'&action='+action+'&grade='+grade,
					success: function(data) {
						if (data=='1') {
							wintq('添加成功',1,1500,0,'');
							
							//document.getElementById(content).style.display="none";
							window.location.href='/dhdSystem/dhd_system/?s=Home/diction/diction_index';
						}else {
							wintq('添加失败',3,1500,1,'?');
							 window.location.href='/dhdSystem/dhd_system/?s=Home/diction/diction_add';
						
						}
					}
				});
            };
        });
	})

</script>
</head>
<body>
<div id="content" >
	<h1>首页 &gt; 权限管理 &gt; 权限信息&gt; 添加权限</h1>
	<h2>
    	<div class="h2_left">
            <a href="javascript:history.back();" class="Retreat">后退</a>
        </div>
    </h2>
	<form id="add">
		<dl id="dl">   	
	        <dd>
	        	<span class="dd_left">权限分类：</span>
	            <span class="dd_right">
	            	<select name="p_id" class="select qtext" style="height: 40px; width: 605px;" name="sid">
	                	<option value="0">顶级目录</option>
	                    <?php if(is_array($node)): foreach($node as $key=>$vo): ?><option value="<<?php echo ($vo["id"]); ?>>"><<?php echo ($vo["name"]); ?>><<?php echo ($vo["opera_name"]); ?>></option><?php endforeach; endif; ?>
	                </select>
	            </span>
	        </dd>
	        <dd>
	        	<span class="dd_left">权限名称：</span>
	        	<span class="dd_right">
	        		<input type="text" id="cname" class="qtext" placeholder="* 输入如：用户管理" style="height: 40px; width: 595px;" name="cname"/>
	        	</span>
	        </dd>
	        
	        <dd>
	        	<span class="dd_left">控制器：</span>
	            <span class="dd_right"><input type="text"  placeholder="* 输入如：role" id="controller"  style="height: 40px; width: 595px;" class="qtext" name="controller"/></span>
	        </dd>
	        <dd>
	        	<span class="dd_left">方法：</span>
	            <span class="dd_right"><input type="text" style="height: 40px; width: 595px;"   placeholder="* 输入如：roleadd" id="action" class="qtext" name="action"/></span>
	        </dd>
	        <dd>
	        	<span class="dd_left">权限优先级：</span>
	            <span class="dd_right">
	            	<input type="text" style="height: 40px; width: 595px;"   placeholder="*输入数字" id="grade" class="qtext" name="grade"/>
				</span>
	        </dd>       
	        <dd>
	        	<span class="dd_left">权限说明：</span>
	            <span class="dd_right">
	            	<textarea name="description" class="textarea" style="width: 606px;"></textarea>
	            </span>
	        </dd>
	        <dd><input type="button" class="button" value="提 交" /></dd>
	        <div style="clear:both;"></div>
	    </dl>
    </form>
</div>
</body>
</html>
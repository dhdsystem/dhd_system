<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<title>用户管理</title>
<link rel="stylesheet" type="text/css" href="/dhd_system/Public/home/css/content.css"  />
<link rel="stylesheet" type="text/css" href="/dhd_system/Public/home/css/public.css"  />
<script type="text/javascript" src="/dhd_system/Public/home/js/jquery.js"></script>
<script type="text/javascript" src="/dhd_system/Public/home/js/Public.js"></script>
<script type="text/javascript" src="/dhd_system/Public/home/js/winpop.js"></script>
<script>
$(document).ready(function() {
	$('#content #table .tr .edit').click(function(event) {
		event.preventDefault();
		var id=$(this).attr('href');
		if (id=='' || isNaN(id)) {
			wintq('ID参数不正确',3,1000,1,'');
			return false;
		}else {
			popload('修改用户信息',800,420,'/dhd_system/?s=Home/User/saveuser/id/'+id);
			addDiv($('#iframe_pop'));
			popclose();
		}
	});
	$('#content #table .tr .del').click(function(event) {
		event.preventDefault();
		if (!confirm('确定要删除该数据吗？')) {
			return false;
		}
		var id=$(this).attr('href');
		if (id=='' || isNaN(id)) {
			wintq('ID参数不正确',3,1000,1,'');
			return false;
		}else {
			wintq('正在删除，请稍后...',4,1000,0,'');
			$.ajax({
				url:'/dhd_system/?s=Home/User/userdel/',
				dataType:'json',
				type:'POST',
				data:'id='+id,
				success: function(data) {
					if (data.s=='ok') {
						wintq('删除成功',1,1500,0,'?');
					}else {
						wintq(data.s,3,1500,1,'');
					}
				}
			});
		}
	});
	$('#dely').click(function(event) {
		event.preventDefault();
		if (!confirm('确定要删除选择项吗？')) {
			return false;
		}
		var delid='';
		for (i=0; i<$('#table .delid').size(); i++) {
			if (!$('#table .delid').eq(i).attr('checked')==false) {
				delid=delid+$('#table .delid').eq(i).val()+',';
			}
		}
		if (delid=='') {
			wintq('请选中后再操作',2,1500,1,'');
		}else {
			wintq('正在删除，请稍后...',4,20000,0,'');
			$.ajax({
				url:'/dhd_system/?s=Home/User/in_user_del/',
				dataType:'JSON',
				type:'POST',
				data:'delid='+delid,
				success: function(data) {
					if (data.s=='ok') {
						wintq('删除成功',1,1500,0,'?');
					}else {
						wintq(data.s,3,1500,1,'');
					}
				}
			});
		}
	});
});
</script>
</head>
<body>
<div id="content">
	<h1>首页 > 权限管理 > 用户管理</h1>
    <h2>
    	<div class="h2_left">
            <a href="/dhd_system/?s=Home/User/user_add" class="add">新增</a>
            <a href="javascript:history.back();" class="Retreat">后退</a>
        </div>
    </h2>
  	<div class="tableBox">
  		<table id="table" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
	    	<tr>
	        	<th><input type="checkbox" class="indel" value="del" /></th>
	        	<th>编号</th>
	            <th>用户名</th>
	            <th>用户真实名</th>
	            <th>用户角色</th>
	            <th>角色描述</th>
	            <th>状态</th>
	            <th>最后登录日期</th>
	            <th>操作</th>
	        </tr>
	        <?php if($volist == 0): ?><tr class="tr"><td class="tc" colspan="11">暂无数据，等待添加～！</td></tr><?php endif; ?>
	        <!--顶级数据-->
	        <?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr <?php if(($mod) == "1"): ?>tr2<?php endif; ?>">
	        	<td class="tc"><input type="checkbox" class="delid" value="<?php echo ($vo["id"]); ?>" /></td>
	            <td class="tc"><?php echo ($vo["id"]); ?></td>
	            <td class="tc"><?php echo ($vo["username"]); ?></td>
	            <td class="tc"><?php echo ($vo["real_name"]); ?></td>
	            <td class="tc"><?php echo ($vo["role_name"]); ?></td>
	            <td class="tc"><?php echo ($vo["description"]); ?></td>
	            <td class="tc">
	            <?php if($vo["state"] == 0): ?><img src="/dhd_system/Public/home/images/home/yes.png" border="0" title="正常" />
	            <?php else: ?>
	            <img src="/dhd_system/Public/home/images/home/no.png" border="0" title="锁定" /><?php endif; ?>
	            </td>
	            <td class="tc"><?php echo (date('Y-m-d H:i:s',$vo["dtime"])); ?></td>
	            <td class="tc fixed_w">
					<a href="<?php echo ($vo["id"]); ?>" class="edit oper">修改</a>
					<a href="<?php echo ($vo["id"]); ?>" class="del oper">删除</a>
	            </td>
	        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	    </table> 
  	</div>
   	

   
    
    <div id="page"><a href="javascript:;" class="selbox">全选</a><a href="javascript:;" class="anti">反选</a><a href="javascript:;" class="unselbox">全不选</a><a href="javascript:;" id="dely">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($page); ?></div>
</div>
</body>
</html>
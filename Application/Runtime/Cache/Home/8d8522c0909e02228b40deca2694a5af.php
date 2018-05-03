<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>报销管理</title>
<link rel="stylesheet" type="text/css" href="/dhd_system/dhd_system/Public/home/css/content.css"  />
<link rel="csssheet" type="text/css" href="/dhd_system/dhd_system/Public/home/css/public.css"  />
<script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/jquery.js"></script>
<script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/Public.js"></script>
<script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/winpop.js"></script>
<script>
$(document).ready(function() {
/*	$('#content #table .tr .edit').click(function(event) {
		event.preventDefault();
		var id=$(this).attr('href');
		if (id=='' || isNaN(id)) {
			wintq('ID参数不正确',3,1000,1,'');
			return false;
		}else {
			popload('修改账户信息',800,410,'/dhd_system/dhd_system/?s=Home/Role/roleedit/id/'+id);
			addDiv($('#iframe_pop'));
			popclose();
		}
	});*/
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
			wintq('正在删除，请稍后...',4,20000,0,'');
			$.ajax({
				url:'/dhd_system/dhd_system/?s=Home/Role/roledel/',
				dataType:'json',
				type:'POST',
				data:'id='+id,
				success: function(data) {
					// alert(data);
					if (data.s=='ok') {
						wintq(data['info'],1,1500,1,'?');
					}else {
						wintq(data['info'],3,1500,1,'');
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
	<h1>首页 > 费用管理 > 报销管理</h1>
    <h2>
    	<div class="h2_left">
            <a href="/dhd_system/dhd_system/?s=Home/Repay/repay_add" class="add">新增</a>
        </div>
        <div class="search">
        <form action="/dhd_system/dhd_system/?s=Home/repay/repay_search" method="post">
            
                <input type="text" name="keyword" class="text" value="">
                <input type="submit" class="so" value="搜 索">
            </form>
        </div>
    </h2>
    <div class="tableBox">
	   	<table id="table" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0" style="width:100%;">
	    	<tr>
	        	<th>费用类型</th>
	            <th>申请金额</th>
	            <th>申请部门</th>
	            <th>申请人员</th>
	            <th>申请时间</th>
	            <th>审核进度</th>            
	            <th>操作</th>
	        </tr>
	        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr" value="1">
	            <td class="tc"><?php echo ($vo["yijikemu"]); ?></td>
	            <td class="tc"><?php echo ($vo["money"]); ?></td>
	            <td class="tc"><?php echo ($vo["department"]); ?></td>
	            <td class="tc"><?php echo ($vo["applicant"]); ?></td>
	            <td class="tc"><?php echo (date('Y-m-d',$vo["declare"])); ?></td>
	            <td class="tc"> <?php if($vo["level"] == '1'): ?>待审核<?php endif; ?></td>
	            <td class="tc fixed_w">
	            <a href="/dhd_system/dhd_system/?s=Home/repay/repay_save/id/<?php echo ($vo["id"]); ?>" class="edit oper">修改</a>
	            <a href="/dhd_system/dhd_system/?s=Home/repay/repay_list/id/<?php echo ($vo["id"]); ?>" class="see oper">查看</a>
	            <!-- <a href="../finish/finish2.html" class="finish oper">完成</a> -->
	            </td>
	        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	    </table>
    </div>
</div>
</body>
</html>
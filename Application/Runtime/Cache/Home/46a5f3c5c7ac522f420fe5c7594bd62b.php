<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>项目管理</title>
    <link rel="stylesheet" type="text/css" href="/dhd_system/dhd_system/Public/home/css/content.css"  />
    <link rel="csssheet" type="text/css" href="/dhd_system/dhd_system/Public/home/css/public.css"  />
    <script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/jquery.js"></script>
    <script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/winpop.js"></script>
    <script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/Public.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#content #table .tr .edit').click(function(event) {
                event.preventDefault();
                var id=$(this).attr('href');
                if (id=='' || isNaN(id)) {
                    wintq('ID参数不正确',3,1000,1,'');
                    return false;
                }else {
                    window.location.href='/dhd_system/dhd_system/?s=Home/project/project_bign_save/det_id/'+id;

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
                    wintq('正在删除，请稍后...',4,20000,0,'');
                    window.location.href='/dhd_system/dhd_system/?s=Home/project/project_bign_del/did/'+id;
                }
            });
        });
    </script>
</head>
<body>
<div id="content">
    <div class="topFix">
        <h1>首页 > 产品管理 > 项目管理 > 产品详情> 小房间(未使用)</h1>
        <h2>
            <div class="h2_left">
                <a href="/dhd_system/dhd_system/?s=Home/project/project_detail_sml/class_id/<?php echo ($class_id); ?>" class="add" title="切换已使用">已使用</a>
                <a href="javascript:history.back();" class="Retreat">后退</a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </h2>

    </div>
    <div class="tableBox">
		<table id="table" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0" style="width:100%">
            <tr>
                <th>项目地址</th>
                <th>房间号</th>
                <th>单价</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr" value="1">
                    <td class="tc"><?php echo ($vo["pro_address"]); ?></td>
                    <td class="tc"><?php echo ($vo["detailscoll"]); ?></td>
                    <td class="tc"><?php echo ($vo["big_sum"]); ?></td>
                    <td class="tc fixed_w">
                        <a href="<?php echo ($vo["id"]); ?>" class="edit oper">修改</a>

                        <a href="<?php echo ($vo["id"]); ?>" class="del oper">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>	
	</div>	
    <div id="page">
        
    </div>
</div>
</body>
</html>
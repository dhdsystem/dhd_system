<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>项目管理</title>
    <link rel="stylesheet" type="text/css" href="/dhd_system/dhd_system/Public/home/css/content.css"  />
    <link rel="stylesheet" type="text/css" href="/dhd_system/dhd_system/Public/home/css/public.css"  />
    <script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/jquery.js"></script>
    <script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/Public.js"></script>
</head>
<body>
<div id="content">
    <div class="topFix">
        <h1>首页 > 产品管理 > 项目管理 > 产品详情> 小房间(已使用)</h1>
        <h2>
            <div class="h2_left">
                <a href="/dhd_system/dhd_system/?s=Home/project/project_detail_smln/class_id/<?php echo ($class_id); ?>" class="add" title="切换未使用">未使用</a>
                <a href="javascript:history.back();" class="Retreat">后退</a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </h2>

    </div>
    <div class="tableBox">
		<table id="table" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0" style="width:150%">
            <tr>
                <th>房间号</th>
                <th>公司名称</th>
                <th>付款方式</th>
                <th>租赁日期</th>
                <th>房租/管理费</th>
                <th>法人姓名</th>
                <th>法人电话</th>
                <th>纳税形式</th>
                <th>信用代码</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr" value="1">
                    <td class="tc"><?php echo ($vo["detailscoll"]); ?></td>
                    <td class="tc"><?php echo ($vo["client_name"]); ?></td>
                    <td class="tc"><?php echo ($vo["paytype"]); ?></td>
                    <td class="tc"><?php echo (date('Y-m-d',$vo["rentstarttime"])); ?>--<?php echo (date('Y-m-d',$vo["rentendtime"])); ?></td>
                    <td class="tc"><?php echo ($vo["rates"]); ?></td>
                    <td class="tc"><?php echo ($vo["legalperson"]); ?></td>
                    <td class="tc"><?php echo ($vo["legaltel"]); ?></td>
                    <td class="tc"><?php echo ($vo["taxstyle"]); ?></td>
                    <td class="tc"><?php echo ($vo["credit_code"]); ?></td>
                    <td class="tc fixed_w">
                        <!-- <a href="" class="edit oper">修改</a> -->
                        <a href="/dhd_system/dhd_system/?s=Home/project/project_sml_del/class_id/<?php echo ($class_id); ?>/id/<?php echo ($vo["id"]); ?>" class="del oper">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>	
	</div>	
    <div id="page">
        
    </div>
</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>渠道商管理</title>
    <link rel="stylesheet" type="text/css" href="/dhd_system/Public/home/css/content.css"  />
    <link rel="csssheet" type="text/css" href="/dhd_system/Public/home/css/public.css"  />
    <script type="text/javascript" src="/dhd_system/Public/home/js/jquery.js"></script>
    <script type="text/javascript" src="/dhd_system/Public/home/js/Public.js"></script>
    <script type="text/javascript" src="/dhd_system/Public/home/js/winpop.js"></script>
    // <script>
    //     $(document).ready(function() {
    //         $('#content #table .tr .del2').click(function(event) {
    //             event.preventDefault();
    //             if (!confirm('确定要删除该数据吗？')) {
    //                 return false;
    //             }
    //              var id=$(this).attr('href');
    //             // console.log(id);
    //             if (id=='' || isNaN(id)) {
    //                 wintq('ID参数不正确',3,1000,1,'');
    //                 return false;
    //             }else {
    //                 wintq('正在删除，请稍后...',4,20000,0,'');
    //                 window.location.href='/dhd_system/?s=Home/Channel/channel_del/id/'+id;
    //             }
    //         });
    //     }
    // </script>
</head>
<body>
<div id="content">
    <div class="topFix">
        <h1>首页 > 客户管理 > 渠道商管理</h1>
        <h2>
            <div class="h2_left">
                <a href="/dhd_system/?s=Home/channel/channel_add" class="add">添加</a>
                <a href="javascript:history.back();" class="Retreat">后退</a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </h2>

    </div>
    <div class="tableBox">
		<table id="table" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0" style="width:100%">
            <tr>
                <th>编号</th>
                <th>公司名称</th>
                <th>联系人</th>
                <th>联系方式</th>
                <th>办公地址</th>
                <th>成单总量</th>
                <th>新签量</th>
                <th>续签量</th>
                <th>业务员</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr" value="1">
                    <td class="tc"><?php echo ($vo["id"]); ?></td>
                    <td class="tc"><?php echo ($vo["middle_name"]); ?></td>
                    <td class="tc"><?php echo ($vo["middle_man"]); ?></td>
                    <td class="tc"><?php echo ($vo["middle_tel"]); ?></td>
                    <td class="tc"><?php echo ($vo["middle_address"]); ?></td>
                    <td class="tc"><?php echo ($vo["middle_total"]); ?></td>
                    <td class="tc"></td>
                    <td class="tc"></td>
                    <td class="tc"><?php echo ($vo["real_name"]); ?></td>
                    <td class="tc fixed_w">
                        <div class="operation">更多
                            <div class="operarea">
                                <a href="/dhd_system/?s=Home/channel/channel_save/id/<?php echo ($vo["id"]); ?>" class="edit oper2">修改</a>
                                <a href="/dhd_system/?s=Home/channel/channel_del/id/<?php echo ($vo["id"]); ?>" class="del2 oper2">删除</a>
                            </div>
                        </div>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>	
	</div>	
    <div id="page">
        
    </div>
</div>
</body>
</html>
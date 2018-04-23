<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>材料添加</title>
    <link rel="stylesheet" type="text/css" href="/dhd_system/Public/home/css/content.css"  />
    <link rel="csssheet" type="text/css" href="/dhd_system/Public/home/css/public.css"  />
    <script type="text/javascript" src="/dhd_system/Public/home/js/jquery.js"></script>
    <script type="text/javascript" src="/dhd_system/Public/home/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/dhd_system/Public/home/js/Public.js"></script>
    <script type="text/javascript" src="/dhd_system/Public/home/js/winpop.js"></script>
</head>
<style type="text/css">
    .tab_select{border-radius: 2px;-webkit-appearance: none;-moz-appearance: none;outline: none;padding-left: 10px;font-size: 14px;}
</style>
<body>
<div id="content">
    <h1>首页 &gt; 客户管理 &gt; 渠道商管理 &gt;渠道商修改</h1>
    <h2>
        <div class="h2_left">
            <a href="javascript:history.back();" class="Retreat">后退</a>
        </div>
    </h2>
    <dl id="dl">
        <form method="post" action="/dhd_system/?s=Home/channel/channeladd_do" id="add">
            <dd>
                <span class="dd_left">渠道商</span>
                <!-- 下拉菜单 -->
                <span class="dd_right">
                    <select  name="middle_state" class="select tab_select" style="width: 372px;height: 40px;border: 1px solid #e6e6e6;">
                        <option value='0'>中间商</option>
                        <option value='1'>中介</option>
                        <option value='2'>平台</option>
                    </select>
                </span>
            </dd>
            <dd>
                <span class="dd_left">公司名称</span>
                <span class="dd_right"><input type="text" name="middle_name" class="qtext" value="" style="width:360px;"/></span>
            </dd>
            <dd>
                <span class="dd_left">联系人</span>
                <span class="dd_right"><input type="text" name="middle_man" class="qtext" value="" style="width:360px;"/></span>
            </dd>
            <dd>
                <span class="dd_left">联系方式</span>
                <span class="dd_right"><input type="text" name="middle_tel" class="qtext" value="" style="width:360px;"/></span>
            </dd>
            <dd>
                <span class="dd_left">办公地址</span>
                <span class="dd_right"><input type="text" name="middle_address" class="qtext" value="" style="width:360px;"/></span>
            </dd>
            <dd><input type="submit" class="button" value="提 交" /></dd>
            <div style="clear:both;"></div>
        </form>
    </dl>
</div>
</body>
<script type="text/javascript">
    // function validform(){
    //     return $("#add").validate({
    //         rules : {
    //             classname : {required : true},
    //             address : { required : true},
    //             copyNub: { required : true}
    //         },
    //         messages :{
    //             classname : {required : '不能为空'},
    //             address : { required : '不能为空'},
    //             copyNub: {required : '不能为空'}
    //         }
    //     })
    // }
    // $(document).ready(function(){
    //     // $(validform());
    //     $(".button").click(function(){
    //         if(validform().form()) {
    //             $("#add").submit(); 
    //             //通过表单验证，以下编写自己的代码
    //             var classname=$('#dl dd .qtext').eq(0).val();
    //             var area=$('#dl dd .qtext').eq(1).val();
    //             var copyNub=$('#dl dd .qtext').eq(2).val();

    //             wintq('正在添加，请稍后...',4,20000,0,'');
    //             $.ajax({
    //                 url:'/dhd_system/?s=Home/User/useradd_do/',
    //                 dataType:'json',
    //                 type:'POST',
    //                 data:'classname='+classname+'&area='+area+'&copyNub='+copyNub,
    //                 success: function(data) {
    //                     // alert(data)
    //                     if (data=='ok') {
    //                         wintq('添加成功',1,1500,0,'/dhd_system/?s=Home/channel/channel_index');
    //                     }else {
    //                         wintq(data.s,3,1000,1,'?');
    //                     }
    //                 }
    //             }); 
    //         } else {
    //         //校验不通过，什么都不用做，校验信息已经正常显示在表单上
    //         }
    //     });

    // })
</script>
</html>
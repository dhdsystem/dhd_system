<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>添加新客户</title>
<link rel="stylesheet" type="text/css" href="/dhd_system/Public/home/css/content.css"/>
<link rel="stylesheet" type="text/css" href="/dhd_system/Public/home/css/public.css"/>
<script type="text/javascript" src="/dhd_system/Public/home/js/jquery.js"></script>
<script type="text/javascript" src="/dhd_system/Public/home/js/Public.js"></script>
<script type="text/javascript" src="/dhd_system/Public/home/js/winpop.js"></script>
<!-- <script type="text/javascript" src="/dhd_system/Public/home/js/check.js"></script> -->
<script type="text/javascript" src="/dhd_system/Public/home/js/WdatePicker.js"></script>
<style>
    #mername{
         z-index: 100000000;
        background: #fff;
        position: absolute;
        top:30px;
        width: 248px;
        left: 126px;
        box-shadow: 3px 7px 10px 2px #dadada;
    }
    #mername p{
        cursor: pointer;
    }
    #mername p:hover{
        background: #eee;
    }
    select{
        width: 108px;
    }

</style>
<script>
    var customtype;                     //合同性质
    var middleman;                      //中间商/中介公司
    var middlename;                     //中间商/中介公司联系人
    var middletel;                      //中间商/中介公司联系人电话
    var middleaddress;                  //中间商/中介公司办公地址
    var customername;                   //客户/公司
    var capital;                        //注册资金
    var legalperson;                    //法人姓名
    var legaltel;                       //法人电话
    var legalidnum;                     //法人身份证号
    function confirm()
    {
        var customtype = $('input[name=customtype]').val();
        if(customtype=="")
        {
            alert('请选择合同性质');
            customtype = 1;
            return false;
        }    
        var middleman = $('input[name=middleman]').val();
        if(middleman=="")
        {
            alert('中间商/中介公司不为空');
            middleman = 1;
            return false;
        }    
        var middlename = $('input[name=middlename]').val();
        if(middlename=="")
        {
            alert('中间商/中介公司联系人不为空');
            middlename = 1;
            return false;
        }    
        var middletel = $('input[name=middletel]').val();
        if(middletel=="")
        {
            alert('中间商/中介公司联系人电话不为空');
            middletel = 1;
            return false;
        }    
        var middleaddress = $('input[name=middleaddress]').val();
        if(middleaddress=="")
        {
            alert('中间商/中介公司办公地址不为空');
            middleaddress = 1;
            return false;
        }    
        var contracttype = $('#customtype').val();
        if(contracttype=='记账直接客户')
        {

        
            var customername = $('input[name=customername]').val();
            if(customername=="")
            {
                alert('客户/公司不为空');
                customername = 1;
                return false;
            }    
 
            var legalperson = $('input[name=legalperson]').val();
            if(legalperson=="")
            {
                alert('法人姓名不为空');
                legalperson = 1;
                return false;
            }    
            var legaltel = $('input[name=legaltel]').val();
            if(legaltel=="")
            {
                alert('法人电话不为空');
                legaltel = 1;
                return false;
            }    
            var legalidnum = $('input[name=legalidnum]').val();
            if(legalidnum=="")
            {
                alert('法人身份证号不为空');
                legalidnum = 1;
                return false;
            }    
        }
    }
</script>
</head>
<body>
<div id="content" style="padding-bottom:20px;">
    <h1>首页 > 客户管理 > 客户信息 > 添加新客户</h1>
    <h2>
        <div class="h2_left">
            <a href="javascript:history.back();" class="Retreat">后退</a>
        </div>
    </h2>
    <form action="/dhd_system/?s=Home/Client/clientadd_do" method="post" onsubmit="return confirm()">
    <dl id="cdl" >
        <dd>
            <span class="dd_left">客户分组：</span>
            <span class="dd_right">
                <select id="customtype" name="contracttype" class="select tab_select" style="width: 752px;height: 40px;">
                        <option value="">--请选择--</option>
                        <option value="直接客户">直接客户</option>
                        <option value="渠道客户">渠道客户</option>
                </select>
            </span>
        </dd>
        <div id="xu"></div>
        <div id="center"></div>

        <div id="contra" style="display:none" >
            <dd>
                <span class="dd_left">客户/公司：</span>
                <span class="dd_right">
                    <input type="hidden" name="clientid" id="clientid" />
                    <input name="customername" id="customername" placeholder="* 填写公司名称或客户名称" type="text" class="qtext" size="50" />
                </span>
                
            </dd>
            <dd>
                <span class="dd_left">注册资金：</span>
                <span class="dd_right">
                    <input name="capital" id="capital" type="text" class="qtext" size="40" />
                </span>
            </dd>
            
            <dd>
                <span class="dd_left">纳税形式：</span>
                <span class="dd_right">
                    <select name="taxstyle" id="taxstyle" class="select tab_select" style="width: 752px;height: 40px;">
                        <option value="一般人">一般人</option>
                        <option value="小规模">小规模</option>
                    </select>
                </span>
            </dd>
            <dd>
                <span class="dd_left">法人姓名：</span>
                <span class="dd_right">
                    <input name="legalperson" id="legalperson" type="text" class="qtext" size="40" />
                </span>
            </dd>
            <dd>
                <span class="dd_left">法人电话：</span>
                <span class="dd_right">
                    <input name="legaltel" id="legaltel" type="text" class="qtext" size="30" />
                </span>
            </dd>
            <dd>
                <span class="dd_left">法人身份证号：</span>
                <span class="dd_right">
                    <input name="legalidnum" id="legalidnum" type="text" class="qtext" size="40" />
                </span>
            </dd>
            <dd>
                <span class="dd_left">其他联系人：</span>
                <span class="dd_right">
                    <input name="customcontacter" id="customcontacter" type="text" class="qtext" size="40" />
                </span>
            </dd>
            <dd>
                <span class="dd_left">联系人电话：</span>
                <span class="dd_right">
                    <input name="customtel" id="customtel" type="text" class="qtext" size="30" />
                </span>
            </dd>
            <dd>
                <span class="dd_left">备注信息：</span>
                <span class="dd_right">
                    <textarea name="message" id="message" class="textarea text_box" rows="3" cols="30" style="width: 752px;"></textarea>
                </span>
            </dd>
        </div>
    </dl>
    <div id="wancheng"></div>
    <input type="submit" class="submit" value="提交" style="margin-left: 174px;" id="su" />
    </form>
</div>
</body>
</html>
<script type="text/javascript">
    /**
     * /选择客户分组判断是否为中间商客户
     * 
     */
    $(document).on('change','#contracttype',function(){
        $('#xu').empty()
    })
    $(document).on('change','#customtype',function(){
        var contract=$(this).val();
        $('#xu').empty()
        $('.center').remove()
        $('#contra').attr('style','display:none');
        // 控制中间部分input标签的可用性
        // $('#contra *').attr('disabled',true)
        if(contract=='渠道客户'){
            var state = 1;
            var ht=$('#contra').html();
            var str='<dd><span class="dd_left"><input type="hidden" id="middelid" name="middelid"/>渠道公司：</span><span class="dd_right"><input name="middleman" type="text" class="qtext" size="40" id="middleman"/><div id="vas"></div></span></dd><dd><span class="dd_left">联系人：</span><span class="dd_right"><input name="middlename" id="middlename" type="text" class="qtext" size="30" /></span></dd>'+ht;
        }
        if(contract=='直接客户'){
            $('#contra').attr('style','display:""')
             $('#contra *').attr('disabled',false)
        }
      
        $('#center').empty().append(str);
    })
    $(document).on('keyup','#customername',function(){
        var contracttype = $('#contracttype').val();
        $('#xu').empty()
        $('#mername').empty().attr('style','display:""')
        var customername = $(this).val();
        var data = {'customername':customername}
        $.ajax({
           type: "POST",
           url: "/dhd_system/?s=Home/Client/searchclient",
           data: data,
           dataType:'json',
           success: function(msg){
            var html='';
            if(msg=="")
            {
                $('#mername').nextAll().remove();

            }else
            {
                $(msg).each(function(i){
                    html+="<p class='click' ids='"+msg[i]['id']+"'>"+msg[i]['customername']+"</p>";
                });
                $('#mername').empty().append(html);
            }

           }
        });
    })
    

    $(document).on('blur','#customername',function(){
        setTimeout("$('#mername').empty()",300);
    })
    $(document).on('blur','#middleman',function(){
        setTimeout("$('#vas').empty()",300);
    })
    $(document).on('keyup','#middleman',function(){

        var contract=$('#customtype').val();

        var middleman = $(this).val();
        var data = {'middleman':middleman}
        $.ajax({
           type: "POST",
           url: "/dhd_system/?s=Home/Client/center_seach",
           data: data,
           dataType:'json',
           success: function(msg){

            var html='';
            if(msg=="")
            {
                $('#vas').remove();

            }else
            {
                $(msg).each(function(i){
                    html+="<p class='midd' ids='"+msg[i]['id']+"'>"+msg[i]['middleman']+"</p>";
                });
                $('#vas').empty().append(html);
            }

           }
        });
    })
    
    
</script>
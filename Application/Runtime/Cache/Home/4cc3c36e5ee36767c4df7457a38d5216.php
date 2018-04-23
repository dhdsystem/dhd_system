<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>客户管理</title>
    <link rel="stylesheet" type="text/css" href="/dhd_system/Public/home/css/content.css" />
    <link rel="stylesheet" type="text/css" href="/dhd_system/Public/home/css/public.css"  />
    <link rel="stylesheet" type="text/css" href="/dhd_system/Public/home/css/popwin.css"  />
    <script type="text/javascript" src="/dhd_system/Public/home/js/jquery.js"></script>
    <script type="text/javascript" src="/dhd_system/Public/home/js/Public.js"></script>
</head>
<body>
<div id="content">
    <div class="topFix">
        <h1>首页 > 客户管理 > 客户信息</h1>
        <h2>
            <div class="h2_left">
                <a href="/dhd_system/index.php/home/client/client_index" class="whole">全部</a>
                <a href="/dhd_system/?s=Home/Client/client_add" class="add">新增</a>
                <a href="javascript:history.back();" class="Retreat">后退</a>
                <div class="clear"></div>
            </div>
            
            <div class="search">
                
                <form action="/?s=Home/Client/index" method="post">
                    <input type="text" value="" name="keyword" class="text" style="border: 1px solid rgb(204, 204, 204); box-shadow: none;">
                    <input type="submit" class="so" value="搜 索">
                </form>
            </div>
            <a href="javascript:;" class="diy">自定义</a>
        </h2>
        <div class="dgv">
            <div class="danyuan">
                <span class="leiMing">项目：</span>
                <a href="javascript:;">财智国际大厦</a>
                <a href="javascript:;">金隅嘉华大厦</a>
                <a href="javascript:;">世纪科贸大厦</a>
            </div>
            <div class="danyuan">
                <span class="leiMing">产品：</span>
                <a href="javascript:;">大面积</a>
                <a href="javascript:;">小面积</a>
                <a href="javascript:;">地址</a>
                <a href="javascript:;">记账</a>
                <a href="javascript:;">代理</a>
            </div>
            
        </div>
    </div>
    <div class="tableBox tableBox2">
		<table id="table" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0" style="width:150%">
            <tr>
                <th>公司名称</th>
                <th>法人姓名</th>
                <th>法人电话</th>
                <th>业务员</th>
                <th>纳税形式</th>
                <th>信用代码</th>
                <th>客户分组</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($volist)): $i = 0; $__LIST__ = $volist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr" value="1">
                    <td class="tc"><?php echo ($vo["client_name"]); ?></td>
                    <td class="tc"><?php echo ($vo["client_address"]); ?></td>
                    <td class="tc"><?php echo ($vo["legalperson"]); ?></td>
                    <td class="tc"><?php echo ($vo["legaltel"]); ?></td>
                    <td class="tc"><?php echo ($vo["sales_id"]); ?></td>
                    <td class="tc"><?php echo ($vo["client_money"]); ?></td>
                    <td class="tc"><?php echo ($vo["taxstyle"]); ?></td>

                    <td class="tc fixed_w">
                        <div class="operation">更多
                            <div class="operarea">
                                <a href="javascript:;" class="yuliu oper2">预留地址号</a>
                                <a href="javascript:;" class="edit oper2">修改/查看</a>
                                <a href="javascript:;" class="del2 oper2">删除</a>
                                <a href="javascript:;" class="renewal oper2">续时</a>
                                <a href="javascript:;" class="mutual oper2">交互记录</a>
                                <a href="javascript:;" class="detInfor oper2">详细信息</a>
                            </div>
                        </div>
                        
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>	
	</div>	
    <div id="page">
    <?php echo ($page); ?>   
    </div>
    
</div>
<!-- 弹窗1 -->
<div class="popWinBox popWinBox1">
    <div class="popWin popWin1">
        <div class="popWinTitle">自定义选择</div>
        <div style="width:640px;margin:0 auto">
            <div class="popWinTop">
                <div class="checkBB">
                    <input type="checkBox" name="guolv" value="财智国际大厦"><label for="check"></label><span>财智国际大厦</span>
                </div>
                <div class="checkBB">
                    <input type="checkBox" name="guolv" value="金隅嘉华大厦" ><label for="check"></label><span>金隅嘉华大厦</span>
                </div>
                <div class="checkBB">
                    <input type="checkBox" name="guolv" value="世纪科贸大厦"><label for="check"></label><span>世纪科贸大厦</span>
                </div>
                <div class="checkBB"><input type="checkBox" name="guolv" value="大面积"><label for="check"></label><span>大面积</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value="小面积"><label for="check"></label><span>小面积</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value="地址"><label for="check"></label><span>地址</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value="记账"><label for="check"></label><span>记账</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value="代理"><label for="check"></label><span>代理</span></div>

                <div class="checkBB"><input type="checkBox" name="guolv" value="记账直接客户"><label for="check"></label><span>记账直接客户</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value="非记账直接客户"><label for="check"></label><span>非记账直接客户</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value=""><label for="check"></label><span>中间商</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value=""><label for="check"></label><span>中介</span></div>

                <div class="checkBB"><input type="checkBox" name="guolv" value=""><label for="check"></label><span>应收款客户</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value=""><label for="check"></label><span>合同到期客户</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value=""><label for="check"></label><span>停租客户</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value=""><label for="check"></label><span>拜访时间</span></div>

                <div class="checkBB"><input type="checkBox" name="guolv" value=""><label for="check"></label><span>渠道一（人员）</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value=""><label for="check"></label><span>渠道二（人员）</span></div>
                <div class="checkBB"><input type="checkBox" name="guolv" value=""><label for="check"></label><span>直销（人员）</span></div>
                  
            </div>
            <div class="popWinBot">
                <form action="" method="post" id="popForm">
                    <div class="popWinTopL">
                        <div class="alldel">全部清除</div>
                        <div class="butBox"></div>
                    </div>
                    <div class="popWinTopr"><input type="submit" name="提交" id="popSub"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 弹窗2-->
<div class="popWinBox popWinBox2">
    <div id="zhuijia">
        <div class="padd">
            <form action="/oa/?s=Home/Client/client_pre" onsubmit="return check()" method="post">
                <dl>
                <dd>
                    <span class="dd_left">预留地址项目</span>
                    <span class="dd_right" id="xiangmu">
                        <select class="select" name="class_id" id="class_id">
                            <option value="">请选择</option>
                            <option value="9">群英科技园</option>
                            <option value="8">新材料创业大厦</option>
                            <option value="7">财智国际大厦</option>
                            <option value="2">北科产业园</option>
                        </select>
                        <input type="hidden" value="1" name="client_id"></span>
                </dd>
                <dd>
                    <span class="dd_left">预留地址</span>
                    <span class="dd_right" id="dizhi">
                        <select name="" id="" class="select"></select>
                    </span>
                </dd>
                <dd>
                    <span class="dd_left">预留地址号</span>
                    <span class="dd_right" id="hao" style="float: left;">
                        <p class="number-1"></p>
                        <!-- <input type="hidden" name="pre_id" id="pre_id" value="410"> -->
                    </span>
                </dd>
                <input type="submit" class="button" value="确定">
                </dl>
            </form>
        </div>
     </div>
</div>
<script type="text/javascript">
    
    $('.checkBB input').click(function(){
    	var ind = $('.checkBB input').index(this);
        if($(this).is(':checked') == true) {
            var text=$(this).attr('value');
            $(this).parent().find('label').css('background','url(/dhd_system/Public/home/images/checkBut2.png) no-repeat');
            // alert(typeof text);
            $('.butBox').append('<div class="secDis ind'+ind+'" value='+text+'>'+text+'</div>')
        }else if($(this).is(':checked') == false){
            $(this).parent().find('label').css('background','url(/dhd_system/Public/home/images/checkBut1.png) no-repeat');
        	$('.butBox div.ind'+ind).remove();
       
        }
    })
    // 全部清除
    $('.alldel').click(function(){
        $('.butBox div').remove();
        $('.checkBB label').css('background','url(/dhd_system/Public/home/images/checkBut1.png) no-repeat');
        $('.checkBB input').attr("checked",false);
    })


    $('#popSub').click(function(){
        $('popForm').submit();
        $('.popWinBox1').hide();
    })
    // 预留地址号
    $('.yuliu').click(function(){
        $('.popWinBox2').show();
        $('body').click(function(e) {
            var target = $(e.target);
            if(!target.is('.yuliu') && !target.is('#zhuijia *')) {
                if ( $('.popWinBox2').is(':visible') ) {
                    $('.popWinBox2').hide();
                }
            }
        })
    }) 

    //select处理
    function check(){
        var pre_id = $('#pre_id').val();
        if(typeof(pre_id)=='undefined'||pre_id==''){
            alert('请选择要预留的地址号');
            return false;
        }
        // alert(pre_id)
        // return false;
    }
    $(document).on('change','#class_id',function(){
        var class_id = $(this).val();
        var client_id =$(this).attr('client_id');
                $.ajax({
           type: "POST",
           url: "/dhd_system/?s=Home/Client/pre_prod",
           data: {'class_id':class_id},
           dataType:'json',
           success: function(msg){

                var html = '<select  class="select" name="prod_id"  id="prod_id">';
                html += '<option value="">请选择</option>'
                $.each(msg,function(k,v){
                    html+='<option value="'+v.id+'">'+v.proname+'</option>'
                })
                html+='</select>'
                $('#dizhi').empty().append(html)

           }
       })

    }) 
    $(document).on('change','#prod_id',function(){
        var prod_id = $(this).val();
        $.ajax({
           type: "POST",
           url: "/dhd_system/?s=Home/Client/pre_regist",
           data: {'prod_id':prod_id},
           dataType:'json',
           success: function(msg){
                var html = '<p class="number-1">'+msg.regist+'</p><input type="hidden" name="pre_id" id="pre_id" value="'+msg.per_id+'" />';                
                $('#hao').empty().append(html);
           }
       })
    })
</script>
</body>
</html>
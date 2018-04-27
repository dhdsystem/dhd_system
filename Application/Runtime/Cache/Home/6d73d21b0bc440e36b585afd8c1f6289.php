<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>添加新客户</title>
<link rel="stylesheet" type="text/css" href="/dhd_system/dhd_system/Public/home/css/content.css"/>
<link rel="stylesheet" type="text/css" href="/dhd_system/dhd_system/Public/home/css/public.css"/>
<script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/jquery.js"></script>
<script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/Public.js"></script>
<script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/winpop.js"></script>
<script type="text/javascript" src="/dhd_system/dhd_system/Public/home/js/WdatePicker.js"></script>
<style type="text/css">
    .file {position: relative;display: inline-block;background: #D0EEFF;border: 1px solid #99D3F5;
        border-radius: 4px;padding: 4px 12px;overflow: hidden;color: #1E88C7;text-decoration: none;
        text-indent: 0;line-height: 20px;}
    .file input {position: absolute;font-size: 15px;right: 0;top: 0;opacity: 0;}
    .file:hover {background: #AADFFD;border-color: #78C3F3;color: #004974;text-decoration: none;}
</style>
</head>
<body>
<div id="content" style="padding-bottom:20px;">
    <h1>首页 > 财务管理 > 模板管理 > 添加模板</h1>
    <h2>
        <div class="h2_left">
            <a href="javascript:history.back();" class="Retreat">后退</a>
        </div>
    </h2>
    <form action="/dhd_system/dhd_system/?s=Home/Stencil/stencilsave_do" method="post" enctype="multipart/form-data">
    <dl id="cdl" >
        <dd>
            <span class="dd_left">客户分组：</span>
            <span class="dd_right">
            <input type="hidden" value="<?php echo ($data["id"]); ?>" name="id">
                <select  name="stencil_type" class="select tab_select" style="width: 752px;height: 40px;">
                        

                        <?php if($data["stencil_type"] == 1 ): ?><option value="1" selected>合同模板</option>
                            <option value="2">表格模板</option>
                        <?php else: ?> 
                            <option value="1">合同模板</option>
                            <option value="2" selected>表格模板</option><?php endif; ?>
                   
                        
                </select>
            </span>
        </dd>
        <dd>
            <span class="dd_left">模板名称：</span>
            <span class="dd_right">
                <input name="stencil_name" value="<?php echo ($data["stencil_name"]); ?>" type="text" class="qtext" size="50" />
            </span>
            
        </dd>
        <dd>
            <span class="dd_left">模板文件：</span>
            <span class="dd_right">
                <a class="file" href="javascript:;">
                    <input name="file"  type="file"/>
                    <span class="fileerrorTip">请选择文件</span>
                    <span class="showFileName"><?php echo ($data["stencil_name"]); ?></span>
                </a>
            </span>
        </dd>
        
        <dd>
            <span class="dd_left">备注：</span>
            <span class="dd_right">
                <textarea name="stencil_remark"><?php echo ($data["stencil_remark"]); ?></textarea>
            </span>
        </dd>
        
 
    </dl>
    <input type="submit" class="submit" value="提交" style="margin-left: 174px;" id="su" />
    </form>
</div>
</body>
<script type="text/javascript">
    $(".fileerrorTip").html("").hide();
    $(".file").on("change","input[type='file']",function(){
        var filePath=$(this).val();
        if(filePath.match(/.xls|.doc|.xlsx|.docx|.xml/i)){
            $(".fileerrorTip").html("").hide();
            var arr=filePath.split('\\');
            var fileName=arr[arr.length-1];
            $(".showFileName").html(fileName);
        }else{
            $(".showFileName").html("");
            $(".fileerrorTip").html("您未上传文件，或者您上传文件类型有误！").show();
            return false 
        }
    })
</script>
</html>
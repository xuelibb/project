<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="admin/css/pintuer.css">
    <link rel="stylesheet" href="admin/css/admin.css">
    <script src="admin/js/jquery.js"></script>
    <script src="admin/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="admin_add_partner" enctype="multipart/form-data">
            <input  type='hidden'   name='_token'  value="<?php echo csrf_token();  ?>" />
            <div class="form-group">
                <div class="label">
                    <label>链接：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="" name="link" data-validate="required:请输入链接" />
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>图片：</label>
                </div>
                <div class="field">
                    <input type="file"  name="img" class="input" style="width:25%; float:left;"  value=""  data-toggle="hover" data-place="right" data-image="" />
                    <div class="tipss">图片尺寸：500*500</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>是否展示：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    展示  ： <input  type="radio"  name="is_show"  value="1"/>
                    不展示 ：<input  type="radio"  name="is_show" value="0"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <input class="button bg-main icon-check-square-o" type="submit" value="提交">
                </div>
            </div>
        </form>
    </div>
</div>

</body></html>
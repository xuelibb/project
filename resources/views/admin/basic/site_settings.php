<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>网站信息</title>
    <link rel="stylesheet" href="admin/css/pintuer.css">
    <link rel="stylesheet" href="admin/css/admin.css">
    <script src="admin/js/jquery.js"></script>
    <script src="admin/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
    <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 网站信息</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="admin_info_add" enctype="multipart/form-data">
            <input  type='hidden'   name='_token'  value="<?php echo csrf_token();  ?>" />
            <div class="form-group">
                <div class="label">
                    <label>网站标题：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="stitle" value="<?=$list['stitle']?>" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>网站网址：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="link" value="<?=$list['link']?>" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>网站LOGO：</label>
                </div>
                <div class="field">
                    <input type="file"    name="logo" class="input" style="width:25%; float:left;"  data-toggle="hover" data-place="right" data-image=""  />
                    <img  src="<?=$list['img']?>" width="100" height="50">
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>网站描述：</label>
                </div>
                <div class="field">
                    <textarea class="input" name="desc"><?=$list['desc']?></textarea>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>客服热线：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="tel" value="<?=$list['tel']?>" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>QQ：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="qq" value="<?=$list['qq']?>" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>地址：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="address" value="<?=$list['address']?>" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>底部信息：</label>
                </div>
                <div class="field">
                    <textarea name="scopyright" class="input" style="height:120px;" rows="20"><?=$list['scopyright']?></textarea>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit">保存设置</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body></html>
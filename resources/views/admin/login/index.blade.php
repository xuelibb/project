<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>登录</title>  
    <link rel="stylesheet" href="admin/css/pintuer.css">
    <link rel="stylesheet" href="admin/css/admin.css">
    <script src="admin/js/jquery.js"></script>
    <script src="admin/js/pintuer.js"></script>  
</head>
<style>
    #div-du{
        background-color:#ffbd5f;
        font-size:17px;
        line-height:43px;
        letter-spacing:1px;
    }
</style>
<body>
<div class="bg"></div>
<div class="container">
    <div class="line bouncein">
        <div class="xs6 xm4 xs3-move xm4-move">
            <div style="height:150px;"></div>
            <div class="media media-y margin-big-bottom">           
            </div>         
            <form action="admin_logins" method="post">
            <div class="panel loginbox">
                <div class="text-center margin-big padding-big-top"><h1>后台管理中心</h1></div>
                <div class="panel-body" style="padding:30px; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="text" class="input input-big" name="user_name" placeholder="登录账号" data-validate="required:请填写账号" />
                            <span class="icon icon-user margin-small"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input input-big" name="user_password" placeholder="登录密码" data-validate="required:请填写密码" />
                            <span class="icon icon-key margin-small"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field" id="dddd">
                            <input type="text" id="du" class="input input-big" name="code" placeholder="填写右侧的验证码" data-validate="required:请填写右侧的验证码" />
                           <!--<img src="admin/images/passcode.jpg" alt="" width="100" height="32" class="passcode" style="height:43px;cursor:pointer;" onclick="this.src=this.src+'?'">-->
                            <div id="div-du" class="passcode" style="height:43px;cursor:pointer;width:100px"></div>
                            <div class="input-help"><ul><li><span id="ver-d"></span></li></ul></div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div style="padding:30px;"><input id="wei" type="submit" class="button button-block bg-main text-big input-big" value="登录"></div>
            </div>
            </form>          
        </div>
    </div>
</div>

</body>
</html>
<script>
    $(function(){
        var flag=0;
        $(document).ready(function(){
            verify_du();
        });
        function verify_du(){
            $.ajax({
                type:'get',
                url:'admin_verify',
                success:function(msg){
                    $('#div-du').html(msg);
                }
            });
        }
        $('#div-du').click(function(){
            verify_du();
        });
        $('#du').blur(function(){
            $('#ver-d').remove();
            var verify=$('#div-du').html().trim();
            var ver=$(this).val().trim();
            if(verify==ver){
                return flag=1;
            }else{
                return flag=0;
            }
        });
        $('#wei').click(function(){
            $('#ver-d').remove();
            // alert($("#ver-d").html())
            if(flag==1){
                return true;
            }else{
                verify_du();
                $("#div-du").after('<div class="input-help" id="ver-d"><ul><li><font color="red">验证码有误</font></li></ul></div>');
                return false;
            }
        });
    });
</script>
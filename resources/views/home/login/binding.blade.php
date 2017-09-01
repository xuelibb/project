<!DOCTYPE html>
<!-- saved from url=(0044)http://www.imooc.com/passport/user/tpperfect -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <title>招财喵</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" href="Public/web/css/snscomplete.css">
</head>

<body>
<div id="main">
    <div class="wcontainer">
        <div class="wwrap  wrap-boxes">
            <div id="js-fill">
                <div class="wheader-wrap">
                    <h1>完善基本资料</h1>
                    <div id="js-sns-tab" class="sns-complete-tab">
                        <span class="sns-tab-active" data-target="js-profile">无招财喵帐号</span>
                        <span data-target="js-bind" class="">绑定已有帐号</span>
                    </div>
                </div>
                <div id="js-profile" class="cprofile-wrap sns-block" style="display: block;">
                    <div class="cprofile-inner clearfix">
                        <div class="avator-wrap l">
                            <div class="avator-inner">
                                <img src="{{$data['avatar']}}" width="160" height="160" alt="头像" title="头像">
                            </div>
                        </div>
                        <div class="cprofile-field-wrap">
                            <form id="cprofile">
                                <div class="wlfg-wrap">
                                    <label class="label-name" for="nick">昵称</label>
                                    <div class="rlf-group">
                                        <input type="text" readonly="readonly" value="{{$data['nickname']}}" class="ipt ipt-nick">
                                        <p class="tips"></p>
                                    </div>
                                </div>
                                <div class="wlfg-wrap">
                                    <label class="label-name" for="nick" >用户名</label>
                                    <div class="rlf-group">
                                        <input type="text" onblur="regCheckUsername()" name="nickname" id="reg_user_name" autocomplete="off" data-validate="nick" class="ipt ipt-nick" placeholder="请输入昵称.">
                                        <p class="tips"  style="color: red" id="regUserSP"></p>
                                    </div>
                                </div>
                                <div class="wlfg-wrap">
                                    <label class="label-name" for="email">电话</label>
                                    <div class="rlf-group">
                                        <input type="tell" autocomplete="off" onblur="regCheckphone()" data-validate="email" name="username" id="phone" class="ipt ipt-email" placeholder="请输入电话号码">
                                        <p class="tips" id="phone_err_msg" style="color: red"></p>
                                    </div>
                                </div>
                                <div class="wlfg-wrap">
                                    <label class="label-name" for="password">密码</label>
                                    <div class="rlf-group">
                                        <input type="password" onblur="regCheckPassword()"  data-validate="password" name="password" id="reg_password" class="ipt ipt-pwd" placeholder="请输入密码.">
                                        <p class="tips" id="pwd_err_msg" style="color: red"></p>
                                    </div>
                                </div>
                                <div class="wlfg-wrap">
                                    <div class="rlf-group">
                                        <input id="cprofile-submit-btn" type="button" class="btn btn-green btn-complete" value="完成">
                                        <p class="tips" id="cprofile-globle-error"></p>
                                    </div>
                                </div>
                                <input id="image" type="hidden" value="">
                            </form>
                        </div>
                    </div>
                </div>
                <div id="js-bind" class="profile-bind sns-block" style="display: none;">
                    <div class="cprofile-inner clearfix">
                        <div class="avator-wrap l">
                            <div class="avator-inner">
                                <img src="{{$data['avatar']}}" width="160" height="160" alt="头像" title="头像">
                            </div>
                        </div>
                        <div class="cprofile-field-wrap">
                            <form id="form-bind">
                                <div class="wlfg-wrap">
                                    <label class="label-name" for="email">手机</label>
                                    <div class="rlf-group">
                                        <input type="tell" autocomplete="off" onblur="bindCheckUsername()" data-validate="email" id="bindphone" class="ipt ipt-email" placeholder="请输入登录邮箱.">
                                        <p class="tips" id="bind_phone_err_msg" style="color: red"></p>
                                        <input type="text" style="display:none">
                                    </div>
                                </div>
                                <div class="wlfg-wrap">
                                    <label class="label-name" for="password">密码</label>
                                    <div class="rlf-group">
                                        <input type="password" autocomplete="off" onblur="bindCheckPassword()" id="bindpwd" class="ipt ipt-pwd" placeholder="请输入密码.">
                                        <p class="tips" id="bind_pwd_err_msg" style="color: red"></p>
                                    </div>
                                </div>
                                <div class="wlfg-wrap">
                                    <label class="label-name">&nbsp;</label>
                                    <div class="rlf-group">
                                        <input type="button" id="js-bind-btn" class="btn btn-green bind-btn" value="绑定">
                                        <p id="js-bind-global-msg" class="tips"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" id="open_id" value="{{$data['id']}}">
<input type="hidden" id="oauth" value="{{$data['oauth_id']}}">
<script charset="utf-8" src="Public/web/js/jquery-1.10.2.min.js"></script>
</body>
</html>
<script>
    $('#js-sns-tab').on('click', 'span', function() {
        var $this = $(this);
        if (!$this.hasClass('sns-tab-active')) {
            $this.addClass('sns-tab-active').siblings('.sns-tab-active').removeClass('sns-tab-active')
                .each(function() {
                    $('#' + $(this).attr('data-target')).hide();
                });
            $('#' + $this.attr('data-target')).show();
        }
    });
    function regCheckUsername(){
        var r=/^[0-9A-Za-z.@\-\_]{6,16}$/;
        var v = $('#reg_user_name').val();
        if(!v.length){
            $("#regUserSP").html("用户名不能为空").parent('span').show();
            $("#regUserSP").focus();
            return false;
        }
        if(!r.test(v)){
            $("#regUserSP").html("用户名格式错误，6~16位组成，").parent('span').show();
            $("#regUserSP").focus();
            return false;

        }
        $("#regUserSP").html("√").css('color','green').parent('span').show();
        return true;
    }

    function regCheckphone(){
        var checkphone=/^0?1[3|4|5|8][0-9]\d{8}$/;
        var phone=$("#phone").val();
        if(phone == '' || phone == null) {
            $("#phone_err_msg").html("请输入手机号码！").parent('span').show();
            $("#phone").focus();
            return false;
        }
        if(!checkphone.test(phone)){
            $("#phone_err_msg").html("手机号码格式不正确，请检查！").parent('span').show();
            $("#phone").focus();
            return false;
        }
        $("#phone_err_msg").html("√").css('color','green').parent('span').show();
        return true;
    }
    function regCheckPassword(){
        var pwd=$('#reg_password').val();
//        alert(pwd)
        var pwd_validate =  /^((?=.*[0-9])|(?=.*[~!@#$%^&*()-+_=]))((?=.*[a-z])|(?=.*[A-Z])).{8,16}$/;
        if(pwd == '') {
            $("#pwd_err_msg").html("请输入密码！").parent('span').show();
            $("#reg_password").focus();
            return false;
        }
        if(!pwd_validate.test(pwd)) {
            $("#pwd_err_msg").html("密码必须是8-16位字母加数字或符号的组合！").parent('span').show();
            $("#pwd").focus();
            return false;
        }
        $("#pwd_err_msg").html("√").css('color','green').parent('span').show();
        return true;
    }



    function bindCheckUsername(){
        var checkphone=/^0?1[3|4|5|8][0-9]\d{8}$/;
        var phone=$("#bindphone").val();
        if(phone == '' || phone == null) {
            $("#bind_phone_err_msg").html("请输入手机号码！").parent('span').show();
            $("#bindphone").focus();
            return false;
        }
        if(!checkphone.test(phone)){
            $("#bind_phone_err_msg").html("手机号码格式不正确，请检查！").parent('span').show();
            $("#bindphone").focus();
            return false;
        }
        $("#bind_phone_err_msg").html("√").css('color','green').parent('span').show();
        return true;

    }
    function bindCheckPassword(){
        var pwd=$('#bindpwd').val();
//        alert(pwd)
        var pwd_validate =  /^((?=.*[0-9])|(?=.*[~!@#$%^&*()-+_=]))((?=.*[a-z])|(?=.*[A-Z])).{8,16}$/;
        if(pwd == '') {
            $("#bind_pwd_err_msg").html("请输入密码！").parent('span').show();
            $("#bindpwd").focus();
            return false;
        }
        if(!pwd_validate.test(pwd)) {
            $("#bind_pwd_err_msg").html("密码必须是8-16位字母加数字或符号的组合！").parent('span').show();
            $("#bindpwd").focus();
            return false;
        }
        $("#bind_pwd_err_msg").html("√").css('color','green').parent('span').show();
        return true;

    }


    $(function(){
        $('#cprofile-submit-btn').click(function(){
            if (regCheckUsername() && regCheckPassword() && regCheckphone() ) {
                var data = {
                    '_token':$('input[name=_token]').val(),
                    'user_name':$('#reg_user_name').val(),
                    'open_id':$('#open_id').val(),
                    'password':$('#reg_password').val(),
                    'phone':$('#phone').val(),
                    'oauth':$('#oauth').val(),
                };
                $.post("oauth_reg", data,
                    function(data){
                        if (data.code==1) {
                            //注册成功
                            $("#pwd_err_msg").html(data.msg).parent('span').show();
                            setInterval("location.href = '/'",3000);
                        }else{
                            $("#pwd_err_msg").css('color','red').html(data.msg).parent('span').show();
                        }
                    }, "json");
            };
        });
        $('#js-bind-btn').click(function(){
            if (bindCheckUsername() && bindCheckUsername() ) {
                var data = {
                    '_token':$('input[name=_token]').val(),
                    'user_name':$('#bindphone').val(),
                    'open_id':$('#open_id').val(),
                    'password':$('#bindpwd').val(),
                    'oauth':$('#oauth').val(),
                };
                $.post("oauth_bind", data,
                    function(data){
                        if (data.code==1) {
                            $("#bind_pwd_err_msg").html(data.msg).parent('span').show();
                            setInterval("location.href = '/'",3000);
                        } else {
                            $("#bind_pwd_err_msg").css('color','red').html(data.msg).parent('span').show();
                        };
                    }, "json");
            };
        });
    })
</script>

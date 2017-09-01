<html xmlns:wb="http://open.weibo.com/wb">
<body>
<div class="ww">
    <div class="Top-position">
        <?php include "layout/home/header.php";?>
    </div>
</div>
<div class="center"><div class="ww both">
        <!--登录框-->
        <div class="login-all">
            <div class="login-bg">
                <div class="login-pic">
                    <div class="login-cont login-cont1">
                        <h3>登录</h3>
                        <form action="login" method="post">
                        <div class="login-on_1">

                            <div class="login-row ofh mtaut28 login-row2">
                                <input id="phone" type="text" name="user" class="login-zh fstyle1 fl" placeholder="请输入登录手机号或用户名"/>
                            </div>

                            <div class="login-row mtaut28 login-row2">
                                <input id="pwd" type="password" name="pwd" class="login-zh fstyle1 fl" placeholder="请输入登录密码"/>
                            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="login-true fstyle1 ofh" style="height:20px;">
                                <i class="icon-reset fl" style="display:none;"></i>
                                <span class="fl" id="err_msg">&nbsp;</span>
                                @if(session('msg'))
                                    <span class="fl" id="err_msg">{{session('msg')}}</span>
                                @endif
                            </div>

                            <div class="login_status">
                                <label class="check-box fstyle1 fl fc3"><input type="checkbox" class="checkbox" checked="checked" value="1" name="rememberMe" id="remember_me"><i class=""></i>记住用户名</label>
                                <a href="/web/index/find_pwd_phone.html" class="forget-password fstyle1">忘记密码</a>
                            </div>

                            <div class="login-btn-box1"><input  type="submit" value="立即登录" class="login_btn login_btn1" style="width: 325px;" id="login_btn"/></div>
                            <div class="login-jizhu tc">
                                <a class="fstyle1 fs16 fc_80 pr10" style="cursor: default;">没有账户</a>
                                <a href="register" class="login-rn fstyle1" >立即注册</a>
                            </div>
                            {{--<div>--}}
                                {{--其他登录方式：--}}
                                {{--@foreach($oauth as $k=>$v)--}}
                                {{--<a href="{{$v['url']}}">--}}
                                    {{--<img src="{{$v['logo']}}" title="{{$v['title']}}" width="18px" height="18px">--}}
                                {{--</a>&nbsp;&nbsp;--}}
                                {{--@endforeach--}}
                            {{--</div>--}}
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        var login_phone = getCookie("login_phone");

        if(login_phone != null || login_phone != "") {
            $("#phone").val(login_phone);
        }


        $("#login_btn").click(function(){
            var phone = $("#phone").val().trim();
            var pwd = $("#pwd").val();
            var verify_code = $("#verify_code").val();

            $("#err_msg").html("").prev("i").hide();
            if(phone == '') {
                $("#err_msg").html("请输入登录手机号！").prev("i").show();
                $("#phone").focus();
                return false;
            }

            if(pwd == '') {
                $("#err_msg").html("请输入登录密码！").prev("i").show();
                $("#pwd").focus();
                return false;
            }


            //TODO格式验证
            $.ajax({
                url: '/web/index/login.html',
                type: 'post',
                data:{'phone':phone, 'pwd':pwd, 'verify_code':verify_code},
                dataType: 'json',
                success:function(result){
                    if(result.code == 1000) {
                        if($('#remember_me').is(':checked')) {
                            setCookie('login_phone', phone);
                        } else {
                            delCookie('login_phone');
                        }

                        window.location.href = result.data.to_url;
                    } else {
                        ChangeCheckCode();
                        $("#err_msg").html(result.msg).prev("i").show();
                    }
                }
            });

        });

        function re_captcha() {
            $url = "{{ URL('captcha') }}";
            $url = $url + "/" + Math.random();
            document.getElementById('img_code').src=$url;
        }


        //回车事件
        $(this).keydown(function (e){
            if(e.which == "13"){
                $("#login_btn").click();
            }
        })

    </script>

</div>
<style>
    .friend_link {
        padding: 0px 0 20px 0;
        float: right !important;
        text-align: center;
    }
    .friend_link a {
        margin: 0 14px 0 14px;
        text-align: center;
    }
    .friend-dl {
        width: 380px !important;
    }
</style>
<div class="ww">
    <!--底部 -->
    <?php include "layout/home/footer.html";?>
</div>
</body>
</html>
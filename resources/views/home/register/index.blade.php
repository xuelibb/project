<body>
<div class="ww">
    <div class="Top-position">
        <?php include "layout/home/header.php";?>
    </div>

</div>
<div class="center"><div class="ww both">
        <!--填写账户信息 -->
        <div class="bg_color1 pt40">
            <div class="wl mtauto bg_color2 pb30">
                <div class="slide08">
                    <div class="hd Menubox03">
                        <ul id="p_type" class="ofh">
                            <li value="1" class="slide06-tab1 on"><a href="/web/index/register.html"><em></em>个人注册</a></li>
                            <li value="2" class="slide06-tab2 " style=" display:none"  ><a href="/web/index/company_register.html"><em></em>企业注册</a></li>
                        </ul>
                    </div>
                </div>
                <div class="register-pro-box">
                    <ul class="ofh">
                        <li class="register-pro1 on">
                            <div class="register-pro-pic">
                                <div class="register-pro-num-box">
                                    <div class="register-pro-num">1</div>
                                </div>
                                <div class="register-pro-tips">填写账户信息</div>
                            </div>
                        </li>
                        <li class="register-pro2">
                            <div class="register-pro-pic2">
                                <div class="register-pro-num-box">
                                    <div class="register-pro-num">2</div>
                                </div>
                                <div class="register-pro-tips">实名认证</div>
                            </div>
                        </li>
                        <li class="register-pro3">
                            <div class="register-pro-pic3">
                                <div class="register-pro-num-box">
                                    <div class="register-pro-num">3</div>
                                </div>
                                <div class="register-pro-tips">注册成功</div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="register-box">
                    <div style="width:650px;float:left;">
                        <dl>
                            <dt>用户名：</dt>
                            <dd>
                                <input type="text" placeholder="请输入用户名" class="register-sr-x1" id="user"/>
                            </dd>
                        </dl>
                        <dl class="mt15">
                            <dt>手机号码：</dt>
                            <dd>
                                <input type="tel" placeholder="请输入手机号" class="register-sr-x1" id="phone"/>
                            </dd>
                        </dl>
                        {{--<dl class="mt15">--}}
                            {{--<dt>验 证 码：</dt>--}}
                            {{--<dd>--}}
                                {{--<input type="text" placeholder="不区分大小写" class="register-sr-x2" id="verify_code" maxlength="5" />--}}
                                {{--<span class="yz-code yz-code_2">--}}
                    {{--<img id="img_code" src="{{ URL('captcha/1') }}" style="cursor:pointer;width: 90%" onclick="ChangeCheckCode();"/>--}}
                    {{--</span>--}}
                                {{--<!----}}
                                {{--<span class="icon-change" onclick="ChangeCheckCode();"></span>--}}
                                 {{---->--}}
                            {{--</dd>--}}
                        {{--</dl>--}}
                        <dl class="mt20">
                            <dt>短信验证：</dt>
                            <dd>
                                <input type="text" placeholder="请输入验证码" class="register-sr-x2" id="phone_code"/>
                                <div class="get-code-btn" onclick="get_phone_code();" id="phone_verify_btn">获取验证码</div>
                            </dd>
                        </dl>
                        <dl class="mt20">
                            <dt>登录密码：</dt>
                            <dd>
                                <input type="password" placeholder="8-16位，包含字母加数字或符号组合" class="register-sr-x1" id="pwd"/>
                            </dd>
                        </dl>
                        <dl class="mt20">
                            @if(!(empty($id) && empty($user_id)))
                            <dd>
                                <input type="hidden" class="register-sr-x1"  id="recommend_id" value="{{$id}}"/>
                            </dd>
                            <dd>
                                <input type="hidden" class="register-sr-x1"  id="recommend_ids" value="{{$user_id}}"/>
                            </dd>
                            @else
                            <dd>
                                <input type="hidden" class="register-sr-x1"  id="recommend_id" value=""/>
                            </dd>
                            <dd>
                                <input type="hidden" class="register-sr-x1"  id="recommend_ids" value=""/>
                            </dd>
                            @endif
                        </dl>
                        <dl class=" mt20" style="line-height:17px;">
                            <dd><span class="lowrong" style="display:none;"><em></em><p id="err_msg">&nbsp;</p></span></dd>
                        </dl>
                        <dl class="mt20">
                            <dd class="agreement">
                                <label class="check-box">
                                    <input type="checkbox" class="checkbox" checked="checked" id="aggrement">
                                    <i class=""></i>已阅读并同意<a href="javascript:void(0);" onclick="view_protocol();">《简贷服务协议》</a>
                                </label>
                            </dd>
                        </dl>
                        <dl class="mt15">
                            <dd>
                                <div class="Register-btn"><a href="javascript:void(0);" id="register">立即注册</a></div>
                            </dd>
                        </dl>
                        <dl class="mt15">
                            其他注册方式：
                            @foreach($oauth as $k=>$v)
                            <a href="{{$v['url']}}">
                            <img src="{{$v['logo']}}" title="{{$v['title']}}" width="18px" height="18px">
                            </a>&nbsp;&nbsp;
                            @endforeach
                        </dl>
                    </div>
                    <div style="width:500px;float:left;">
                        <div>
                            <ul class="reg-list" id="reg-list">
                                <li class="reg1" id="reg1"></li>
                                <li class="reg2" id="reg2"></li>
                                <li class="reg3" id="reg3"></li>
                            </ul>
                        </div>
                        <div class="hd">
                            <ul class="slide_regbtn">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}" id="_token">
    <script type="text/javascript" src="Public/web/js/jquery.SuperSlide.2.1.1.js"></script>
    <script>
        $(function () {
            $('.reg-list > li').each(function (index) {
                index++;
                $('.slide_regbtn').append('<li data-index="reg'+index+'"></li>');
                $('.slide_regbtn > li').mouseenter(function () {
                    $('.slide_regbtn > li.on').removeClass('on');
                    $(this).addClass('on');

                    var id = $(this).attr('data-index');
                    $('.reg-list > li.active').removeClass('active');
                    $('#'+id).addClass('active');
                });
                $('.slide_regbtn > li:first').mouseenter();
            });
            setInterval('switch_slide()',2000);
        });

        function switch_slide() {
            if ($('.slide_regbtn > li.on').next().length > 0){
                $('.slide_regbtn > li.on').next().mouseenter();
            }else {
                $('.slide_regbtn > li:first').mouseenter();
            }
        }
        {{--function ChangeCheckCode() {--}}
            {{--$url = "{{ URL('captcha') }}";--}}
            {{--$url = $url + "/" + Math.random();--}}
            {{--document.getElementById('img_code').src=$url;--}}
        {{--}--}}


        $("#register").click(function(){
            var submit_url = "register";
            var user = $("#user").val().trim();
            var phone = $("#phone").val().trim();
            var phone_code = $("#phone_code").val().trim();
            var pwd = $("#pwd").val().trim();
//            var recommend_code = $("#verify_code").val().trim();
            var _token=$("#_token").val().trim();
            var id=$("#recommend_id").val().trim();
            var user_id=$("#recommend_ids").val().trim();


            $("#err_msg").html("").parent('span').hide();

            if(user == '' || user == null) {
                $("#err_msg").html("请输入用户名！").parent('span').show();
                $("#user").focus();
                return false;
            }


            if(phone == '' || phone == null) {
                $("#err_msg").html("请输入手机号码！").parent('span').show();
                $("#phone").focus();
                return false;
            }

            //验证手机号码
            var phone_validate = /^((13)|(14)|(15)|(18)|(17))[0-9]{9}$/;
            if(!phone_validate.test(phone)){
                $("#err_msg").html("手机号码格式错误！").parent('span').show();
                $("#phone").focus();
                return false;
            }

            if(phone_code == '' || phone_code == null) {
                $("#err_msg").html("请输入短信验证码！").parent('span').show();
                $("#phone_code").focus();
                return false;
            }

            if(pwd == '' || phone_code == null) {
                $("#err_msg").html("请输入密码！").parent('span').show();
                $("#pwd").focus();
                return false;
            }

            var pwd_validate =  '^((?=.*[0-9])|(?=.*[~!@#$%^&*()-+_=]))((?=.*[a-z])|(?=.*[A-Z])).{8,16}$';
            if(!(pwd.search(pwd_validate)>=0)) {
                $("#err_msg").html("密码必须是8-16位字母加数字或符号的组合！").parent('span').show();
                $("#pwd").focus();
                return false;
            }

            //协议
            if(!$('#aggrement').is(':checked')) {
                $("#err_msg").html("同意服务协议才能完成注册").parent('span').show();
                return false;
            }
            $.ajax({
                url: submit_url,
                type: 'post',
                data:{'phone':phone, 'phone_code':phone_code, 'login_pwd':pwd,'_token':_token,'user':user,'activity_id':id,'invite_id':user_id},
                dataType: 'json',
                success:function(result){
                    //alert(result)
                    if(result.code == 1) {
                        window.location.href = 'register_tel';
//                        $("#err_msg").html(result.msg).parent('span').show();
                    } else {
                        $("#err_msg").html(result.msg).parent('span').show();
                    }
                }
            });
        });


        //获取手机验证码
        function get_phone_code() {
            var submit_url = "/client";
            var phone = $("#phone").val();
//            var verify_code = $("#verify_code").val();
            var user = $("#user").val().trim();
            var _token=$("#_token").val().trim();
            $("#err_msg").html("").parent('span').hide();
            if(user == '' || user == null) {
                $("#err_msg").html("请输入用户名！").parent('span').show();
                $("#user").focus();
                return false;
            }

            if(phone=='') {
                $("#phone").focus();
                $("#err_msg").html("请输入您的手机号！").parent('span').show();
                return false;
            }

//            if(verify_code=='') {
//                $("#verify_code").focus();
//                $("#err_msg").html("请输入验证码！").parent('span').show();
//                return false;
//            }

            $.ajax({
                url: submit_url,
                type: 'post',
                data:{'phone':phone,'_token':_token,'name':user},
                dataType: 'json',
                success:function(result){
                    if(result.code == 1) {
                        //倒计时
                        settime(60);
                    } else {
                        $("#err_msg").html(result.msg).parent('span').show();
                    }
                }
            });
        }

        //倒计时
        function settime(time) {
            if(time != 0) {
                $("#phone_verify_btn").html(time+'秒后重新获取').removeAttr('onclick').css("background","#bfbfbf");
                time --;

                setTimeout(function(){settime(time);},1000);
            } else {
                $("#phone_verify_btn").attr('onclick', 'get_phone_code();').html('重新获取验证码').css("background","#f5930a");
            }
        }

        //查看协议
        function view_protocol() {
            layer.open({
                type: 2,
                //skin: 'layui-layer-lan',
                title: '简贷服务协议',
                fix: false,
                shadeClose: true,
                maxmin: false,
                area: ['700px', '550px'],
                content: "/web/index/protocol.html",
            });
        }
    </script></div>
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

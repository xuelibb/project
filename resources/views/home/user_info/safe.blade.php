<html>
<body>
<style>
    .renzheng-title-ct a{color:#ff5a4c;font-size:14px;padding:0 0 0 10px;cursor: pointer;}
</style>
<div class="ww">
    <?php include "layout/home/header.php";?>
</div>
<div class="ww both">
    <div class="bg_color1">
        <div class="wl mtauto ofh">
            <?php include "layout/home/user.php";?>
            <div class="fr content-right-x22 bg_color2">
                <div class="content-right-x2-title bdbt_e6">
                    <h3 class="fl pr15 pl15 fs20">安全中心</h3>
                    <div class="fr">
                        <span class="fs14 fstyle1 lh46 fl">安全级别</span>
                        <span class="fr ml5">
     		<i class="star-icon2"></i><i class="star-icon2"></i>     		<i class="star-icon1"></i><i class="star-icon1"></i><i class="star-icon1"></i>     		</span>
                    </div>
                </div>
                <ul class="renzheng-ifo">

                    <li class="renzheng-ifo1 bds_e7 mt20">
                        <div class="renzheng-title ofh">
                            <div class="renzheng-title-icon renzheng-title-icon1 fl"></div>
                            <div class="fl renzheng-title-ct-box">
                                <div class="renzheng-title-ct">实名认证
                                    <span>
                                        @if($model->details_name!=Null)
                                           <?php echo $model->details_name;?>
                                        @else
                                            未认证
                                        @endif
                                    </span>
                                </div>
                                <div class="renzheng-title-tips">保障账户安全，确认出借身份</div>
                            </div>
                            @if($model->details_name!=Null)
                                <div class="renzheng-btn renzheng-btn1 fr dib real_name btn-checked c-808080">已认证</div>
                            @else
                                <div class="renzheng-btn renzheng-btn1 fr dib toggle real_name"><a>去认证</a></div>
                            @endif
                        </div>
                        <div class="centy-fill-box" style="display:none;">
                            <div class="ofh mt20 mb25"><span class="centy-fill-title fl dib">真实姓名：</span>
                                <input type="text" placeholder="" id="real_name" class="fl dib"/></div>
                            <div class="ofh mb25"><span class="centy-fill-title fl dib">身份证号：</span><input type="text" placeholder=""
                                                                                                           id="id_card" class="fl dib"/>
                            </div>
                            <div class="renzheng-btn renzheng-btn2"><a class="" href="javascript:void(0);" id="real_name_verify" onclick="verify_real_name();">提交认证</a></div>
                        </div>
                    </li>

                    <li class="bds_e7 mt20">
                        <div class="renzheng-title ofh">
                            <div class="renzheng-title-icon renzheng-title-icon2 fl"></div>
                            <div class="fl renzheng-title-ct-box">
                                <div class="renzheng-title-ct">手机认证<span>{{$phone}}</span><a href="change_phone" target="_self">修改手机号</a></div>
                                <div class="renzheng-title-tips">保障资金安全，重要的身份凭证，获取账户资金变动通知</div>
                            </div>
                        </div>
                        <div class="centy-fill-box" style="display:none;">
                            <div class="ofh mt20 mb25"><span class="centy-fill-title fl dib">手机号码：</span>
                                <input type="tel" placeholder="" id="phone" class="fl dib"/></div>
                            <div class="renzheng-btn renzheng-btn2"><a href="javascript:void(0);" class="" onclick="verify_phone();">提交认证</a>
                            </div>
                        </div>
                    </li>
                    <li class="bds_e7 mt20">
                        <div class="renzheng-title ofh">
                            <div class="renzheng-title-icon renzheng-title-icon3 fl"></div>
                            <div class="fl renzheng-title-ct-box">
                                <div class="renzheng-title-ct">登录密码</div>
                                <div class="renzheng-title-tips">登录时需要输入的密码</div>
                            </div>
                            <div class="renzheng-btn renzheng-btn1 fr dib toggle"><a>修改</a></div>
                        </div>
                        <div class="centy-fill-box" style="display:none;">
                            <div class="ofh mt20 mb25">
                                <span class="centy-fill-title fl dib">旧登录密码：</span>
                                <input type="password" placeholder="原始登录密码"  id="pwd" class="fl dib" />
                            </div>
                            <div class="ofh mt20 mb25">
                                <span class="centy-fill-title fl dib">新登录密码：</span>
                                <input type="password"  id="new_pwd" class="fl dib" placeholder="8-16位字母加数字或符号的字符" />
                            </div>
                            <div class="ofh mt20 mb25"><span class="centy-fill-title fl dib">确认登录密码：</span>
                                <input type="password" placeholder="再次输入新密码" id="re_new_pwd" class="fl dib"/>
                            </div>
                            <div style="margin:-20px 5px 10px 95px;color:#808080">* 新密码必须8-16位字母加数字或符号的组合</div>
                            <div class="renzheng-btn renzheng-btn2">
                                <a href="javascript:void(0);" class="" id="modify_pwd_btn" onclick="modify_pwd();">确认修改</a></div>
                        </div>
                    </li>
                    <li class="bds_e7 mt20">
                        <div class="renzheng-title ofh">
                            <div class="renzheng-title-icon renzheng-title-icon4 fl"></div>
                            <div class="fl renzheng-title-ct-box">
                                <div class="renzheng-title-ct">支付密码</div>
                                <div class="renzheng-title-tips">保障资金安全，充值、取现、出借等资金相关操作时使用</div>
                            </div>
                            <div class="renzheng-btn renzheng-btn1 fr dib toggle" >
                            <a>设置</a>
                            </div>
                        @if($model->details_pay==Null)
                        </div>
                        <div class="centy-fill-box" id="pay_pwd" style="display:none;">
                        <div class="ofh mt20 mb25"><span class="centy-fill-title fl dib">支付密码：</span><input type="password" placeholder="支付密码" id="user_pay_pwd"/></div>
                        <div class="ofh mt20 mb25"><span class="centy-fill-title fl dib">确认支付密码：</span><input type="password" placeholder="请务必牢记密码" id="user_enter_pwd"/></div>
                        <div class="renzheng-btn renzheng-btn2">
                            <a href="javascript:void(0);" class="" id="pay_pwd_btn" onclick="pay_pwd();">确认修改</a>
                        </div>
                        @else
                        </div>
                        <div class="centy-fill-box" id="pay_pwd" style="display:none;">
                        <div class="ofh mt20 mb25"><span class="centy-fill-title fl dib">旧支付密码：</span><input type="password" placeholder="旧支付密码" id="old_pay_pwd"/></div>
                        <div class="ofh mt20 mb25"><span class="centy-fill-title fl dib">支付密码：</span><input type="password" placeholder="支付密码" id="upload_user_pay_pwd"/></div>
                        <div class="ofh mt20 mb25"><span class="centy-fill-title fl dib">确认支付密码：</span><input type="password" placeholder="请务必牢记密码" id="upload_user_enter_pwd"/></div>
                        <div class="renzheng-btn renzheng-btn2">
                            <a href="javascript:void(0);" class="" id="upload_pay_pwd_btn" onclick="upload_pay_pwd();">确认修改</a>
                        </div>
                        @endif

                        </div>
                    </li>
                    <li class="bds_e7 mt20">
                        <div class="renzheng-title ofh">
                            <div class="renzheng-title-icon renzheng-title-icon5 fl"></div>
                            <div class="fl renzheng-title-ct-box">
                                <div class="renzheng-title-ct">绑定银行卡</div>
                                <div class="renzheng-title-tips">保障资金安全，充值、取现资金建议同卡进出</div>
                            </div>
                            <div class="renzheng-btn renzheng-btn1 fr dib"><a href="bank_info">绑定</a></div>        </div>
                    </li>
                    <li class="bds_e7 mt20">
                        <div class="renzheng-title ofh">
                            <div class="renzheng-title-icon renzheng-title-icon7 fl"></div>
                            <div class="fl renzheng-title-ct-box">
                                <div class="renzheng-title-ct">风险承受能力
                                    @if(session('assess')=='0')
                                    <span>保守型<em class="fc_80">(默认)</em></span>
                                    @else
                                    <span>{{session('assess')}}</span>
                                    @endif
                                </div>
                                <div class="renzheng-title-tips">根据风险评估结果选择您适合的投资项目<em class="fc_ff5a4c">(今年还可评估{{session('number')}}次)</em></div>
                            </div>
                            @if(session('number')>=1)
                            <div class="renzheng-btn renzheng-btn1 fr dib"><a href="survey">去评估</a></div>
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="renzheng-title ofh">
                            <div class="renzheng-title-icon renzheng-title-icon6 fl"></div>
                            <div class="fl renzheng-title-ct-box">
                                <div class="renzheng-title-ct">电子邮箱

                                        @if($model->details_email!=Null)
                                        <span>
                                            {{$model->details_email}}
                                        </span>
                                        @endif

                                </div>
                                <div class="renzheng-title-tips">获取账户资金变动通知和出借讯息</div>
                            </div>
                            @if($model->details_email!=Null)
                            <div class="renzheng-btn renzheng-btn1 fr dib real_name btn-checked c-808080">已认证</div>
                            @else
                            <div class="renzheng-btn renzheng-btn1 fr dib toggle"><a>去设置</a></div>
                            @endif
                        </div>
                        <div class="centy-fill-box" id="set_to_email" style="display:none;">
                            <div class="ofh mt20 mb25"><span class="centy-fill-title fl dib">电子邮箱：</span><input type="email" placeholder="" id="get_email"/></div>
                            <div class="renzheng-btn renzheng-btn2"><a class="" href="javascript:void(0);" id="set_email" onclick="set_email();">确认</a></div>
                        </div>
                    </li>
                </ul>
                <div style="height:200px;"></div>
                <input type="hidden" name="_token" value="{{csrf_token()}}" id="_token">

                <script>
                    var verify_real = Number("1");
                    var identity_type = Number("1");

                    function set_pay_password() {
                        if (verify_real != 2 && identity_type == 1) {
                            layer.open({
                                type: 2,
                                title: '实名认证',
                                fix: true,
                                shadeClose: true,
                                maxmin: false,
                                area: ['455px', '340px'],
                                content: "/web/user/real_name_box.html",
                            });

                            return false;
                        }

                        return true;
                    }


                    $('.toggle').click(function () {
                        var is_real_name = $(this).hasClass("real_name");
                        //企业会员
                        if(is_real_name && identity_type == 2) {
                            layer.alert('您是企业会员，请联系客服完成认证！', {icon: 3});
                            return false;
                        }

                        $(this).parent('.renzheng-title').toggleClass('renzheng-title-bg');
                        $(this).parent('.renzheng-title').siblings('.centy-fill-box').toggle();
                        $(this).parent('.renzheng-title').parent(this).toggleClass('bd_ff5a4c');
                        $(this).parent('.renzheng-title').parent(this).siblings().removeClass('bd_ff5a4c');
                        $(this).parent('.renzheng-title').parent(this).siblings().children('.centy-fill-box').hide();
                        $(this).parent('.renzheng-title').parent(this).siblings().children('.renzheng-title').removeClass('renzheng-title-bg');
                    })

                    //点击实名认证
                    function verify_real_name() {
                        var real_name = $("#real_name").val();
                        var id_card = $("#id_card").val();
                        var real_name_check = /^[\u4e00-\u9fa5]{2,6}$/;
                        var id_card_check = /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;
                        var url = "user_card_add";
                        var _token=$("#_token").val();

                        if (!real_name_check.test(real_name)) {
                            layer.alert('真实姓名格式有误！', {icon: 2});
                            return false;
                        }

                        if (!id_card_check.test(id_card)) {
                            layer.alert('身份证号码格式有误！', {icon: 2});
                            return false;
                        }

                        $("#real_name_verify").attr('onclick',"");
                        $("#real_name_verify").css({color:"#fff",background:"#ccc"});
                        $("#real_name_verify").parent("div").css({border:"1px solid #ccc"});


                        $.ajax({
                            url: url,
                            type: 'post',
                            data: {'real_name': real_name, 'cert_no': id_card,'_token':_token},
                            dataType: 'json',
                            success: function (result) {
                                if (result.code == 1) {
                                    layer.alert(result.msg, {code: 1}, function () {
                                        window.location.reload();
                                    });
                                } else {
                                    layer.alert(result.msg, {icon: 2});
                                    $("#real_name_verify").attr('onclick',"verify_real_name();");
                                    $("#real_name_verify").removeAttr("style");
                                    $("#real_name_verify").parent("div").css({border:"1px solid #ff5a4c"});
                                }
                            }
                        });

                    }


                    //点击手机验证
                    function verify_phone() {
                        var phone = $("#phone").val();
                        var phone_check = /^((13)|(14)|(15)|(18)|(17))[0-9]{9}$/;
                        var url = "/web/user/bind_phone.html";

                        if (!phone_check.test(phone)) {
                            layer.alert('手机号码格式有误！', {icon: 2});
                            return false;
                        }

                        $.ajax({
                            url: url,
                            type: 'post',
                            data: {'phone': phone},
                            dataType: 'json',
                            success: function (result) {
                                if (result.code == 1000) {
                                    layer.alert(result.msg, {icon: 1}, function () {
                                        window.location.reload();
                                    });
                                } else {
                                    layer.alert(result.msg, {icon: 2});
                                }
                            }
                        });
                    }

                    //修改密码
                    function modify_pwd() {
                        var pwd = $("#pwd").val();
                        var new_pwd = $("#new_pwd").val();
                        var re_new_pwd = $("#re_new_pwd").val();
                        var _token=$("#_token").val();
                        var pwd_check = /^[0-9a-zA-Z]{6,20}$/;
                        var url = "upload_login_pwd";

                        if (pwd == '' || pwd == null) {
                            layer.alert('请输入旧密码！', {icon: 2});
                            return false;
                        }

                        if (pwd == new_pwd) {
                            layer.alert('新密码不得与旧密码一致！', {icon: 2});
                            return false;
                        }

                        if (!pwd_check.test(new_pwd)) {
                            layer.alert('新密码格式有误！', {icon: 2});
                            return false;
                        }

                        if (new_pwd != re_new_pwd) {
                            layer.alert('两次新密码不一致！', {icon: 2});
                            return false;
                        }

                        $("#modify_pwd_btn").attr('onclick',"");
                        $("#modify_pwd_btn").css({color:"#fff",background:"#ccc"});
                        $("#modify_pwd_btn").parent("div").css({border:"1px solid #ccc"});


                        $.ajax({
                            url: url,
                            type: 'post',
                            data: {'old_pwd': pwd, 'new_pwd': new_pwd, 're_new_pwd': re_new_pwd,'_token':_token},
                            dataType: 'json',
                            success: function (result) {
                                if (result.code == 1) {
                                    layer.alert(result.msg, {icon: 1}, function () {
                                        window.location.reload();
                                    });
                                } else {
                                    layer.alert(result.msg, {icon: 2});
                                    $("#modify_pwd_btn").attr('onclick',"modify_pwd();");
                                    $("#modify_pwd_btn").removeAttr("style");
                                    $("#modify_pwd_btn").parent("div").css({border:"1px solid #ff5a4c"});
                                }
                            }
                        });
                    }

                    //设置支付密码
                    function pay_pwd() {
                        
                        var pay_pwd=$("#user_pay_pwd").val();
                        var enter_pay=$("#user_enter_pwd").val();
                        var _token=$("#_token").val();
                        var url = "user_pay_pwd";
                        if (pay_pwd != enter_pay) {
                            layer.alert('两次新密码不一致！');
                            return false;
                        }
                        $.ajax({
                            url: url,
                            type: 'post',
                            data: {'pay_pwd':pay_pwd,'_token':_token},
                            dataType: 'json',
                            success: function (result) {
                                layer.closeAll();
                                if (result.code == 1) {
                                    layer.alert(result.msg, {code: 1}, function () {
                                        window.location.reload();
                                    });
                                } else {
                                    layer.alert(result.msg, {icon: 2});
                                }
                            }
                        });
                    }

                    //修改支付密码
                    function upload_pay_pwd() {
                        var old_pay_pwd=$("#old_pay_pwd").val();
                        var upload_pay_pwd=$("#upload_user_pay_pwd").val();
                        var upload_enter_pay=$("#upload_user_enter_pwd").val();
                        var _token=$("#_token").val();
                        var url = "upload_pay_pwd";
                        if (old_pay_pwd == upload_pay_pwd) {
                            layer.alert('新密码不得与旧密码一致！', {icon: 2});
                            return false;
                        }
                        if (upload_pay_pwd != upload_enter_pay) {
                            layer.alert('两次新密码不一致！');
                            return false;
                        }
                        if (upload_pay_pwd == '' || upload_enter_pay == null) {
                            layer.alert('请输入旧密码！', {icon: 2});
                            return false;
                        }
                    
                        $.ajax({
                            url: url,
                            type: 'post',
                            data: {'upload_pay_pwd':upload_pay_pwd,'_token':_token,'old_pay_pwd':old_pay_pwd},
                            dataType: 'json',
                            success: function (result) {
                                layer.closeAll();
                                if (result.code == 1) {
                                    layer.alert(result.msg, {code: 1}, function () {
                                        window.location.reload();
                                    });
                                } else {
                                    layer.alert(result.msg, {icon: 2});
                                }
                            }
                        });
                    }

                    //设置邮箱
                    function set_email(){
                        var email=$("#get_email").val();
                        //进行邮箱验证
                        var check_tmail=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        var _token=$("#_token").val();
                        var url='add_email';
                        if (email == '' || email == null) {
                            layer.alert('请输入邮箱', {icon: 2});
                            return false;
                        }
                        if (!check_tmail.test(email)) {
                            layer.alert('邮箱格式错误，请核对检查！', {icon: 2});
                            return false;
                        }
                        $.ajax({
                            url: url,
                            type: 'post',
                            data: {'email':email,'_token':_token},
                            dataType: 'json',
                            success: function (result) {
                                layer.closeAll();
                                if (result.code == 1) {
                                    layer.alert(result.msg, {code: 1}, function () {
                                        window.location.reload();
                                    });
                                } else {
                                    layer.alert(result.msg, {icon: 2});
                                }
                            }
                        });
                    }


                </script>


            </div>
        </div>
    </div>
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
    <?php include "layout/home/footer.php";?>
</div>
</body>
</html>
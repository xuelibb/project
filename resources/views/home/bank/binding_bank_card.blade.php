<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>招财喵</title>
    <link type="text/css" rel="stylesheet" href="Public/web/css/basic.css">
    <link type="text/css" rel="stylesheet" href="Public/web/css/index.css">
    <link type="text/css" rel="stylesheet" href="Public/web/iconfont/iconfont.css">
    <link type="text/css" rel="stylesheet" href="Public/web/js/layer/skin/layer.css">
    <link type="text/css" rel="stylesheet" href="Public/web/css/call.css">

    <script type="text/javascript" src="Public/web/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="Public/web/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="Public/web/js/layer/layer.js"></script>
    {{--<link rel="stylesheet" href="https://www.jiandai.com/Public/web/js/layer/skin/layer.css" id="layui_layer_skinlayercss" style="">--}}
    <script type="text/javascript" src="Public/web/js/function.js"></script>
</head>
<body style="">
<!--绑定银行卡-->
<div class="popup-box popup-box1  identity-popup-box">
    <div class="fstyle1 fc3 ofh mt30 fs16"><span>卡  号：</span><input type="text" placeholder="请输入银行卡号" id="bank_account_no"></div>
    <div class="fstyle1 fc3 ofh mt30 psr fs16">
        <span>银  行：</span><input type="text" placeholder="银行" disabled="disabled" id="bank_type" bank_id="" value="">
    </div>
    <div class="fstyle1 fc3 ofh mt35 fs16"><span>手机号：</span><input type="text" placeholder="请输入银行预留的手机号码" id="phone_no"></div>
    <div class="fstyle1 fc3 ofh mt30 fs16">
        <span>验证码：</span>
        <div class="fr dib countdown" id="phone_verify_btn" onclick="get_phone_code();">获取验证码</div>
        <input type="text" placeholder="" class="yzm-into" id="phone_code">
    </div>
    @if(session('msg'))
        <div class="fstyle1 fc_red ofh mt15 mb15" id="err_msg" style="min-height:22px;max-height: 35px;">{{session('msg')}}</div>
    @else
    <div class="fstyle1 fc_red ofh mt15 mb15" id="err_msg" style="min-height:22px;max-height: 35px;">
    </div>
    @endif
    <input type="hidden" id="ticket">
    <div class="tc btn_bg fc0 fs22 identity-btn mb30" id="do_bind">同意协议并绑定</div>
    {{--<div class="protocol"><a class="fc_red6 save_money" url="/web/user/protocol/article_id/21.html">《存钱罐服务协议》</a>  <a url="/web/user/protocol/article_id/22.html" class="fc_red6 sina_pay">《新浪快捷支付协议》</a></div>--}}
</div>
<input type="hidden" id="_token" value="{{csrf_token()}}">
<script>
    $("#bank_account_no").blur(function(){
        var bank_card = $(this).val();
        var _token=$("#_token").val();
        var url_format = /^(\d{16}|\d{18}|\d{19})$/;
        if(!url_format.test(bank_card)) {
            var msg = "<em></em>请输入正确的银行卡号";
            $("#err_msg").html(msg);
            return false;
        } else {
            $("#err_msg").html("");
        }

        $.ajax({
            url: "get_bank_info",
            type: 'post',
            data:{'bank_card':bank_card,'_token':_token},
            dataType: 'json',
            success:function(result){
                $("#bank_type").attr('value',result.bank_name);
                $("#bank_type").attr('bank_id',result.bank_id);


            }
        });
    });
    //获取验证码
    function get_phone_code() {
        //卡号
        var bank_account_no = $("#bank_account_no").val().trim();
        var phone_no = $("#phone_no").val().trim();
        var _token=$("#_token").val();


        if(bank_account_no == '' || bank_account_no == null) {
            var msg = "<em></em>请输入银行卡号";
            $("#err_msg").html(msg);
            return false;
        }
        var url_format = /^(\d{16}|\d{18}|\d{19})$/;

        if(!url_format.test(bank_account_no)) {
            var msg = "<em></em>请输入正确的银行卡号";
            $("#err_msg").html(msg);
            return false;
        }

        if(phone_no == '' || phone_no == null) {
            var msg = "<em></em>请输入手机号码";
            $("#err_msg").html(msg);
            return false;
        }
        if(!/^1[3|5|8|7]\d{9}$/.test(phone_no)) {
            var msg = "<em></em>手机号格式不正确";
            $("#err_msg").html(msg);
            return false;
        }

        $("#err_msg").html("");

        //TODO格式验证
        $.ajax({
            url: 'phone_client',
            type: 'post',
            data:{'phone_no':phone_no,'_token':_token},
            dataType: 'json',
            success:function(result){
                if(result.code == 1) {
                    settime(60);
                } else {
                    var msg = "<em></em>"+result.msg;
                    $("#err_msg").html(msg);
                }
            }
        });
    }


    $("#do_bind").click(function(){
        var bank_account_no = $("#bank_account_no").val().trim();
        var bank_id=$("#bank_type").attr('bank_id').trim();
        var phone_no = $("#phone_no").val().trim();
        var valid_code = $("#phone_code").val().trim();
        var _token=$("#_token").val();

        if(bank_account_no == '' || bank_account_no == null) {
            var msg = "<em></em>请输入银行卡号";
            $("#err_msg").html(msg);
            return false;
        }

        var url_format = /^(\d{16}|\d{18}|\d{19})$/;

        if(!url_format.test(bank_account_no)) {
            var msg = "<em></em>请输入正确的银行卡号";
            $("#err_msg").html(msg);
            return false;
        }

        if(bank_id == '' || bank_id == null) {
            var msg = "<em></em>请重新输入卡号获取银行信息";
            $("#err_msg").html(msg);
            return false;
        }

        if(valid_code == '' || valid_code == null) {
            var msg = "<em></em>请输入手机验证码！";
            $("#err_msg").html(msg);
            return false;
        }

        //TODO格式验证
        $.ajax({
            url: 'binding_bank_card_advance',
            type: 'post',
            data:{'phone_no':phone_no,'bank_id':bank_id,'bank_account_no':bank_account_no, 'valid_code':valid_code,'_token':_token},
            dataType: 'json',
            success:function(result){
                if(result.code == 1) {
                    //$("#ticket").val(result.data.ticket);
                    alert('绑定银行卡成功！', {icon:1});
                    setTimeout(function(){top.location.reload();}, 3000);
                } else {
                    var msg = "<em></em>"+result.msg;
                    $("#err_msg").html(msg);
                    return false;
                }
            }
        });

    });

    //倒计时
    function settime(time) {
        if(time != 0) {
            $("#phone_verify_btn").html(time+'秒后重新获取').removeAttr('onclick').css("background","#bfbfbf");
            time --;

            setTimeout(function(){settime(time);},1000);
        } else {
            $("#phone_verify_btn").attr('onclick', 'get_phone_code();').html('重新获取验证码').css("background", "#f5930a");
        }
    }
</script>

</body></html>
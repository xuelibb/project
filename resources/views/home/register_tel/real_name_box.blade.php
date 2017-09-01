<link type="text/css" rel="stylesheet" href="Public/web/css/basic.css">
<link type="text/css" rel="stylesheet" href="Public/web/css/index.css">
<link type="text/css" rel="stylesheet" href="Public/web/css/iconfont.css">
<link type="text/css" rel="stylesheet" href="Public/web/css/layer.css">
<link type="text/css" rel="stylesheet" href="Public/web/css/call.css">
<script type="text/javascript" src="Public/web/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="Public/web/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="Public/web/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="Public/web/js/layer.js"></script><link rel="stylesheet" href="Public/web/css/layer.css" id="layui_layer_skinlayercss" style="">
<script type="text/javascript" src="Public/web/js/function.js"></script>
<script src="Public/web/js/browser_judgment.js"></script>
<form action="register_tel" method="post" enctype="multipart/form-data" id="upload_form" >
        <div class="register-box">
            <div style="height:23px;"></div>
            <dl class="mt10">
                <dt>身份证照片：</dt>
                <dd>
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="_token">
                    <input placeholder="请上传你的有效证件" class="register-sr-x1" name="id_photos" id="id_photos"type="file">
                    <input type="hidden" name="box" value="box">
                </dd>
            </dl>
            <dl class="mt20">
                @if(session('msg'))
                    <dd class="f14 fc_80" style="color: red">{{session('msg')}}</dd>
                @else
                    <dd class="f14 fc_80" style="color: red">亲~为避免不必要的麻烦，请务必上传本人身份证哦！</dd>
                @endif
            </dl>
            <dl class="mt20">
                <dt>示例图片：</dt>
                <dd class="f14 fc_80"><img src="Public/web/images/shili.jpg" height="150px"></dd>
            </dl>
            <dl class="mt20">
                <dd class="agreement">
                    <label class="check-box"><input class="checkbox" checked="checked" id="aggrement" type="checkbox"><i class=""></i>已阅读并同意<a href="javascript:void(0);" onclick="view_protocol();">《招财喵服务协议》</a></label>
                </dd>
            </dl>
            <div class="id_photos" >

            </div>
            <dl class="mt15">
                <dd>
                    <div class="Register-btn"><a  href="javascript:void(0);" id="verify_real_name">下一步</a></div>
                </dd>
            </dl>
            <dl class="mt15">
                <dd class="f14 tc fc_80">资金由新浪支付全程托管</dd>
            </dl>
            <div style="height:106px;"></div>
        </div>
</form>

<script>
    $("#verify_real_name").click(function() {

        $("#err_msg").html("").parent('span').hide();


        //协议
        if(!$('#aggrement').is(':checked')) {
            $("#err_msg").html("同意服务协议才能完成实名认证").parent('span').show();
            return false;
        }
        $("#upload_form").submit();
    });


</script>

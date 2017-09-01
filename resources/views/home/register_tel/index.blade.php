<html>
<body>
<div class="ww">
<div class="Top-position">
	<!--头部开始-->
	<?php include "layout/home/header.php";?>
</div>

</div>

<div class="center"><!--填写账户信息 -->
<div class="bg_color4 pt40">
	<div class="wl mtauto bg_color2 pb30">
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
                <li class="register-pro2 on">
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
        <form action="register_tel" method="post" enctype="multipart/form-data" id="upload_form" >
        <div class="register-box">
        	<div style="height:23px;"></div>
            <dl class="mt10">
            	<dt>身份证照片：</dt>
                <dd>
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="_token">
                	<input placeholder="请上传你的有效证件" class="register-sr-x1" name="id_photos" id="id_photos" type="file">
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
    </div>
</div>

<script>
$("#verify_real_name").click(function() {

	$("#err_msg").html("").parent('span').hide();


	//协议
	if(!$('#aggrement').is(':checked')) {
		$("#err_msg").html("同意服务协议才能完成实名认证").parent('span').show();
		return false;
	}
    $("#upload_form").submit();
    alert('请您耐心等待5秒中~');
});


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

</body></html>

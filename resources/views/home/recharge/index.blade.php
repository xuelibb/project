<body>
<div class="ww">
    <div class="Top-position">
        <?php include "layout/home/header.php";?>
    </div>
</div>

<div class="ww both">
<div class="bg_color1">
<div class="wl mtauto ofh">
<?php include "layout/home/user.php";?>
	<div class="fr content-right-x22 bg_color2">
	<div class="content-right-x2-title bdbt_e6">
	<h3 class="fl pr25 fs20">我的资金</h3>
    <div class="fr return-money-btn">
    	<a href="javascript:void(0);" class="checked">充值</a>
    	<a href="/web/user/recharge_list.html">充值记录</a>
    </div>
</div>
            

<div class="ofh width100">
	 <div class="fs12 fc_80 fstyle1 ofh sina-pay mt18 fl">
         <span class="fl dib mr10 cash-sina-icon"></span>
         <span class=" fl dib pt8">新浪支付全程提供账户托管和支付服务</span>
     </div>
     <div class="fs12 fstyle1 fr mt20"><a href="/web/user/bank_quota.html" class="fc_blue1">限额查询</a>
     </div>
</div>
<div class="ofh mt56">
    <form action="alipay/pay" method="POST" id="recharge_form" target="_blank">
    <div>
        <input type="radio" name="pay" value="alipay"><img src="Public/web/images/alipay.png" alt="" width="180" height="40">
        <input type="radio" name="pay" value="weixinpay"><img src="Public/web/images/weixinpay.png" alt="">
    </div>
	<div class="fl dib recharge-box-fl recharge-box-fl-x1 Invest-wanted-price" style="display:block;margin:0;">

        <div class="fc_red4 fs26 fstyle2 bold ml50 ofh mt30"><span class="pr15">账户余额(元):</span>{{$model->details_balance}}</div>
        <div class="ml50 ofh mt15 "><span>充值金额(元)：</span><input type="text" placeholder="" id="recharge_amount" name="recharge_amount"/>
                <div style="display: none;position:absolute;width:250px;top:80px;left:118px;" id="tip_info">
                    <div class="icon"></div>
                    <div class="tip" style="height:98px;">
                        <ul>
                            <li>最低100元起充值 </li>
                            <li>可使用绑定银行卡充值 </li>
                            <li>大额充值可使用网银ukey充值</li>
                        </ul>
                    </div>
                </div>
        </div>
        <div class="login-true fstyle1 ofh" style="height:27px;margin:5px 40px 10px;">
          		<i class="icon-reset fl" style="margin:10px;display:none;"></i>
          		<span class="fl" id="err_msg" style="color:#ff0000;"></span>
        </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="ml120 pl25"><div class="recharge-now-btn fs18 tc" id="do_recharge">立即充值</div></div>

    </div>
        @if($brank!=Null)
            @foreach($brank as $k=>$v)
                <?php
                $bank_name=DB::table('bank_name')->where('bank_id',$v['bank_name_id'])->first();
                ?>
        <div class="fr dib recharge-box-fr" style="display:block">
            <div class="ofh mt25">
                <div class="fl dib bank-icon"></div>
                <div class="fl dib">
                    <div class="fs24 bold fc3 mt10">{{$bank_name['bank_name']}}</div>
                    <div class="fs20 fc_80 fstyle3 mt25">{{substr($v['bank_card'],0,4).'*********'.substr($v['bank_card'],-4,4)}}</div>
                </div>
                <div class="fr dib pr15 fs14 fc_80 fstyle1 mt20">{{$bank_name['bank_type']}}</div>
            </div>
            <div class="ofh fs18 fc0 bank-card-type mt20 bank-card-type-bg9">
                <div class="fl dib ml20">快捷卡支付已开通</div>
                <div class="fr dib mr20"><em></em>安全卡</div>
            </div>
            <div class="fs12 fc_80 fstyle1 ml20 mt15 tc">
                单笔限额5万元，单日限额50万          </div>
        </div>
            @endforeach
        @endif

    </form>
</div>

<div class="fs14 fstyle1 fc_80 mt40 bd_e6 pl20 pt20 pb20">
	<div><span class="block bold">温馨提示:</span></div>
	<div class="ofh lh36 mt5" ><span class="fl dib">1、</span><p class="fl">目前充值免费；</p></div>
    <div class="ofh lh36 mt5" ><span class="fl dib">1、</span><p class="fl">目前暂时支持支付宝；</p></div>
	<div class="ofh lh36"><span class="fl dib">2、</span><p class="fl">充值金额应不少于100元，单笔超过100万请使用<span class="fc_red">招商银行、农业银行、浦发银行、兴业银行</span>等网银充值；</p></div>
	<div class="ofh lh36"><span class="fl dib">4、</span><p class="fl">严禁洗钱、信用卡套现等不良行为，一经发现将严厉处罚，包括但不限于：限制收款、冻结账户、永久封号，还将影响<br>您的银行征信记录；</p></div>
	<div class="ofh lh36"><span class="fl dib">5、</span><p class="fl">充值期间，请勿关闭浏览器，如有疑问，请咨询客服：400-8858-258；</p></div>
  </div>

<div style="height:450px;"></div>

<script>
var identity_type = Number("1");
var obj = $(".sideMenu-icon2").parent().parent("h3");
obj .addClass("on");
obj.siblings("ul").show();
obj.siblings("ul").children("li").eq(1).children("a").addClass("active");

$("#do_recharge").click(function(){

	var amount = $("#recharge_amount").val();
	if(isNaN(amount)){
		$("#err_msg").html('充值金额有误！').prev('i').show();
		return false;
	}
	if(amount < 0.01) {
		$("#err_msg").html('充值金额不得低于100元！').prev('i').show();
		return false;
	}

	$("#recharge_form").submit();

	/**
	layer.load(3);
	$.ajax({
		url: "/web/user/recharge.html",
		type: 'post',
		data:{'amount':amount},
		dataType: 'json',
		success:function(result){
			layer.closeAll();
			if(result.code == 1000) {
				var url = '/web/index/redirect_url.html';
				sina_redirect(url, '充值');
			} else {
				layer.alert(result.msg, {icon:2});
			}
		}
	});
	**/
});

$("#recharge_amount").keyup(function(){
	var amount = $("#recharge_amount").val();
	//如果输入的不是数字，则默认100
	if(isNaN(amount)){
		$("#err_msg").html('充值金额有误！').prev('i').show();
		return false;
	} else {
		$("#err_msg").html('').prev('i').hide();
	}

});


$("#recharge_amount").hover(function(event){
    $("#tip_info").show();
}, function(event){
    $("#tip_info").hide();
});
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
<?php include "layout/home/footer.php";?>
</div>
</body>
</html>
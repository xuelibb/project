<!DOCTYPE html>
<html>


<div class="ww">

    <?php include "layout/home/header.php";?>

</div>
<?php   date_default_timezone_set('Asia/Shanghai'); ?>
<script>
    window.addEventListener(
        "scroll",function(){
            var scrollTop=document.body.scrollTop;
            if(scrollTop>200){
                $("#hidden-header").removeClass("Top-position3").addClass("Top-position4")
            }
            if(scrollTop<=200){
                $("#hidden-header").removeClass("Top-position4").addClass("Top-position3")
            }
        }
    );

    //顶部微信弹出
    $('#login_way').mouseenter(function(){
        $('#login_way em').addClass('active1');
        $('#login_way .icon-down').addClass('active2').removeClass('icon-down');
        $('.login_way_more').show();
    })
    $('#login_way').mouseleave(function(){
        $('#login_way em').removeClass('active1');
        $('#login_way .active2').removeClass('active2').addClass('icon-down');
        $('.login_way_more').hide();
    })


    jQuery("#nav").slide({
        type:"menu",// 效果类型，针对菜单/导航而引入的参数（默认slide）
        titCell:".nLi", //鼠标触发对象
        targetCell:".sub", //titCell里面包含的要显示/消失的对象
        effect:"slideDown", //targetCell下拉效果
        delayTime:300 , //效果时间
        triggerTime:0, //鼠标延迟触发时间（默认150）
        returnDefault:true //鼠标移走后返回默认状态，例如默认频道是“预告片”，鼠标移走后会返回“预告片”（默认false）
    });
    jQuery("#nav1").slide({
        type:"menu",// 效果类型，针对菜单/导航而引入的参数（默认slide）
        titCell:".nLi", //鼠标触发对象
        targetCell:".sub", //titCell里面包含的要显示/消失的对象
        effect:"slideDown", //targetCell下拉效果
        delayTime:300 , //效果时间
        triggerTime:0, //鼠标延迟触发时间（默认150）
        returnDefault:true //鼠标移走后返回默认状态，例如默认频道是“预告片”，鼠标移走后会返回“预告片”（默认false）
    });
    $('.account-more').mouseenter(function(){
        $('.my-account').children('h3').children('a').addClass('active');
    })
    $('.account-more').mouseleave(function(){
        $('.my-account').children('h3').children('a').removeClass('active');
    })

</script>

<div class="center"><style>
		.tender_help  ul li {
			margin: 0 !important;
			text-align: right !important;
		}
		.Invest-detail-box .com-num {
			max-width: 40%;
		}
		.Invest-detail-box .com-num a{
			font-size: 14px;
			margin-right: 20px;
		}
		.help-ifo li.help-ifo-xx {
			padding: 12px 0px 24px 37px;
		}
	</style>
	<div class="ww both">
		<!--面包屑-->
		<div class="bg_color1 both">
			<div class="wl mtauto">
				<div class="crumbs">
					<i class="iconfont location_icon"></i>您当前所在的位置：<a href="/" class="fc_80">简贷</a><em>&gt;</em><a href="invest" class="fc_80">我要出借</a><em>&gt;</em>出借详情</div>
			</div>
		</div>

		<!--content-->
		<div class="bg_color1">
			<div class="wl mtauto bg_color2">
				<div class="ofh Invest-detail-box">
					<div class="fl content-left-x1 bd_e6">
						<dl>
							<dt class="ofh">
							<div class="com-pic fl dib">
								<img src="Public/web/images/domain.png">
							</div>
							<div class="com-name fl dib" title="h.cc"><?=$info['lend_goods']?></div>

							<div class="com-num fr dib">
								编号：<?=$info['lend_number']?></div>
							</dt>
							<dd class="com-ifo-part1">
								<ul class="ofh">
									<li class="fl width40">
										<div class="com-ifo-part1-tp">借款总额</div>
										<div class="com-ifo-part1-ft fc_orange1"><?php echo sprintf("%.2f",$info['lend_money']/10000) ;?><span>万</span></div>
									</li>
									<li class="fl width35">
										<div class="com-ifo-part1-tp">预期年化利率</div>
										<div class="com-ifo-part1-ft fc_red2"><?=$info['lend_return']?></div>
									</li>
									<li class="fr width25">
										<div class="com-ifo-part1-tp">借款期限</div>
										<div class="com-ifo-part1-ft fc_4d">
                                            <?=$info['lend_repay_time']?><span>个月</span>                            	</div>
									</li>
								</ul>
							</dd>
							<dd class="com-ifo-part2">
								<div class="ofh">
									<div class="fl dib width40"><span>最低金额：</span><div class="com-ifo-part-ct"><?php  echo sprintf("%.2f",$info['lend_few_money'])  ?>元</div></div>
									<div class="fl dib width40"><span>上架时间：</span><div class="com-ifo-part-ct"><?php  echo  date('Y-m-d H:i:s',$info['lend_start_time'] )?></div></div>
								</div>
								<div class="ofh">
									<div class="fl dib width40"><span> 剩余金额：</span><div class="com-ifo-part-ct" id='wz_syje'><?php echo sprintf("%.2f",($info['lend_money']-$info['lend_repay_money'])/10000);?>万</div></div>
									<div class="fl dib width40"><span>截止时间：</span><div class="com-ifo-part-ct"><?php  echo  date('Y-m-d H:i:s',$info['lend_end_time'] )?></div></div>
								</div>
								<div class="ofh">
									<div class="fl dib width40"><span> 还款方式：</span><div class="com-ifo-part-ct">
                                            <?php if ($info['lend_repay_method']==1){ ?>
											等额本息
                                            <?php }   else  { ?>
											先息后本
                                            <?php  } ?>
										</div></div>
									<div class="fl dib">
										<span>出借进度：</span>
										<div class="fl dib trade-time-box">
											<div class="trade-time-bar fl dib">
												<div class="trade-time-in" id='wz_jindutiao' style="width:<?php echo ($info['lend_repay_money']/$info['lend_money']*100); ?>%"></div>
											</div>
											<div class="fl dib trade-time-percent"  id='wz_jindu' ><?php echo floor($info['lend_repay_money']/$info['lend_money']*100); ?>%</div>
										</div>
									</div>
								</div>
							</dd>
						</dl>
					</div>
					<div class="fr content-right-x1 bd_e6">
						<dl>
							<dt class="ofh">
							<div class="fl dib fs22 fc3">我要出借</div>
							<div class="fr dib fs12 fstyle1 fc_cc">友情提示：出借有风险</div>

                            <?php if($info['lend_repay_money']==$info['lend_money']) {?>
							<dd >
								<div class="tc mt38"  ><img src="Public/web/images/r1_bg.png"></div>
								<div class="fs14 fc3 tc mt20 lh34">亲~！！来晚了一步哦····</div>
								{{--  <div class="fs14 fc3 tc lh34 mb15">完成时间：2017-06-12 19:31:14</div>--}}
							</dd>
							</dt>
                            <?php } else	if(session('islogin')!=1){      ?>
							<dd class="content-right-ifo1">
								<div class="ofh mt15">
									<div class="fl dib width65">
										<div class="fs14 lh32 ofh"><span class="fl dib">账号余额：</span>
											<div class="fc3 fl dib content-right-ifo1-ct">
												尚未登录                                </div>
										</div>
										<div class="fs14 lh32 ofh"><span class="fl dib">可投金额：</span>
											<div class="fc3 fl dib fstyle2 fs14 bold content-right-ifo1-ct">0.00<span>元</span></div>
										</div>
									</div>
									<div class="fr dib invest-login-btn"><a href="login">登录</a></div>                        </div>
								<form method="POST" action="/web/usertrade/investment.html" target="_blank" id="submit_form">
									<div class="Invest-wanted-price">
										<input class="fstyle1" name="order_amount" id="tender_amount" disabled="登陆后为您计算" placeholder="登陆后为您计算" type="text">

										<div id="tip_info" style="display: none;">
											<div class="icon"></div>
											<div class="tip">
												<ul>
													<li>请输入100的整数倍</li>
													<li>余额充足时可使用余额支付</li>
													<li>余额不足时可使用网银直接支付</li>
												</ul>
											</div>
										</div>
									</div>
									<div>预计利息：<span class="fs14 bold fc_red3 fstyle2" id="profit">0元</span></div>
								</form>
							</dd>
							<dd>
								<div class="mt10 mb10">
									<label class="check-box fstyle1 fc3"><input class="checkbox" checked="checked" id="aggrement" type="checkbox"><i class=""></i> 我已阅读并同意
										<a class="fc_blue1" href="javascript:void(0);" onclick="view_protocol();">《出借协议》</a>                            </label>
								</div>
								<div class="login-btn-box2">
									<input value="立即出借" class="login_btn login_btn2" id="do_tender" type="button">
								</div>
							</dd>


                            <?php		}else{  ?>
							<dd id='wz_tb'></dd>

							<dd class="content-right-ifo1" id='youa'  >
								<div class="ofh mt15">
									<div class="fl dib width65">
										<div class="fs14 lh32 ofh"><span class="fl dib">账号余额：</span>
											<div class="fc3 fl dib content-right-ifo1-ct">
												<span id='money'></span>元
											</div>
										</div>
										<div class="fs14 lh32 ofh"><span class="fl dib">可投金额：</span>
											<div class="fc3 fl dib fstyle2 fs14 bold content-right-ifo1-ct"><?php echo sprintf("%.2f",$info['lend_money']-$info['lend_repay_money']); ?><span>元</span></div>
										</div>
									</div>
								</div>
								<form method="POST" action="/web/usertrade/investment.html" target="_blank" id="submit_form">
									<div class="Invest-wanted-price">
										<input class="fstyle1" name="order_amount" id="tender_amount" placeholder="最低100元起投" type="text">
										<input name="project_id" id='hide' type="hidden">
										<input name="" id='zijin' type="hidden">
										<input name="" id='lixi' type="hidden">
										<div id="tip_info" style="display: none;">
											<div class="icon"></div>
											<div class="tip">
												<ul>
													<li>请输入100的整数倍</li>
													<li>余额充足时可使用余额支付</li>
													<li>余额不足时可使用网银直接支付</li>
												</ul>
											</div>
										</div>
									</div>
									<div>预计利息：<span class="fs14 bold fc_red3 fstyle2" id="profit">0元</span></div>
								</form>
							</dd>
							<dd id='youb'>
								<div class="mt10 mb10">
									<label class="check-box fstyle1 fc3"><input class="checkbox" checked="checked" id="aggrement" type="checkbox"><i class=""></i> 我已阅读并同意
										<a class="fc_blue1" href="javascript:void(0);" onclick="view_protocol();">《出借协议》</a>                            </label>
								</div>
								<div class="login-btn-box2">
									<input value="立即出借" class="login_btn login_btn2" id="chujie" type="button">

							</dd>

                            <?php   } ?>
						</dl>

					</div>
				</div>

				<div class="slide03-box">
					<div class="slideTxtBox slide03">
						<div class="hd">
							<ul id="info_list">
								<li class="fl on" val="pawn_detail"><p>授信详情</p></li>
								<li class="slide03-hd-center" val="user_info"><p>借款者信息</p></li>
								<li class="fr" val="order_list"><p class="fr">出借记录</p></li>
							</ul>
						</div>
						<div class="bd">
                            <?php if(session('islogin')==1) {   ?>
							<div id='tender_info' >

							</div>

                            <?php   }else{  ?>
							<div class="wdl fs18 fc3">
								您现在未登录，暂时无法查看。请您
								<a class="" href="login">登录</a>或
								<a href="register">注册</a>后查看。
							</div>
                            <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">jQuery(".slideTxtBox").slide();</script>
	<script>
        var project_user_id = "18375";
        var pawn_id = "2951";
        var pawn_type = "1";
        var user_id = "";
        var project_type = Number("1");

        $("#info_list li").each(function(){
            $(this).click(function(){
                var val=$(this).attr('val');

                getDetail(val);
            });
        });

        function getDetail(val) {
            if(!val) {
                if(project_type == 2) {
                    val = 'repay_list';
                }
            }
            if(val == 'faq') {
                loadHelp();
                return;
            }

            //如果是车贷
            if(pawn_type == 2 && val == 'user_info') {
                val = 'car_user_info';
            }


            switch(val) {
                case 'pawn_detail':
                    url = "invest_empower?id=<?php echo  $info['lend_id'];?>";
                    break;
                case 'user_info':
                    url = "lender?id=<?php echo  $info['lend_id'];?>";
                    break;
                case 'car_user_info':
                    url = "/web/tender/car_user_info/pawn_id/2951/show_user_id/0.html";
                    break;
                case "order_list":
                    url = "order_list?id=<?php echo $info['lend_id'];?>";
                    break;
                case 'repay_list':
                    url = "/web/tender/repay_list.html";
                    break;
                default:
                    url = "invest_empower?id=<?php echo $info['lend_id'];?>";
            }

            if(url != "") {

                $.ajax({
                    url: url,
                    type:'get',
                    data:{},
                    dataType: 'html',
                    success:function(result){
                        $("#tender_info").html(result);
                    }
                });
            }
        }

        getDetail();

        function loadHelp() {
            var html = '<div class="tender_help"><ul class="help-ifo">' +
                '<li class="help-ifo-xx">' +
                '<div class="help-ques"><em>问</em><span>什么是出借转让？</span></div>' +
                '<div class="help-answer"><em>答</em><span>出借转让服务旨在帮简贷平台的用户提高资金的流动性，用户在需要资金时，可以通过转让其名下拥有的符合相应条件的出借给其他用户，转让成功即可收回流动资金。 </span></div>' +
                '</li>' +
                '<li class="help-ifo-xx">' +
                '<div class="help-ques"><em>问</em><span>哪些标可以申请转让？</span></div>' +
                '<div class="help-answer"><em>答</em><span>一般出借的项目超过30天的即可申请转让，每个月还款日前七日无法申请转让。</span></div>' +
                '</li>' +
                '<li class="help-ifo-xx">' +
                '<div class="help-ques"><em>问</em><span>购买的出借转让后可以二次转让吗？</span></div>' +
                '<div class="help-answer"><em>答</em><span>投资转让后可以再次申请转让。</span></div>' +
                '</li>' +
                '<li class="help-ifo-xx">' +
                '<div class="help-ques"><em>问</em><span>转让期限内项目未售罄怎么办？</span></div>' +
                '<div class="help-answer"><em>答</em><span>债权转让的时效为一般为24小时。转让期限内若项目未满标，则会触发流标。流标后，标的撤销冻结，可再次申请转让；受让人出借的金额将退回原账号。流标不扣除服务费。</span></div>' +
                '</li>' +
                '<li class="help-ifo-xx">' +
                '<div class="help-ques"><em>问</em><span>转让期间借款人还款怎么办？</span></div>' +
                '<div class="help-answer"><em>答</em><span>若在项目转让期间，借款人归还利息或者本金的，该转让强制流标，款项将退回受让人的账号。</span></div>' +
                '</li>' +
                '<li class="help-ifo-xx">' +
                '<div class="help-ques"><em>问</em><span>出借转让是否收取转让服务费？</span></div>' +
                '<div class="help-answer"><em>答</em><span>平台会根据转让人的申请转让价格收取千分之二的转让居间服务费，此过程不向受让人收取任何费用。</span></div>' +
                '</li>' +
                '</ul></div>';
            $("#tender_info").html(html);
        }

        $("#login").click(function(){
            open_login_box();
        });


        /**
         * 弹窗登录框
         */
        function open_login_box() {
            layer.open({
                type: 2,
                title: '登录',
                fix: false,
                shadeClose: true,
                maxmin: false,
                area: ['800px', '800px'],
                content: "login",
            });
        }


        $("#do_tender").click(function(){
            var can_tender = 0;
            var project_id = "6577";
            var order_amount = parseInt($("#tender_amount").val().trim());
            var url = "/web/usertrade/investment.html";
            var is_login = "";
            var balance = "";
            balance = parseFloat(balance);

            if(!is_login) {
                open_login_box();
                return false;
            }

            var verify_real = Number("1");
            var identity_type = Number("1");

            if(verify_real != 2 && identity_type == 1) {
                layer.open({
                    type: 2,
                    title: '实名认证',
                    fix: true,
                    shadeClose: true,
                    maxmin: false,
                    area: ['455px', '340px'],
                    content: "/web/user/real_name_box.html",
                });

                return;
            }

            //协议
            if(!$('#aggrement').is(':checked')) {
                layer.alert("同意出借协议才能出借", {icon:2});
                return false;
            }

            if(isNaN(order_amount)) {
                layer.alert("请填写正确的出借金额", {icon:2});
                return false;
            }

            if(can_tender <= 0) {
                layer.alert("暂无可出借额度！", {icon:2});
                return false;
            }


            if(order_amount<100 || order_amount>can_tender) {
                layer.alert("出借金额必须在100-"+can_tender+"之间！", {icon:2});
                return false;
            }

            if(order_amount % 100) {
                layer.alert("出借金额必须是100的倍数！", {icon:2});
                return false;
            }

            if(project_user_id == user_id) {
                layer.alert("不能出借自己的项目", {icon:2});
                return false;
            }

            $("#submit_form").submit();

            var url = "/web/public/pay_confirm.html";
            layer.open({
                type: 2,
                title: '确认支付',
                fix: true,
                shadeClose: true,
                maxmin: false,
                area: ['580px', '480px'],
                content: url
            });
            $("#tender_amount").val('');
            /**
             $.ajax({
		url: "/web/usertrade/investment.html",
		type: 'post',
		data:{'project_id':project_id, 'order_amount':order_amount},
		dataType: 'json',
		async : false,
		success:function(result){
			if(result.code == 1000) {
				$("#redirect_form").submit();

				var url = "/web/public/pay_confirm.html";
				layer.open({
			        type: 2,
			        title: '确认支付',
			        fix: true,
			        shadeClose: true,
			        maxmin: false,
			        area: ['580px', '480px'],
			        content: url
			    });

			} else {
				layer.alert(result.msg, {icon:2});
			}
		}
	});
             **/

            //$("#investment_form").submit();

            /**
             layer.confirm('确定要出借吗？', function(index){
		$.ajax({
			url: url,
			type: 'post',
			data:{'project_id':project_id, 'order_amount':order_amount},
			dataType: 'json',
			success:function(result){
				if(result.code == 1000) {
					layer.alert(result.msg, {icon:1});
					var url = '/web/index/redirect_url.html';
					sina_redirect(url, '新浪支付');
					//setTimeout(function(){window.location.reload();}, 3000);
				} else {
					layer.alert(result.msg, {icon:2});
				}
			}
		});
	});
             **/

        });

        $("#tender_amount").keyup(function(){
            calculate_profit();
        });

        $("#tender_amount").mouseenter(function(){
            $("#tip_info").show();
        }).mouseleave(function(){
            $("#tip_info").hide();
        });


        //计算收益
        function calculate_profit() {
            var mn=$("#hide").val();
            //var received_amount = parseFloat(8000);
            //var wait_pay_amount = parseFloat(7000);
            var ratea=<?php echo substr($info['lend_return'],0,strlen($info['lend_return'])-1 ); ?>;
            //var can_tender = received_amount - wait_pay_amount;
            var can_tender = parseFloat(<?php echo sprintf("%.2f",$info['lend_money']-$info['lend_repay_money']);?>);
            var rate = parseFloat(ratea);
            var tender_amount = parseFloat( $("#tender_amount").val() );
            var loan_period = parseInt( <?php echo $info['lend_repay_time']; ?>);
            var period = parseInt( 90 );
            var repay_method = "MYHX";


            if(tender_amount > can_tender) {
                if( mn>=can_tender && tender_amount>=mn ){
                    tender_amount=can_tender;
                }else if( mn<can_tender ){
                    tender_amount = mn;
                }

                $("#tender_amount").val(tender_amount);
            }
            if(isNaN(tender_amount)) {
                tender_amount = 0;
            }

            //计算收益
            var  profit = 0;
            //代收利息总和
            var wait_interest_total = parseFloat(-250000);

            if(repay_method == 'DEBX') {
                month_rate = rate/1200;
                if(project_type == 1) {
                    var month_interest = 0;
                    for(var i=1; i<=loan_period; i++) {
                        var month_interest = ( tender_amount*month_rate*(Math.pow(1+month_rate, loan_period)-Math.pow(1+month_rate, i-1)) ) / (Math.pow(1+month_rate, loan_period)-1);
                        month_interest = Math.floor(month_interest*100)/100;
                        profit += month_interest;
                    }
                    profit = Math.floor(profit*100)/100;
                } else {
                    profit = tender_amount / received_amount * wait_interest_total;
                    profit = Math.floor(profit*100)/100;
                }

            } else {
                if(project_type == 2 || period == 7 || period == 15) {
                    profit = Math.floor((tender_amount*rate)*period*100/36000)/100;
                } else {
                    profit = Math.floor((tender_amount*rate)*loan_period*100/1200)/100;
                }
            }

            profit = profit.toFixed(2);
            //var	profit = Math.floor(tender_amount*rate/1200/30*period*100)/100;
            //profit = Math.floor(tender_amount*rate/36000*period*100)*100;
            //var profit = tender_amount*rate.toFixed(2)*0.01*period/360;
            //profit = profit.toFixed(2);
            $("#profit").html(profit+'元');
            $("#lixi").val(profit);
        }

        //查看出借协议
        function view_protocol() {
            var type = "1";
            var url = "/web/tender/tender_protocol/type/_type.html";
            url = url.replace('_type', type);

            layer.open({
                type: 2,
                //skin: 'layui-layer-lan',
                title: '出借协议',
                fix: false,
                shadeClose: true,
                maxmin: false,
                area: ['800px', '550px'],
                content: url,
            });
        }


        //查看转让协议
        function view_transfer_protocol() {
            layer.open({
                type: 2,
                //skin: 'layui-layer-lan',
                title: '债权转让协议',
                fix: false,
                shadeClose: true,
                maxmin: false,
                area: ['800px', '550px'],
                content: "/web/tender/transfer_protocol.html",
            });
        }

        //全部投资
        function all_invest()
        {
            var need_amount = 0.00;
            var balance = 0.00;
            var invest_amount = 0;
            if(need_amount>balance){
                invest_amount = balance;
            }else{
                invest_amount = need_amount;
            }
            invest_amount = parseInt(invest_amount / 100) * 100;
            $("#tender_amount").val(invest_amount);
            calculate_profit();
        }
        //查看可投资金额
        function user_info(id){

            $.ajax({
                url:'invest_user_info?id='+id,
                type:'get',
                data:{},
                dataType: 'html',
                success:function(result){

                    $("#money").html(Math.floor(result));
                    $("#hide").val(Math.floor(result));
                    $("#zijin").val(Math.floor(result));
                }
            });
        }
        user_info( <?php echo  session('user_id') ?> );

        $("#chujie").click(function(){
            //投资金额（取整处理）
            var invest_money=parseInt($("#tender_amount").val());
            //获取利息（取整处理）
            var  lixi=parseInt($("#lixi").val());
            var  sum=invest_money+lixi;
            var invest_return_money=sum;
            //用户id
            var user_id=<?php echo session('user_id'); ?>;
            //投资id
            var lend_id=<?php echo $info['lend_id']; ?>;

            var zijin=$("#zijin").val();

            $.ajax({
                url:'user_invest?id='+user_id,
                type:'get',
                data:{
                    "zijin":zijin,
                    "invest_money":invest_money,
                    "invest_return_money":invest_return_money,
                    "user_id":user_id,
                    "lend_id":lend_id
                },
                dataType: 'html',
                success:function(result){
                    user_info( <?php echo  session('user_id') ?> );
                    if(result==0){
                        alert(' 亲，不能超额投资哦');
                    }else if (result==1){
                        $("#youa").hide();
                        $("#youb").hide();
                        $("#wz_tb").html('<div class="tc mt38"  ><img src="Public/web/images/r3_bg.png"></div><div class="fs14 fc3 tc lh34 mb15">完成时间：<?php echo date('Y-m-d H:i:s');  ?></div>');
//<div class="fs14 fc3 tc mt20 lh34">完成耗时:1分钟抢光</div>
                        inf(lend_id);
                    }else if(result==2){
                        alert(' 亲，投资失败亲~~!!');
                    }else if (result==3){
                        alert('余额不足，请充值');
                    }else if(result==4){
                        alert('最少投资100,亲~~!!');
                    }


                }
            });

        });
        //查询是否满标
        function inf(id){

            $.ajax({
                url:'lend_msg?id='+id,
                type:'get',
                data:{},
                dataType:'json',
                success:function(result){
                    var lend_repay_money=result['lend_repay_money'];
                    var lend_money=result['lend_money'];
                    var jindu=lend_repay_money/lend_money*100;
                    var  syje=(lend_money-lend_repay_money)/10000;

                    if(syje==0){
                        $("#youa").hide();
                        $("#youb").hide();
                        $("#wz_tb").html('<div class="tc mt38"  ><img src="Public/web/images/r3_bg.png"></div>');
//<div class="fs14 fc3 tc mt20 lh34">完成耗时:1分钟抢光</div><div class="fs14 fc3 tc lh34 mb15">完成时间：2017-06-12 19:31:14</div>
                    }
                    $("#wz_jindutiao").css('width',jindu+'%');
                    $("#wz_jindu").html(jindu+'%');
                    //alert(syje);
                    $("#wz_syje").html(syje+'万');

                }
            });
        }




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

    <?php include "layout/home/footer.php";?>

</div>

</html>

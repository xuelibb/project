<!DOCTYPE html>
<html>
<body>
<div class="ww">
    <?php include "layout/home/header.php";?>

</div>
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

<div class="center"><div class="ww both">
        <div class="bg_color2">
            <div class="wl mtauto psr">
                <div class="ins-bg1"></div>
                <div class="ensure ensure-one">合规保障</div>
                <div class="ensure ensure-two">严格风控</div>
                <div class="ensure ensure-three">资金安全</div>
                <div class="ensure ensure-forth">技术安全</div>
                <div class="ensure ensure-five">法律护航</div>
            </div>
        </div>
        <div class="bg_color4">
            <div class="wl mtauto ofh">
                <div class="fl ensure-ifo mt125">
                    <div class="step-icon step-icon1"></div>
                    <h4>资金安全</h4>
                    <div class="mt10">
                        <b><em>•</em>新浪支付第三方托管</b>
                        <p>简贷与实力雄厚有品牌信誉保证的第三方支付机构—新浪支付合作，<br/>出借资金全程托管，平台不设资金池，保证信息流与资金流的独立。</p>
                        <b><em>•</em>全程托管</b>
                        <p>三天后简贷将启动用户服务质量保障基金垫付机制，然后再拍卖处置违约抵质押物。</p>
                    </div>
                </div>
                <div class="fr ensure-pic mr75 mt60 mb60">
                    <img src="Public/web/images/ins_bg2.png"/>
                </div>
            </div>
        </div>
        <div class="bg_color2">
            <div class="wl mtauto ofh">
                <div class="fr ensure-ifo mt60">
                    <div class="step-icon step-icon2"></div>
                    <h4>严格风控</h4>
                    <div class="mt10">
                        <b><em>•</em>丰富行业经验团队，用专业铸造信赖</b>
                        <p>简贷拥有从事域名行业20年的风控团队、5年汽车金融的风控团队，从风控体系建立到执行，从贷前审查到贷后管理等专业领域都有着非常丰富的经验。</p>
                        <b><em>•</em>六步审核工序，保证每笔借款优质可靠</b>
                        <p>在借款人提交申请之后，信审风控团队将对借款人进行严格、谨慎的当面审核，对域名进行全面、专业的价值评估。</p>
                        <b><em>•</em>足额抵质押担保物，还款有保障</b>
                        <p>简贷的借款项目每个都有借款人提供的足额抵质押物进行担保，授信额度一般为其评估价值的50%左右，以降低市场价值波动的风险。</p>
                    </div>
                </div>
                <div class="fl ensure-pic mr75 mt60 mb60">
                    <img src="Public/web/images/ins_bg3.png"/>
                </div>
            </div>
        </div>
        <div class="bg_color4">
            <div class="wl mtauto ofh">
                <div class="fl ensure-ifo mt70">
                    <div class="step-icon step-icon3"></div>
                    <h4>合规保障</h4>
                    <div class="mt10">
                        <b><em>•</em>合规合法</b>
                        <p>简贷严格按金融行业监管要求，不做资金池，不做超募或直接融资，完全遵循“透明、安全”的原则，完全信息中介平台。</p>
                        <b><em>•</em>资金投向真实透明</b>
                        <p>每个标的都对应一个真实可查的金融资产。融资人信息公开透明；电子合同具备法律效力，司法可鉴定。</p>
                    </div>
                </div>
                <div class="fr ensure-pic mr75 mt20 mb60">
                    <img src="Public/web/images/ins_bg4.png"/>
                </div>
            </div>
        </div>
        <div class="bg_color2">
            <div class="wl mtauto ofh">
                <div class="fr ensure-ifo mt60">
                    <div class="step-icon step-icon4"></div>
                    <h4>法律护航</h4>
                    <div class="mt10">
                        <b><em>•</em>专业法律支持</b>
                        <p>简贷聘用了信实律师事务所作为公司的常年法律顾问。简贷所有业务活动以及相关合同和协议均咨询信实律师事务所，确保其符合相关法律法规，简贷合法守信经营，让用户权益受国家法律保护。</p>
                        <b><em>•</em>电子合同保障</b>
                        <p>简贷同美亚柏科达成战略合同，引进电子合同与存证云合同存证，实现了电子合同签署过程中“签署主体身份真实有效+签署时间客户真实+合同传输以及保管+司法鉴定”不可篡改，确保了平台上签署的合同具有与原件同等的法律证据效力。</p>
                    </div>
                </div>
                <div class="fl ensure-pic mr75 mt60 mb60">
                    <img src="Public/web/images/ins_bg5.png"/>
                </div>
            </div>
        </div>
        <div class="bg_color4">
            <div class="wl mtauto ofh">
                <div class="fl ensure-ifo mt110">
                    <div class="step-icon step-icon5"></div>
                    <h4>技术安全</h4>
                    <div class="mt10">
                        <b><em>•</em>强劲技术团队保驾护航</b>
                        <p>简贷技术团队成员在计算机、互联网安全等领域从业多年，对信息系统安全、数据加密、大数据、交易并发、异常预警监管、突发事件应急处置等核心技术拥有丰富的实践经验。简贷系统采用多重安全保障体系，多层网络隔离系统，多地数据库机房容灾备份机制，充分保障用户的资金安全、数据安全、信息安全。</p>
                    </div>
                </div>
                <div class="fr ensure-pic mr75 mt60 mb60">
                    <img src="Public/web/images/ins_bg6.png"/>
                </div>
            </div>
        </div>
        <div class="bg_color4">
            <div class="wl mtauto ofh">
                <div class="btn-reg" onclick="to_register();">立 即 注 册</div>
            </div>
        </div></div>
    <script>
        function to_register() {
            window.location.href="register";
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

<?php
$path='basic/slideshow.txt';
//查询轮播图数据
if(file_exists($path)){
$arr=json_decode(file_get_contents($path),true);
foreach($arr as $k=>$v){
if($v['is_show']==0){
unset($arr['$k']);
}
}
}else{
$arr=[];
}
//查询网站基本设置
if(file_exists("basic/settings.txt")){
$settings=json_decode(file_get_contents("basic/settings.txt"),true);
}
//查询导航栏
if(file_exists('basic/nav.txt')){
$nav=json_decode(file_get_contents('basic/nav.txt'),true);
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$settings['stitle']?></title>
    <meta name="keywords" content="<?=$settings['desc']?>">
    <meta name="description" content="简贷JianDai.com，企业志简载域而贷，帮助借款人快速融资。借款人以互联网资产（域名）、汽车等资产作为抵押物，进行融资。">
    <meta name="copyright" content="简贷JianDai.com  厦门简贷金融技术服务有限公司">

    <link href="https://www.jiandai.com/Public/web/images/ico.ico" rel="shortcut icon">

    <link type="text/css" rel="stylesheet" href="Public/web/css/basic.css">
    <link type="text/css" rel="stylesheet" href="Public/web/css/index.css">
    <link type="text/css" rel="stylesheet" href="Public/web/css/iconfont.css">
    <link type="text/css" rel="stylesheet" href="Public/web/css/layer.css">
    <link type="text/css" rel="stylesheet" href="Public/web/css/call.css">
    <script type="text/javascript" src="Public/web/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="Public/web/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="Public/web/js/layer.js"></script>
    <link rel="stylesheet" href="Public/web/css/layer.css" id="layui_layer_skinlayercss" style="">
    <script type="text/javascript" src="Public/web/js/function.js"></script>
    <script src="Public/web/js/browser_judgment.js"></script>
    <script type="text/javascript">
        /*	var sUserAgent = navigator.userAgent.toLowerCase();
         var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
         var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
         var bIsMidp = sUserAgent.match(/midp/i) == "midp";
         var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
         var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
         var bIsAndroid = sUserAgent.match(/android/i) == "android";
         var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
         var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
         if(bIsIpad||bIsIphoneOs||bIsAndroid||bIsMidp||bIsUc7||bIsUc||bIsCE||bIsWM){
         window.location.href = "/home/phone.html";
         }
         */
    </script>
    <style>
        h1.logo{width:180px;height:60px;margin-top:15px;background:url("<?=$settings['img']?>") no-repeat 0 0;background-size: 150px,100px;}
    </style>
</head>
<!--头部开始-->
<div class="bdbt_ce Top-position1">
    <div class="wl mtauto">
        <div class="ofh height40">
            <p class="fl fs14 fc_80 lh40">客服热线:<?php echo $settings['tel'] ?>（工作日：09:00-21:00）</p>
            <div class="nav">
                <?php if(session('islogin')==1) {?>
                <a href="user_info" class="pr15">欢迎<font color="red">&nbsp;&nbsp;<?php echo session('user_user')?></font></a>
                <a href="logout" class="nav_login">退出</a>
                <?php
                }else{
                ?>
                <a href="register" class="pr15">注册</a>
                <a href="login" class="nav_login">登录</a>
                <?php
                }
                ?>
                <span>|</span>
                <a href="javascript:void(0);" class="" id="login_way"><em></em><span>微信</span><span class="icon-down"></span></a>
                <span>|</span>
                <a href="javascript:void(0);" class="help_center"   >帮助中心</a>                 <span>|</span>
                <a href="javascript:void(0);" class="javascript:void(0);">新手引导</a>                </div>
        </div>
        <!--微信图标-->
        <div class="lh40 psab login_way_more ofh unblock">
            <a href="#" class="fl">
                <em class="block"><img src="uploads/weixin1.jpg" style="width:80px;height: 80px"  /></em>
                <span class="block tc fc_80 fs14"  >客服微信号</span>
            </a>
            <a href="#" class="ml22 fl">
                <em class="block"><img src="uploads/weixin1.jpg" style="width:80px;height:80px;"  /></em>
                <span class="block tc fc_80 fs14"  >招财喵公众号</span>
            </a>
        </div>
    </div>
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

<!--导航开始-->
<div class="Top-position2" style="box-shadow: 0px 0px 20px 0px #e9e9e9;">
    <!---->
    <div class="wl mtauto">
        <a href="/web/index/index.html"><h1 class="logo fl"></h1></a>
        <div class="fr pt20 navbox">
            <ul id="nav">
                <?php foreach($nav as $k=>$v){ ?>
                <li class="nLi"><h3><a href="<?=$v['nav_link']?>" class="fc3 lh40 fs16 <?php if($k==0){
                echo 'active ml30';}?>"><em></em><span><?=$v['nav_title']?></span></a></h3></li>
                <?php } ?>
                <!---->
                <!--<li class="nLi"><h3><a href="/web/index/mobile.html" class="fc3 lh40 fs16"><em></em><span>手机版</span></a></h3></li>-->
                <!---->
            </ul>
        </div>
    </div>
</div>

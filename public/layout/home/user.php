<?php
use App\Model\Home\User_details;
use Illuminate\Support\Facades\DB;
$user_id=session('user_id');
$model=User_details::where('details_user_id',$user_id)->first();
//查询当前用户是否有绑定银行卡
$brank=DB::table('bank_card')->where('user_id',$user_id)->get();
?>
<div class="fl content-left-x2 bg_color2">
    <div class="user-ifo">
        <div class="user-head-pic">
            <a href="javascript:void(0);" style="cursor: default;">
                <img src="Public/web/images/user_touxiang.png">

            </a>
        </div>
        <script>
            $('.container > img').cropper({
                aspectRatio: 16 / 9,
                crop: function(data) {
                    // Output the result data for cropping image.
                }
            });
        </script>
        <div class="user-contact">
            <?php echo $model->details_name?$model->details_name:session('user_user');?>
        </div>
        <div class="user-ifo-more">
            <ul class="">
                <li>
                    <?php if($model->is_new!=0) {?>
                    <a href="#"  class="user-ifo-icon1"></a>
                    <?php
                    }else{
                   ?>
                    <a href="#"  class="user-ifo-icon11"></a>
                    <?php
                    }
                    ?>
                    <div class="user-ifo-tips">实名认证</div>

                </li>

                <li>
                    <a href="#" class="user-ifo-icon2"></a>
                    <div class="user-ifo-tips">手机认证</div>
                </li>

                <li>
                    <?php if($model->details_pay!=Null) {?>
                    <a href="#" class="user-ifo-icon3"></a>
                    <?php
                    }else{
                   ?>
                    <a href="#" class="user-ifo-icon31"></a>
                    <?php
                    }
                    ?>
                    <div class="user-ifo-tips">支付密码</div>
                </li>
                <li>
                    <?php if($brank!=Null) {?>
                    <a href="#" class="user-ifo-icon4"></a>
                    <?php
                    }else{
                   ?>
                    <a href="#" class="user-ifo-icon41"></a>
                    <?php
                    }
                    ?>
                    <div class="user-ifo-tips" title="未绑定银行卡">银行卡</div>
                </li>
            </ul>
            <div style="clear:both;"></div>
        </div>
        <div class="mt5">
            <div class="sideMenu">
                <h3><a href="user_info"><i class="sideMenu-icon1"></i>账号首页<em></em></a></h3>
            </div>
            <div class="sideMenu">
                <h3><a href="javascript:;" class="Menu-more"><i class="sideMenu-icon2"></i>我的资金<em></em></a></h3>
                <ul style="display:none">
                    <li><a href="fund_statistic">资金统计</a></li>
                    <li><a href="recharge">充值</a></li>
                    <li><a href="withdraw">提现</a></li>
                </ul>                   </div>
            <div class="sideMenu">
                <h3><a href="javascript:;"><i class="sideMenu-icon3"></i>我的出借<em></em></a></h3>
                <ul style="display:none">
                    <li><a href="tender_list">出借记录</a></li>
                    <li><a href="recover">回款计划</a></li>
                    <li><a href="transfer">出借转让</a></li>
                </ul>                   </div>

            <div class="sideMenu">
                <h3><a href="javascript:;" class="Menu-more"><i class="sideMenu-icon4"></i>我的借款<em></em></a></h3>
                <ul style="display:none">
                    <li><a href="borrow_list">借款管理</a></li>
                </ul>                   </div>
            <div class="sideMenu">
                <h3><a href="#" class="Menu-more"><i class="sideMenu-icon-i8"></i>质押管理<em></em></a></h3>
                <ul style="display:none">
                    <li><a href="pawn_list">域名管理</a></li>
                    <li><a href="pawn">申请质押</a></li>
                </ul>                   </div>

            <div class="sideMenu">
                <h3><a href="#" class="Menu-more"><i class="sideMenu-icon7"></i>活动位置<em></em></a></h3>
                <ul style="display:none">
                    <li><a href="lottery">大转盘活动</a></li>
                </ul>                   </div>

            <div class="sideMenu">
                <h3><a href="bank_info"><i class="sideMenu-icon5"></i>银行卡管理<em></em></a></h3>
            </div>
            <div class="sideMenu">
                <h3><a href="user_safe"><i class="sideMenu-icon6"></i>安全中心<em></em></a></h3>
            </div>
            <div class="sideMenu">
                <h3><a href="#"><i class="sideMenu-icon7"></i>我的消息 <em></em></a></h3>
            </div>
            <div class="sideMenu">
                <h3><a href="#" class="Menu-more"><i class="sideMenu-icon7"></i>邀请管理<em></em></a></h3>
                <ul style="display:none">
                    <li><a href="invite">邀请注册活动</a></li>
                </ul>                   </div>
    </div>
    <div class="APP-load-box1">
        <div class="APP-load-box1-pic"><img src="Public/web/images/code.png"></div>
        <div class="">扫一扫下载招财喵APP</div>
    </div>
</div>
</div>
<script>
    //左侧个人信息显示隐藏
    $('.user-ifo-more a').mouseenter(function(){
        $(this).siblings().show();
    });
    $('.user-ifo-more a').mouseleave(function(){
        $(this).siblings().hide();
    });
    $('.sideMenu h3').click(function(){
        $(this).siblings().toggle();
        $(this).toggleClass('on');
        $(this).parent('.sideMenu').siblings().children('h3').removeClass('on');
        $(this).parent('.sideMenu').siblings().children('ul').hide();
    });

    $('.renzheng-btn').click(function(){
        $(this).parent('.renzheng-title').toggleClass('renzheng-title-bg');
        $(this).parent('.renzheng-title').siblings('.centy-fill-box').toggle();
    })

</script>
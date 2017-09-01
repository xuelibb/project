<!DOCTYPE html>
<html>
<body>

    <div class="Top-position">
        <?php include "layout/home/header.php"?>
    </div>

<div class="center"><style>
        .mt-number-animate{
            line-height:54px;
            height: 52px;
            overflow: hidden;
            display: inline-block;
            position: relative;
        }
        .mt-number-animate-dom{
            margin-top:8px;
            width:38px;
            text-align:center;
            float:left;
            position:relative;
            top:-20px;
        }
        .mt-number-animate-dom a{
            margin:5px;
            cursor:default;
        }

        .index-statistic {
            padding: 0 70px 0 70px !important;
        }
        .index-statistic p{
            text-align: center;
        }
    </style>



    <!--banner-->
    <div class="ww">
        <div class="bannerbox">
            <div class="psr">
                <div class="slide_bannerbox">
                    <ul class="slide_banner">
                        <?php foreach ($imgList as $k=>$v){?>
                          <?php if($v['is_show']==1){?>
                                <!--
                        <li><a href="javascript:void(0);" target="_blank" class="banner01" id="banner0" ></a></li>
                        -->
                        <li><img class="banner01" src="<?=$v['img']?>" id="banner<?=$k-2;?>"/></li><!--
                <li><a href="javascript:void(0);" target="_blank" class="banner01" id="banner0" ></a></li>
                -->
                        <?php }
                        }?>
                    </ul>
                </div>
                <div class="slide_btnbox">
                    <ul class="slide_btn">

                    </ul>
                </div>
                {{--判断是否登录--}}
                <?php if(!session('islogin')==1) {?>
                    <div class="registered psab">
                        <p class="fs24 fc0 tc pt30">新浪支付全程托管</p>
                        <p class="ban_data">8%-15%</p>
                        <p class="ban_txt">年化收益</p>
                        <p class="pr20 pl20"><a href="register" class="tc regist_click block mtauto fs22 fc0">点 击 注 册</a></p>
                        <p class="ofh pr20 pl20 other_login tc pt10"><a class="fc_a6 fs16 pr10" style="cursor: default;">已有账户</a><a href="login" class="fs16 fc0 fc_fda">点击登录</a></p>
                    </div>
                <?php }else{  ?>
                    <div class="registered psab">
                        <p class="fs24 fc0 tc pt30">新浪支付全程托管</p>
                        <p class="ban_data">8%-15%</p>
                        <p class="ban_txt">年化收益</p>
                        <p class="pr20 pl20"><a href="user_info" class="tc regist_click block mtauto fs22 fc0">进入我的账号</a></p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!--累计会员-->
        <div class="">
            <div class="wl mtauto bdbt_e6">
                <div class="ofh section-title bdbt_e6">
                    <div class="fl">
                        <span class="fl icon-ifo-span"><i class="icon-ifo"></i></span>
                    </div>
                    <div class="txtScroll-top fl">
                        <div class="hd">
                            <ul></ul>
                        </div>
                        <div class="bd">
                            <ul class="infoList" id="info_list">
                            </ul>
                        </div>
                    </div>

                    <div class="fr pt4"><a href="javascript:;" >更多+</a></div>
                    <span class="font-style4 fr mt8">投资有风险，决策需谨慎！</span>
                </div>

                <ul class="ofh vip_ifobox bdbt_f2">
                    <li class="fl bdr_e6 vip_ifo1">
                        <em class="fl"></em>
                        <p class="fl">
                            <span class="fs22 bold block tc">累计会员</span>
                            <span class="fs22 fc_80 block tc mt15" id="total_user"><?=$vip;?>人</span>
                        </p>
                    </li>
                    <li class="fl bdr_e6 vip_ifo2">
                        <p class="fs22 bold block tc">累计成交金额（万元）</p>
                        <div  class="fs22 fc_80 block tc mt15" id="total_deal" style="margin-top:5px;"><font color="green"><?=$sum;?></font></div>
                    </li>
                    <li class="fl bdr_e6 vip_ifo2">
                        <p class="fs22 bold block tc">累计为出借人赚取（万元）</p>
                        <div  class="fs22 fc_80 block tc mt15" id="earn_statistic" style="margin-top:5px;"><font color="red"><?=$money?></font></div>
                    </li>
                    <li class="fl vip_ifo3">
                        <a href="javascript:;" class="block psr"><span class="fs16 fc3 psab fstyle1">查看运营报告</span></a>
                    </li>
                </ul>

                <div class="ofh why_usbox">
                    <dl class="fl why_us">
                        <dt class="why_ico1"></dt>
                        <dd class="">
                            <p>福建域名协会</p>
                            <p>首批理事会员企业</p>
                        </dd>
                    </dl>
                    <dl class="fl why_us">
                        <dt class="why_ico2"></dt>
                        <dd class="">
                            <p>二十年域名行业积累</p>
                            <p>精选优质域名质押</p>
                        </dd>
                    </dl>
                    <dl class="fl why_us">
                        <dt class="why_ico3"></dt>
                        <dd >
                            <p>服务质量保障基金</p>
                            <p>信息及系统安全多重保障</p>
                            <p>新浪支付全程托管</p>
                        </dd>
                    </dl>
                    <dl class="fl why_us">
                        <dt class="why_ico4"></dt>
                        <dd>
                            <p>最低100起投</p>
                            <p>期限灵活</p>
                            <p>转让便捷</p>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>


        <!--热门推荐-->
        <div class="pt10">
            <div class="wl mtauto">
                <div class="ofh section-title pb15">
                    <div class="fl">
                        <span class="fl"><i class="icon-hot"></i></span>
                        <div class="fs14 fc3 fl"><h4>热门推荐</h4></div>
                    </div>
                    <div class="fr pt4"><a href="javascript:;">更多+</a></div>
                    <span class="font-style4 fr mt8">投资有风险，决策需谨慎！</span>
                </div>

                <div class="ofh">
                    <div class="fl">
                        <dl class="hot_title">
                            <dt class="fl hot-pic">
                            <h4 class="fc0 fs20 bold">热门推荐</h4>
                            <p class="fs12 fc0 lh24">精选优质项目，快速选择出借项目！</p>
                            </dt>
                        </dl>
                    </div>

                    <div id="slideBox" class="slideBox slide01 bdr_e6 fl bdt_e6 bdbt_e6">
                        <div class="hd">
                            <ul>
                                <li></li><li></li><li></li>					</ul>
                        </div>

                        <div class="bd">
                            <ul>
                                <?php  foreach ($hot as $kk =>$vv){ ?>
                                <li class="ofh hot-list-data" onclick="window.location.href='invest_info?id=<?=$vv['lend_id']?>'">
                                    <div class="ym-name mt22">
                        	<span class="domain_str">
							 	<a href="/web/tender/tender_info/project_id/6531.html" title="<?=$vv['lend_goods']?>"><?=$vv['lend_goods']?></a>
	                        	<font style="display:none;"><?=$vv['lend_number']?></font>
                        	</span>
                                    </div>
                                    <dl class="fl hot_title">
                                        <dd class="fl hot_title01 pb8">
                                            <p class="hot_rate1 tl ml38"><em class="fs45"><?php echo $vv['lend_return']  ;?></em></p>
                                            <p class="fs12 fc_80 tl hot_rate_txt1 ml38">预期年化利率</p>
                                        </dd>
                                        <dd class="fl hot_title02">
                                            <div class="tc ofh">
                                                <span class="fs12 fc_80 tc hot_rate_txt2 lh32 fl dib mt20">借款期限</span>
                                                <span class="hot_rate2 tc fl dib mt18"><?=$vv['lend_repay_time']?><em class='fs24'>个月</em></span>
                                            </div>
                                            <div class="tc ofh">
                                                <span class="fs12 fc_80 tc hot_rate_txt2 lh32 fl dib mt17">借款总额</span>
                                                <span class="hot_rate3 tc fl dib pt9"><?=$vv['lend_money']/10000?><em class="fs24">万</em></span>
                                            </div>
                                        </dd>
                                    </dl>

                                    <div class="circle-wrapbox fl">
                                        <!--<div class="circle-wrap">
                                            <div class="circle-in"></div>
                                            <div class="circle-out-wrap">
                                                <div class="circle-out"></div>
                                            </div>
                                            <div class="jindu_data">50%</div>
                                        </div>-->
                                        <div class="Invest-pro2 ofh">
                                            <div class="Invest-pro-bar-box ofh">
                                                <div class="Invest-pro-bar fl">
                                                    <div class="Invest-pro-bar-in hot_progress_list" name="<?php echo floor(($vv['lend_repay_money']/$vv['lend_money'])*100)  ;?>"></div>
                                                </div>
                                                <div class="Invest-pro-data fr"><?php echo floor(($vv['lend_repay_money']/$vv['lend_money'])*100)  ;?>%</div>
                                            </div>
                                            <p class="Invest-pro-txt"><span class="fc_4d">出借进度</span></p>
                                        </div>
                                    <?php $str=time();$tt=$vv['lend_end_time']; $s=$tt-$str; ?>
                                        <!--<p class="fs14 fc_80 tc ofh jindu_txt"><span class="fl">0</span>出借进度<span class="fr">100</span></p>-->
                                        <div class="invest_now_btn_box">
                                            <?php if($vv['lend_repay_money']/$vv['lend_money']*100==100){ ?>
                                            <p class="un-buy" style="border:1px solid gainsboro;"><a href="invest_info?id=<?=$vv['lend_id']?>" class="tc block" style="background: gainsboro;">已抢光</a></p>
                                            <?php } else{       ?>
                                            <p class="invest_now" style="border:1px solid orange;"><a href="invest_info?id=<?=$vv['lend_id']?>" class="tc block" style="">立即出借</a></p>
                                            <?php  }?>
                                        </div>
                                    </div>
                                    <?php if($s>0&&$vv['lend_repay_money']/$vv['lend_money']*100<100){ ?>
                                    <div class="slide08">
                                        <div class="time_box ofh" style="margin-right:65px;">
                                            <input class="hidden_input" name="<?=$vv['lend_id']?>" value="<?php echo ($tt-$str);?>" type="hidden">
                                            <div class="ofh shu-line-xx">
                                                <em class="shu-line"></em>
                                                <span class="" id="hour_<?=$vv['lend_id']?>">00</span>
                                            </div>
                                            <em class="mt15">：</em>
                                            <div class="ofh shu-line-xx">
                                                <em class="shu-line"></em>
                                                <span class="" id="minute_<?=$vv['lend_id']?>">00</span>
                                            </div>
                                            <em class="mt15">：</em>
                                            <div class="ofh shu-line-xx">
                                                <em class="shu-line"></em>
                                                <span class="" id="second_<?=$vv['lend_id']?>">00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>




                                </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </div>

                    <div class="fr dib aside_ban">
                        <div class="aside_ban1"><a href="/web/index/mobile.html"><img src="Public/web/images/aside_ban.png"/></a></div>
                        <div class="aside_ban2 mt15"><a href="/web/help/guide.html"><img src="Public/web/images/aside_ban2.png"/></a></div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 出借专区 -->
        <div class="pt15">
            <div class="wl mtauto ofh">
                <div class="ofh section-title bdbt_blue2 pb15">
                    <div class="fl">
                        <span class="fl"><i class="icon-invest"></i></span>
                        <div class="fs14 fc3 fl">
                            <h4 class="">
                                <span>出借专区</span><span class="fs16 fc_80 fstyle1">(100元起投)</span>
                            </h4>
                        </div>
                    </div>
                    <div class="fr pt4"><a href="javascript:;">更多+</a></div>
                    <span class="font-style4 fr mt8">投资有风险，决策需谨慎！</span>
                </div>

                <div class="Invest_Zone ofh">
                    <div class="ofh Invest_pic fl">
                        <h4 class="fc0 fs20 bold">出借专区</h4>
                        <p class="fs12 fc0 lh24">合理投资，互利共赢！</p>
                    </div>
                    <div class="w998 fl bd_e6 bdt_none Invest_fr"><?php foreach ($invest as $k => $v) {?>
                        <div class="ofh Invest_title bdbt_e6 tender_list_data" onclick="window.location.href='invest_info?id=<?=$v['lend_id']?>'">

                            <div class="fl">
                                <div class="ym-name mt25 mb15">
                        <span  title="<?php  echo $v['lend_goods'] ;?>" class="domain_str">
                        	<a href="invest_info?id=<?=$v['lend_id']?>" title="<?php  echo $v['lend_goods'] ;?>"><?php  echo $v['lend_goods'] ;?></a>

                        	<font style="display:none;"><?=$v['lend_number']?></font>
                        </span>
                                </div>
                                <div class="ofh">
                                    <div class="fl domain-ifo">
                                        <p class=""><span class="rate-percent"><?=$v['lend_return']?></span><span class="">预期年化利率</span></p>
                                        <p><span class="date-num"><?php  echo $v['lend_repay_time'] ;?><em class='fs16 fc_4d'>个月</em></span><span class="">借款期限</span></p>
                                        <p><span class="date-num"><?php echo sprintf("%.2f",(($v['lend_money']-$v['lend_repay_money'])/10000))  ;?><em class="fs16 fc_4d">万</em></span><span class="">剩余金额</span></p>
                                    </div>
                                    <div class="Invest-pro fl">
                                        <div class="Invest-pro-bar-box ofh">
                                            <div class="Invest-pro-bar fl">
                                                <div class="Invest-pro-bar-in transfer_progress_list" name="<?php echo floor($v['lend_repay_money']/$v['lend_money']*100); ?>" >
                                                </div>
                                            </div>
                                            <div class="Invest-pro-data fr"><?php echo floor(($v['lend_repay_money']/$v['lend_money'])*100)  ;?>%</div>
                                        </div>
                                        <p class="Invest-pro-txt"><span class="fc_4d">出借进度</span></p>
                                    </div>
                                </div>
                            </div>

                            <?php if($v['lend_repay_money']/$v['lend_money']*100==100){ ?>
                            <div class="unable-buy fl"><a href="invest_info?id=<?=$v['lend_id']?>" class="fs20 fc0 tc block">已抢光</a></div>
                            <?php } else{       ?>
                            <div class="invest_now2 fl"> <a href="invest_info?id=<?=$v['lend_id']?>"   class="fs20 fc0 tc block">立即出借</a></div>
                            <?php  }?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>


        <!--转让专区 -->
        <div class="pt15" style="display: none" >
            <div class="wl mtauto ofh">
                <div class="ofh section-title bdbt_green1 pb15">
                    <div class="fl">
                        <span class="fl"><i class="icon-Realise"></i></span>
                        <div class="fs14 fc3 fl">
                            <h4 class="">
                                <span>转让专区</span><span class="fs16 fc_80 fstyle1">(100元起投)</span>
                            </h4>
                        </div>
                    </div>
                    <div class="fr pt4"><a href="javascript:;" target="_blank">更多+</a></div>
                    <span class="font-style4 fr mt8">投资有风险，决策需谨慎！</span>
                </div>
                <div class="Invest_Zone ofh">
                    <div class="ofh Realise_pic fl">
                        <h4 class="fc0 fs20 bold">转让专区</h4>
                        <p class="fs12 fc0 lh24">轻松投资，享受生活！</p>
                    </div>
                    <div class="w998 fl bd_e6 bdt_none Invest_fr">
                        <div class="ofh Invest_title bdbt_e6 cash_list_data" onclick="window.location.href='/web/tender/tender_info/project_id/6525.html'">
                            <div class="fl">
                                <div class="ym-name mt25 mb15">
                        <span title="henhao.com，chuanwen.com" title="henhao.com，chuanwen.com" class="domain_str">
                        <a href="/web/tender/tender_info/project_id/6525.html" title="henhao.com，chua...">henhao.com，chua...</a>

                        <font style="display:none;">P32503830</font>
                        </span>
                                </div>
                                <div class="ofh">
                                    <div class="fl domain-ifo">
                                        <p class=""><span class="rate-percent"><em>9.</em><em class="fs18">31</em><em class="fs16">%</em></span><span class="">预期年化利率</span></p>
                                        <p><span class="date-num">29<em class='fs16 fc_4d'>天</em></span><span class="">借款期限</span></p>
                                        <p><span class="date-num">0.00<em class="fs16 fc_4d">万</em></span><span class="">剩余金额</span></p>
                                    </div>
                                    <div class="Invest-pro fl">
                                        <div class="Invest-pro-bar-box ofh">
                                            <div class="Invest-pro-bar fl">
                                                <div class="Invest-pro-bar-in transfer_progress_list" name="100">
                                                </div>
                                            </div>
                                            <div class="Invest-pro-data fr">100%</div>
                                        </div>
                                        <p class="Invest-pro-txt"><span class="fc_4d">出借进度</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="unable-buy fl"><a href="/web/tender/tender_info/project_id/6525.html" class="fs20 fc0 tc block">2分钟抢光</a></div>                                    </div><div class="ofh Invest_title bdbt_e6 cash_list_data" onclick="window.location.href='/web/tender/tender_info/project_id/6393.html'">
                            <div class="fl">
                                <div class="ym-name mt25 mb15">
                        <span title="闽C379BW" title="闽C379BW" class="domain_str">
                        <a href="/web/tender/tender_info/project_id/6393.html" title="雷克萨斯NX2015 15款 ...">雷克萨斯NX2015 15款 ...</a>

                        <font style="display:none;">P23331619</font>
                        </span>
                                </div>
                                <div class="ofh">
                                    <div class="fl domain-ifo">
                                        <p class=""><span class="rate-percent"><em>13.</em><em class="fs18">77</em><em class="fs16">%</em></span><span class="">预期年化利率</span></p>
                                        <p><span class="date-num">4<em class='fs16 fc_4d'>个月</em>27<em class='fs16 fc_4d'>天</em></span><span class="">借款期限</span></p>
                                        <p><span class="date-num">0.00<em class="fs16 fc_4d">万</em></span><span class="">剩余金额</span></p>
                                    </div>
                                    <div class="Invest-pro fl">
                                        <div class="Invest-pro-bar-box ofh">
                                            <div class="Invest-pro-bar fl">
                                                <div class="Invest-pro-bar-in transfer_progress_list" name="100">
                                                </div>
                                            </div>
                                            <div class="Invest-pro-data fr">100%</div>
                                        </div>
                                        <p class="Invest-pro-txt"><span class="fc_4d">出借进度</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="unable-buy fl"><a href="/web/tender/tender_info/project_id/6393.html" class="fs20 fc0 tc block">16分钟抢光</a></div>                                    </div><div class="ofh Invest_title  cash_list_data" onclick="window.location.href='/web/tender/tender_info/project_id/6386.html'">
                            <div class="fl">
                                <div class="ym-name mt25 mb15">
                        <span title="闽DY193V" title="闽DY193V" class="domain_str">
                        <a href="/web/tender/tender_info/project_id/6386.html" title="保时捷 macan  迈凯A1...">保时捷 macan  迈凯A1...</a>

                        <font style="display:none;">P37052129</font>
                        </span>
                                </div>
                                <div class="ofh">
                                    <div class="fl domain-ifo">
                                        <p class=""><span class="rate-percent"><em>14.</em><em class="fs18">67</em><em class="fs16">%</em></span><span class="">预期年化利率</span></p>
                                        <p><span class="date-num">1<em class='fs16 fc_4d'>个月</em>23<em class='fs16 fc_4d'>天</em></span><span class="">借款期限</span></p>
                                        <p><span class="date-num">0.00<em class="fs16 fc_4d">万</em></span><span class="">剩余金额</span></p>
                                    </div>
                                    <div class="Invest-pro fl">
                                        <div class="Invest-pro-bar-box ofh">
                                            <div class="Invest-pro-bar fl">
                                                <div class="Invest-pro-bar-in transfer_progress_list" name="100">
                                                </div>
                                            </div>
                                            <div class="Invest-pro-data fr">100%</div>
                                        </div>
                                        <p class="Invest-pro-txt"><span class="fc_4d">出借进度</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="unable-buy fl"><a href="/web/tender/tender_info/project_id/6386.html" class="fs20 fc0 tc block">1分钟抢光</a></div>                                    </div>        	</div>
                </div>
            </div>
        </div>

        <!--借款流程 -->
        <div class="pt15">
            <div class="wl mtauto ofh">
                <div class="ofh section-title bdbt_e6 pb15">
                    <div class="fl">
                        <span class="fl"><i class="icon-Borrowing"></i></span>
                        <div class="fs14 fc3 fl"><h4 class="">借款流程</h4></div>
                    </div>
                </div>
                <div class="pt20">
                    <ul class="process-invest w9 pl10">
                        <li class="animate">
                            <div class="process-invest-pic process-invest-iocn1"></div>
                            <div class="process-invest-txt">免费注册</div>
                        </li>
                        <li>
                            <div class="triangle-right"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic process-invest-iocn7"></div>
                            <div class="process-invest-txt">开通新浪托管账户</div>
                        </li>
                        <li>
                            <div class="triangle-right"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic process-invest-iocn8"></div>
                            <div class="process-invest-txt">域名授信</div>
                        </li>
                        <li>
                            <div class="triangle-right"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic process-invest-iocn9"></div>
                            <div class="process-invest-txt">发标借款</div>
                        </li>
                        <li>
                            <div class="triangle-right"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic process-invest-iocn10"></div>
                            <div class="process-invest-txt">满标放款</div>
                        </li>
                        <li>
                            <div class="triangle-right"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic process-invest-iocn11"></div>
                            <div class="process-invest-txt">按期还款</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--出借流程 -->
        <div class="pt30">
            <div class="wl mtauto ofh">
                <div class="ofh section-title bdbt_e6 pb15">
                    <div class="fl">
                        <span class="fl"><i class="icon-tz"></i></span>
                        <div class="fs14 fc3 fl"><h4 class="">出借流程</h4></div>
                    </div>
                </div>
                <div class="mt20">
                    <ul class="process-invest w9 pl10">
                        <li class="animate">
                            <div class="process-invest-pic2 process-invest-iocn01"></div>
                            <div class="process-invest-txt2">免费注册</div>
                        </li>
                        <li>
                            <div class="triangle-right2"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic2 process-invest-iocn02"></div>
                            <div class="process-invest-txt2">开通新浪托管账户</div>
                        </li>
                        <li>
                            <div class="triangle-right2"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic2 process-invest-iocn03"></div>
                            <div class="process-invest-txt2">选择项目</div>
                        </li>
                        <li>
                            <div class="triangle-right2"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic2 process-invest-iocn04"></div>
                            <div class="process-invest-txt2">100元起投</div>
                        </li>
                        <li>
                            <div class="triangle-right2"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic2 process-invest-iocn05"></div>
                            <div class="process-invest-txt2">满标</div>
                        </li>
                        <li>
                            <div class="triangle-right2"></div>
                        </li>
                        <li class="animate">
                            <div class="process-invest-pic2 process-invest-iocn06"></div>
                            <div class="process-invest-txt2">分期回款</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--banner -->
        <div class="pt40">
            <div class="wl mtauto ofh">
                <div class="ft_ban"><a href="/web/index/tender.html"><img src="Public/web/images/ban20.jpg"/></a></div>
            </div>
        </div>

        <!--合作伙伴 -->
        <div class="pt15">
            <div class="wl mtauto ofh">
                <div class="ofh section-title bdbt_e6 pb10">
                    <div class="fl">
                        <span class="fl"><i class="icon-partner"></i></span>
                        <div class="fs14 fc3 fl"><h4 class="">合作伙伴</h4></div>
                    </div>
                    <div class="fr pt10"><a href="/web/help/about_us.html" target="_blank">更多+</a></div>
                </div>
                <div class="">
                    <ul class="ofh partner_ifo">
                        <?php foreach($partner as $k=>$v){?>
                        <li class="mr30"><a href="<?=$v['partner_link']?>" target="_blank"><img src="<?=$v['partner_img']?>"/></a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>


        <!--悬浮侧栏-->
        <div class="floatBtn">
            <ul>
                <li class="kefu">
                    <a class="BtnName" onclick="" href="http://float2006.tq.cn/static.jsp?version=vip&admiuin=9786963&ltype=1&iscallback=1&page_templete_id=107017&is_message_sms=0&is_send_mail=0&uin=9786963" rel="nofollow" target="_blank"><i></i></a>
                    <a style="width: 0px; left: 0px; display: none;" class="what" onclick="" href="javascript:void(0);" rel="nofollow">
                        <p><?php echo $settings['tel'] ?> </p><p class="kefuTime">工作日：09:00-21:00</p>
                    </a>
                </li>
                <li class="watch">
                    <a class="BtnName" href="javascript:void(0);" rel="nofollow"><i></i></a>
                    <a style="width: 0px; left: 0px; display: none;" class="what" href="javascript:void(0);" rel="nofollow">
                        <div class="dingyue">
                            <img alt="" src="uploads/weixin1.jpg" width="100" height="100">
                            <p>微信公众号</p>
                        </div>
                    </a>
                </li>
                <li class="app">
                    <a class="BtnName" href="counter" rel="nofollow" target="_blank"><i></i></a>
                    <a style="width: 0px; left: 0px; display: none;" class="what" target="_blank" href="counter" rel="nofollow">
                        <p>利息计算器</p>
                    </a>
                </li>
                    {{--   <li class="compute">
                           <a class="BtnName" target="_blank" href="/web/index/mobile.html" rel="nofollow" target="_blank"><i></i></a>
                           <a style="width: 0px; left: 0px; display: none;" class="what" href="/web/index/mobile.html" rel="nofollow" target="_blank">
                               <div class="app-download">
                                   <img alt="" src="Public/home/new/images/code.png" width="113" height="113">
                                   <p>手机APP下载</p>
                               </div>
                           </a>
                       </li>--}}
                <li class="top">
                    <a class="BtnName" rel="nofollow" href="javascript:scroll(0,0);"><i></i></a>
                </li>
            </ul>
        </div>

    </div>


    <script>jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true});</script>
    <script type="text/javascript" src="Public/web/js/roll.js"></script>
    <script>

        //banner切换
        $(function () {
            $('.slide_banner > li').each(function (index) {
                $('.slide_btn').append('<li data-index="banner'+index+'"></li>');
                $('.slide_btn > li').mouseenter(function () {
                    $('.slide_btn > li.on').removeClass('on');
                    $(this).addClass('on');

                    var id = $(this).attr('data-index');
                    $('.slide_banner > li.active').removeClass('active');
                    $('#'+id).parent().addClass('active');
                });
                $('.slide_btn > li:first').mouseenter();
            });
            setInterval('switch_slide()',5000);
        });


        function switch_slide() {
            if ($('.slide_btn > li.on').next().length > 0){
                $('.slide_btn > li.on').next().mouseenter();
            }else {
                $('.slide_btn > li:first').mouseenter();
            }
        }

        //侧栏微信显示/隐藏
        $(".floatBtn ul li").mouseenter(function(){
            if($(this).attr('class') == 'kefu') {
                var wh = {"width":"185px","left":"-185px"};
            }else{
                var wh = {"width":"140px","left":"-140px"};
            }
            $(this).children(".what").show().animate( wh,120);
            $(this).siblings().children(".what").hide();
        })
        $(".floatBtn ul li").mouseleave(function(){
            $(this).children(".what").animate({"width":"0","left":"0"},120).hide();
        })


        //进度条
        $(".hot_progress_list").each(function(){
            var val = parseFloat($(this).attr("name"));
            $(this).animate({width:val+'%'},'slow');
        });

        $(".tender_progress_list").each(function(){
            var val = parseFloat($(this).attr("name"));
            $(this).animate({width:val+'%'},'slow');
        });

        $(".transfer_progress_list").each(function(){
            var val = parseFloat($(this).attr("name"));
            $(this).animate({width:val+'%'},'slow');
        });


        $(function () {
            $(".hot-list-data").each(function(){
                $(this).mouseenter(function(){
                    $(this).find("font").show();
                }).mouseleave(function(){
                    $(this).find("font").hide();
                });
            });

            $(".tender_list_data").each(function(){
                $(this).mouseenter(function(){
                    $(this).find("font").show();
                }).mouseleave(function(){
                    $(this).find("font").hide();
                });
            });


            $(".cash_list_data").each(function(){
                $(this).mouseenter(function(){
                    $(this).find("font").show();
                }).mouseleave(function(){
                    $(this).find("font").hide();
                });
            });


            $('.aside_ban1 img,.aside_ban2 img').mouseenter(function(){
                var this_obj = $(this);
                $(this).addClass('hover');
            }).mouseleave(function(){
                $(this).removeClass('hover');
            });
            $('.partner_ifo li a').mouseenter(function(){
                var this_obj = $(this);
                $(this).addClass('hover');
            }).mouseleave(function(){
                $(this).removeClass('hover');
            });

        })


        $("#total_earn a").each(function(){
            var num = Math.floor(Math.random()*10);
            $(this).html(num);
        });


        function get_statistic() {
            $.ajax({
                url: '/web/index/get_statistic.html',
                type: 'post',
                data:{},
                dataType: 'json',
                success:function(result){
                    if(result.code == 1000) {
                        $("#total_user").html(result.data.total_user+'人');
                        var earn_statistic = result.data.total_income;
                        var total_deal = result.data.total_turnover;
                        earn_statistic = earn_statistic <= 0 ? 1 : earn_statistic;
                        total_deal = total_deal <= 0 ? 1 : total_deal;


                        if(earn_statistic) {
                            var numRun4 = $("#earn_statistic").numberAnimate({num:'0000000', speed:900});
                            numRun4.resetData(earn_statistic);
                        }

                        if(total_deal) {
                            var numRun4 = $("#total_deal").numberAnimate({num:'0000000', speed:900});
                            numRun4.resetData(total_deal);
                        }

                    }
                }
            });
        }

        get_statistic();


        //获取新闻
        $.ajax({
            url: 'home_index_new',
            type: 'get',
            data:{},
            dataType: 'json',
            success:function(result){
                var list = '';
                var data = result.data;
                for(var i=0;i<data.length;i++) {
                    var item = data[i];
                    var sj=getLocalTime(item.article_time);
                    list += '<li><a href="#" target="_blank">'+item.article_title+'</a><span class="date">('+sj+')</span></li>';
                }
                $("#info_list").html(list);
                $(".slideBox").slide({mainCell:".bd ul",autoPlay:true});
                $(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"top",autoPlay:true,pnLoop:false});
            }
        });
        //将PHP时间戳转化为js时间
        function getLocalTime(nS) {
            return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
        }
        //循环
        $("input[class='hidden_input']").each(function(){
            var key = $(this).attr('name');
            var second = parseInt($(this).val());

            daojishi(second, key);
        });


        //倒计时
        function daojishi(second, key) {
            if(second < 0) {
                $("#hour_"+key).html('00');
                $("#minute_"+key).html('00');
                $("#second_"+key).html('00');
                return false;
            }

            var hour = Math.floor(second/3600).toString();
            var left_second = second % 3600;
            var minute = Math.floor(left_second/60).toString();
            var left_second = (left_second % 60).toString();

            hour = (hour.length == 1) ? '0'+hour : hour;
            minute = (minute.length == 1) ? '0'+minute : minute;
            left_second = (left_second.length == 1) ? '0'+left_second : left_second;

            $("#hour_"+key).html(hour);
            $("#minute_"+key).html(minute);
            $("#second_"+key).html(left_second);

            second--;

            setTimeout(function(){daojishi(second, key);}, 1000);
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
    <!--底部 -->
<!--    --><?php //include "layout/home/footer.php";?>
</div>
</body>
</html>

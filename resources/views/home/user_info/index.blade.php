<!-- saved from url=(0042)https://www.jiandai.com/web/user/main.html -->
<html>
<body style="">
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
                <div class="ofh pt20">
                    <div class="lh40 pl40 psr bd_ff5a4d bg_fceeed">
                        @if(session('assess')=="0")
                        <span id="no_naire"></span>
                        您未进行风险承受能力评估，为不影响投资请立即评估。<a href="survey" class="fc_blue1">立即评估</a>
                        @else
                        您的风险承受能力为：<span style="color: red;font-size: 16px">{{session('assess')}}</span>
                        @endif
                    </div>	<div class="fl content-right-inbox11">
                        <div class="fs20 fc3 mt25 mb25 tc">可用余额</div>
                        <div class="balance-price ofh"><span>{{$model->details_balance}}</span><span>元</span></div>
                        <div class="ofh balance-btn-box">
                            <div class="fl fs20 balance-btn recharge-btn"><a href="recharge" class="fc0">充  值</a></div>
                            <div class="fr fs20 balance-btn cash-btn"><a href="withdraw" class="fc_orange2">提  现</a></div>
                        </div>
                    </div>
                    <div class="fr content-right-inbox11">
                        <div class="user-binding user-binding_1">
                            <ul class="pt5 pb40">
                                @if(($model->details_name && $model->details_card)!=Null)
                                <li class="ofh">
                                    <a href="javascript:void(0);" class="fl" style="cursor:default;"><em class="user-binding-icon1">
                                        </em>实名认证</a>
                                    <div class="fr fs14 fc_80 fstyle1 binding-tips2 mr60"><em></em>已完成</div>
                                </li>
                                @else
                                <li class="ofh">
                                    <a class="fl" style="cursor: default;" href="javascript:void(0);"><em class="user-no-binding-icon1"></em>实名认证</a>
                                    <div class="fr user-sure-btn tc"><a class="fstyle1 fs14" href="user_safe">立即认证</a>
                                    </div>
                                </li>
                                @endif
                                @if(($model->details_name && $model->details_card &&$brank)!=Null)
                                        <li class="ofh">
                                            <a class="fl" style="cursor: default;" href="javascript:void(0);"><em class="user-binding-icon2"></em>绑定银行卡</a>
                                            <div class="fr fs14 fc_80 fstyle1 binding-tips2 mr60"><em></em>已完成</div>
                                        </li>
                                    @elseif(($model->details_name && $model->details_card)!=Null)
                                        <li class="ofh">
                                            <a href="javascript:void(0);" class="fl" style="cursor:default;"><em class="user-no-binding-icon2"></em>绑定银行卡</a>
                                            <div class="fr user-sure-btn tc"><a href="bank_info" class="fstyle1 fs14">立即绑定</a></div>
                                        </li>
                                    @else
                                    <li class="ofh">
                                        <a class="fl" style="cursor: default;" href="javascript:void(0);"><em class="user-no-binding-icon2"></em>绑定银行卡</a>
                                        <div class="fr fs14 fstyle1 binding-tips1 mr60"><em></em>需先完成实名认证</div>
                                    </li>
                                    @endif
                                    @if(($model->details_name && $model->details_card && $model->details_pay)!=Null)
                                <li class="ofh">
                                    <a href="javascript:void(0);" class="fl" style="cursor:default;"><em class="user-binding-icon3"></em>支付密码设置</a>
                                    <div class="fr fs14 fc_80 fstyle1 binding-tips2 mr60"><em></em>已完成</div>
                                </li>
                                    @elseif(($model->details_name && $model->details_card)!=Null)
                                        <li class="ofh">
                                            <a class="fl" style="cursor: default;" href="javascript:void(0);"><em class="user-no-binding-icon3"></em>支付密码设置</a>
                                            <div class="fr user-sure-btn tc"><a class="fstyle1 fs14" href="user_safe">立即设置</a>
                                        </li>
                                    @else
                                <li class="ofh">
                                    <a class="fl" style="cursor: default;" href="javascript:void(0);"><em class="user-no-binding-icon3"></em>支付密码设置</a>
                                    <div class="fr fs14 fstyle1 binding-tips1 mr60"><em></em>需先完成实名认证</div>
                                </li>
                                    @endif
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="bd_e6" style="position:relative;">
                    <div id="main" style="width: 502px; height: 380px; padding: 10px 50px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative; background: transparent;" _echarts_instance_="ec_1497006579874"><div style="position: relative; overflow: hidden; width: 502px; height: 380px; cursor: pointer;"><canvas width="502" height="380" data-zr-dom-id="zr_0" style="position: absolute; left: 0px; top: 0px; width: 502px; height: 380px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas></div><div style="position: absolute; display: block; border-style: solid; white-space: nowrap; z-index: 9999999; transition: left 0.4s cubic-bezier(0.23, 1, 0.32, 1), top 0.4s cubic-bezier(0.23, 1, 0.32, 1); background-color: rgba(50, 50, 50, 0.7); border-width: 0px; border-color: rgb(51, 51, 51); border-radius: 4px; color: rgb(255, 255, 255); font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 14px; font-family: &quot;Microsoft YaHei&quot;; line-height: 21px; padding: 5px; left: 142.5px; top: 169px;">待还利息:￥0.00<br>0%</div></div>
                    <!--
                    <canvas id="canvas_circle" width="702" height="330">
                        浏览器不支持canvas
                    </canvas>
                     -->

                    <div class="tab-info tab-info_1">
                        <p><i style="background-color:#f08501;"></i>待收本金：0.00元</p>
                        <p><i style="background-color:#92bc00;"></i>待还本金：0.00元</p>
                        <p><i style="background-color:#fcc417;"></i>累计收益：0.00元</p>
                        <p><i style="background-color:#5d5d5d;"></i>待收利息：0.00元</p>
                        <p><i style="background-color:#cb3802;"></i>待还利息：0.00元</p>
                        <p><i style="background-color:#00a1cb;"></i>存钱罐收益：0.00元</p>
                    </div>

                </div>

                <script src="Public/web/js/echarts.min.js"></script>
                <script type="text/javascript">
                    var wait_earnings_corpus = Number("0.00");
                    var wait_repayment_corpus = Number("0.00");
                    var have_earnings = Number("0.00");
                    var wait_earnings = Number("0.00");
                    var wait_repayment = Number("0.00");
                    var bonus = Number("0.00");

                    wait_earnings_corpus = wait_earnings_corpus.toFixed(2);
                    wait_repayment_corpus = wait_repayment_corpus.toFixed(2);
                    have_earnings = have_earnings.toFixed(2);
                    wait_earnings = wait_earnings.toFixed(2);
                    wait_repayment = wait_repayment.toFixed(2);
                    bonus = bonus.toFixed(2);

                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main'));
                    // 指定图表的配置项和数据
                    option = {
                        title : {
                            text: '',
                            x:'center'
                        },
                        tooltip : {
                            trigger: 'item',
                            formatter: "{b}:￥{c}<br/>{d}%"
                        },
                        legend: {
                            show: false,
                            trigger: 'item',
                            orient: 'vertical',
                            x: 'right',
                            y: 'center',
                            itemHeight: 12,
                            itemWidth:12,
                            itemGap: 16,
                            data: ['待收本金','待还本金','累计收益','待收利息','待还利息', '存钱罐收益'],
                            formatter: "{name}"
                        },
                        series : [
                            {
                                name: '资金统计',
                                type: 'pie',
                                radius : '73%',
                                center: ['40%', '50%'],
                                data:[
                                    {value:wait_earnings_corpus, name:'待收本金',itemStyle:{normal:{color:'#f08501'}}},
                                    {value:wait_repayment_corpus, name:'待还本金',itemStyle:{normal:{color:'#92bc00'}}},
                                    {value:have_earnings, name:'累计收益',itemStyle:{normal:{color:'#fcc417'}}},
                                    {value:wait_earnings, name:'待收利息',itemStyle:{normal:{color:'#5d5d5d'}}},
                                    {value:wait_repayment, name:'待还利息',itemStyle:{normal:{color:'#cb3802'}}},
                                    {value:bonus, name:'存钱罐收益',itemStyle:{normal:{color:'#00a1cb'}}}
                                ],
                                itemStyle: {
                                    normal: {
                                        label: {
                                            show: false
                                        },
                                        labelLine: {
                                            show: false
                                        }
                                    },
                                    emphasis: {
                                        shadowBlur: 0,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                }
                            }
                        ]
                    };

                    // 使用刚指定的配置项和数据显示图表。
                    myChart.setOption(option);



                    //绘制饼图
                    /**
                     function drawCircle(canvasId, data_arr, color_arr, text_arr)
                     {
                         var c = document.getElementById(canvasId);
                         var ctx = c.getContext("2d");

                         var radius = c.height / 2 - 20; //半径
                         var ox = radius + 20, oy = radius + 20; //圆心

                         var width =12, height =12; //图例宽和高
                         var posX = ox * 2 + 20, posY = 30;   //
                         var textX = posX + width + 5, textY = posY + 10;

                         var startAngle = 0; //起始弧度
                         var endAngle = 0;   //结束弧度
                         for (var i = 0; i < data_arr.length; i++)
                         {
                             //绘制饼图
                             endAngle = endAngle + data_arr[i] * Math.PI * 2; //结束弧度
                             ctx.fillStyle = color_arr[i];
                             ctx.beginPath();
                             ctx.moveTo(ox, oy); //移动到到圆心
                             ctx.arc(ox, oy, radius, startAngle, endAngle, false);
                             ctx.closePath();
                             ctx.fill();
                             startAngle = endAngle; //设置起始弧度

                             //绘制比例图及文字
                             ctx.fillStyle = color_arr[i];

                             ctx.fillRect(posX+154, posY + 50 * i, width, height);//posX文字块状的中心距离,posY块状的高度
                             ctx.moveTo(posX, posY + 20 * i);
                             ctx.font = '16px 宋体';    //字体
                             ctx.fillStyle = '#333'; //"#000000";
                             var percent = text_arr[i] ;
                             ctx.fillText(percent, textX+162, textY + 50 * i);//textX文字的中心距离,textY文字的高度
                         }
                     }

                     function init() {
        //绘制饼图
        var wait_earnings_corpus = 0.00;
        var wait_repayment_corpus = 0.00;
        var have_earnings = 0.00;
        var wait_earnings = 0.00;
        var wait_repayment = 0.00;
        var bonus = 0.00;

        var total = wait_earnings_corpus+wait_repayment_corpus+have_earnings+wait_earnings+wait_repayment+bonus;
        var wait_earnings_corpus_rate = Math.floor(wait_earnings_corpus/total*10000)/10000;
        var wait_repayment_corpus_rate = Math.floor(wait_repayment_corpus/total*10000)/10000;
        var have_earnings_rate = Math.floor(have_earnings/total*10000)/10000;
        var wait_earnings_rate = Math.floor(wait_earnings/total*10000)/10000;
        var wait_repayment_rate = Math.floor(wait_repayment/total*10000)/10000;
        var bonus_rate = 1-wait_earnings_corpus_rate-wait_repayment_corpus_rate-have_earnings_rate-wait_earnings_rate-wait_repayment_rate;

        //比例数据和颜色
        var data_arr = [wait_earnings_corpus_rate, wait_repayment_corpus_rate, have_earnings_rate, wait_earnings_rate, wait_repayment_rate, bonus_rate];
        var color_arr = ["#f08501", "#92bc00", "#fcc417", "#5d5d5d","#cb3802","#00a1cb"];

        wait_earnings_corpus = wait_earnings_corpus.toFixed(2);
        wait_repayment_corpus = wait_repayment_corpus.toFixed(2);
        have_earnings = have_earnings.toFixed(2);
        wait_earnings = wait_earnings.toFixed(2);
        wait_repayment = wait_repayment.toFixed(2);
        bonus = bonus.toFixed(2);

        var text_arr = ["待收本金："+wait_earnings_corpus+"元",
                        "待还本金："+wait_repayment_corpus+"元",
                        "累计收益："+have_earnings+"元",
                        "待收利息："+wait_earnings+"元",
                        "待还利息："+wait_repayment+"元",
                        "存钱罐收益："+bonus+"元"];

        drawCircle("canvas_circle", data_arr, color_arr, text_arr);
    }

                     //页面加载时执行init()函数
                     window.onload = init;
                     **/

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

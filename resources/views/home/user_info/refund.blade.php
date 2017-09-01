<html>
<body>
<div class="ww">
    <?php include "layout/home/header.php";?>
</div>
<div class="ww both">
    <div class="bg_color1">
        <div class="wl mtauto ofh">
            <?php include "layout/home/user.php";?>
            <div class="fr content-right-x22 bg_color2">
                <div class="content-right-x2-title bdbt_e6">
                    <h3 class="fl pr25 fs22">还款计划</h3>
                </div>
                <div class="bd_e6 mt15 repay-ifo-top">
                    <dl class="ofh">
                        <input type="text" id="b_ids" value="{{$b_id}}">
                        <dt class="fl">
                        <div class="fs30 bold fc_red4 tc mt20">{{$info['r_sumMoney']}}</div>
                        <div class="fs14 fstyle1 fc_80 tc mt15">待还款总金额（元）</div>
                        </dt>
                        <dd class="fr">
                            <div class="fl ml45 repay-ifo-top-ct1">
                                <div>待还款本金（元）：<span>{{$info['r_benjin']}}</span></div>
                                <div class="pt30">待还款利息（元）：<span>{{$info['r_sumAccrual']}}</span></div>
                            </div>
                            <div class="fr mr10 repay-ifo-top-ct1">
                                <div>未来7日应还（元）：<span>{{$sumPrice}}</span></div>
                                <div class="pt30">未来30天应还（元）：<span>{{$sumPrice30}}</span></div>
                            </div>
                        </dd>
                    </dl>
                    <input type="hidden" value="{{csrf_token()}}" id="_token">
                </div>
                <input type="hidden" id="r_type" value="{{$info['r_type']}}">
                <div id="refund_list">

                </div>
                <script>
                    var _token=$("#_token").val();
                    var url = "refund_list_data";
                    var b_id=$("#b_ids").val();
                    function getList(page){
                        page = page == null ? 1 : page;
                        javascript:scroll(0,0);

                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{'current_page':page,'_token':_token,b_id:b_id},
                            dataType: 'html',
                            success:function(result){
                                $("#refund_list").html(result);
                            }
                        });
                    }

                    getList();
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
    <!--底部 -->
    <?php include "layout/home/footer.php";?>
</div>
</body>
</html>

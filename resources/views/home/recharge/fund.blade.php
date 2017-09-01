<!-- saved from url=(0042)https://www.jiandai.com/web/user/fund.html -->
<html>
<link rel="stylesheet" href="Public/web/css/bootstrap.css">
<script src="Public/web/js/bootstrap.min.js"></script>
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
                <div class="content-right-x2-title bdbt_e6">
                    <h3 class="fl pr25 fs20">我的资金</h3>
                    <div class="fr return-money-btn">
                        <a href="https://www.jiandai.com/web/user/fund_statistic.html">资金详情</a>
                        <a class="checked" href="javascript:void(0);">资金记录</a>
                    </div>
                </div>

                <div class="ofh mt35 pb20">
                    <div class="fl dib mr80">
                        <span class="fs14 fstyle1 fc3 fl lh38">类型</span>
                        <div class="capital-type-choose fl">
                            <select class="fl dib" id="type_list">
                                <option value="0">全部</option>
                                <option value="Deposit">账户充值</option><option value="Withdraw">账户提现</option><option value="InvestmentCollect">出借支付</option><option value="InvestmentPay">满标放款</option><option value="Turnover">流标退款</option><option value="Refuse">拒绝放款</option><option value="BorrowCollect">还款</option><option value="BorrowPay">出借回款</option><option value="RecommendPay">领取奖励</option>            </select>
                        </div>
                    </div>

                    <div class="fl dib query-btn fs14 fstyle1 tc" id="search">查询</div>
                </div>

                <div id="fund_list"><table class="table table-bordered table-hover">
                        <tbody><tr class="active">
                            <th width="90">类型</th>
                            <th width="120">查询编号</th>
                            <th width="100">时间</th>
                            <th width="80">金额</th>
                            <th width="60">状态</th>
                            <th width="120">备注</th>
                        </tr>
                        @foreach($recharge as $k=>$v)
                        <tr>
                            <td>{{$v['recharge_type']}}充值</td>
                            <td>{{$v['recharge_order']}}</td>
                            <td>{{$v['recharge_success_time']}}</td>
                            <td>
                                <font class="red">+{{$v['recharge_money']}}元</font>
                            </td>
                            <td>
                                @if($v['status']==0)
                                    <font class="red">未支付</font>
                                @elseif($v['status']==3)
                                    <font class="green">支付成功</font>
                                @endif
                            </td>
                            <td title=""></td>
                        </tr>
                        @endforeach
                        <tr class="not-hover">
                            <td colspan="5">
                                <div class="ft_pages" id="page_list">
                                    {{$page->render()}}
                                    </div></td>
                        </tr>
                        </tbody>
                    </table>


                    <script>
                        $("#page_list a").each(function(){
                            $(this).click(function(){
                                var page = $(this).attr('page');
                                if(page>0) {
                                    getList(page);
                                }
                            });
                        });
                    </script></div>

                <script>

                    var url = "/web/user/fund_list.html";
                    var page = 1;

                    function getList(page){
                        page = page == null ? 1 : page;
                        type = $("#type_list option:selected").val();
                        javascript:scroll(0,0);

                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{'current_page':page, 'type':type},
                            dataType: 'html',
                            success:function(result){
                                $("#fund_list").html(result);
                                $(window).scrollTop(0);
                            }
                        });

                    }

                    getList(page);

                    $("#get_more").click(function(){
                        page ++;
                        getList(page);
                    });

                    $("#search").click(function(){
                        $("#get_more").show();
                        page = 1;
                        getList(page);
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
    <!--底部 -->
    <?php include "layout/home/footer.php";?>
</div>

</body></html>
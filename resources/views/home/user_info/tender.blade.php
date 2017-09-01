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
                    <h3 class="fl pr25 fs20 pl5">出借记录</h3>
                </div>
                <div class="mt25">
                    <div class="slideTxtBox slide04">
                        <div class="hd">
                            <ul class="ofh" id="type_list">
                                <li class="slide04-hd-li-wdx1" name="repay">回款中：<span id="pay_again_count"><?=$msg['repay_num']; ?></span></li>
                                <li class="slide04-hd-li-wdx1" name="finish">已完成：<span><?=$msg['finish_num'];?></span></li>
                                <li class="slide04-hd-li-wdx1" name="tender">投标中：<span><?=$msg['tender_num'];?></span></li>
                                <li class="slide04-hd-li-wdx1" name="overdue">已逾期：<span><?=$msg['overdue']; ?></span></li>
                                <li class="slide04-hd-li-wdx1" style="padding-right:2px;" name="fail">已失败：<span><?=$msg['fail']; ?></span></li>
                            </ul>
                        </div>
                        <div id="tender_list">
                            <input type="hidden" id="_token" value="{{csrf_token()}}">
                        </div>
                    </div>
                </div>

                <script>
                    var _token=$("#_token").val();
                    var url = "tender_list_data";
                    var page = 1;
                    var type = "repay";
                    var user_id = <?php echo session('user_id'); ?>;

                        //初始化
                    $("#type_list [name='"+type+"']").addClass('on');

                    function getList(page){
                        page = page == null ? 1 : page;
                        type = $("#type_list li.on").attr("name");
                        javascript:scroll(0,0);
                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{'current_page':page, 'type':type,'_token':_token,'user_id':user_id},
                            dataType: 'html',
                            success:function(result){
                                $("#tender_list").html(result);
                            }
                        });

//                        $.ajax({
//                            url: "/web/usertrade/pay_again_count.html",
//                            type: 'post',
//                            dataType: 'json',
//                            success:function(result){
//                                $("#pay_again_count").text(result.data);
//                            }
//                        });
                    }

                    getList(page);

                    $("#type_list li").each(function(){
                        $(this).click(function(){
                            page = 1;
                            $(this).nextAll('li').removeClass('on');
                            $(this).prevAll('li').removeClass('on');
                            $(this).addClass('on');
                            getList(page);
                        });
                    });

//                                        //出借回款
//                                        function tender_recover(order_id, domain) {
//                                            var url = "/web/usertrade/tender_recover/order_id/_order_id/domain/_domain.html";
//                                            url = url.replace('_order_id', order_id);
//                                            url = url.replace('_domain', domain);
//
//                                            layer.open({
//                                                type: 2,
//                                                title: domain,
//                                                fix: true,
//                                                shadeClose: true,
//                                                maxmin: false,
//                                                area: ['850px', '500px'],
//                                                content: url
//                                            });
//                                        }
//
//                                        function pay_again(trade_id,domain){
//                                            var url = '/index.php?s=/Web/Usertrade/investment_pay_again/trade_id/'+trade_id;
//
//                                            layer.open({
//                                                type: 2,
//                                                title: domain,
//                                                fix: true,
//                                                shadeClose: true,
//                                                maxmin: false,
//                                                area: ['1000px', '600px'],
//                                                content: url,
//                                                cancel: function () {
//                                                    window.parent.location.reload();
//                                                }
//                                            });
//                                        }
//
//                                        function cancel_investment(trade_id){
//                                            layer.confirm('确定取消交易订单？', function(index){
//                                                var url = "/index.php?s=/Web/Usertrade/cancel_investment";
//                                                $.ajax({
//                                                    url: url,
//                                                    type: 'post',
//                                                    data: {"trade_id":trade_id},
//                                                    dataType: 'json',
//                                                    success: function (result) {
//                                                        layer.close();
//                                                        if(result.code == 1000) {
//                                                            window.location.reload();
//                                                        }else{
//                                                            layer.alert(result.msg, function(){
//                                                                window.location.reload();
//                                                            });
//                                                        }
//                                                    }
//                                                });
//                                            });
//                                        }

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
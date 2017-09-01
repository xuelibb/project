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
                    <h3 class="fl pr25 fs22">回款计划</h3>
                    <div class="fr return-money-btn" id="recover_list_data">
                        <a href="javascript:void(0);" class="checked" name="wait">未回款</a>
                        <a href="javascript:void(0);" name="have">已回款</a>
                    </div>
                </div>
                <div class="bd_e6 mt15 repay-ifo-top">
                    <dl class="ofh">
                        <dt class="fl">
                        <div class="fs28 bold fc_red4 tc mt20"><?php echo $invest_return_money; ?></div>
                        <div class="fs14 fstyle1 fc_80 tc mt15">待回款总金额（元）</div>
                        </dt>
                        <dd class="fr">
                            <div class="fl ml45 repay-ifo-top-ct1">
                                <div>待回款本金（元）：<span><?php echo $invest_money; ?></span></div>
                                <div class="pt30">待回款利息（元）：<span><?php echo $lixi; ?></span></div>
                            </div>
                            <div class="fr mr10 repay-ifo-top-ct1">
                                <div>&nbsp;&nbsp;未来7日应回（元）：<span><?php echo $se; ?></span></div>
                                <div class="pt30">未来30日应回（元）：<span><?php echo $mo;?></span></div>
                            </div>
                        </dd>
                    </dl>
                </div>
                <input type="hidden" value="{{csrf_token()}}" name="_token" id="_token">
                <div id="recover_list">

                </div>

                <script>
                    var _token=$('#_token').val();
                    var type = 'wait';
                    var url = "recover_list_data";
                    var page = 1;
                    var obj = $(".sideMenu-icon3").parent().parent("h3");
                    obj .addClass("on");
                    obj.siblings("ul").show();
                    obj.siblings("ul").children("li").eq(1).children("a").addClass("active");
                    $("#recover_list_data a").each(function(){
                        $(this).click(function(){
                            $(this).prev('a').removeClass('checked');
                            $(this).next('a').removeClass('checked');
                            $(this).addClass('checked');
                            var type = $(this).attr('name');

                            getList(page, type);
                        });
                    });

                    function getList(page, type){
                        page = (page == null) ? 1 : page;
                        javascript:scroll(0,0);

                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{'current_page':page, 'type':type,'_token':_token},
                            dataType: 'html',
                            success:function(result){
                                $("#recover_list").html(result);
                            }
                        });
                    }

                    getList(page,type);

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
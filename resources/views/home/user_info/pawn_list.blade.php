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
                    <h3 class="fl pr25 fs20 pl5">域名管理</h3>
                    <div class="fr return-money-btn lh26 fc_red3 tc list-banner-btn">
                        <a href="pawn" class="list-banner-btn">申请质押  </a>
                    </div>
                </div>
                {{--<div class="domain-name-title">--}}
                    {{--<ul class="ofh">--}}
                        {{--<li>授信总额度（元）：<span style="color:#ff0000;">0.00万</span></li>--}}
                        {{--<li class="tc">已使用额度（元）：<span style="color:#ff0000;">0.00万</span></li>--}}
                        {{--<li class="tr">可用额度（元）：<span style="color:#ff0000;">0.00万</span></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}

                <div class="">
                    <div class="slideTxtBox slide04">
                        <div class="hd">
                            <ul class="ofh" id="type_list">
                                <li class="slide04-hd-li-wdx1" name="have_pawn" status="1">域名审核完成</li>
                                <li class="slide04-hd-li-wdx1" name="have_credit" status="0">域名审核中</li>
                            </ul>
                        </div>
                        <div class="bd mb20" id="pawn_list">
                        </div>
                    </div>
                </div>

                <input type="hidden" value="{{csrf_token()}}" id="_token">
                <script>
                    var url = "pawn_list_data";
                    var page = 1;
                    var type = "have_pawn";
                    var _token=$("#_token").val();
                    if(type == null || type == '') {
                        type = 'have_pawn';
                    }

                    $("#type_list li[name='"+type+"']").addClass('on');

                    function getList(page){
                        var status=$('#type_list li.on').attr('status');
                        page = page == null ? 1 : page;
                        var type =  $("#type_list li.on").attr('name');
                        javascript:scroll(0,0);
                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{'current_page':page, 'type':type,'_token':_token,'status':status},
                            dataType: 'html',
                            success:function(result){
                                $("#pawn_list").html(result);
                            }
                        });
                    }

                    getList();

                    $("#type_list li").each(function(){
                        $(this).click(function(){
                            $(this).addClass('on');
                            $(this).prevAll('li').removeClass('on');
                            $(this).nextAll('li').removeClass('on');
                            type_name = $(this).attr('name');
                            getList();
                        });
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
</body>
</html>
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
                    <h3 class="fl pr25 fs22">借款管理</h3>
                </div>

                <div class="mt25">
                    <div class="slideTxtBox slide04">
                        <div class="hd">
                            <ul class="ofh" id="type_list">
                                <li class="slide04-hd-li-wdx1" name="in_repay" status="2">还款中</li>
                                <li class="slide04-hd-li-wdx1" name="verify" status="0">审核中</li>
                                <li class="slide04-hd-li-wdx1" name="in_tender" status="1">投标中</li>
                                <li class="slide04-hd-li-wdx1" name="have_repay" status="3">已还款</li>
                                <li class="slide04-hd-li-wdx1" name="have_repay" status="4">已失败</li>
                            </ul>
                        </div>
                        <input type="hidden" id="_token" value="{{csrf_token()}}">
                        <div class="bd" id="borrow_list">

                        </div>
                    </div>
                </div>

                <script>
                    var type = "in_repay";
                    $("#type_list [name='"+type+"']").addClass("on");
                    var _token=$('#_token').val();
                    var url = "borrow_list_data";
                    function getList(page){
                        page = page == null ? 1 : page;
                        var type = $("#type_list li.on").attr("name");
                        var status = $("#type_list li.on").attr("status");
                        javascript:scroll(0,0);
                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{'current_page':page, 'type':type,'_token':_token,'status':status},
                            dataType: 'html',
                            success:function(result){
                                $("#borrow_list").html(result);
                            }
                        });
                    }

                    getList();

                    $("#type_list li").each(function(){
                        $(this).click(function(){
                            $(this).addClass("on");
                            $(this).prevAll("li").removeClass("on");
                            $(this).nextAll("li").removeClass("on");
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
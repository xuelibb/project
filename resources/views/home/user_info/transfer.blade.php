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
                    <h3 class="fl pr25 fs20 pl5">出借转让</h3>
                </div>
                <div class="mt25">
                    <div class="slideTxtBox slide04">
                        <div class="hd">
                            <ul class="ofh" id="type_list">
                                <li class="slide04-hd-li-wdx2 on" name="can">可申请 : 0</li>
                                <li class="slide04-hd-li-wdx2" name="in">转让中 : 0</li>
                                <li class="slide04-hd-li-wdx2" name="complate">已完成 : 0</li>
                                <li class="slide04-hd-li-wdx2" name="fail">已失败 : 0</li>
                            </ul>
                        </div>
                        <div class="bd" id="transfer_list">


                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{csrf_token()}}" name="_token" id="_token">

                <script>
                    var page = 1;

                    function getList(page){
                        page = page == null ? 1 : page;
                        _token=$("#_token").val();
                        type = $("#type_list li.on").attr("name");
                        var obj = $(".sideMenu-icon3").parent().parent("h3");
                        obj .addClass("on");
                        obj.siblings("ul").show();
                        obj.siblings("ul").children("li").eq(2).children("a").addClass("active");
                        if(type == null || type == '') {
                            type = 'can';
                        }
                        javascript:scroll(0,0);

                        var url = "can_transfer_data";
                        switch (type) {
                            case 'in':
                                url = "in_transfer_data";
                                break;
                            case 'complate':
                                url = "complate_transfer_data";
                                break;
                            case 'fail':
                                url = "fail_transfer_data";
                                break;
                            default:
                                url = "can_transfer_data";
                        }


                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{'current_page':page, 'type':type,'_token':_token},
                            dataType: 'html',
                            success:function(result){
                                $("#transfer_list").html(result);
                            }
                        });
                    }

                    getList();

                    $("#type_list li").each(function(){
                        $(this).click(function(){
                            $(this).addClass("on");
                            $(this).nextAll().removeClass("on");
                            $(this).prevAll().removeClass("on");

                            var type = $(this).attr("name");
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
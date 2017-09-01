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
                <div class="slideTxtBox slide05">
                    <div class="hd mt20">
                        <ul class="ofh psr bdbt_e6">
                            <li class="fl"><a href="invite_one">邀请好友</a></li>
                            <li class="fl slide05-title-center on">邀请记录</li>
                            <li class="fr"><a href="award_list">奖励记录</a></li>
                        </ul>
                    </div>
                    <div class="bd">
                        <div class="slide05-bd mt35">
                            <div class="ofh invited-record bd_e6">
                                <div class="fl dib ml65"><div class="fl dib">累计邀请人数</div><span class="fc_orange2 fl dib">0人</span></div>
                                <div class="fr dib mr75"><div class="fl dib">累计邀请出借金额</div><span class="fc_red5 fl dib">0元</span></div>
                            </div>
                            <div  id="invite_list">

                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{csrf_token()}}" id="_token">
                <script>
                    var url = "invite_list_data";
                    var _token=$("#_token").val();
                    function getList(page){
                        page = page == null ? 1 : page;
                        javascript:scroll(0,0);

                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{'current_page':page,'_token':_token},
                            dataType: 'html',
                            success:function(result){
                                $("#invite_list").html(result);
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
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
                            <li class="fl slide05-title-center"><a href="invite_list">邀请记录</a></li>
                            <li class="fr on">奖励记录</li>
                        </ul>
                    </div>
                    <!--奖励记录-->
                    <div class="slide05-bd mt35">
                        <div class="ofh bd_e6 fs16 fstyle1">
                            <div class="fl dib prize-box prize-box1">
                                <div class="fl dib"><span class="fl dib">获奖总额</span><span class="fc_orange2 fl dib bold fs22 pl10 fstyle2">0.00元</span></div>
                                <div class="fl dib"><span class="fl dib">已领取</span><span class="fl dib bold fs22 pl10 fc3 fstyle2">0.00元</span></div>
                                <div class="fl dib"><span class="fl dib">可领取</span><span class="fl dib bold fs22 pl10 fc_red5 fstyle2">0.00元</span></div>
                            </div>
                            <div class="dole-btn fs16 fstyle1 fc0 tc fr dib" id="extract">一键领取</div>
                        </div>
                        <div id="award_list">

                        </div>
                    </div>
                </div>
                <input type="hidden"  value="{{csrf_token()}}" id="_token">
                <script>
                    var url = "award_list_data";
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
                                $("#award_list").html(result);
                            }
                        });
                    }

                    getList();

                    //点击领取奖励
                    var extract = true;
                    $("#extract").click(function(){
                        if(!extract) {
                            return false;
                        }
                        extract = false;
                        var url = "/web/user/extract.html";
                        var can_extract = 0.00;
                        can_extract = parseFloat(can_extract);

                        if(can_extract<100) {
                            layer.alert('奖励金额必须100以上，才能领取！', {icon:2});
                            return false;
                        }

                        $(this).css("background-color", "#ccc");
                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{},
                            dataType: 'json',
                            success:function(result){
                                if(result.code == 1000) {
                                    extract = true;
                                    layer.alert('领取奖励成功！', {icon:1}, function(){
                                        window.location.reload();
                                    });
                                } else {
                                    layer.alert(result.msg, {icon:2});
                                }
                            }
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
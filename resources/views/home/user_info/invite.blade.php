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
                            <li class="fl on">邀请好友</li>
                            <li class="fl slide05-title-center"><a href="invite_list">邀请记录</a></li>
                            <li class="fr"><a href="award_list">奖励记录</a></li>
                        </ul>
                    </div>
                    <div class="bd">
                        <!--邀请好友-->
                        <div class="slide05-bd">
                            <div class="invited-ban mt20">
                                <div class="ofh invited-ban-txt">
                                </div>
                            </div>
                            <div class="fs18 fc3 mt30">邀请方式一：请输入被邀请人的邮箱</div>
                            <form action="invite_add?id={{base64_encode($id)}}" method="post">
                            <div class="ofh invited-way1">
                                <input class="fl" placeholder="" value="" id="recommend_url" name="email" type="email"/>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                                <div class="ofh invited-way1"  style="width: 300px;margin-left: 600px">
                                    <input type="submit" class="fl" placeholder="" value="发送邮件" id="recommend_urls"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script type="text/javascript" src="/Public/web/js/jquery.zclip.min.js"></script>

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
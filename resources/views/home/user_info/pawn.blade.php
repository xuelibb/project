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
                    <h3 class="fl fs20">申请质押</h3>
                </div>

                <div class="ofh Domain-mortgage">
                    <div class="dib">
                        <div class="ofh mt35">
                            <span class="fl dib fc3 fstyle1 mr6 fc_80">【单个质押】</span>
                            <span class="fl dib fc_80 fstyle1 mr16">如:www.xlibb.com</span>
                            <span class="fl dib fc3 fstyle1 mr6 fc_80"> 【批量质押】</span>
                            <span class="fl dib fc_80 fstyle1">如:jiandai.com等10个双拼com</span>
                        </div>
                        <textarea class="mt15 mb25" id="domain" style="overflow-y:scroll;"></textarea>
                        <div class="btn">
                            <div class="fl fs16 fstyle1 fc_red5 tc lh40 apply-domain-mortgage-btn" id="singular_apply">单个质押</div>
                            <div class="fl fs16 fstyle1 fc_red5 tc lh40 apply-domain-mortgage-btn1"  id="match_apply" style="margin-left:170px;">批量质押</div>
                        </div>
                    </div>
                </div>

                <div class="fs14 fstyle1 fc_80 mt40 bd_e7 pl20 pt20 pb20 border-radius3">
                    <div class="bold">温馨提示:</div>
                    <p class="mt5 lh36">每个域名占一行，如需质押多个域名，请分行输入，最多可输入10行。</p>
                    <p class="lh36">只接受2字符.com/.cn 3数字.com/.cn 4数字.com 3字母.com ，有固定价值区间的拼音域名以及其它万元以上的硬通货域名。<br/>而某些域名虽然有很高价值，但难以评估， 我们不提倡质押。</p>
                    <div class="ofh lh32">
                        <div class="fl dib mr90">
                            <div>易名ID：167719</div>
                            <div>验证邮箱：domain@jiandai.com</div>
                        </div>
                        <div class="fl dib mr90">
                            <div>爱名ID：1060210</div>
                            <div>验证邮箱：domain@jiandai.com</div>
                        </div>
                        <div class="fl dib">
                            <div>万网ID：1100556453942511</div>
                            <div>验证账号：简贷金融</div>
                        </div>
                    </div>
                </div>

                <div style="height:500px;"></div>

                <script>
                    var identity_type = Number("1");

                    function set_real()
                    {
                        var verify_real = Number("1");
                        if(verify_real != 2) {
                            if(identity_type == 2) {
                                layer.alert('您是企业会员，请联系客服完成认证！', {icon:3});
                            } else {
                                layer.open({
                                    type: 2,
                                    title: '实名认证',
                                    fix: true,
                                    shadeClose: true,
                                    maxmin: false,
                                    area: ['455px', '340px'],
                                    content: "/web/user/real_name_box.html",
                                });
                            }

                            return false;
                        }
                        return true;
                    }
                    //单个质押
                    $("#singular_apply").click(function(){
                        if(!set_real()) {
                            return false;
                        }
                        var domain = $("#domain").val().trim();
                        var format = /^[\u4e00-\u9fa5a-z0-9]+(\.){1}[\u4e00-\u9fa5a-z]{2,4}((\.){1}[\u4e00-\u9fa5a-z]{2,4})?$/;

                        if(domain == null || domain == '') {
                            layer.alert('请提交您要质押的域名！', {icon:2});
                            return false;
                        }

                        if(!format.test(domain)) {
                            layer.alert('域名格式有误！', {icon:2});
                            return false;
                        }

                        do_pawn(domain, 'Y');
                    });

                    //单个质押
                    $("#match_apply").click(function(){
                        if(!set_real()) {
                            return false;
                        }
                        var domain = $("#domain").val().trim();

                        if(domain == null || domain == '') {
                            layer.alert('请提交您要质押的域名！', {icon:2});
                            return false;
                        }

                        do_pawn(domain, 'N');
                    });

                    //申请域名质押
                    function do_pawn(domain, type) {
                        if(!set_real()) {
                            return false;
                        }
                        var url = "/web/pawn/pawn.html";

                        $.ajax({
                            url: url,
                            type: 'post',
                            data:{'domain':domain, 'singular':type},
                            dataType: 'json',
                            success:function(result){
                                if(result.code == 1000) {
                                    layer.confirm('提交成功，跳转到域名管理列表？', function(index){
                                        var pawn_list_url = "/web/pawn/pawn_list/type/in_credit.html";
                                        window.location.href = pawn_list_url;
                                    });
                                } else {
                                    var data = result.data;
                                    if(data.type !=undefined && data.type == 'invite'){
                                        layer.open({
                                            title:"邀请码",
                                            content: '目前简贷平台申请域名质押需要邀请码，请加简贷客服微信号：931797777，索取邀请码。<Br><Br>请输入邀请码：<input style="width:150px;border:1px solid #bfbfbf;height:30px;color:#333; margin;15px;" type="text" name="verify_code" id="verify_code" maxlength="8">'
                                            ,btn: ['确定', '取消']
                                            ,yes: function(index, layero){
                                                $.post("/web/pawn/invite.html", {"verify_code":$("#verify_code").val()},function(result,status){
                                                    if(result.code ==1000){
                                                        layer.alert(result.msg, {icon:1});
                                                    }
                                                    else{
                                                        layer.alert(result.msg, {icon:2});
                                                    }
                                                },'json')}
                                            ,cancel: function(){}
                                        });
                                    }else{
                                        layer.alert(result.msg, {icon:2});
                                    }
                                }
                            }
                        });


                    }

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
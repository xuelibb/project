<body>
<div class="ww" style="line-height: 33px">
    <!--头部开始-->
    <?php include "layout/home/header.php";?>
<div class="ww both">
    <div class="bg_color1">
        <div class="wl mtauto ofh">
            <?php include "layout/home/user.php";?>
                <div class="fr content-right-x22 bg_color2">
                    <div class="content-right-x2-title bdbt_e6">
                        <h3 class="fl fs20">申请质押</h3>
                    </div>
                    <form action="domain_do" method="post">
                    <div class="ofh Domain-mortgage">
                        <div class="dib">
                            <div class="ofh mt35">
                                <span class="fl dib fc3 fstyle1 mr6 fc_80">【单个质押】</span>
                                <span class="fl dib fc_80 fstyle1 mr16">如:www.xlibb.com</span>
                            </div>
                            <textarea class="mt15 mb25" id="domain" style="overflow-y:scroll;" name="lend_goods"></textarea>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="btn">
                                <input class="fl fs16 fstyle1 fc_red5 tc lh40 apply-domain-mortgage-btn" id="singular_apply" type="submit" value="单个质押">
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="fs14 fstyle1 fc_80 mt40 bd_e7 pl20 pt20 pb20 border-radius3">
                        <div class="bold">温馨提示:</div>
                        <p class="mt5 lh36">输入域名前面不要有换行和空格</p>
                        <p class="lh36">只接受2字符.com/.cn/.xin 3数字.com/.cn/.xin 4数字.com/.cn/.xin 3字母.com/.cn/.xin ，有固定价值区间的拼音域名以及其它万元以上的硬通货域名。<br/>而某些域名虽然有很高价值，但难以评估， 我们不提倡质押。</p>
                        <div class="ofh lh32">
                            <div class="fl dib mr90">
                                <div>易名ID：167719</div>
                                <div>验证邮箱：mdzzwq@sina.com</div>
                            </div>
                            <div class="fl dib mr90">
                                <div>爱名ID：1060210</div>
                                <div>验证邮箱：mdzzwq@sina.com</div>
                            </div>
                            <div class="fl dib">
                                <div>万网ID：1100556453942511</div>
                                <div>验证账号：招财喵</div>
                            </div>
                        </div>
                    </div>

                    <div style="height:500px;"></div>
                </div>
        </div>
</div>
</div>
{{include_once "layout/home/footer.php"}}
</div>
</body>
<script>
    $(document).on('blur','#domain',function () {
        var flag=0;
        var vas=$(this).val();
        //alert(vas)
        var str=/^www.\w{2,8}(.com|.cn|.xin)$/;
        if(str.test(vas)){
            flag=1;
        }else{
            flag=0;
        }
        //alert(flag)
        $(document).on('click','#singular_apply',function () {
            //alert(flag)
            if(flag==1){
                return true;
            }else{
                return false;
            }
        });
    });
</script>

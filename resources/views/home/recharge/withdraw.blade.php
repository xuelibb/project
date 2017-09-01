<div class="content"  id="hintBox">
    <div class="title">支付宝支付密码：</div>
    <div class="box"></div>
    <div class="forget">忘记密码？</div>
    <div class="point">请输入6位数字密码</div>
    <button class="getPasswordBtn">确认</button>
    <button class="getPasswordBtn btn_hint" >取消</button>
    <div class="errorPoint">请输入数字！</div>

</div>
<body>
<style>
    #hintBox{
        width: 13rem;
        height: 12rem;
        background: #FFFFFF;
        position:fixed;
        top: 0px;
        left:0px;
        z-index: 9999;
        padding:0 40px;
        /* margin: -3.025rem 0.000rem 0.000rem -6.025rem; */
        overflow: hidden;
        border-radius: 2px;
        display: none;
    }



    #hintBox .btn_hint{
        /*width: 2rem;
        line-height: 0.75rem;
        background: #ececec;
        display: block;
        font-size: 0.55rem;
        color: #09bb07;*/
        border: 0px;
        border-radius: 2px;
        /*margin: 0.5rem auto;
        padding: 0.055rem 0px ;*/
        cursor: pointer;
    }

    .lock{
        background: #000000;
        position: absolute;
        top: 0px;
        left: 0px;
        filter:alpha(opacity=30); /*IE滤镜，透明度50%*/
        -moz-opacity:0.3; /*Firefox私有，透明度50%*/
        opacity:0.3;/*其他，透明度50%*/
        z-index: 999;
        display: none;

    }
    /*zhifucss*/
    .content{
        width: 400px;
        height: 50px;
        margin: 0 auto;
        margin-top: 100px;

    }
    .title{
        font-family: '微软雅黑';
        font-size: 16px;
    }
    .box{
        width: 190px;
        height: 30px;
        border:1px solid #ccc;
        margin-top: 10px;
        line-height: 30px;
    }
    .content .box,.forget{
        display: inline-block;
    }
    .content .forget{
        width: 100px;
        color:lightskyblue;
        vertical-align: super;
        font-size: 14px;
    }
    .box input.paw{
        width: 30px;
        height: 20px;
        line-height: 20px;
        margin-left: -9px;
        border:none;
        border-right: 1px dashed #ccc;
        text-align: center;
    }
    .box input.paw:nth-child(1){
        margin-left: 0;
    }
    .content .box .pawDiv:nth-child(6) input.paw{
        border: none;
    }
    .content .box input.paw:focus{outline:0;}
    .content .box .pawDiv{
        display: inline-block;
        line-height: 30px;
        width: 31px;
        height: 31px;
        margin-top: -2px;
        float: left;
    }
    .point{
        font-size: 14px;
        color: #ccc;
        margin: 5px 0;
    }
    .errorPoint{
        color: red;
        display: none;
    }
    .getPasswordBtn{
        width: 100px;
        height: 30px;
        background-color: cornflowerblue;
        font-size: 14px;
        font-family: '微软雅黑';
        color: white;
        border: none;
    }
</style>
<div class="ww">
    <div class="Top-position">
        <!--头部开始-->
            <?php include "layout/home/header.php";?>
    </div>

</div>

<div class="ww both">
    <div class="bg_color1">
        <div class="wl mtauto ofh">
            <?php include "layout/home/user.php";?>
            <div class="fr content-right-x22 bg_color2">
                <div class="content-right-x2-title bdbt_e6">
                    <h3 class="fl pr25 fs20">我的资金</h3>
                    <div class="fr return-money-btn">
                        <a href="javascript:void(0);"  class="checked">提现</a>
                        <a href="javascript:void(0);">提现记录</a>
                    </div>
                </div>

                <div class="ofh width100">
                    <div class="fs12 fc_80 fstyle1 ofh sina-pay mt18 fl">
                        <span class="fl dib mr10 cash-sina-icon"></span>
                        <span class=" fl dib pt8">新浪支付全程提供账户托管和支付服务</span>
                    </div>
                </div>
                <div class="ofh fstyle1 fc3 fs14 mt30 cash-handle-bd" style="padding-bottom:10px;">
                    <div class="fl dib ml50 cash-handle-l">
                        <div class="ofh mt30"><span class="fl dib">持卡人： </span>
                            {{mb_substr($model->details_name,0,1).'*'}}
                        </div>
                        <div class="ofh mt35"><span class="fl dib">提现手续费(元)： </span>0</div>
                        <div class="ofh mt35 mb40">
                            <span class="fl dib">到账时间：</span>
                            <div class="fl dib account-time">
                                <div class="">15点前提现 T+1 到账</div>
                                <div class="mt10">15点后提现 T+2 到账</div>
                            </div>
                        </div>
                    </div>
                    <div class="fr dib cash-handle-r Invest-wanted-price" style="margin-top:0;">
                        <form action="withdraw" method="POST" id="withdraw_form" target="_blank">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="ofh mt30"><span class="fl dib">可提金额(元)：</span>&nbsp;&nbsp;{{$model->details_balance}}</div>
                            <div class="ofh mt22 lh40"><span class="fl dib">提现金额(元)： </span><input type="text" name="withdraw_amount" placeholder="" class="fstyle1 fs14" id="withdraw_amount"/>
                                <div style="display:none;position:absolute;width:230px;top:70px;left:102px;" id="tip_info">
                                    <div class="icon"></div>
                                    <div class="tip" style="height:100px;">
                                        <ul>
                                            <li style="line-height:20px;">最低50元起提现  </li>
                                            <li style="line-height:20px;">绑定银行卡后才可申请提现 </li>
                                            <li style="line-height:20px;">
                                                提现单笔5万，每日50万						</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="login-true fstyle1 ofh" style="height:19px;">
                                <i class="icon-reset fl" style="display:none;"></i><span class="fl" id="err_msg"></span>
                            </div>
                            <div class="cash-handle-btn tc" id="do_withdraw">立即提现</div>
                        </form>
                    </div>
                </div>
                @if($brank!=Null)
                    @foreach($brank as $k=>$v)
                        <?php
                        $bank_name=DB::table('bank_name')->where('bank_id',$v['bank_name_id'])->first();
                        ?>
                <div class="ofh mt35">
                    <div class="fl dib recharge-box-fr" style="display:block">
                        <div class="ofh mt25">
                            <div class="fl dib bank-icon"></div>
                            <div class="fl dib">
                                <div class="fs24 bold fc3 mt10">{{$bank_name['bank_name']}}</div>
                                <div class="fs20 fc_80 fstyle3 mt25">{{substr($v['bank_card'],0,4).'*********'.substr($v['bank_card'],-4,4)}}</div>
                            </div>
                            <div class="fr dib pr15 fs14 fc_80 fstyle1 mt20">{{$bank_name['bank_type']}}</div>
                        </div>
                        <div class="ofh fs18 fc0 bank-card-type mt20 bank-card-type-bg9">
                            <div class="fl dib ml20">快捷卡支付已开通</div>
                            <div class="fr dib mr20"><em></em>安全卡</div>
                        </div>
                        <div class="fs12 fc_80 fstyle1 ml20 mt15 tc">
                            单笔限额5万元，单日限额50万		  </div>
                    </div>
                </div>
                    @endforeach
                @endif
                <div class="bdt_e6 mt40"></div>


                <div class="fs14 fstyle1 fc_80 mt41 bd_e6 pt20 pl20 pb20">
                    <div><span class="block bold">温馨提示:</span></div>
                    <div class="ofh lh36 mt5" ><span class="fl dib">1、</span><p class="fl">个人提现无须简贷平台审核，15点前提交新浪支付申请第二天到账，15点后提交新浪支付申请第三天到账；</p></div>
                    <div class="ofh lh36"><span class="fl dib">2、</span><p class="fl">您选择的银行卡开户名必须与您的简贷网实名认证一致，否则提现申请将无法提交。</p></div>
                    <div class="ofh lh36"><span class="fl dib">3、</span><p class="fl">如有疑问，请联系客服：400-8858-258（工作日:9:00-21:00）</p></div>
                    <div class="ofh lh36"><span class="fl dib">4、</span><p class="fl">提示：中华人民共和国法律规定，冒用他人居民身份证的，由公安机关处二百元以上一千元以下罚款，<br/>或者处十日以下拘留，有违法所得的，没收违法所得。</p></div>
                </div>

                <div style="height:450px;"></div>

                <style>
                    .Invest-wanted-price .fstyle1:hover .tip_info {display:block;}
                </style>
                <script>
                    var balance = Number("{{$model->details_balance}}");
                    var obj = $(".sideMenu-icon2").parent().parent("h3");
                    obj .addClass("on");
                    obj.siblings("ul").show();
                    obj.siblings("ul").children("li").eq(2).children("a").addClass("active");
                    $("#do_withdraw").click(function(){
                        var amount = $("#withdraw_amount").val();
                        var min_amount = 0.01;
                        if(isNaN(amount)){
                            $("#err_msg").html('提现金额有误！').prev('i').show();
                            return false;
                        }


                        if(amount < min_amount) {
                            $("#err_msg").html('提现金额不得低于'+min_amount+'元！').prev('i').show();
                            return false;
                        }

                        if(amount>balance) {
                            $("#err_msg").html('可提现金额不足！').prev('i').show();
                            return false;
                        }
                        var bodyH=$('body').height();//body的高度
                        var windowH=$(window).height();//浏览器的高度

                        /*
                         判断如果body的高小于浏览器(window)的高那么
                         body的高就等于浏览器(window)的高
                         */

                        //判断
                        if(bodyH<windowH){
                            bodyH=windowH;
                        }

                        /*
                         body的宽 也可以是浏览器的宽
                         var sW=$(window).width();
                         */

                        var sW=$('body').width();

                        //显示遮罩层
                        $('.lock').css({                       //遮罩层的样式
                            height:bodyH,               //遮罩层的高是body内容的高
                            width:sW,                     //遮罩层的宽是body内容的宽
                            display:"block"             //显示遮罩层
                        });
                        $('#hintBox').css('display','block');//提示框




//                         layer.load(3);
//                         $.ajax({
//		url: "/web/user/withdraw.html",
//		type: 'post',
//		data:{'amount':amount},
//		dataType: 'json',
//		success:function(result){
//			layer.closeAll();
//			if(result.code == 1000) {
//				layer.closeAll('loading');
//				var url = '/web/index/redirect_url.html';
//				sina_redirect(url, '提现');
//			} else {
//				layer.alert(result.msg, {icon:2});
//			}
//		}
//	});

                    });

                    $("#withdraw_amount").keyup(function(){
                        var amount = $("#withdraw_amount").val();

                        //如果输入的不是数字，
                        if(isNaN(amount)){
                            $("#err_msg").html('提现金额有误！').prev('i').show();
                            return false;
                        } else {
                            $("#err_msg").html('').prev('i').hide();
                        }

                        if(amount>balance) {
                            $("#err_msg").html('可提现余额不足！').prev('i').show();
                            return false;
                        } else {
                            $("#err_msg").html('').prev('i').hide();
                        }

                    });

                    $("#withdraw_amount").hover(function(event){
                        $("#tip_info").show();
                    }, function(event){
                        $("#tip_info").hide();
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
<script>
$(function(){
//提示框设置居中
var top=($(window).height()-$('#hintBox').height())/5;
//高度==浏览器的高-div（$('#hintBox')）的高/2
var left=($(window).width()-$('#hintBox').width())/2;
//宽度同上
$('#hintBox').css('top',top).css('left',left);
//改变浏览器窗口时也居中
window.onresize=function(){
var top=($(window).height()-$('#hintBox').height())/5;
var left=($(window).width()-$('#hintBox').width())/2;
$('#hintBox').css('top',top).css('left',left);
};

//关闭提示框（这个就不用太在意 ）
$('.btn_hint').click(function(){
$('#hintBox').css('display','none');
$('.lock').css('display','none')
$('.finish').css('background','#ffffff');
});

});

// zhufu js
/*动态生成*/
var box=document.getElementsByClassName("box")[0];
function createDIV(num){
for(var i=0;i<num;i++){
var pawDiv=document.createElement("div");
pawDiv.className="pawDiv";
box.appendChild(pawDiv);
var paw=document.createElement("input");
paw.type="password";
paw.className="paw";
paw.maxLength="1";
paw.readOnly="readonly";
pawDiv.appendChild(paw);
}
}
createDIV(6);



var pawDiv=document.getElementsByClassName("pawDiv");
var paw=document.getElementsByClassName("paw");
var pawDivCount=pawDiv.length;
/*设置第一个输入框默认选中*/
pawDiv[0].setAttribute("style","border: 2px solid deepskyblue;");
paw[0].readOnly=false;
paw[0].focus();

var errorPoint=document.getElementsByClassName("errorPoint")[0];
/*绑定pawDiv点击事件*/

function func(){
for(var i=0;i<pawDivCount;i++){
pawDiv[i].addEventListener("click",function(){
pawDivClick(this);
});
paw[i].onkeyup=function(event){
console.log(event.keyCode);
if(event.keyCode>=48&&event.keyCode<=57){
/*输入0-9*/
changeDiv();
errorPoint.style.display="none";

}else if(event.keyCode=="8") {
/*退格回删事件*/
firstDiv();

}else if(event.keyCode=="13"){
/*回车事件*/
getPassword();

}else{
/*输入非0-9*/
errorPoint.style.display="block";
this.value="";
}

};
}

}
func();


/*定义pawDiv点击事件*/
var pawDivClick=function(e){
for(var i=0;i<pawDivCount;i++){
pawDiv[i].setAttribute("style","border:none");
}
e.setAttribute("style","border: 2px solid deepskyblue;");
};


/*定义自动选中下一个输入框事件*/
var changeDiv=function(){
for(var i=0;i<pawDivCount;i++){
if(paw[i].value.length=="1"){
/*处理当前输入框*/
paw[i].blur();

/*处理上一个输入框*/
paw[i+1].focus();
paw[i+1].readOnly=false;
pawDivClick(pawDiv[i+1]);
}
}
};

/*回删时选中上一个输入框事件*/
var firstDiv=function(){
for(var i=0;i<pawDivCount;i++){
console.log(i);
if(paw[i].value.length=="0"){
/*处理当前输入框*/
console.log(i);
paw[i].blur();

/*处理上一个输入框*/
paw[i-1].focus();
paw[i-1].readOnly=false;
paw[i-1].value="";
pawDivClick(pawDiv[i-1]);
break;
}
}
};



/*获取输入密码*/
var getPassword=function(){
var n="";
for(var i=0;i<pawDivCount;i++){
n+=paw[i].value;
}

    if(n==111111){
        $("#withdraw_form").submit();
    }else{
        alert('密码错误');
    }


};
var getPasswordBtn=document.getElementsByClassName("getPasswordBtn")[0];

getPasswordBtn.addEventListener("click",getPassword);

/*键盘事件*/
document.onkeyup=function(event){
if(event.keyCode=="13") {
/*回车事件*/
getPassword();
}
};

</script>
</html>

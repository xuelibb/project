<table class="table table-bordered table-hover">
    <tbody><tr class="active">
        <th width="100">项目编号</th>
        <th width="100">质/抵押物</th>
        <th width="60">年化利率</th>
        <th width="65">期限</th>
        <th width="75">还款方式</th>
        <th width="85">借款金额</th>
        {{--<th width="85">--}}
            {{--到期时间--}}
        {{--</th>--}}
        @if(isset($data[0]['asign']))
        <th>操作</th>
        @endif
    </tr>
    @if(!empty($data))
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v['lend_id']}}</td>
            <td>{{$v['lend_goods']}}</td>
            @if($v['lend_return']==0)
                <td>#</td>
            @else
                <td><span id="lilvzhi">{{$v['lend_return']}}</span></td>
            @endif
            @if($v['lend_repay_time']==0)
                <td>#</td>
            @else
                <td><span id="kuanqixian">{{$v['lend_repay_time']}}</span>个月</td>
            @endif
            @if($v['lend_repay_method']==1)
                <td><font color="green"><span id="typePrice">等额本息</span></font></td>
            @else
                <td><font color="#adff2f"><span id="typePrice">先息后本</span></font></td>
            @endif
            @if($v['lend_money']==1)
                <td>#</td>
            @else
                <td><span id="ben">{{$v['lend_money']}}</span></td>
            @endif
            @if(isset($v['asign']))
                @if($v['asign']==1)
                    <td><span id="{{$v['lend_id']}}" class="oneqing" style="cursor: pointer;color: blue;">一次还清</span><br><a href="refund_list?b_id={{$v['lend_id']}}">分期还清</a></td>
                @endif
            @endif
        </tr>
        @endforeach
    @else
    <tr class="not-hover"><td colspan="9" style="text-align: center;height:900px"><div class="no_record"></div>暂无记录!</td></tr>
    @endif
    </tbody>
</table>
<div id="zzcnew" style="width: 100%; z-index: 10000; background-color: rgba(198, 198, 198, 0.27);display: none;position: absolute;top: 0;left: 0;"></div>
<div id="zhifuhz" style="z-index: 10001;background-color: #ffffff; display: none;position: absolute;left:40%;width: 30%;height:180px;">
    <li class="liInfo" style="">还款总额：<span id="sumPrice"></span>元</li>
    <li class="liInfo" style="">本金： <span id="benjin"></span>元</li>
    <li class="liInfo" style="">利率： <span id="lilv"></span> </li>
    <li class="liInfo" style="">利息： <span id="lixi"></span> 元</li>
    <li class="liInfo" style="">期限： <span id="qixian"></span> 月</li>
    <li class="liInfo" id="ok" ids="" style="cursor: pointer">确定</li>
</div>

<div id="zhifuhz1" style="z-index: 10001;background-color: #ffffff; position: relative; display: none;position: absolute;left:40%;height:60px;">
    <div id="mm">
    <img src="Public/web/images/zhifu.png" alt="" >
    <input type="password" id="password" style="position: absolute;top:104px;left:112px;height:20px;width: 161px">
    <span id="tj" style="display: inline-block;width: 60px;height: 24px;position: absolute;top:134px;left:113px;"></span>
    </div>
    <div id="cg">
        <img src="Public/web/images/success.png" alt="" style="display: none;">
    </div>
    <div id="czq">
        <img id="zcql" url="recharge" src="Public/web/images/yuebuzu.png" alt="" style="display: none;">
    </div>
</div>

<style>
    .liInfo{
        width: 150px;
        height: 30px;
        float: left;
        margin-left:30px;
        margin-top: 15px;
    }
</style>
<script>
    $(function(){
        $(".oneqing").mouseover(function(){
            $(this).css("color","red");
        }).mouseout(function(){
            $(this).css("color","blue");
        }).click(function(){
            var height=document.body.offsetHeight;
            var theight=document.body.scrollTop;
            var newh=parseInt(theight)+260;
            var lend_id=$(this).attr("id");
            var lilvzhi=$("#lilvzhi").html();
            var kuanqixian=$("#kuanqixian").html();
            var typePrice=$("#typePrice").html();
            var ben=$("#ben").html();
            $.ajax({
                type:"get",
                url:"jisuanlilv",
                data:{
                    lilvzhi:lilvzhi,
                    kuanqixian:kuanqixian,
                    typePrice:typePrice,
                    ben:ben
                },
                dataType:"json",
                success:function(data){
                    $("#sumPrice").html(data['r_sumMoney']);
                    $("#benjin").html(ben);
                    $("#lilv").html(lilvzhi);
                    $("#lixi").html(data['r_sumAccrual']);
                    $("#qixian").html(kuanqixian);
                    $("#ok").attr("ids",lend_id);
                    $("#zhifuhz").css("top",newh+"px").show();
                    $("#zzcnew").css("height",height+"px").show();
                }
            })
        })
        $("#ok").click(function(){
            $("#zhifuhz").hide();
            var theight=document.body.scrollTop;
            var newh=parseInt(theight)+260;
            $("#zhifuhz1").css("top",newh+"px").show();



        })
        $("#tj").click(function(){
            var b_id=$("#ok").attr("ids");
            var pwd=$("#password").val();
            $.ajax({
                url:"onehuan",
                data:{
                    b_id:b_id,
                    pwd:pwd,
                    sum:$("#sumPrice").html()
                },
                success:function(data){
                    if(data==2)
                    {
                        $("#mm").hide();
                        $("#cg").show();
                        setTimeout(function(){window.history.go(0)},1000);
                    }
                    else if(data==1){
                        alert("密码错误，请从新输入");
                    }
                    else if(data==3){
                        $("#cg").hide();
                        $("#czq").show();
                    }
                }
            })
        })
        $("#czql").click(function(){
            var url=$(this).attr("url");
            location.href=url;
        })



    })
</script>
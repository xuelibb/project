<table class="table table-bordered table-hover">
    <tbody><tr class="active">
        <th style="text-align: center" width="120">期号</th>
        <th style="text-align: center" width="70">应还时间</th>
        <th style="text-align: center" width="75">应还本金</th>
        <th style="text-align: center" width="75">应还利息</th>
        <th style="text-align: center" width="65">应还金额</th>
        <th style="text-align: center" width="45">状态</th>
        <th style="text-align: center" width="45"> 操作</th>
    </tr>
    @foreach($data as $k=>$v)
    <tr class="not-hover">
        <td style="text-align: center; line-height:60px; font-size: 15px; width:120px;  height:30px">第 <span id="r{{$id[$k]}}"><?php echo $k+1?></span>期</td>
        @foreach($v as $kk=>$vv)
        <td id="{{$kk.$id[$k]}}" style="text-align: center; line-height: 60px;  font-size: 15px; width:120px;  height:30px"><?php echo $vv?></td>
       @endforeach
        @if($start[$k]==0)
            <td style="text-align: center;  line-height: 60px; font-size: 15px;  width:120px;  height:30px">未开始</td>
        @elseif($start[$k]==1)
            <td style="text-align: center;  line-height: 60px; font-size: 15px;  width:120px;  height:30px">还款中</td>
        @elseif($start[$k]==2)
            <td style="text-align: center;  line-height:60px; font-size: 15px; width:120px;  height:30px">已还完</td>
        @elseif($start[$k]==3)
            <td style="text-align: center; line-height: 60px;  font-size: 15px; width:120px;  height:30px">逾期未还</td>
        @endif
        <td style="text-align: center; line-height: 60px; font-size: 15px;  width:120px;  height:30px">
            @if($start[$k]==2)
                <div style="position: relative">
                <img class="ts" di="{{$id[$k]}}" src="Public/web/images/xiaolian.png" style="width:50px;height:50px;border-radius: 50px" >
                <span class="textts{{$id[$k]}}" style="position: absolute;top:25px;left: -10px;font-size: 10px;color: red;display: none;">您已成功还完</span><span class="textts{{$id[$k]}}" style="position: absolute;top:35px;left: -10px;font-size: 10px;color: red;display: none">当期款项</span>
                </div>
            @else
                <span class="refund" id="{{$id[$k]}}" b_id="{{$b_id}}" style="position: inherit;padding:7px 15px;background-color:#ff560b;color: #FFFFFF; cursor: pointer; border-radius: 8px; font-size: 15px; ">还款</span>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<div id="jyz_zzc" style="display: none;position: absolute;top:0;left:0; z-index: 10000; width: 100%;background-color: rgba(140, 140, 140, 0.32)"></div>
<style>
    .jyz_passwordList{
        float: left;
        width:160px;
        height: 30px;
        margin-left: 20px;
        margin-top: 15px;
    }
    #zfmm{
        width:90px;
        height: 30px;
        letter-spacing:6px;
        border: 1px #000000 dotted;
    }
</style>
<div id="password" style="width:380px;background: #fffbe9;z-index: 10001; display: none; position: absolute;left:40%;">
    <li class="jyz_passwordList">应还金额：<span id="jyz_price"></span></li>
    <li class="jyz_passwordList">还款方式：<span id="jyz_type"></span></li>
    <li class="jyz_passwordList">应还本金：<span id="jyz_ben"></span></li>
    <li class="jyz_passwordList">应还利息：<span id="jyz_xi"></span></li>
    <input type="hidden" id="b_id" value="">
    <li class="jyz_passwordList" id="jyz_passwordInput" style="width: 300px; margin-bottom: 5px;">
        支付密码：<input type="password" id="zfmm">
        <input id="jyz_but" type="button" b_id="" value="确定" style="margin-left: 15px;padding: 5px 15px;border-radius: 10px;background-color: #c6c6c6;cursor: pointer">
        <input id="jyz_call" type="button" value="取消" style="padding: 5px 15px;border-radius: 10px;background-color: #c6c6c6;cursor: pointer">
    </li>
</div>
<div>
    <img id="yuepng" url="recharge" src="Public/web/images/yuebuzu.png" alt="" style="z-index: 10001;display: none; position: absolute;left:30%; cursor: pointer">
</div>
<script>
    $(function(){
        $(document).ready(function(){
            $(".not-hover:even").css("background","#c4e1ff")
        })
        $(".ts").mousemove(function(){
            var id=$(this).attr("di");
            $(".textts"+id).show();
            $(".texttss"+id).show();
        }).mouseout(function(){
            var id=$(this).attr("di");
            $(".textts"+id).hide();
            $(".texttss"+id).hide();
        })
        $(".refund").click(function()
        {
            var r_id=$(this).attr("id");
            var b_id=$(this).attr("b_id");
            var qi=$("#r"+r_id).text();
            if(qi!=1)
            {
                var r_ids=parseInt(r_id)-1;
                $.ajax({
                    type:"get",
                    url:"refundrequst",
                    data:{
                        r_id:r_ids
                    },
                    success:function(data){
                       if(data==0)
                       {
                           alert("请先结清上期款项");
                       }
                        else
                       {
                           yanzheng(r_id,b_id)
                       }
                    }
                })
            }else
            {
                yanzheng(r_id,b_id)
            }


        })
        $("#jyz_call").click(function(){
            $("#jyz_zzc").hide();
            $("#password").hide();
        })
        $("#jyz_but").click(function(){
            var id=$("#b_id").val();
            var b_id=$(this).attr("b_id");
            var price=$("#jyz_price").html();
            var zfmm=$("#zfmm").val();
            if(zfmm=="")
            {
                alert("请填写密码")
                return false;
            }
            $.ajax({
                type:"get",
                url:"ifprice",
                data:{
                    price:price,
                    zfmm:zfmm,
                    r_id:id,
                    b_id:b_id
                },
                success:function(data){
                    if(data==0)
                    {
                       alert("支付密码错误")
                    }
                    else if(data==1) {
                        alert("支付成功")
                       window.history.go(0)
                    }
                    else if(data==3){
                        alert("网络拥堵，请稍后重试");
                    }
                            else if(data==2){
                        $("#password").hide();
                        $("#yuepng").show();
                    }
                    else
                    {
                        window.history.go(0)
                    }
                }
            })

        });
        $("#yuepng").click(function()
        {
            var url=$(this).attr("url");
            location.href=url;
        })
        function yanzheng(r_id,b_id)
        {
            var refsum=$("#r_m_a"+r_id).text();
            var benjin=$("#r_oneMoney"+r_id).text();
            var lixi=$("#r_oneAccrual"+r_id).text();
            var height=document.body.offsetHeight;
            var theight=document.body.scrollTop;
            var type=$("#r_type").val();
            var str="";
            if(type=="1")
            {
                str="等额本息";
            }
            else
            {
                str="先息后本";
            }
            $("#jyz_zzc").css("height",height+"px").show();
            $("#password").css("top",theight+200).show();
            $("#yuepng").css("top",theight+100);
            $("#jyz_price").html(refsum);
            $("#jyz_ben").html(benjin);
            $("#jyz_xi").html(lixi);
            $("#jyz_type").html(str);
            $("#b_id").val(r_id);
            $("#jyz_but").attr("b_id",b_id)
        }




    })
</script>
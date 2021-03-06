<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>问卷调查</title>
</head>
<style>
    body{
        margin: 0 auto;
        padding: 0;
        width: 100%;
        background-color:#f2f2f2;
    }
    #tonglan{
        margin-top: 25px;
        width: 100%;
        height: 80px;
        background-color:white;
        line-height: 80px;
        font-size:30px;
        letter-spacing: 10px;
        font-weight: 900;
    }
    .p_title{

    }
    .opt_true{

    }
    #body{
        margin-top: 23px;
        width: 1200px;
        background-color:white;
        padding-top: 35px;
    }
    #hint{
        width: 1119px;
        height: 140px;
        background-color:#f2f2f2;
        line-height: 27px;
        position: relative;
        font-size: 17px;
    }
    #yuan{
        width: 19px;
        height: 19px;
        border-radius: 50px;
        background-color: red;
        position: absolute;
        top: 32px;
        left:26px;
        color: #FFFFFF;
        line-height: 19px;
    }
    li{
        list-style: none;
    }
    .pro{
        background-color:#f2f2f2 ;
        margin-left: 41px;
        width: 1119px;
        height: 37px;
        line-height: 37px;
    }
    .opt{
        margin-left: 41px;
        margin-top: 35px;
        line-height: 25px;
    }
    #but{
        width: 360px;
        height: 62px;
        font-size: 28px;
        color: #FFFFFF;
        letter-spacing: 2px;
        background-color:#e83928;
        border-radius: 10px;
    }
</style>
<body>
<p style="margin-top:15px;margin-left: 40px">客服热线:400-8858-258（工作日：09:00-21:00）</p>
<div align="center" id="tonglan">
    个人风险评估问卷调查
</div>
<center>
    <div id="body">
        <div id="hint" align="left">
            <div id="yuan" align="center">!</div>
            <br>
            <li style="margin-left: 56px">风险提示：</li>
            <li style="margin-left: 56px">出借资金可能获得比较高的预期收益，但也存在比较大的交易风险，请您根据自身的风险承受能力，审慎作出交易决定。</li>
        </div>
        <h4 style="font-weight: 100">(填写评估问卷大致需要3分钟)</h4>
        <div align="left">
            <?php $i=1; foreach($newArray as $k=>$v){?>
                <div class="pro">
                    <span class="po"></span><p class="p_title"><?php echo $i;?>.<?php echo $k?></p>
                </div>
                <div class="opt">
                    <?php foreach($v as $key=>$val){?>
                        <li><input type="radio" class="opt_true" name="<?php echo $val['p_id']?>" value="<?php echo $val['o_grade']?>"><?php echo $val['o_option']?></li>
                    <?php }?>
                </div>
                <?php $i++;}?>

            <input type="hidden" value="<?php echo $max?>" id="max">
            <input type="hidden" value="<?php echo $min?>" id="min">
            <center>
                <div>
                    <input type="button" id="but" value="提交问卷">
                </div>
            </center>
        </div>
    </div>
</center>
</body>
</html>
<script src="admin/js/jquery.js"></script>
<script>
    $(function(){
        $("#but").click(function(){
            var mm=parseInt($("#max").val());
            var nn=parseInt($("#min").val());
            var opt=$(".opt_true");
            var po=$(".po");
            var sum=0;
            var str="";
            for(var i=0;i<opt.length;i++)
            {
                if(opt.eq(i).prop("checked"))
                {
                    sum+=parseInt(opt.eq(i).val());
                }
            }
            if(sum<nn-1)
            {
                alert("还有没选的题，请选择，谢谢合作");
                return false;
            }
            var s=parseInt((mm-nn)/po.length);
            if(sum>0&&sum<=nn)
            {
                str="保守型";
            }
            else if(sum>nn&&sum<=nn+(s))
            {
                str="稳健型";
            }
            else if(sum>nn+(s)&&sum<=nn+(s*2))
            {
                str="平衡型";
            }
            else if(sum>nn+(s*2)&&sum<=nn+(s*3))
            {
                str="成长型";
            }
            else if(sum>=nn+(s*3))
            {
                str="进取型";
            }
            $.ajax({
                type:"get",
                url:"up/assess",
                data:{
                    assess:str
                },
                success:function(data){
                    alert(str);
                    location.href='user_info';
                }
            })
        })
    })
</script>

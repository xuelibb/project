<?php include "layout/home/header.php"?>
<style>
    #hkxxjh_ul{
        text-align: left;
        margin-left: -20px;
    }
    #hkxxjh_ul li{
        height: 55px;
        width: 1084px;
        line-height: 55px;
        border-bottom: 1px #fafafa ridge;
        margin-left:50px;
    }
    #hkxxjh_ul li span{
        display: inline-block;
        width:180px;
    }
    .one{
        margin-left:85px;
    }
</style>
<div>
    <span onclick="javascript:history.back(-1);" id="retu" style="float:right; margin-right:50px;font-size: 20px;color: red;cursor: pointer">返回</span>
    <input type="hidden" id="rate" value="<?php echo $lilv?>">
    <input type="hidden" id="amount" value="<?php echo $zonge?>">
    <input type="hidden" id="period" value="<?php echo $qixian?>">
    <input type="hidden" id="type" value="t2">
</div>
<center>
<div style="position: relative;height: 800px;margin-left: 100px;">
    <div style="margin-top: 22px; width: 1136px;border:1px #e6e6e6 ridge; " >
        <div style="width:1136px; border: 1px #e6e6e6 ridge; ">
            <div style="width:1136px; background-color: #fafafa; line-height: 32px; height: 32px; border-bottom: 1px #e6e6e6 ridge; text-align: left;">
                &nbsp;&nbsp;&nbsp;&nbsp;还款详细计划
            </div>
            <div>
                <ul id="hkxxjh_ul" style="list-style: none;">
                    <li>
                        <span class="one">期限</span>
                        <span style="margin-left:15px">还款时间</span>
                        <span style="margin-left:15px">还款总额</span>
                        <span style="margin-left:15px">本金</span>
                        <span style="margin-left:15px">利息</span>
                    </li>
                    <div id="result"></div>
                </ul>
            </div>
        </div>

    </div>
</div>
</center>
<script>
    $(function(){
        $(document).ready(function(){
            var amount = $("#amount").val();
            var rate = parseInt($("#rate").val());
            var period = $("#period").val();
            var type = $("#type").val();
            if(type == 't1') {
                myhx(amount, rate, period);
            } else {
                debx(amount, rate, period);
            }
        })
        $("#calculate").click(function(){
            var amount = $("#amount").val().trim();
            var rate = $("#rate").val().trim();
            var period = $("#period").val().trim();
            var type = $('input:radio[name="cal-type"]:checked').val();

            if(amount<=0 || amount == '' || amount == null) {
                layer.alert('�����������', {icon:2});
                return false;
            }

            if(rate <= 0 || rate == '' || rate == null) {
                layer.alert('�������껯����', {icon:2});
                return false;
            }

            if(period <= 0 || period == '' || period == null) {
                layer.alert('���������ʱ��', {icon:2});
                return false;
            }

            amount = parseFloat(amount);
            rate = parseFloat(rate);
            period = parseFloat(period);

            if(type == 't1') {
                myhx(amount, rate, period);
            } else {
                debx(amount, rate, period);
            }
        });
        //重置
        $("#reset").click(function(){
            $("#amount").val('');
            $("#rate").val('');
            $("#period").val('');
            $("#ben_xi").html("0.00元");
            $("#li_xi").html("0.00元");
            $('input:radio[name="cal-type"]')[0].checked = true;
        });


        $("#amount").keyup(function(){
            var amount = $("#amount").val();
            if(isNaN(amount)) {
                $("#amount").val(0);
            }
        });
        $("#rate").keyup(function(){
            var rate = $("#rate").val();
            if(isNaN(rate)) {
                $("#rate").val(0);
            }
        });
        $("#period").keyup(function(){
            var period = $("#period").val();
            if(period%1 != 0) {
                $("#period").val(0);
            }
        });

        //�ȶϢ
        function debx(amount, rate, period) {
            var month_rate = rate/100/12;
            amount = parseFloat(amount);
            var month_total = parseFloat(amount*month_rate*Math.pow((1+month_rate),period)/(Math.pow((1+month_rate), period)-1));
            month_total = parseFloat(month_total.toFixed(2));

            var total_amount = parseFloat((month_total*period).toFixed(2));
            var total_interest = parseFloat((total_amount-amount).toFixed(2));
            total_amount = (total_amount == null || total_amount == '' || total_amount == 0) ? '0.00' : total_amount;
            total_interest = (total_interest == null || total_interest == '' || total_interest == 0) ? '0.00' : total_interest;

            $("#ben_xi").html(formatMoney(total_amount.toString())+'元');
            $("#li_xi").html(formatMoney(total_interest.toString())+'元');


            var li = '';
            for(var i=1; i<=period; i++) {
                var current_principal = parseFloat(amount*month_rate*Math.pow((1+month_rate), i-1)/(Math.pow((1+month_rate), period)-1));
                var current_interest = parseFloat(month_total)-parseFloat(current_principal);
                current_principal = current_principal.toFixed(2);
                current_interest = current_interest.toFixed(2);
                var date = getRefundDate(i);

                show_month_total = formatMoney(month_total);
                show_current_principal = formatMoney(current_principal);
                show_current_interest = formatMoney(current_interest);

                li += '<li>';
                li += '<span class="one">第'+i+'期</span>&nbsp;&nbsp;&nbsp;&nbsp;';
                li += '<span>'+date+'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
                li += '<span>'+show_month_total+'元</span>&nbsp;&nbsp;&nbsp;&nbsp;';
                li += '<span>'+show_current_principal+'元</span>&nbsp;&nbsp;&nbsp;&nbsp;';
                li += '<span>'+show_current_interest+'元</span>&nbsp;&nbsp;&nbsp;&nbsp;';
                li += '</li>';
            }
            $("#result").html(li);
        }
        //每月还息
        function myhx(amount, rate, period) {
            amount = parseFloat(amount);
            rate = parseFloat(rate);
            period = parseInt(period);

            var rate_amount = amount*rate/1200;
            //四舍五入
            rate_amount = rate_amount.toFixed(2);
            rate_amount = parseFloat(rate_amount);

            var total_interest = rate_amount*period;
            show_total_amount = parseFloat(total_interest)+amount;

            $("#ben_xi").html(formatMoney(show_total_amount.toString())+"元");
            $("#li_xi").html(formatMoney(total_interest.toString())+"元");

            //取日期
            var myDate = new Date();
            var year = myDate.getFullYear();
            var month = myDate.getMonth();
            var date = myDate.getDate();

            var li = '';
            for(var i=1; i<=period; i++) {
                var total_amount = rate_amount;
                var principal = 0;
                if(i == period) {
                    principal = amount;
                    total_amount += principal;
                }

                var date_format = getRefundDate(i);

                total_amount_format = formatMoney(total_amount);
                principal_format = formatMoney(principal);
                rate_amount_format = formatMoney(rate_amount);

                li += '<li>';
                li += '<span class="one">第'+i+'期</span>';
                li += '<span>'+date_format+'</span>';
                li += '<span>'+total_amount_format+'元</span>';
                li += '<span>'+principal_format+'元</span>';
                li += '<span>'+rate_amount_format+'元</span>';
                li += '</li>';
            }

            $("#result").html(li);
        }

        //格式化资金
        function formatMoney(v) {
            if(isNaN(v)){
                return v;
            }
            v = (Math.round((v - 0) * 100)) / 100;
            v = (v == Math.floor(v)) ? v + ".00" : ((v * 10 == Math.floor(v * 10)) ? v
            + "0" : v);
            v = String(v);
            var ps = v.split('.');
            var whole = ps[0];
            var sub = ps[1] ? '.' + ps[1] : '.00';
            var r = /(\d+)(\d{3})/;
            while (r.test(whole)) {
                whole = whole.replace(r, '$1' + ',' + '$2');
            }
            v = whole + sub;

            return v;
        }
        //获取每一期的还款时间
        function getRefundDate(period) {
            var date = new Date();
            var new_date = new Date(date.setDate(date.getDate() + period*30));

            var year = new_date.getFullYear();
            var month = new_date.getMonth()+1;
            var date = new_date.getDate();

            return year+'-'+month+'-'+date;
        }

    })

</script>
<?php include "layout/home/footer.html";?>

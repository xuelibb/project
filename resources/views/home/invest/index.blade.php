<!DOCTYPE html>
<html>
<div class="ww">

       <?php include "layout/home/header.php";?>

</div>
<script>
    window.addEventListener(
        "scroll",function(){
            var scrollTop=document.body.scrollTop;
            if(scrollTop>200){
                $("#hidden-header").removeClass("Top-position3").addClass("Top-position4")
            }
            if(scrollTop<=200){
                $("#hidden-header").removeClass("Top-position4").addClass("Top-position3")
            }
        }
    );

    //顶部微信弹出
    $('#login_way').mouseenter(function(){
        $('#login_way em').addClass('active1');
        $('#login_way .icon-down').addClass('active2').removeClass('icon-down');
        $('.login_way_more').show();
    })
    $('#login_way').mouseleave(function(){
        $('#login_way em').removeClass('active1');
        $('#login_way .active2').removeClass('active2').addClass('icon-down');
        $('.login_way_more').hide();
    })


    jQuery("#nav").slide({
        type:"menu",// 效果类型，针对菜单/导航而引入的参数（默认slide）
        titCell:".nLi", //鼠标触发对象
        targetCell:".sub", //titCell里面包含的要显示/消失的对象
        effect:"slideDown", //targetCell下拉效果
        delayTime:300 , //效果时间
        triggerTime:0, //鼠标延迟触发时间（默认150）
        returnDefault:true //鼠标移走后返回默认状态，例如默认频道是“预告片”，鼠标移走后会返回“预告片”（默认false）
    });
    jQuery("#nav1").slide({
        type:"menu",// 效果类型，针对菜单/导航而引入的参数（默认slide）
        titCell:".nLi", //鼠标触发对象
        targetCell:".sub", //titCell里面包含的要显示/消失的对象
        effect:"slideDown", //targetCell下拉效果
        delayTime:300 , //效果时间
        triggerTime:0, //鼠标延迟触发时间（默认150）
        returnDefault:true //鼠标移走后返回默认状态，例如默认频道是“预告片”，鼠标移走后会返回“预告片”（默认false）
    });
    $('.account-more').mouseenter(function(){
        $('.my-account').children('h3').children('a').addClass('active');
    })
    $('.account-more').mouseleave(function(){
        $('.my-account').children('h3').children('a').removeClass('active');
    })

</script>

<div class="center"><div class="ww">
        <!--面包屑-->
        <div class="bg_color1">
            <div class="wl mtauto">
                <div><a><img src="Public/web/images/ban21.jpg" class="wl"/></a></div>
                <div class="crumbs"><i class="iconfont location_icon">&#xe601</i>您当前所在的位置：<a href="/web/index/index.html" class="fc_80">简贷</a><em>&gt;</em>我要出借</div>
            </div>
        </div>

        <div class="bg_color1">
            <div class="wl mtauto bg_color2">
                <div class="slideTxtBox slide08">
                    <div class="hd Menubox03">
                        <ul class="ofh" id="project_type">
                            <li class="slide05-tab1 on" value="1">出 借 区</li>
                            <li style="display: none" class="slide05-tab2 " value="2">转 让 区</li>
                        </ul>
                    </div>
                    <div class="bd invest_ct">
                        <ul>
                            <li class="invest_choose">
                                <dl class="ofh">
                                    <dt class="fl">借款类型：</dt>
                                    <dd class="fl" id="pawn_type">
                                        <a href="javascript:void(0);" class="fc0 active" value="0">全部</a>
                                       <!--  <a href="javascript:void(0);" class="" value="2">车贷</a> -->
                                        <a href="javascript:void(0);" class="" value="1">域名贷 </a>
                                    </dd>
                                </dl>
                                <dl class="ofh repayment">
                                    <dt class="fl">借款期限：</dt>
                                    <dd class="fl" id="repay_time">
                                        <a href="javascript:void(0);" class="fc0 active" value="0">全部</a>
                                        <a href="javascript:void(0);" class="" value="1">1个月以下</a>
                                        <a href="javascript:void(0);" class="" value="2">1-3个月</a>
                                        <a href="javascript:void(0);" class="" value="3">3-6个月</a>
                                        <a href="javascript:void(0);" class="" value="4">6-9个月</a>
                                        <a href="javascript:void(0);" class="" value="5">9-12个月</a>
                                        <a href="javascript:void(0);" class="" value="6">12个月以上</a>
                                    </dd>
                                </dl>
                                <dl class="ofh">
                                    <dt class="fl">预期年化：</dt>
                                    <dd class="fl" id="rate">
                                        <a href="javascript:void(0);" class="fc0 active" value="0">全部</a>
                                        <a href="javascript:void(0);" class="" value="1">10% 以下</a>
                                        <a href="javascript:void(0);" class="" value="2">10%-14%</a>
                                        <a href="javascript:void(0);" class="" value="3">14% 以上</a>
                                    </dd>
                                </dl>
                                <!--<dl class="ofh">-->
                                <!--<dt class="fl">投标进度：</dt>-->
                                <!--<dd class="fl" id="p_status">-->
                                <!--<a href="javascript:void(0);" class="fc0 active" value="0">全部</a>-->
                                <!--<a href="javascript:void(0);" class="" value="1">投标中</a>-->
                                <!--<a href="javascript:void(0);" class="" value="2">已满标</a>-->
                                <!--<a href="javascript:void(0);" class="" value="3">已完成</a>-->
                                <!--</dd>-->
                                <!--</dl>-->
                                <!--<dl class="ofh">-->
                                <!--<dt class="fl">排序方式：</dt>-->
                                <!--<dd class="fl" id="p_order">-->
                                <!--<a href="javascript:void(0);" class="fc0 active" value="0">全部</a>-->
                                <!--<a href="javascript:void(0);" class="" value="1">预期年化</a>-->
                                <!--<a href="javascript:void(0);" class="" value="2">借款期限 </a>-->
                                <!--</dd>-->
                                <!--</dl>-->
                                <dl class="ofh">
                                    <dt class="fl">还款方式：</dt>
                                    <dd class="fl" id="repay_method">
                                        <a href="javascript:void(0);" class="fc0 active" value="0">全部</a>
                                        <a href="javascript:void(0);" class="" value="1">等额本息</a>
                                        <a href="javascript:void(0);" class="" value="2">先息后本</a>
                                    </dd>
                                </dl>
                            </li>
                            <input type="hidden" id="_token" value="{{csrf_token()}}">
                            <div id="tender_list">

                            </div>
                        </ul>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true});</script>
    <script type="text/javascript" src="Public/web/js/roll.js"></script>
    <script>
        var page = 1;
        var project_type = "1";

        function getList(page, project_type, rate, repay_type, repay_time, p_status, p_order, pawn_type, repay_method){
            page = page == null ? 1 : page;
            project_type = project_type == null ? 1 : project_type;
            var url = "invest_list";
            var _token=$("#_token").val();
            javascript:scroll(0,0);
            $.ajax({
                url: url,
                type: 'post',
                data:{'_token':_token,'current_page':page, 'project_type':project_type, 'rate':rate, 'repay_type':repay_type, 'repay_time':repay_time, 'p_status':p_status, 'p_order':p_order, 'pawn_type':pawn_type, 'repay_method':repay_method},
                dataType: 'json',
                success:function(result){
                    var str='';



        $.each(result['data'],function(k,v){
                        //当前服务器时间
                        var now=<?php echo time(); ?>;
                        //投标结束时间
                        var endtime=v['lend_end_time'];
                        //倒计时
                        var c=endtime-now;

                        //剩余金额
                        var less_money=v['lend_money']-v['lend_repay_money'];
                        //出借进度
                        var progress=v['lend_repay_money']/v['lend_money']*100;
                        str+='<li class="choose_ifobox">';
                        str+='<div class="choose_ifo ofh" onclick="window.location.href=\'invest_info?id='+v.lend_id+'\'">';
                        str+='<dl class="fl"><img src="/Public/web/images/domain.png"  class="fl"/><dd class="fl">';
                        str+='<p class="ofh domain_string"><a href="/web/tender/tender_info/project_id/6676.html">';
                        str+='<span class="fs22 fc3 fl lh26 slide05-ym" title="'+v.lend_goods+'">'+v.lend_goods+'</span></a>';
                        str+='<span class="fl p_no channel_sh" style="display:block;">';
                        str+='<font>'+v.lend_number+'</font></span>';
                        if(v.lend_repay_method==1){
                            str+='<span class="promise01 fl channel_sh" style="display:block;">等额本息</span>';
                         }else if(v.lend_repay_method==2){
                            str+='<span class="promise01 fl channel_sh" style="display:block;">先息后本</span>';
                        }
                        str+='<span class="promise02 fl channel_sh" style="display:block;"> 域名质押</span></p>';
                        str+='<div class="ofh">';
                        str+='<div class="fl slide05-bow-tol">';
                        str+='<span class="">'+(v.lend_money/10000).toFixed(2)+'万</span>';
                        str+='<span class="fc_80">借款总额(元)</span></div>';
                        str+='<div class="fl slide05-bow-tol"><span class="">'+(less_money/10000).toFixed(2)+'万</span><span class="fc_80">剩余金额(元)</span></div>';
                        str+='<div class="fl slide05-bow-tol">';
                        str+='<span class="bow-rate">'+v.lend_return+'</span>';
                        str+='<span class="fc_80"><font class="normal">预期年化利率 </font></span></div>';
                        str+='<div class="fl slide05-bow-tol slide05-bow-tol_2">';
                        str+='<span class="bow-day">'+v.lend_repay_time+'个月</span><span class="fc_80"><font class="normal">借款期限</font></span></div>';
                        if(v.lend_repay_method==1){
                            str+='<div class="fl slide05-bow-tol slide05-bow-tol_1"><span>等额本息</span>';
                        }else if(v.lend_repay_method==2){
                            str+='<div class="fl slide05-bow-tol slide05-bow-tol_1"><span>先息后本</span>';
                        }
                        str+='<span class="fc_80"><font class="normal">还款方式</font></span></div>';
                        str+='<div class="slide05-pro fl"><div class="Invest-pro-bar-box ofh"><div class="Invest-pro-bar fl">';
                        str+='<div class="Invest-pro-bar-in tender_process" name="'+progress+'"style="width:'+progress+'%;"></div></div>';
                        str+='<div class="Invest-pro-data fr fs16">'+parseInt(progress)+'%</div></div>';
                        str+='<p class="Invest-pro-txt"><span class="fc_80">出借进度</span></p></div></div></dd></dl><div class="fr invest_nowbox">';
                        str+='<p class="invest_now4">';
                        if(progress==100 ){
                        str+='<a class="un-buy" href="invest_info?id='+v.lend_id+'">已抢光</a>';
                        }else{
                        str+='<a href="invest_info?id='+v.lend_id+'"  class="">立即出借</a>';
                        }

                        str+='</p></div>';
                        if(c>0&&progress<100) {
                            str += '<div class="slide08">' +
                                '<div class="time_box ofh" style="margin-right:65px;">' +
                                '<input class="hidden_input" name="' + v.lend_id + '" value="' + c + '" type="hidden">' +
                                '<div class="ofh shu-line-xx">' +
                                ' <em class="shu-line"></em>' +
                                ' <span class="" id="hour_' + v.lend_id + '">00</span>' +
                                ' </div>' +
                                ' <em class="mt15">：</em>' +
                                '<div class="ofh shu-line-xx">' +
                                '<em class="shu-line"></em>' +
                                '<span class="" id="minute_' + v.lend_id + '">00</span>' +
                                '</div>' +
                                '<em class="mt15">：</em>' +
                                '<div class="ofh shu-line-xx">' +
                                '<em class="shu-line"></em>' +
                                '<span class="" id="second_' + v.lend_id + '">00</span>' +
                                '</div>' +
                                '</div>';
                        }

                        str+='</div></li>';

                    });
                    str+='<div class="ft_pages" id="page_list">';
                    str+='<span class="total-pages">共'+result['pages']['sums']+'页：</span>';
                    str+='<a page="1" class="first-page">第一页</a>';
                    str+='<a page="'+result['pages']['prev']+'" class="prev">上一页</a>';

                    $.each(result['pages']['pag'],function(kk,vv){

                        if(result['pages']['page']==vv){
                            str+='<a class="active ">'+vv+'</a>';
                        }else{
                            str+='<a class="num"  onclick="pp('+vv+')"     page="'+vv+'">'+vv+'</a>';
                        }
                    });
                        str+='<a page="'+result['pages']['next']+'" class="next">下一页</a>';
                        str+='<a page="'+result['pages']['sums']+'" class="last">最后一页</a></div>';
                        $("#tender_list").html(str);
                        push();


                }
            });
        }

        function get_data(page) {
            var project_type = $("#project_type li.on").val();
            var rate = $("#rate a.active").attr("value");
            var repay_type = $("#repay_type a.active").attr("value");
            var repay_time = $("#repay_time a.active").attr("value");
            var p_status = $("#p_status a.active").attr("value");
            var p_order = $("#p_order a.active").attr("value");
            var pawn_type = $("#pawn_type a.active").attr("value");
            var repay_method = $("#repay_method a.active").attr("value");

            if(project_type == 2){
                $(".repayment").hide();
                repay_time = 0;
            }else{
                $(".repayment").show();
            }
            getList(page, project_type, rate, repay_type, repay_time, p_status, p_order, pawn_type, repay_method);
        }

        //初始化
        get_data(page);
        //上一页
        $(document).on('click',".prev",function(){
            var p=$('.prev').attr('page');
            get_data(p);
        });
        //下一页
        $(document).on('click',".next",function(){
            var p=$('.next').attr('page');
            get_data(p);
        });
        //第一页
        $(document).on('click',".first-page",function(){
            var p=1;
            get_data(p);
        });
        //最后一页
        $(document).on('click',".last",function(){
            var p=$('.last').attr('page');
            get_data(p);
        });
        //某一页
       function  pp(id){
           get_data(id);
       }


        //类别
        $("#project_type li").each(function(){
            $(this).click(function(){
                $(this).addClass("on");
                $(this).nextAll().removeClass("on");
                $(this).prevAll().removeClass("on");
                get_data();
            });
        });
        //年化利率
        $("#rate a").each(function(){
            $(this).click(function(){
                $(this).addClass("active");
                $(this).nextAll().removeClass("active");
                $(this).prevAll().removeClass("active");
                get_data();
            });
        });
        //还款方式
        $("#repay_type a").each(function(){
            $(this).click(function(){
                $(this).addClass("active");
                $(this).nextAll().removeClass("active");
                $(this).prevAll().removeClass("active");
                get_data();
            });
        });
        //还款期限
        $("#repay_time a").each(function(){
            $(this).click(function(){
                $(this).addClass("active");
                $(this).nextAll().removeClass("active");
                $(this).prevAll().removeClass("active");
                get_data();
            });
        });
        //状态
        $("#p_status a").each(function(){
            $(this).click(function(){
                $(this).addClass("active");
                $(this).nextAll().removeClass("active");
                $(this).prevAll().removeClass("active");
                get_data();
            });
        });
        //排序
        $("#p_order a").each(function(){
            $(this).click(function(){
                $(this).addClass("active");
                $(this).nextAll().removeClass("active");
                $(this).prevAll().removeClass("active");
                get_data();
            });
        });
        //借款类型
        $("#pawn_type a").each(function(){
            $(this).click(function(){
                $(this).addClass("active");
                $(this).nextAll().removeClass("active");
                $(this).prevAll().removeClass("active");
                get_data();
            });
        });

        //还款方式
        $("#repay_method a").each(function(){
            $(this).click(function(){
                $(this).addClass("active");
                $(this).nextAll().removeClass("active");
                $(this).prevAll().removeClass("active");
                get_data();
            });
        });
        //循环
        function push(){
            $("input[class='hidden_input']").each(function(){
                var key = $(this).attr('name');
                var second = parseInt($(this).val());
                daojishi(second, key);
            });
        }


        //进度条
        $(".tender_process").each(function(){
            var val = parseFloat($(this).attr("name"));
            $(this).animate({width:val+'%'},'slow');
        });




        //倒计时
        function daojishi(second, key) {
            if(second < 0) {
                alert(key+'结束');
                $("#hour_"+key).html('00');
                $("#minute_"+key).html('00');
                $("#second_"+key).html('00');
                return false;
            }

            var hour = Math.floor(second/3600).toString();
            var left_second = second % 3600;
            var minute = Math.floor(left_second/60).toString();
            var left_second = (left_second % 60).toString();

            hour = (hour.length == 1) ? '0'+hour : hour;
            minute = (minute.length == 1) ? '0'+minute : minute;
            left_second = (left_second.length == 1) ? '0'+left_second : left_second;

            $("#hour_"+key).html(hour);
            $("#minute_"+key).html(minute);
            $("#second_"+key).html(left_second);

            second--;

            setTimeout(function(){daojishi(second, key);}, 1000);
        }
    </script>
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
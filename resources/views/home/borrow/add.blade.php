<style>
	#tables{
		width: 900px;
		height: 200px;
		/*background-image: url('admin/images/bg.jpg');*/
	}
	#bo{
		font-size: 30px;
		color: blue;
	}
	#tables th{
		background-image: url('admin/images/1000.jpg');
	}
</style>
<body>
<div class="ww">
		<!--头部开始-->
        <?php include "layout/home/header.html";?>
</div>
<div class="ww both">
	<div class="bg_color1">
		<div class="wl mtauto ofh">
            <?php include "layout/home/user.php";?>
			<div class="fr content-right-x22 bg_color2">
				<div class="content-right-x2-title bdbt_e6">
					<h3 class="fl pr25 fs22">借款管理</h3>
				</div>

				<div class="mt25">
					<div class="slideTxtBox slide04">
						<div class="hd">
							<ul class="ofh" id="type_list">
								<li class="slide04-hd-li-wdx1" name="in_repay" status="1">还款中</li>
								<li class="slide04-hd-li-wdx1" name="in_repay1" status="2">审核中</li>
								<li class="slide04-hd-li-wdx1" name="in_repay2" status="3">审核完成</li>
								<li class="slide04-hd-li-wdx1" name="in_repay3" status="4">投标中</li>
								<li class="slide04-hd-li-wdx1" name="in_repay4" status="0">已还款</li>
							</ul>
						</div>
						<input type="hidden" name="_token" id="token" value="{{csrf_token()}}"></input>
						<div class="bd" id="borrow_list">

						</div>
						<br><br>
						<center>
							<a href="borrow_news" id="bo">我要借款</a>
						</center>
					</div>
				</div>

				<script>
                    var type = "in_repay";
                    $("#type_list [name='"+type+"']").addClass("on");

                    //var url = "/web/usertrade/borrow_list_data.html";
                    function getList(page){
                        page = page == null ? 1 : page;
                        var type = $("#type_list li.on").attr("name");
                        javascript:scroll(0,0);
                        var status = $("#type_list li.on").attr("status");
                        var token=$('#token').val();
                        $.ajax({
                            type:'post',
                            url:'borrow_ajax',
                            data:{'status':status,'_token':token},
                            dataType:"json",
                            success:function(msg){
                                if(!(msg=='')){
                                    var str='<center><table id="tables"><th>抵押域名</th><th>年化利率</th><th>借款金额</th><th>借款开始时间</th><th>借款最后还款时间</th><th>总还款额度</th><th>每月还款金额</th><th>最少投资金额</th>';
                                    $.each(msg,function(k,v){
                                        str+='<tr><td>'+v.lend_goods+'</td><td>'+v.lend_return+'</td><td>¥'+v.lend_money+'</td><td>'+v.lend_start_time+'</td><td>'+v.lend_end_time+'</td><td>¥'+v.lend_total_money+'</td><td>¥'+v.lend_month_money+'</td><td>¥'+v.lend_few_money+'</td></tr>';
                                    });
                                    str+='</table></center>';
                                    $('#borrow_list').html(str);
                                }else{
                                    $('#borrow_list').html("<center><br><br><br><br><span>还没有数据偶，亲</span></center>");
                                }
                            }
                        });
                    }

                    //getList();

                    $("#type_list li").each(function(){
                        $(this).click(function(){
                            $(this).addClass("on");
                            $(this).prevAll("li").removeClass("on");
                            $(this).nextAll("li").removeClass("on");

                            getList();
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
    <?php include "layout/home/footer.html";?>
</div>
</body>
</html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>大转盘抽奖</title>

<link rel="stylesheet" href="Public/web/css/demo.css" type="text/css" />

<script type="text/javascript" src="Public/web/js/jquery.min.js"></script>
<script type="text/javascript" src="Public/web/js/awardRotate.js"></script>
<script type="text/javascript">
$(function (){

	var rotateTimeOut = function (){
		$('#rotate').rotate({
			angle:0,
			animateTo:2160,
			duration:8000,
			callback:function (){
				alert('网络超时，请检查您的网络设置！');
			}
		});
	};
	var bRotate = false;

	var rotateFn = function (awards, angles, txt){
		bRotate = !bRotate;
		$('#rotate').stopRotate();
		$('#rotate').rotate({
			angle:0,
			animateTo:angles+1800,
			duration:8000,
			callback:function (){
				bRotate = !bRotate;
				var token=$('.tokens').val();
				$.ajax({
					type:'post',
					url:"lottery_ajax",
					data:{id:{{$id}},user_id:{{$user_id}},_token:token,txt:txt},
					success:function(msg){
						if(msg==1){
							alert(txt);
						}else{
							alert('亲，出故障了');
						}
					}
				});
			}
		})
	};

	$('.pointer').click(function (){

		if(bRotate)return;
		var item = rnd(0,7);

		switch (item) {
			case 0:
				//var angle = [26, 88, 137, 185, 235, 287, 337];
				rotateFn(0, 337, '未中奖');
				break;
			case 1:
				//var angle = [88, 137, 185, 235, 287];
				rotateFn(1, 26, '免单4999元');
				break;
			case 2:
				//var angle = [137, 185, 235, 287];
				rotateFn(2, 88, '免单50元');
				break;
			case 3:
				//var angle = [137, 185, 235, 287];
				rotateFn(3, 137, '免单10元');
				break;
			case 4:
				//var angle = [185, 235, 287];
				rotateFn(4, 185, '免单5元');
				break;
			case 5:
				//var angle = [185, 235, 287];
				rotateFn(5, 185, '免单5元');
				break;
			case 6:
				//var angle = [235, 287];
				rotateFn(6, 235, '免分期服务费');
				break;
			case 7:
				//var angle = [287];
				rotateFn(7, 287, '白条额度+200');
				break;
		}
		//alert(item);
		console.log(item);
	});
});
function rnd(n, m){
	return Math.floor(Math.random()*(m-n+1)+n)
}
</script>

</head>
<body>
<div style="background-color: blue;width:100%;height: 100%;">
    <center><font size="15px" color="yellow">幸运抽奖活动</font></center>
    <div class="turntable-bg">
        <!-- <div class="mask"><img src="images/award_01.png"/></div> -->
        <div class="pointer"><img src="Public/web/images/pointer.png" alt="pointer"/></div>
        <div class="rotate" ><img id="rotate" src="Public/web/images/turntable.png" alt="turntable"/></div>
    </div>
	<div style="text-align:center;">
	<input type="hidden" name="_token" value="{{csrf_token()}}" class="tokens"></input>
</div>
</div>
</body>
</html>
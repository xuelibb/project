<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>  
    <link rel="stylesheet" href="admin/css/pintuer.css">
    <link rel="stylesheet" href="admin/css/admin.css">
    <script src="admin/js/jquery.js"></script>
    <script src="admin/js/pintuer.js"></script>  
</head>
<body>
<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 活动列表</strong></div>
    <div class="padding border-bottom">
      <!-- <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
        </li>
      </ul> -->
    </div>
    @if(!empty($data))
    <table class="table table-hover text-center">
      <tr>
        <th>活动名称</th>       
        <th>活动时间</th>
        <th>详情</th>       
      </tr>
      @foreach($data as $k=>$v)
        <tr>
          <td>{{$v['activity_name']}}</td>
          <td>{{date("Y-m-d H:i:s",$v['start_time'])}}~~{{date("Y-m-d H:i:s",$v['end_time'])}}</td>
          <td>
          <div class="button-group"> <a class="button border-red" href="lottery_info?id={{$v['activity_id']}}"><span class="icon-trash-o"></span> 点击抽奖</a> </div>
          </td>
        </tr>
      @endforeach
    </table>
    @else
    <center>
      <h1>目前没有任何活动</h1>
    </center> 
    @endif
  </div>
</form>
<script type="text/javascript">

// function del(id){
// 	if(confirm("您确定要删除吗?")){
		
// 	}
// }

// $("#checkall").click(function(){ 
//   $("input[name='id[]']").each(function(){
// 	  if (this.checked) {
// 		  this.checked = false;
// 	  }
// 	  else {
// 		  this.checked = true;
// 	  }
//   });
// })

// function DelSelect(){
// 	var Checkbox=false;
// 	 $("input[name='id[]']").each(function(){
// 	  if (this.checked==true) {		
// 		Checkbox=true;	
// 	  }
// 	});
// 	if (Checkbox){
// 		var t=confirm("您确认要删除选中的内容吗？");
// 		if (t==false) return false; 		
// 	}
// 	else{
// 		alert("请选择您要删除的内容!");
// 		return false;
// 	}
// }

</script>
</body></html>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="admin/css/pintuer.css">
<link rel="stylesheet" href="admin/css/admin.css">
<script src="admin/js/jquery.js"></script>
<script src="admin/js/pintuer.js"></script>
</head>
<body>
<form method="post" action="" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 借款列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    @if(!empty($data))
    <table class="table table-hover text-center">
      <tr>
        <th>抵押物</th>
        <th>用户名</th>
          <th>借款审核状态</th>
        <th>操作</th>
      </tr>
         @foreach($data as $k=>$v)
         <tr>
             <td>{{$v['lend_goods']}}</td>
             <td>{{$v['user_user']}}</td>
             @if($v['borrow_state']==0)
                 <td><font color="red">待审核</font></td>
             @else
                 <td><font color="green" readonly="readonly">审核完成</font></td>
             @endif
             <td>
             <div class="button-group">
             <a class="button border-main" href="admin_bor_info?id={{base64_encode($v['lend_id'])}}"><span class="icon-edit"></span> 查看详情</a>
             </div>
             </td>
         </tr>
         @endforeach
    </table>
    @endif
  </div>
</form>
<script type="text/javascript">

//搜索


</script>
</body>
</html>
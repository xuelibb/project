<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>文章管理</title>  
    <link rel="stylesheet" href="admin/css/pintuer.css">
    <link rel="stylesheet" href="admin/css/admin.css">
    <script src="admin/js/jquery.js"></script>
    <script src="admin/js/pintuer.js"></script>  
    <style media="screen">
    .pagination  li{
     float: left;
      margin: 1px;
    }
    </style>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 文章列表</strong></div>
  <div class="padding border-bottom">  
  <a class="button border-yellow" href="admin_article_add"><span class="icon-plus-square-o"></span> 添加文章</a>
  </div> 
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>     
      <th>文章标题</th>  
      <th>内容</th>
      <th>添加时间</th>
      <th>最近一次修改时间</th>        
      <th width="250">操作</th>
    </tr>
   <?php  foreach ($article_info as $v )  { ?>
    <tr id="del<?=$v['article_id']?>">
      <td><?php echo $v['article_id'];?></td>      
      <td><?=$v['article_title']?></td>
      <td><?=$v['article_content']?></td>    
      <td><?php echo date("Y:m:d H:i:s",$v['article_time'])  ;?></td>
      <td>
        <?php if( $v['article_time']==$v['update_time'] ) {
          //如果添加时间和修改时间一致则显示未修改
          echo "未经过修改";
          }else{
          echo date("Y:m:d H:i:s",$v['update_time']);}
        ?>
      </td>       
      <td>
      <div class="button-group">
      <a type="button" class="button border-main" href="admin_article_update?id=<?=$v['article_id']?>"><span class="icon-edit"></span>修改</a>
      <a class="button border-red" href="javascript:void(0)" onclick="return del(<?=$v['article_id']?>)"><span class="icon-trash-o"></span> 删除</a>
      </div>
      </td>
    </tr> 
    <?php } ?>
   </table>
   </div>
{{$page->render()}}
<script>
function del(id){
	if(confirm("您确定要删除吗?")){
		$.ajax({
      url:'admin_article_delete/'+id
    })
    $("#del"+id).remove();
	}
}
</script>
<div class="panel admin-panel margin-top">
  
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="renderer" content="webkit">
  <title>设置轮播图</title>
  <link rel="stylesheet" href="admin/css/pintuer.css">
  <link rel="stylesheet" href="admin/css/admin.css">
  <script src="admin/js/jquery.js"></script>
  <script src="admin/js/pintuer.js"></script>
  <style>
    #first{
      visibility:hidden;
    }
  </style>
</head>
<body>
<form method="post" action="admin_nav" id="listform">
  <input  type='hidden'   name='_token'  value="<?php echo csrf_token();  ?>" />
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 设置导航栏</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
    <table class="table table-hover text-center">
      <tr>
        <th>导航标题</th>
        <th>链接</th>
        <th width="310">操作</th>
      </tr>
      <tr><td><input type="text" name="nav_title[]" value="<?=$arr[0]['nav_title']?>"  ></td><td><input type="text" name="nav_link[]" value="<?=$arr[0]['nav_link']?>"></td><td><div class="button-group"> <a class="button border-main" href="javascript:void(0);" ><span class="icon-edit"></span>+</a> <a class="button border-red" id="first" href="javascript:void(0)"><span class="icon-trash-o"></span>-</a> </div></td></tr>
      <?php foreach($arr=isset($arr)?$arr:array() as $k=>$v){
      if($k!=0){?>
      <tr><td><input type="text" name="nav_title[]" value="<?=$v['nav_title']?>"  ></td><td><input type="text" name="nav_link[]" value="<?=$v['nav_link']?>"></td><td><div class="button-group"> <a class="button border-main" href="javascript:void(0);" ><span class="icon-edit"></span>+</a> <a class="button border-red"  href="javascript:void(0)"><span class="icon-trash-o"></span>-</a> </div></td></tr>
      <?php }}?>
    </table>
        <input class="button bg-main icon-check-square-o" type="submit" value="保存设置" style="margin-left: 600px;">
  </div>
</form>
<script type="text/javascript">
  //添加导航
  $(document).on('click','.border-main',function(){
     $(this).parents("tr").after('<tr><td><input type="text" name="nav_title[]" placeholder="填写导航名称"></td> <td><input type="text" name="nav_link[]" placeholder="填写导航链接地址"></td><td><div class="button-group"> <a class="button border-main" href="javascript:void(0);"><span class="icon-edit"></span>+</a> <a class="button border-red" href="javascript:void(0)"><span class="icon-trash-o" ></span>-</a> </div></td></tr>');
  });
//删除导航
  $(document).on('click',".border-red",function(){
    if(confirm("您确定要删除吗?")){
     $(this).parents("tr").remove();
    }
  });
  //全选
  $("#checkall").click(function(){
    $("input[name='id[]']").each(function(){
      if (this.checked) {
        this.checked = false;
      }
      else {
        this.checked = true;
      }
    });
  })

  //批量删除
  function DelSelect(){
    var Checkbox=false;
    $("input[name='id[]']").each(function(){
      if (this.checked==true) {
        Checkbox=true;
      }
    });
    if (Checkbox){
      var t=confirm("您确认要删除选中的内容吗？");
      if (t==false) return false;
      $("#listform").submit();
    }
    else{
      alert("请选择您要删除的内容!");
      return false;
    }
  }

  //批量排序
  function sorts(){
    var Checkbox=false;
    $("input[name='id[]']").each(function(){
      if (this.checked==true) {
        Checkbox=true;
      }
    });
    if (Checkbox){

      $("#listform").submit();
    }
    else{
      alert("请选择要操作的内容!");
      return false;
    }
  }


  //批量首页显示
  function changeishome(o){
    var Checkbox=false;
    $("input[name='id[]']").each(function(){
      if (this.checked==true) {
        Checkbox=true;
      }
    });
    if (Checkbox){

      $("#listform").submit();
    }
    else{
      alert("请选择要操作的内容!");

      return false;
    }
  }

  //批量推荐
  function changeisvouch(o){
    var Checkbox=false;
    $("input[name='id[]']").each(function(){
      if (this.checked==true) {
        Checkbox=true;
      }
    });
    if (Checkbox){


      $("#listform").submit();
    }
    else{
      alert("请选择要操作的内容!");

      return false;
    }
  }

  //批量置顶
  function changeistop(o){
    var Checkbox=false;
    $("input[name='id[]']").each(function(){
      if (this.checked==true) {
        Checkbox=true;
      }
    });
    if (Checkbox){

      $("#listform").submit();
    }
    else{
      alert("请选择要操作的内容!");

      return false;
    }
  }


  //批量移动
  function changecate(o){
    var Checkbox=false;
    $("input[name='id[]']").each(function(){
      if (this.checked==true) {
        Checkbox=true;
      }
    });
    if (Checkbox){

      $("#listform").submit();
    }
    else{
      alert("请选择要操作的内容!");

      return false;
    }
  }

  //批量复制
  function changecopy(o){
    var Checkbox=false;
    $("input[name='id[]']").each(function(){
      if (this.checked==true) {
        Checkbox=true;
      }
    });
    if (Checkbox){
      var i = 0;
      $("input[name='id[]']").each(function(){
        if (this.checked==true) {
          i++;
        }
      });
      if(i>1){
        alert("只能选择一条信息!");
        $(o).find("option:first").prop("selected","selected");
      }else{

        $("#listform").submit();
      }
    }
    else{
      alert("请选择要复制的内容!");
      $(o).find("option:first").prop("selected","selected");
      return false;
    }
  }

</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>修改文章</title>  
    <link rel="stylesheet" href="admin/css/pintuer.css">
    <link rel="stylesheet" href="admin/css/admin.css">
    <script src="admin/js/jquery.js"></script>
    <script src="admin/js/pintuer.js"></script>
</head>
<body>
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改文章</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="admin_article_update_do?id=<?php  echo $article_info['article_id'];?>">   
      <input type="hidden" name="_token"  value="<?php echo csrf_token(); ?>" />  
      <div class="form-group">
        <div class="label">
          <label>文章标题：</label>
         </div>
        <div class="field">
          <input type="text" class="input w50"  name="article_title" value="<?php  echo $article_info['article_title']; ?>" data-validate="required:请输入文章标题" />         
          <div class="tips"></div>
        </div>
      </div> 
       <div class="form-group">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">
          <textarea name="article_content"  class="w50" data-validate="required:请输入文章内容" ><?php  echo $article_info['article_content']; ?></textarea>
          <div class="tips"></div>
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 修改</button>
          <button class="button bg-main icon-check-square-o" type="reset"> 重置</button>
        </div>
      </div>
    </form>
  </div>
</body>
</html>



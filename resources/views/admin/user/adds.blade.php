<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加管理员</title>
<link rel="stylesheet" href="admin/css/pintuer.css">
<link rel="stylesheet" href="admin/css/admin.css">
<script src="admin/js/jquery.js"></script>
<script src="admin/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加管理员</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="admin_user_do">  

    <input type="hidden" name="_token" value="{{csrf_token()}}">

      <div class="form-group">
        <div class="label">
          <label>请输入管理员名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="user_name" data-validate="required:请输入管理员名" />
          <div class="tips"></div>
        </div>
      </div>   

      <div class="form-group">
        <div class="label">
          <label>请输入密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" value="" name="user_password" data-validate="required:请输入密码" />
          <div class="tips"></div>
        </div>
      </div> 

      <div class="form-group">
          <div class="label">
            <label>给管理员添加角色：</label>
          </div>
          <div class="field" style="padding-top:8px;">
          @foreach($data as $k=>$v)
            <input name="role_id" type="radio" value="{{$v['role_id']}}"/>{{$v['role_name']}}
          @endforeach
          </div>
        </div>
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit">管理员添加</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body></html>
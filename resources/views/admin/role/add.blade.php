<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加角色</title>
<link rel="stylesheet" href="admin/css/pintuer.css">
<link rel="stylesheet" href="admin/css/admin.css">
<script src="admin/js/jquery.js"></script>
<script src="admin/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加权限</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="admin_role_do">  

    <input type="hidden" name="_token" value="{{csrf_token()}}">

      <div class="form-group">
        <div class="label">
          <label>请输入角色名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="role_name" data-validate="required:请输入角色名" />
          <div class="tips"></div>
        </div>
      </div>   

      <div class="form-group">
          <div class="label">
            <label>其他属性：</label>
          </div>
          <div class="field" style="padding-top:8px;">
          @foreach($data as $k=>$v)
            <input name="node_id[]" type="checkbox" value="{{$v['node_id']}}"/>{{$v['node_name']}}
          @endforeach
          </div>
        </div>

      <div class="form-group">
        <div class="label">
          <label>角色描述：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input" name="role_msg" style="height:80px;"></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit">角色添加</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body></html>
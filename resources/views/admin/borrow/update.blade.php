<!DOCTYPE html>
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
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改状态</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="admin_borrow_updates">  
        <div class="form-group">
          <div class="label">
            <label>状态：</label>
          </div>
          <div class="field">
            <select name="status" class="input w50">
              <option value="">请选择状态</option>
              <option value="1">还款中</option>
              <option value="2">审核中</option>
              <option value="3">审核完成</option>
              <option value="4">投标中</option>
              <option value="0">已还款</option>
            </select>
            <div class="tips"></div>
          </div>
        </div>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="lend_id" value="{{$id}}">
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body></html>
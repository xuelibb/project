<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改权限</title>
<link rel="stylesheet" href="admin/css/pintuer.css">
<link rel="stylesheet" href="admin/css/admin.css">
<script src="admin/js/jquery.js"></script>
<script src="admin/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加权限</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="admin_node_updates?id={{$id}}">  

    <input type="hidden" name="_token" value="{{csrf_token()}}">

      <div class="form-group">
        <div class="label">
          <label>请输入权限名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="{{$data[0]['node_name']}}" name="node_name" data-validate="required:请输入权限名" />
          <div class="tips"></div>
        </div>
      </div>   

        <div class="form-group">
          <div class="label">
            <label>添加分类：</label>
          </div>
          <div class="field">
            <select name="p_id" class="input w50">
                <option value="0">顶级分类</option>
            @foreach($arr as $k=>$v)
              <option value="{{$v['node_id']}}">{{$v['node_name']}}</option>
            @endforeach
            </select>
            <div class="tips"></div>
          </div>
        </div>

      <div class="form-group">
        <div class="label">
          <label>请输入路由：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="{{$data[0]['node_url']}}" name="node_url" data-validate="required:请输入路由" />
          <div class="tips"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label>权限描述：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input" name="node_msg" style="height:80px;">{{$data[0]['node_msg']}}</textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit">权限修改</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body></html>
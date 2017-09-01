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
<div style="width: 100%;height: 1000px;opacity: 0.5;position: absolute;top: 0;left: 0;z-index: 100;display: none" id="zhe"></div>
<div align="center" style="position:absolute; top: 25%;left: 25%;width: 50%;height: 50%;z-index: 200;display: none" id="zhao">
    <center>
    <div class="panel admin-panel">
        <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>抵押物价值</strong></div>
        <div class="body-content">
            <form method="post" class="form-x" action="admin_domain_do">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="user_id" value="" id="user_id">
                <input type="hidden" name="lend_goods" value="" id="lend_goods">
                <div class="form-group"  style="width: 1000px;">
                    <div class="label" style="margin-left: 18%;">
                        <label>抵押物价值：</label>
                    </div>
                    <div class="field" style="margin-left: 18%">>
                        <input type="text" class="input w50" value="" name="lend_worth" data-validate="required:请输入抵押物价值" />
                        <div class="tips"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label></label>
                    </div>
                    <div class="field">
                        <button class="button bg-main icon-check-square-o" type="submit">完成审核</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </center>
</div>
<form method="post" action="" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 域名列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
        @if(!empty($data))
            <table class="table table-hover text-center">
                <tr>
                    <th>抵押物</th>
                    <th>用户名</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $k=>$v)
                    <tr>
                        <td>{{$v['lend_goods']}}</td>
                        <td>{{$v['user_user']}}</td>
                        @if($v['status']==0)
                            <td><font color="red">待审核</font></td>
                            <td>
                                <div class="button-group">
                                    <a class="button border-main" id="duw" user-id="{{$v['user_id']}}" lend-goods={{$v['lend_goods']}}><span class="icon-edit"></span> 域名请审核</a>
                                </div>
                            </td>
                        @else($v['status']==1)
                            <td><font color="lime">审核完成</font></td>
                            <td>
                                <div class="button-group">
                                    <a class="button border-main" disabled="true"><span class="icon-edit"></span> 已审核完成</a>
                                </div>
                            </td>
                        @endif

                    </tr>
                @endforeach
            </table>
        @endif
    </div>
</form>
</body>
</html>
<script>
    $(document).on('click','#duw',function () {
        var u_id=$(this).attr('user-id');
        var l_goods=$(this).attr('lend-goods');
        $('#user_id').attr('value',u_id);
        $('#lend_goods').attr('value',l_goods);
        $("html,body").animate({scrollTop:0}, 100);
        $('#zhe').css('display','block');
        $('#zhao').css('display','block');
    });
</script>
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
<div align="center" style="position:absolute;left: 25%;width: 50%;height: 50%;z-index: 200;display: none" id="zhao">
    <center>
        <div class="panel admin-panel">
            <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>是否审核</strong></div>
            <div class="body-content">
                <form method="post" class="form-x" action="admin_bor_su">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="lend_id" value="" id="lend_id">
                    <div class="form-group"  style="width: 1000px;">
                        <div class="label" style="margin-left: 18%;">
                            <label>抵押物：</label>
                        </div>
                        <div class="field" style="margin-left: 18%">>
                            <input type="text" class="input w50" value="" id="lend_goodss" data-validate="required:请输入抵押物" readonly/>
                            <div class="tips"></div>
                        </div>
                    </div>

                    <div class="form-group"  style="width: 1000px;">
                        <div class="label" style="margin-left: 18%;">
                            <label>抵押物价值：</label>
                        </div>
                        <div class="field" style="margin-left: 18%">>
                            <input type="text" class="input w50" value="" id="lend_worth" data-validate="required:请输入抵押物价值"  readonly/>
                            <div class="tips"></div>
                        </div>
                    </div>

                    <div class="form-group"  style="width: 1000px;">
                        <div class="label" style="margin-left: 18%;">
                            <label>借款金额：</label>
                        </div>
                        <div class="field" style="margin-left: 18%">>
                            <input type="text" class="input w50" value="" id="lend_money" data-validate="required:请输入借款金额" readonly/>
                            <div class="tips"></div>
                        </div>
                    </div>

                    <div class="form-group"  style="width: 1000px;">
                        <div class="label" style="margin-left: 18%;">
                            <label>年化利率：</label>
                        </div>
                        <div class="field" style="margin-left: 18%">>
                            <input type="text" class="input w50" value="" id="lend_return" data-validate="required:请输入年化利率" readonly/>
                            <div class="tips"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="label">
                            <label></label>
                        </div>
                        <div class="field">
                            <button class="button bg-main icon-check-square-o" type="submit">   确定</button>
                            <button class="button bg-main icon-check-square-o" type="reset">   取消</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </center>
</div>
<form method="post" action="" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 借款列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>
        @if(!empty($data))
            <table class="table table-hover text-center">
                <tr>
                    <th>ID</th>
                    <th>抵押物</th>
                    <th>用户名</th>
                    <th>年化利率</th>
                    <th>抵押物价值</th>
                    <th>借款金额</th>
                    <th>借款期限</th>
                    <th>还款方式</th>
                    <th>生成订单号</th>
                    <th>借款审核状态</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $k=>$v)
                    <tr>
                        <td>{{$v['lend_id']}}</td>
                        <td>{{$v['lend_goods']}}</td>
                        <td>{{$v['user_user']}}</td>
                        <td>{{$v['lend_return']}}</td>
                        <td>{{$v['lend_worth']}}</td>
                        <td>{{$v['lend_money']}}</td>
                        <td>{{$v['lend_repay_time']}}个月</td>
                        @if($v['lend_repay_method']==1)
                            <td><font color="green">等额本息</font></td>
                        @else
                            <td><font color="#adff2f">先息后本</font></td>
                        @endif
                        <td>{{$v['lend_number']}}</td>
                        @if($v['borrow_state']==0)
                            <td><font color="red">待审核</font></td>
                            <td>
                                <div class="button-group">
                                    <a class="button border-main" href="#" id="shen" lend-goods="{{$v['lend_goods']}}" lend-return="{{$v['lend_return']}}" lend-money="{{$v['lend_money']}}" lend-worth="{{$v['lend_worth']}}" lend-id="{{$v['lend_id']}}"><span class="icon-edit"></span> 点击审核</a>
                                </div>
                            </td>
                        @else
                            <td><font color="green" readonly="readonly">审核完成</font></td>
                            <td>
                                <div class="button-group">
                                    <a class="button border-main" href="#"><span class="icon-edit"></span> 无需审核</a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
</form>
<script type="text/javascript">
    $(document).on('click','#shen',function () {
        var l_id=$(this).attr('lend-id');
        $('#lend_id').attr('value',l_id);
        var l_goods=$(this).attr('lend-goods');
        $('#lend_goodss').attr('value',l_goods);
        var l_worth=$(this).attr('lend-worth');
        $('#lend_worth').attr('value',l_worth);
        var l_money=$(this).attr('lend-money');
        $('#lend_money').attr('value',l_money);
        var l_return=$(this).attr('lend-return');
        $('#lend_return').attr('value',l_return);
        $("html,body").animate({scrollTop:0}, 100);
        $('#zhe').css('display','block');
        $('#zhao').css('display','block');
    });
</script>
</body>
</html>
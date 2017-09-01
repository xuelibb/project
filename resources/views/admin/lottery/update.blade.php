<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加活动</title>
</head>
<link rel="stylesheet" type="text/css" href="admin/codebase/GooCalendar.css"/>
<link rel="stylesheet" href="admin/css/pintuer.css">
<link rel="stylesheet" href="admin/css/admin.css">
<script src="admin/js/pintuer.js"></script>
<script  type="text/javascript" src="admin/codebase/jquery-1.3.2.min.js"></script>
<script  type="text/javascript" src="admin/codebase/GooFunc.js"></script>
<script  type="text/javascript" src="admin/codebase/GooCalendar.js"></script>
<script type="text/javascript">
    var property2={
        divId:"demo2",//日历控件最外层DIV的ID
        needTime:true,//是否需要显示精确到秒的时间选择器，即输出时间中是否需要精确到小时：分：秒 默认为FALSE可不填
        yearRange:[1970,2030],//可选年份的范围,数组第一个为开始年份，第二个为结束年份,如[1970,2030],可不填
        week:['日','一','二','三','四','五','六'],//数组，设定了周日至周六的显示格式,可不填
        month:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],//数组，设定了12个月份的显示格式,可不填
        format:"yyyy-MM-dd hh:mm:ss"
        /*设定日期的输出格式,可不填*/
    };
    //var property={
    //  divId:"demo",
    //  needTime:true,
    //  fixid:"fff"
    //  /*决定了日历的显示方式，默认不填时为点击INPUT后出现，但如果填了此项，日历控件将始终显示在一个id为其值（如"fff"）的DIV中（且此DIV必须存在）*/
    //};
    $(document).ready(function(){
//  canva1=$.createGooCalendar("calen",property);
        canva2=$.createGooCalendar("calen2",property2);
        canva1=$.createGooCalendar("calen1",property2);
        //canva2.setDate({year:2008,month:11,day:22,hour:14,minute:52,second:45});
    });
</script>
<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改活动</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="admin_lottery_updates?id=<?php echo $data[0]['activity_id']?>">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <div class="label">
                    <label>活动时间：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="{{date('Y-m-d H:i:s',$data[0]['start_time'])}}" name="start_time" data-validate="required:请输入标题" id="calen1" /><input type="text" class="input w50" value="{{date('Y-m-d H:i:s',$data[0]['end_time'])}}" name="end_time" data-validate="required:请输入标题" id="calen2" />
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>活动名称：</label>
                </div>
                <div class="field">
                    <select name="activity_name" class="input w50">
                        <option value="">请选择活动名称</option>
                        <option value="大转盘活动">大转盘活动</option>
                        <option value="邀请注册">邀请注册</option>
                    </select>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>活动状态：</label>
                </div>
                <div class="field">
                    <select name="status" class="input w50">
                        <option value="">请选择活动状态</option>
                        <option value="1">开放</option>
                        <option value="0">未开放</option>
                    </select>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 修改活动</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>

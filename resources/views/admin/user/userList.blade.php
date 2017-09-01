<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户列表</title>

</head>
<body>
<div id="zzc" style="z-index: 1; position: absolute;top: 0;left: 0;display:none; width: 100%;height:1000px;background-color: #919191;opacity: 0.3;"></div>
<center>
<div style="z-index:100;border-radius:15px; background-color: #ffffff ;width:60%;height: 300px;display: none; position: absolute;top:10%;left:20%;" id="info"></div>
</center>
<div style="z-index: 100">
<table style="width: 100%;" cellspacing="0" cellpadding="0">
    <tr>
        <th>用户编号</th>
        <th>用户名称</th>
        <th>身份证照片</th>
        <th>用户手机号</th>
        <th>用户的测试类型</th>
        <th>抵押物数量</th>
        <th>是否实名认证</th>
        <th>信用度</th>
        <th>操作</th>
    </tr>
    @foreach($new as $k=>$v)
    <tr class="trs" align="center">
        <td align="center">{{$v['user_id']}}</td>
        <td align="center">{{$v['user_user']}}</td>
        <td align="center">
            @if(!empty($v['details_img']))
                 <img src="{{$v['details_img']}}" style="width:80px;height:80px">
            @else
                <img src="uploads/error32.png" style="width:80px;height:80px">
            @endif
        </td>
        <td align="center">{{$v['user_tel']}}</td>
        <td align="center">
            @if($v['assess']!="0")
            <span style="color:green;">{{$v['assess']}}</span>
                @else
            <span style="color: red">未评估</span>
                @endif
        </td>
        <td align="center">
            @if($v['count']!=0)
                {{$v['count']}}个
            @else
                <span>还没有质押物</span>
            @endif
        </td>
        <td align="center">
            @if($v['is_new']!=0)
                <span style="color: green">以认证</span>
            @else
                <span style="color: red">未认证</span>
            @endif
        </td>
        <td align="center">{{$v['xyd']}}</td>
        <td class="aa" id="{{$v['user_id']}}"><span style="cursor: pointer;background-color: #717aff;padding: 5px;color: #fffc00" id="{{$v['user_id']}}">查看</span></td>
        {{--<td class="aa" align="center"><span style="background-color: red;cursor: pointer; display: inline-block;width:50px;height:35px; ">拉黑</span></td>--}}
    </tr>
        @endforeach
</table>
</div>
</body>
</html>
<script src="admin/js/jquery.js"></script>
<script>
    $(function(){
        $(".aa").click(function(){
            var user_id=$(this).attr("id");
            var str="";
            $("#zzc").show();
            $("#info").show();
            $.ajax({
                type:"get",
                url:"userListAjax",
                data:{
                    user_id:user_id
                },
                dataType:"json",
                success:function(data){
                    str='<ul style="list-style: none"> ' +
                            '<li style="float: left; width: 40%;height:50px; margin-top:10px;margin-left: 15px; background-color: #f0ffda">真实姓名：'+data['details_name']+'</li> ' +
                            '<li style="float: left; width: 40%;height:50px; margin-top:10px;margin-left: 15px; background-color: #f0ffda">性别：'+data['details_sex']+'</li> ' +
                            '<li style="float: left; width: 40%;height:50px; margin-top:10px;margin-left: 15px; background-color: #f0ffda">所在地：'+data['details_address']+'</li> ' +
                            '<li style="float: left; width: 40%;height:50px; margin-top:10px;margin-left: 15px; background-color: #f0ffda">身份证号码：'+data['details_card']+'</li>' +
                            '<li style="float: left; width: 40%;height:50px; margin-top:10px;margin-left: 15px; background-color: #f0ffda">是否认证：';
                            if(data['is_new']!="*"){
                                str+="已认证";
                            }
                            else
                            {
                                str+="未认证";
                            }
                            str+='</li>' +
                            ' <li style="float: left; width: 40%;height:50px; margin-top:10px;margin-left: 15px;background-color: #f0ffda">信誉度：'+data['xyd']+'</li> ' +
                            '<li style="float: left; width: 40%;height: 50px; margin-top:10px;margin-left: 15px;background-color: #f0ffda">账户余额：'+data['details_balance']+'</li> ' +
                            '</ul>';
                    $("#info").html(str);
                }
            })
        })
        $("#zzc").click(function(){
            $(this).hide();
            $("#info").hide();
        })
        $("#info").click(function(){
            $(this).hide();
            $("#zzc").hide();
        })
        $(document).ready(function(){
            var evtr=$(".trs:even");
            var oddtr=$(".trs:odd");
            evtr.css("background","#0072ff");
            oddtr.css("background","#c2fffe");
        })
    })
</script>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>题库列表</title>
    <style>
        table tr td{
            border-bottom: 1px red ridge;
            width:400px;
        }
        #problem_info{
            width: 100%;
            height:510px;
            background-color:#ecf0f1;
            position: absolute;
            top: 0;
            left:0;
            line-height:35px;
        }
    </style>
</head>
<body>
<h2 align="left">当前题库中一共有<span style="color: red"><?php echo $sum?></span>道题</h2>
<table cellspacing="0">
    <tr class="jyz_tr">
        <td style="width: 100px" align="center">题目序号</td>
        <td align="center">题目内容</td>
        <td align="center">添加时间</td>
        <td style="width: 100px" align="center">操作</td>
        <td style="width: 100px" align="center">全选<input type="checkbox" id="che"></td>
    </tr>
    <?php foreach($info as $k=>$v){?>
        <tr class="jyz_tr">
            <td style="width: 100px" align="center" ><?php echo $v['id']?></td>
            <td align="center"><?php echo $v['exam_title']?></td>
            <td align="center"><?php echo $v['addtime']?></td>
            <td style="width: 100px" align="center"><span style="cursor:pointer" class="show_info" sid="<?php echo $v['id']?>">查看</span></td>
            <td style="width: 100px" align="center"><span rid="<?php echo $v['id']?>" class="del_pro">删除</span><input type="checkbox" pid="<?php echo $v['id']?>"></td>
        </tr>
    <?php }?>
</table>
<div id="problem_info" align="center" style="display: none">
    <div align="right" style="margin-right: 20px;margin-top: 5px">
        <img src="Public/web/images/timg1.gif" alt="退出" id="out" width="40px" height="40px">
    </div>
    <input id="tok" type="hidden" name="_token"  value="<?php echo csrf_token(); ?>" />
    <table id="infos_jyz" style="margin-top: 100px">

    </table>
</div>
</body>
</html>
<script src="admin/js/jquery.js"></script>
<script>
    $(function(){
        $(document).ready(function(){
            var tr_color=$(".jyz_tr");
            for(var i=0;i<tr_color.length;i++)
            {
                if(i%2==0)
                {
                    tr_color.eq(i).css("background-color","#ecf0f1");
                }
            }
        });
        $(document).on("click",".up_option",function(){
            var ot=$(this);
            var o_id=ot.attr("oid");
            var id=ot.attr("ids");
            var t=ot.attr('t');
            var k=ot.attr("k");
            var opt= ot.html();
            var str="<input class='in_option' type='text' id='"+o_id+"' k='"+k+"' t='"+t+"' value='"+opt+"' kid='"+id+"' def='"+opt+"'>";
            ot.parent().html(str);
        })
        $(document).on("blur",".in_option",function(){
            var oi=$(this);
            var t=oi.attr('t');
            var o_id=oi.attr("id");
            var def=oi.attr("def");
            var k=oi.attr("k");
            var kid=oi.attr("kid");
            var opt=oi.val();
            var str="";
            var token=$("#tok").val();
            $.ajax({
                type:"post",
                url:"admin_ajax_up",
                data:{
                    "_token":token,
                    o_id:o_id,
                    opt:opt,
                    t:t,
                    k:k,
                    kid:kid
                },
                success:function(data)
                {
                    if(data)
                    {
                        alert("修改成功");
                        str='<span class="up_option" oid="'+o_id+'">'+opt+'</span>';
                    }
                    else
                    {
                        alert("修改失败");
                        str='<span class="up_option" oid="'+o_id+'">'+def+'</span>';
                    }
                    oi.parent().html(str);
                }
            });

        })
        $("#out").click(function(){
            $("#problem_info").hide();
        })
        $(".show_info").click(function(){
            var present=$(this);
            var pid=present.attr("sid");
            var str="";
            var token=$("#tok").val();
            $.ajax({
                type:"post",
                url:"admin_ajax_pro",
                data:{
                    "_token":token,
                    p_id:pid
                },
                dataType:"json",
                success:function(data){
                    str+='<tr><td><span class="up_option" ids="id" k="exam_title" t="problem" oid="'+data.pro['id']+'">'+data.pro['exam_title']+'</span></td></tr>'
                    $.each(data['opt'],function(k,v){
                        str+='<tr><td><span class="up_option" ids="o_id" k="o_option" t="option" oid="'+v['o_id']+'">'+v['o_option']+'</span></td></tr>';
                    })
                    $("#infos_jyz").html(str);
                    $("#problem_info").show();
                }
            })
        })
        $(".del_pro").click(function(){
            var token=$("#tok").val();
            var id=$(this).attr("rid");
            var str=$(this);
            $.ajax({
                type:"post",
                url:"admin_ajax_del",
                data:{
                    _token:token,
                    id:id
                },
                success:function(data){
                    alert("删除成功");
                    str.parent().parent().remove();
                }
            })
        })

    })
</script>
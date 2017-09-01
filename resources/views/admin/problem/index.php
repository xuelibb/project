<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加试题</title>
    <script src=""></script>
    <style>
        .input_style_20{
            width: 30px;
        }
        .input_exam_20{
            width:450px;
        }
        .box_style_20{
            width: 750px;
            background-color: #ebfffc;
            height: auto;
        }
        #add_exam_20{
            cursor: pointer;
            color: #ff140c;
            font-weight: 900;
        }
        .jyz_remove_por{
            cursor: pointer;
        }
    </style>
</head>
<body>
<div>
    <form action="add/problem" method="post">
        <input type="hidden" name="_token"  value="<?php echo csrf_token(); ?>" />
        <table>
            <tr><td id="add_exam_20">添加题目</td></tr>
            <tbody id="opt1" class="box_style_20">
            <tr>
                <td>题目：</td>
                <td colspan="4"><input type="text" value="测试1" name="exam_title1" class="input_exam_20"></td>
            </tr>
            <tr>
                <td>选项：</td>
                <td><input type="text" value="选项1"  name="option1[]"></td>
                <td>分数：<input type="text" value="1" name="grade1[]" class="input_style_20"></td>
                <td>排序：<input type="text" value="1" name="order1[]" class="input_style_20"></td>
                <td class="add_opt_20" ids="1">添加选项<input type="hidden" name="num[]" id="1" value="1" class="num_20"></td>
            </tr>
            </tbody>
            <tr>
                <td><input type="submit" value="提交"> </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo public_path()?>\admin\js\jquery.js"></script>
<script>
    $(function(){
        //添加题目
        $("#add_exam_20").click(function(){
            var nuu=$(".num_20:last").attr("id");
            var num=parseInt(nuu)+1;
            var str='<tbody id="opt'+num+'" class="box_style_20">' +
                '<tr><td class="jyz_remove_por">删除此题</td></tr>' +
                '<tr>' +
                '<td>题目：</td>' +
                '<td colspan="4">' +
                '<input type="text" value="测试'+num+'" name="exam_title'+num+'" class="input_exam_20">' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>选项：</td>' +
                '<td>' +
                '<input type="text" value="选项'+num+'"  name="option'+num+'[]">' +
                '</td> ' +
                '<td>分数：<input type="text" name="grade'+num+'[]" class="input_style_20">' +
                '</td>' +
                '<td>排序：<input type="text" name="order'+num+'[]" class="input_style_20">' +
                '</td> ' +
                '<td class="add_opt_20" ids="'+num+'">添加选项<input type="hidden" name="num[]" id="'+num+'" value="'+num+'" class="num_20">' +
                '</td>' +
                '</tr>' +
                '</tbody>';
            $("#opt"+nuu).after(str);
        });
        //添加选项
        $(document).on("click",".add_opt_20",function()
        {
            var vars=$(this);
            var nuu=vars.attr("ids");
            var num=parseInt(nuu)+1;
            var str='<tr>' +
                '<td>选项：</td>' +
                '<td><input type="text"  name="option'+nuu+'[]">' +
                '</td>' +
                '<td>分数：<input type="text" name="grade'+nuu+'[]" class="input_style_20"></td>' +
                '<td>排序：<input type="text" name="order'+nuu+'[]" class="input_style_20"></td>' +
                '<td class="remove_opt_20">删除选项' +
                '</td>' +
                '</tr>';
            $("#opt"+nuu).append(str);
        })
        //删除题目
        $(document).on("click",".jyz_remove_por",function(){
            $(this).parent().parent().remove();
        })
        $(document).on("click",".remove_opt_20",function(){
            $(this).parent().remove();
        })
    })
</script>
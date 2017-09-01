<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>添加活动</title>
</head>
<style type="text/css">
    #tab{
        width: 100%;
        height: 600px;
        background-image: url('admin/images/555.jpg');
    }
</style>
<body>
<center>
<div id="tab">
<h1 style="color: lime">邀请注册</h1>
    <form action="invite_add?id={{$id}}" method="post">
        <table width="500px" height="250px">
            <tr>
              <td>请输入被邀请人邮箱:</td>
              <td>
                  <input type="email" name="email"></input>
              </td>
            </tr>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <tr>
              <td colspan="2"><input type="submit" value="邀请他（她）注册"></input></td>
            </tr>
        </table>
    </form>
</div>
</center>
</body>
</html>
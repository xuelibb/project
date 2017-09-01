<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<style>
    /*头部*/
    .header{
        height: 80px;
        width:auto;
        border: dashed;

    }
    #img{
        float: left;
        margin-left: 200px;
        margin-top: 10px;
    }
    #h3{
        float: right;
        margin-right: 500px;
        margin-top: 30px;
    }
    .main{
        height: 100px;
        width: auto;
        margin-top: 10px;
    }
    .main_left{
        height: 100px;
        width:200px;
        background-color:beige;
        float: left;
    }
    .main_center{
        height:100px;
        width:200px;
        background-color: #00aaee;
        float: left;
        margin-left: 250px;
    }
    .main_right{
        height: 100px;
        width:200px;
        background-color: #9a1e23;
        float: right;
    }
    .wrapper{
        border: 1px solid brown;
        margin-top: 20px;
    }
</style>

<body>
<center>
    <div class="header"><img src="uploads/1PwImHMYxc.jpg" height="50px" id="img" ><h3 id="h3">欢迎进入<font color="#ff7f50">招财喵</font>后台系统</h3></div>
    <div class="main">
        <div class="main_left">
            <h3>网站注册用户量：</h3>
            <h4>12人</h4>
        </div>
        <div class="main_center">
            <h3>网站累计成交金额：</h3>
            <h4>73000</h4>
        </div>
        <div class="main_right">
            <h3>网站今日收益：</h3>
            <h4>0元</h4>
        </div>
    </div>
    <div class='wrapper'>
        <div style="margin: 20px auto; text-align: center;">
        <a href="http://www.100sucai.com/" target="_blank"><h3>网站成交量展示：</h3></a>
        </div>
        <canvas height='300' id='canvas' width='900'></canvas>
    </div>

    <script src='js/Chart.min.js'></script>

    <script src="js/index.js"></script>

</center>

</body>
</html>

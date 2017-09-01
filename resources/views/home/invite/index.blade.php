<link rel="stylesheet" href="admin/css/pintuer.css">
<link rel="stylesheet" href="admin/css/admin.css">
<script src="admin/js/jquery.js"></script>
<script src="admin/js/pintuer.js"></script>
<body>
<style>
    #tabs tr td{
        text-align: center;
    }
</style>
<div class="ww" style="line-height: 33px">
    <!--头部开始-->
    <?php include "layout/home/header.php";?>
    <div class="ww both">
        <div class="bg_color1">
            <div class="wl mtauto ofh">
                <?php include "layout/home/user.php";?>
                    <div class="fr content-right-x22 bg_color2">
              <div class="panel admin-panel" style="border: 0">
                <div class="panel-head"><strong class="icon-reorder"> 活动列表</strong></div>
                <div class="padding border-bottom">
                </div>
                @if(!empty($data))
                <table class="table table-hover text-center" id="tabs">
                  <tr>
                    <th>活动名称</th>
                    <th>活动时间</th>
                    <th>详情</th>
                  </tr>
                  @foreach($data as $k=>$v)
                    <tr>
                      <td>{{$v['activity_name']}}</td>
                      <td>{{date("Y-m-d H:i:s",$v['start_time'])}}~~{{date("Y-m-d H:i:s",$v['end_time'])}}</td>
                      <td>
                      <div class="button-group"> <a class="button border-red" href="invite_one?id={{base64_encode($v['activity_id'])}}"><span class="icon-trash-o"></span> 点击邀请注册</a> </div>
                      </td>
                    </tr>
                  @endforeach
                </table>
                @else
                <center>
                  <h1>目前没有任何活动</h1>
                </center>
                @endif
              </div>
                    </div>
            </div>
            </div>
            </div>
            </div>
            {{include_once "layout/home/footer.php"}}
<script type="text/javascript"></script>
</body></html>
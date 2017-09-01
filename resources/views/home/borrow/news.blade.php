  <link rel="stylesheet" href="admin/css/pintuer.css">
  <link rel="stylesheet" href="admin/css/admin.css">
  <script src="admin/js/jquery.js"></script>
  <script src="admin/js/pintuer.js"></script>
<body>
<div class="ww" style="line-height: 33px">
  <!--头部开始-->
    <?php include "layout/home/header.php";?>
</div>
<div class="ww both">
  <div class="bg_color1">
    <div class="wl mtauto ofh">
        <?php include "layout/home/user.php";?>
      <div class="fr content-right-x22 bg_color2">

<div class="panel admin-panel" style="border: 0">
  <div class="content-right-x2-title bdbt_e6">
    <h3 class="fl pr25 fs22">我要借款</h3>
  </div>
  <center>
  <div class="body-content">
    <form method="post" class="form-x" action="borrow_bor">
      <div class="form-group"  style="width: 1000px">
        <div class="label">
          <label>域名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="{{$lend_goods}}" name="lend_goods" data-validate="required:请输入域名" readonly/>
        </div>
      </div>
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group" style="width: 1000px">
        <div class="label">
          <label>年化利率：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="lend_return" data-validate="required:请输入年化利率，以%结尾" />
          <div class="tips">请输入年化利率，以数字开头，以%结尾，只能是8-15%之间，例如10%</div>
        </div>
      </div>
      <div class="form-group" style="width: 1000px">
        <div class="label">
          <label>借款金额：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="lend_money" data-validate="required:请输入借款金额" id="money"/>
          <div class="tips" id="tis">请输入借款金额，直接输入数字就可</div>
        </div>
      </div>
      <div class="form-group" style="width: 1000px">
        <div class="label">
          <label>抵押物价值：</label>
        </div>
        <div class="field">
          <input type="text" id="mon" class="input w50" value="{{$lend_worth}}" name="lend_worth" data-validate="required:请输入抵押物价值" readonly/>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group" style="width: 1000px">
        <div class="label">
          <label>还款期限：</label>
        </div>
        <div class="field">
          <select name="lend_repay_time" class="input w50">
            <option value="">请选择还款期限</option>
            <option value="1">一个月</option>
            <option value="2">二个月</option>
            <option value="3">三个月</option>
            <option value="4">四个月</option>
            <option value="5">五个月</option>
            <option value="6">半年</option>
            <option value="7">七个月</option>
            <option value="8">八个月</option>
            <option value="9">九个月</option>
            <option value="10">十个月</option>
            <option value="11">十一个月</option>
            <option value="11">一年</option>

          </select>
          <div class="tips">必须选择期限</div>
        </div>
      </div>

      <div class="form-group" style="width: 1000px">
        <div class="label">
          <label>还款方式：</label>
        </div>
        <div class="field">
          <select name="lend_repay_method" class="input w50">
            <option value="">请选择还款方式</option>
            <option value="1">等额本息</option>
            <option value="2">先息后本</option>
          </select>
          <div class="tips">必须选择方式</div>
        </div>
      </div>

      <div class="field">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="button bg-main icon-check-square-o" type="submit"> 我要借款</button>
      </div>
    </form>
  </div>
  </center>
</div>
</div>
    </div>
  </div>
</div>

{{include_once "layout/home/footer.php"}}
</body></html>
  <script>
      $(document).on('blur','#money',function () {
          var money=$(this).val();
          var mon=$("#mon").val();
          if(parseInt(money)>parseInt(mon)){
//              $(this).attr('data-validate','required:您输入的金额不能大于域名的估价')
              $('#tis').html('<font color="red">您输入的价格大于域名估价</font>');
              return false;
          }else{
              $('#tis').html('<font color="green">OK</font>');
          }
      });
  </script>
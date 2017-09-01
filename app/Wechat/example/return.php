<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017/6/7
 * Time: 11:52
 */
   include_once  '../lib/WxPay.Data.php';
    //异步处理业务

   $input=new WxPayDataBase();
    //把接收的XML数据转换为数组
   //$data=$input->FromXml($GLOBALS['HTTP_RAW_POST_DATA']); //此方法在PHP7.0被废弃
   $data=$input->FromXml(file_get_contents('php://input')); //此方法同上面一样，可以接收POST数据，也可以接收XML数据
   //file_put_contents(time().'.log',$data);
   //file_put_contents('4.log',json_encode($data));
    //签名认证
      $pay=new WxPayResults();
//给类的属性进行赋值，值为微信服务器返回的接口信息
//      $pay->values=$data;
       //签名认证
      $res=$pay->CheckSign();
      if($res){
         if($data['trade_state']=='SUCCESS'){
          //处理业务逻辑
          //修改订单支付状态、减少库存
            //当处理完成后告知微信服务平台已经处理成功，这样微信平台就不再发消息给我，否则会在半小时内发8次通知
          echo '<xml>
            <return_code><![CDATA[SUCCESS]]></return_code>
            <return_msg><![CDATA[OK]]></return_msg>
          </xml>';
         }
       // file_put_contents('5.log','yes');
      }else{
       file_put_contents('6.log','no');
      }


    /*
     *  自定义的验证方法
    //用户接收的签名
     $access_sign=$data['sign'];
    //根据相关的参数计算签名
    //签名步骤一：按字典序排序参数
    ksort($data);
    $string =ToUrlParams($data);
    //签名步骤二：在string后加入KEY
    $string = $string . "&key=".WxPayConfig::KEY;
    //签名步骤三：MD5加密
    $string = md5($string);
    //签名步骤四：所有字符转为大写
    $result = strtoupper($string);

    //比对签名
     if($result==$access_sign){
        file_put_contents('3.log','yes');
     }else{
      file_put_contents('4.log','yes');
     }
        //签名处理
      function ToUrlParams($data){
         $buff = "";
        foreach ($data as $k => $v) {
         if($k != "sign" && $v != "" && !is_array($v)){
          $buff .= $k . "=" . $v . "&";
         }
        }
        $buff = trim($buff, "&");
        return $buff;
   }
  */





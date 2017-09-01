<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/6/23
 * Time: 15:34
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Model\Home\Recharge;
use Illuminate\Http\Request;
use DB;

class AlipayController extends Controller
{
    public function pay(Request $request){
        //判断是否登录
        if(session('islogin')!=1){
            return redirect('login');
        }
        //判断数据是否用post提交
        if($request->isMethod('post')){
            $post=$request->input();
            if($post['pay']=='alipay'){
                return $this->alipay($post);
            }elseif ($post['pay']=='weixinpay'){
//
                return $this->weixinPay($post);
            }
        }
    }
    //阿里支付
    public function alipay($post){
//            $money=$post['recharge_amount'];
            $money=0.01;
            if($money<0.01){
                $money=0.01;
            }
//            dd($post);
            //用户订单
            $tradeno=uniqid().time();
            $alipay = app('alipay.web');
            $alipay->setOutTradeNo($tradeno);
            $alipay->setTotalFee($money);
            $alipay->setSubject('招财喵贷');
            $alipay->setBody('对余额进行充值');
            $alipay->setQrPayMode('5'); //该设置为可选1-5，添加该参数设置，支持二维码支付
            //进行创建订单
            $user_id=session('user_id');
            $recharge_time=date("Y-m-d H:i:s",time());
            $status=Recharge::CREATEORDER;
            $recharge=DB::table('recharge')->insert(['user_id'=>$user_id,'recharge_money'=>$money,'recharge_order'=>$tradeno,'recharge_time'=>$recharge_time,'status'=>$status,'recharge_type'=>'支付宝']);
            // 跳转到支付页面。
            return redirect()->to($alipay->getPayLink());
    }
    //微信支付页面
    public function weixinPay($post){
        //获取金钱
//        $money=$post['recharge_amount']*100;
        $money=1;
        require_once app_path()."/Wechat/lib/WxPay.Api.php";
//        echo 1;die;
        require_once app_path()."/Wechat/example/WxPay.NativePay.php";
        require_once app_path().'/Wechat/example/log.php';
        $notify = new \NativePay();
        $input = new \WxPayUnifiedOrder();
        //var_dump($notify);die;
        //echo 1;die;
        $input->SetBody("充值");
        $input->SetAttach("test");
        //生成订单号
        $num=\WxPayConfig::MCHID.date("YmdHis");
        //$num='2222223222222';
        $input->SetOut_trade_no($num);
        //订单总金额，单位是分
        $input->SetTotal_fee($money);

        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 300));
        $input->SetGoods_tag("test");
        //异步通知地址
        $input->SetNotify_url("http://www.xlibb.top/wechat/return");
        //扫码支付设置
        $input->SetTrade_type("NATIVE");
        //商品ID
        $Product_id=time().uniqid();
        $input->SetProduct_id($Product_id);
//        var_dump($input);die;
        $result = $notify->GetPayUrl($input);
        //var_dump($result);die;
        $url2 = urlencode($result["code_url"]);
//        echo $url2;die;
        //将订单存入数据库
        $user_id=session('user_id');
        DB::table('recharge')->insert(['user_id'=>$user_id,'recharge_money'=>$money/100,'recharge_order'=>$num,'recharge_time'=>date("Y-m-d H:i:s",time()),'status'=>Recharge::CREATEORDER,'recharge_type'=>'微信']);
        return view("home.wechat.native",['url2'=>$url2,'num'=>$num]);
    }
    //微信回调页面
    public function wechatreturn(Request $request){
//
//        dd(json_decode($arr));
        include_once  app_path().'/Wechat/lib/WxPay.Data.php';
        $input=new \WxPayDataBase();
        //把接收的XML数据转换为数组
        $data=$input->FromXml(file_get_contents('php://input')); //此方法同上面一样，可以接收POST数据，也可以接收XML数据
        $all=json_encode($data);
        $recharge_time=date("Y-m-d H:i:s",time());
        $recharge_order=$data['out_trade_no'];
        $recharge_money=$data['total_fee']/100;
//        file_put_contents('3.log',json_encode($data));
        $pay=new \WxPayResults();
        $pay->FromArray($data);
        //签名认证
        $res=$pay->CheckSign();
      if($res){
            if($data['result_code']=='SUCCESS'){

                //根据订单获取用户ID
                $user_id=DB::table('recharge')->where('recharge_order',$recharge_order)->value('user_id');
//                file_put_contents('2.log',$user_id);
                DB::beginTransaction();
                try{
                    if(empty($user_id)){
                        throw new \Exception();
                    }
                    //对该用户的余额进行修改
                    $update_recharge=DB::table('user_details')->where('details_id',$user_id)->increment('details_balance',$recharge_money);
                    if(!$update_recharge){
                        throw new \Exception();
                    }
                    //进行添加用户的充值记录进行修改
                    $recharge=DB::table('recharge')->where('recharge_order',$recharge_order)->update(['recharge_all'=>$all,'recharge_success_time'=>$recharge_time,'status'=>Recharge::PAYSUCCESS]);
                    if(!$recharge){
                        throw new \Exception();
                    }
                    DB::commit();
                }catch (\Exception $e){
                    DB::rollBack();
                }
             echo '<xml>
            <return_code><![CDATA[SUCCESS]]></return_code>
            <return_msg><![CDATA[OK]]></return_msg>
            </xml>';
            }
        }

    }
    //同步通知
    public function AliPayReturn(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
    // 验证请求。
        if (!app('alipay.web')->verify())
        {
            return redirect('/alipay/fail');
        }
        $post=$request->input();
        if($post['trade_status']=='TRADE_SUCCESS')
        {
//            return view('home.recharge.success');
            return redirect('success');
        }
//        trade_no=2017062421001004360292306407&trade_status=TRADE_SUCCESS
    }
    //加载付款失败页面
    public function pay_fail(){
        return view('home.recharge.fail');
    }
    //加载付款成功页面
    public function pay_success(){
        return view('home.recharge.success');
    }
    //异步通知
    public function aliPayNotify(Request $request){

        // 验证请求。
        if (!app('alipay.web')->verify()) {
            return 'fail';
        }
        $post=$request->input();
        $all=json_encode($post);
        $recharge_time=$post['notify_time'];
        $recharge_order=$post['out_trade_no'];
        $recharge_money=$post['total_fee'];
        //根据订单获取用户ID
        $user_id=DB::table('recharge')->where('recharge_order',$recharge_order)->value('user_id');
        // 判断通知类型。
        if($post['trade_status']=='TRADE_SUCCESS')
        {
//            echo 1;
//            //进行操作数据库,首先进行修改余额
            DB::beginTransaction();
            try{
                if(empty($user_id)){
                    throw new \Exception();
                }
                //对该用户的余额进行修改
                $update_recharge=DB::table('user_details')->where('details_id',$user_id)->increment('details_balance',$recharge_money);
                if(!$update_recharge){
                    throw new \Exception();
                }
                //进行添加用户的充值记录进行修改
                $recharge=DB::table('recharge')->where('recharge_order',$recharge_order)->update(['recharge_all'=>$all,'recharge_success_time'=>$recharge_time,'status'=>Recharge::PAYSUCCESS]);
                if(!$recharge){
                    throw new \Exception();
                }
                DB::commit();
            }catch (\Exception $e){
                DB::rollBack();
            }
            return 'success';
        }
    }

    //微信订单查询
    public function orderquery(){
        require_once app_path()."/Wechat/lib/WxPay.Api.php";
        if(isset($_REQUEST["out_trade_no"]) && $_REQUEST["out_trade_no"] != ""){
            $out_trade_no = $_REQUEST["out_trade_no"];
            $input = new \WxPayOrderQuery();
            $input->SetOut_trade_no($out_trade_no);
            $result=\WxPayApi::orderQuery($input);
            return $result['trade_state'];
        }
    }
}
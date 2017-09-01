<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/7/13
 * Time: 10:02
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Flc\Alidayu\Support;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Cache;
use Carbon\Carbon;


class BankController extends Controller
{
    public function index(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.bank.bank_info');
    }

    //绑定银行卡号
    public function binding_bank_card(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.bank.binding_bank_card');
    }

    //获取银行类型
    public function get_bank_info(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
        //判断是否是post传值
        if($request->isMethod('post')){
            $card=$request->input('bank_card');
            if(empty($card)){
                return ['msg'=>'银行卡号不能为空'];
            }
            //获得银行卡号的前6位，进行银行卡匹配查询
            $bank_front=substr($card,0,6);
            $bank_info=DB::table('bank_name')->where('bank_front',$bank_front)->first();
            if(!$bank_info){
                return ['msg'=>'对不起，暂不支持该银行'];
            }
            return $bank_info;
        }

    }

    //短信验证码
    public function phone_client(Request $request){
        if($request->isMethod('post')){
            $post=$request->input();
            //获取随机数
            $set=new Support();
            $number=$set->randStr();
            $name=session('user_user');
            $phone=$post['phone_no'];
            $config = [
                'app_key'    => '24493891',
                'app_secret' => 'fb1a6f927a2f0ec8adff05b77f59776c',
            ];
            $client = new Client(new App($config));
            $req    = new AlibabaAliqinFcSmsNumSend;
            $req->setRecNum($phone)
                ->setSmsParam([
                    'name'=>$name,
                    'number' => $number
                ])
                ->setSmsFreeSignName('薛里巴巴')
                ->setSmsTemplateCode('SMS_71810311');

            $resp = $client->execute($req);
            if($resp->result->success){
                //设置验证码过期时间
                $expiresAt = Carbon::now()->addMinutes(5);
                Cache::put($phone, $number, $expiresAt);
                return ['code'=>1,'msg'=>'发送成功'];
            }
        }

    }

    public function binding_bank_card_advance(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
        if($request->isMethod('post')){
            $data=$request->input();
            $bank_card=$data['bank_account_no'];
            $user_id=session('user_id');
            $bank_name_id=$data['bank_id'];
            $phone_no=$data['phone_no'];
            $valid_code=$data['valid_code'];
            //获取验证码，先判断手机验证码是否正确
            $cache=Cache::get($phone_no);
            if($valid_code!=$cache){
                return ['msg'=>'验证码错误，请检查核对！'];
            }
            //查询该银行卡是否绑定
            $bank_only=DB::table('bank_card')->where('bank_card',$bank_card)->first();
            if($bank_only){
                return ['msg'=>'该银行已经被绑定，请先解绑后再进行绑定！'];
            }
            //验证码验证成功则进行入库操作
            $bank_info=DB::table('bank_card')->insert(['bank_card'=>$bank_card,'user_id'=>$user_id,'bank_name_id'=>$bank_name_id]);
            if($bank_info){
                return ['code'=>1];
            }
            return ['msg'=>'绑定失败，请联系客服！'];
        }
    }
    //解绑银行卡
    public function unbinding_bank_card(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
        if($request->isMethod('post')){
            $card_id=$request->input('card_id');
            //查询用户金额是否为空，不为空不能进行解绑
            $user_id=session('user_id');
            $yue=DB::table('user_details')->where('details_user_id',$user_id)->value('details_balance');
            if($yue!=0.00){
                return ['msg'=>'解绑失败，您还有余额还未进行提现'];
            }
            //根据ID进行删除
            $bank_del=DB::table('bank_card')->where('bank_id',$card_id)->delete();
            if($bank_del){
                return ['code'=>1000,'msg'=>'解绑成功'];
            }
            return ['msg'=>'解绑失败，请联系管理员'];
        }

    }

}
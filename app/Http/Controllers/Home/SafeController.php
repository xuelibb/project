<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Home\User_details;
use Illuminate\Support\Facades\DB;
use App\Model\Home\User;
use Hash;
use Mail;
use Carbon\Carbon;
use Cache;

class SafeController extends Controller
{
    public function index(){

        return view('home.safe.index');
    }
    public function user_safe(){
        //判断用户是否进行登录
        if(session('islogin')!=1){
            return redirect('login');
        }

        //实例化model
        $user_id=session('user_id');
        $model=User_details::where('details_user_id',$user_id)->first();
        //查询当前用户是否有绑定银行卡
        $brank=DB::table('bank_card')->where('user_id',$user_id)->get();
        $phone=DB::table('user')->where('user_id',$user_id)->value('user_tel');
        $phone = substr_replace($phone,'****',3,4);
        return view('home.user_info.safe',['model'=>$model,'brand'=>$brank,'phone'=>$phone]);
    }

    public function user_card_add(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
        //判断是否是POST提交
        if($request->isMethod('post')){
            //接收值
            $post=$request->input();
            //实例化Model
            $model=new User_details();
            return $model->details_add($post);
        }
    }

    //支付密码
    public function user_pay_pwd(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
        //判断是否是POST提交
        if($request->isMethod('post')){
            //接收值
            $post=$request->input();
            $pay_pwd=md5($post['pay_pwd']);
            //实例化Model
            $user_id=session('user_id');
            $info=DB::table('user_details')->where('details_user_id',$user_id)->update(['details_pay'=>$pay_pwd]);
            if($info){
                return ['msg'=>'添加成功','code'=>1];
            }
        }

    }

    //修改支付密码
    public function upload_pay_pwd(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
        //判断是否是POST提交
        if($request->isMethod('post')){
            //接收值
            $post=$request->input();
            //检测旧密码是否一致
            $user_id=session('user_id');
            $old_pay_pwd=$post['old_pay_pwd'];
            $old_pwd=DB::table('user_details')->where('details_user_id',$user_id)->select('details_pay')->first();
            if (md5($old_pay_pwd)!= $old_pwd['details_pay']){
                return ['msg'=>'旧密码输入错误，请重新核对','code'=>2,'hash'=>$old_pay_pwd];
            }
            $pay_pwd=md5($post['upload_pay_pwd']);
            //实例化Model
            $info=DB::table('user_details')->where('details_user_id',$user_id)->update(['details_pay'=>$pay_pwd]);
            if($info){
                return ['msg'=>'修改成功','code'=>1];
            }
        }
    }
    //修改登录密码
    public function upload_login_pwd(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
        if($request->isMethod('post')){
            $post=$request->input();
            //实例化usermodel
            $model=new User;
            return $model->upload_login_pwd($post);
        }
        
    }

    //修改手机号码
    public function change_phone(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.user_info.change_phone');
    }

    //添加邮箱
    public function add_email(Request $requests){
        if(session('islogin')!=1){
            return redirect('login');
        }
        if($requests->isMethod('post')){
            $email=$requests->input('email');
            $user_id=$requests->session()->get('user_id');
            $user_user=$requests->session()->get('user_user');
            $token=time().uniqid().base64_encode($user_id);
            //将token值存入memcache中
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put($user_id, $token, $expiresAt);
            if(empty($email)){
                return ['msg'=>'请输入正确的邮箱！'];
            }
            define('EMAIL', $email);

            if(empty($user_id)){
                return ['msg'=>'绑定失败，请联系客服'];
            }
            $res=Mail::send('home.safe.email',
                ['user_user'=>$user_user,
                    'user_id'=>base64_encode($user_id),
                'email'=>base64_encode($email),
                'token'=>$token],
                function ($message) {
                    $message ->to(EMAIL)->subject('绑定您的邮箱');
                });
            if(!$res){
                return ['msg'=>'发送邮件失败，网络异常！'];
            }
            return ['code'=>1,'msg'=>'发送成功'];
        }
    }

    public function activate(Request $request){
        $user_id=base64_decode($request->input('user_id'));
        $email=base64_decode($request->input('email'));
        $token=$request->input('token');
        //获取token值
        $check_token=Cache::get($user_id);
//        dd($token);
        if($token!=$check_token){
            return '激活失败，链接已经过期！！！';
        }
        //修改当前用户的邮箱
        $info=DB::table('user_details')->where('details_user_id',$user_id)->update(['details_email'=>$email]);
        if(!$info){
            return '激活失败,请联系客服！！！';
        }
        Cache::forget($user_id);
        return '<center><font size="35px" color="red">激活成功</font></center>';
    }


}
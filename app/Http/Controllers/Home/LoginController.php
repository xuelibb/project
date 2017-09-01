<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Model\Home\User;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Support;
use Cache;
class LoginController extends Controller
{
    public function index(Request $request){

        if($request->isMethod('post'))
        {
            $post=$request->input();
//            return $post;
            //利用model层判断
            $user=new User();
            $extix=$user->where('user_user',$post['user'])->orwhere('user_tel',$post['user'])->first();
            if(!$extix) {
                return back()->with('msg','账号不存在,请核对您的账户');
            }
            if(md5($post['pwd'])!=$extix->user_pwd){
                return back()->with('msg','密码错误，请重新输入');
            }

            //存入用户名
            session()->put('user_user',$extix->user_user);
            //存入用户ID
            session()->put('user_id',$extix->user_id);
            session()->put('number',$extix->number);
            //判断是否登录值
            session()->put('islogin',1);
            session()->put('assess',$extix->assess);
            return redirect('/');

        }
//        dd($oauth);
        return view('home.login.login');
    }
    //验证码类
    public function captcha($tmp)
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    //退出操作
    public function logout(){
        //全部清空session
        session()->forget('user_user');
        session()->forget('user_id');
        session()->forget('islogin');
        session()->forget('assess');
        return redirect('/');
    }
    //第三方登录
    public function redirectToProvider(Request $request,$service)
    {
//        echo 1;
        return \Socialite::driver($service)->redirect();
    }
    //第三方回调
    public function handleProviderCallback(Request $request,$service)
    {

        //判断用户是否进行绑定
        $user = \Socialite::driver($service)->user();
        $oauth=1;
        if($service=='weibo'){
            $oauth=2;
        }
        //获取用户唯一ID
        $id=$user->id;
        //获取用户用户名
        $data['nickname']=$user->nickname;
        $data['id']=$id;
        $data['oauth_id']=$oauth;
        //获取用户头像
        $data['avatar']=$user->avatar;
        //进行判断用户是否绑定账户，没有绑定则进行绑定，否则直接进行登录
        $user_id=DB::table('oauth_user')->where('oauth_user_id',$id)->value('user_id');
        if($user_id){
            $username=DB::table('user')->where('user_id',$user_id)->value('user_user');
            //存入用户名
            session()->put('user_id',$user_id);
            //存入用户ID
            session()->put('user_user',$username);
            //判断是否登录值
            session()->put('islogin',1);
            return redirect('/');
        }
        //将数组存入session之中
        session()->put('data',$data);
        return redirect('/oauth_reg');
    }
    //第三方注册
    public function oauth_reg(Request $request){
        if($request->isMethod('post')){
            $post=$request->input();
            //获取当前用户的手机号码
            $user=new User();
            return $user->add_oauth($post);
        }
        //判断是否用post 提交
        $data=session('data');
        return view('home.login.binding',['data'=>$data]);
    }
    //第三方登录
    public function oauth_bind(Request $request){
        if($request->isMethod('post')){
            $post=$request->input();
            //获取当前用户的手机号码
            $user=new User();
            return $user->bind_oauth($post);
        }
    }

    //短信验证码
    public function client(Request $request){
        if($request->isMethod('post')){
            $post=$request->input();
            //获取随机数
            $set=new Support();
            $number=$set->randStr();
            $name=$post['name'];
            $phone=$post['phone'];
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
}

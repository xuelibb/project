<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/6/13
 * Time: 23:36
 */
namespace App\Model\Home;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use DB;
use Cache;
class User extends Model
{
    protected $table='user';
    protected $primaryKey='user_id';
    public function useradd($post){
        $username=$post['user'];
        $password=md5($post['login_pwd']);
        $phone=$post['phone'];
        $phone_code=$post['phone_code'];
        $activity_id=$post['activity_id'];
        $invite_id=$post['invite_id'];
        //查询用户名是否存在
        $user_exists=$this->where('user_user',$username)->exists();
        if($user_exists){
            //清除手机验证码缓存
            return ['code'=>'4','msg'=>'账号已经存在'];
        }
        $phone_exists=$this->where('user_tel',$phone)->exists();
        if($phone_exists){
            Cache::forget($phone);
            return ['code'=>'3','msg'=>'手机号码已经存在'];
        }
        //获取当前保存的验证码
        $phone_cache=Cache::get($phone);
        if($phone_cache==null){
            return ['code'=>'5','msg'=>'请输入正确的手机验证码'];
        }
        if($phone_code!=$phone_cache){
            return ['code'=>'2','msg'=>'手机短信验证码错误'];
        }
        $this->user_user=$username;
        $this->user_pwd=$password;
        $this->user_tel=$phone;
        $this->invite_id=$invite_id;
        $this->activity_id=$activity_id;
        if($this->save()){
            session()->put('user_user',$this->user_user);
            //存入用户ID
            session()->put('user_id',$this->user_id);
            //判断是否登录值
            session()->put('islogin',1);
            \Illuminate\Support\Facades\DB::table('user_details')->insert(['details_user_id'=>$this->user_id]);
            return ['code'=>'1','msg'=>'注册成功'];
        }
    }

    public function upload_login_pwd($post){
        $old_pwd=md5($post['old_pwd']);
        $new_pwd=$post['new_pwd'];
        $re_new_pwd=$post['re_new_pwd'];
        $user_id=session('user_id');
        $user=User::find($user_id);
        if($old_pwd!=$user->user_pwd){
            return ['msg'=>'请核对旧密码','code'=>2];
        }
        if($new_pwd!=$re_new_pwd){
            return ['msg'=>'两次密码不一致','code'=>3];
        }
        $user->user_pwd=md5($new_pwd);
        if($user->save()){
            session()->forget('user_user');
            session()->forget('user_id');
            session()->forget('islogin');
            return ['msg'=>'修改成功','code'=>1];
        }
    }

    public function add_oauth($post){
        $user_user=$post['user_name'];
        $open_id=$post['open_id'];
        $password=md5($post['password']);
        $phone=$post['phone'];
        $oauth=$post['oauth'];
        $user_exists=$this->where('user_user',$user_user)->exists();
        if($user_exists){
            return ['code'=>'4','msg'=>'账号已经存在'];
        }
        $phone_exists=$this->where('user_tel',$phone)->exists();
        if($phone_exists){
            return ['code'=>'3','msg'=>'手机号码已经存在'];
        }
        $this->user_user=$user_user;
        $this->user_pwd=$password;
        $this->user_tel=$phone;
        if($this->save()){
            session()->put('user_user',$this->user_user);
            //存入用户ID
            session()->put('user_id',$this->user_id);
            //判断是否登录值
            session()->put('islogin',1);
            DB::table('user_details')->insert(['details_user_id'=>$this->user_id]);
            $info=DB::table('oauth_user')->insert(['oauth_user_id'=>$open_id,'oauth_id'=>$oauth,'user_id'=>$this->user_id]);
            if($info){
                return ['code'=>'1','msg'=>'注册成功,即将跳转'];
            }

        }
    }

    //绑定用户
    public function bind_oauth($post){
        $phone=$post['user_name'];
        $open_id=$post['open_id'];
        $pwd=$post['password'];
        $oauth_id=$post['oauth'];
        //查询当前手机是否存在
        $phone_exists=$this->where('user_tel',$phone)->first();
        if(!$phone_exists){
            return ['code'=>'3','msg'=>'手机号码不存在，请核对'];
        }
        //核对用户否正确
        if(md5($pwd)!=$phone_exists->user_pwd){
            return ['code'=>'2','msg'=>'密码错误，请重新输入'];
        }
        //否则进行绑定
        $info=DB::table('oauth_user')->insert(['oauth_user_id'=>$open_id,'oauth_id'=>$oauth_id,'user_id'=>$phone_exists->user_id]);
        if($info){
            session()->put('user_user',$phone_exists->user_user);
            //存入用户ID
            session()->put('user_id',$phone_exists->user_id);
            //判断是否登录值
            session()->put('islogin',1);
            return ['code'=>'1','msg'=>'绑定成功,即将跳转'];
        }
    }
}
?>
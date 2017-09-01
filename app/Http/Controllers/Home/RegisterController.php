<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Model\Home\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
class RegisterController extends Controller
{
    public function index(Request $request){
        //判断是否有数据提交
        $oauth=DB::table('oauth')->get();
        if($request->isMethod('post'))
        {
            //接收用户注册的信息
            $post=$request->input();
            //实例化model
            $user=new User();
            //调用model层方法进行添加用户信息
             return $user->useradd($post);
        }
        @$id=base64_decode(Input::get('id'));
        //echo $id;die;
        @$user_id=base64_decode(Input::get('user_id'));
        //echo $user_id;die;
        if($id && $user_id){
            return view('home.register.index',['id'=>$id,'user_id'=>$user_id,'oauth'=>$oauth]);
        }else{
            return view('home.register.index',['oauth'=>$oauth]);
        }
    }

}
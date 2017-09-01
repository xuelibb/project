<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
	public function index(){
		return view('admin/login/index');
	}
	public function login_do(Request $request){
		$data=$request->input();
		$user_name=$data['user_name'];
		$user_password=md5($data['user_password']);
		// unset($data['_token']);
		$datas=DB::table('admin_user')->where(['user_name'=>$user_name,'user_password'=>$user_password])->get();
		if($datas){
			$request->session()->set('admin_id',$datas[0]['user_id']);
			$request->session()->set('admin_name',$datas[0]['user_name']);
			return $this->success('登录成功','admin_index');
		}else{
			return $this->error('登录失败','admin_login');
		}
	}
	public function verify(){
		$str='';
		for($i=0;$i<=4;$i++){
			$num=rand(0,9);
			if($num%3==0){
				$str.=$num;
			}else if($num%3==1){
				$str.=chr(rand(97,122));
			}else if($num%3==2){
				$str.=chr(rand(65,90));
			}
		}
		echo $str;
	}
	public function logout(Request $request){
		$request->session()->forget('admin_id');
		return $this->success('退出成功','admin_login');
	}
}
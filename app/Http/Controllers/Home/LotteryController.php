<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Model\Home\Lottery;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
class LotteryController extends Controller
{
    public function index(){
    	$model=new Lottery();
    	$data=$model->one("state",'1');
    	$new=time();
    	foreach($data as $k => $v){
    		if(!($v['start_time']<=$new && $v['end_time']>=$new && $v['status']==1)){
    			unset($data[$k]);
    		}
    	}
    	// print_r($data);die;
        return view('home.lottery.index',['data'=>$data]);
    }
    public function info(Request $request){
    	$id=Input::get('id');
    	//判断是否登录
    	$user_id=$request->session()->get('user_id');
    	//$user_id=1;
    	if($user_id){
    		return view('home.lottery.info',['id'=>$id,'user_id'=>$user_id]);
    	}else{
    		echo "<script>alert('亲，请先登录偶！');location.href='login';</script>";
    	}
    }
    public function ajaxs(Request $request){
    	$data=$request->input();
    	//print_r($data);die;
    	$activity_id=$data['id'];
    	$user_id=$data['user_id'];
    	$txt=$data['txt'];
    	$time=time();
    	$res=DB::table('get')->insert([
    		'activity_id'=>$activity_id,
    		'user_id'=>$user_id,
    		'txt'=>$txt,
    		'time'=>$time
    	]);
    	if($res){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
}

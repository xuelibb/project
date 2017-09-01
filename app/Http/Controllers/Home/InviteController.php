<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Model\Home\Lottery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
class InviteController extends Controller
{
    public function invite_list_data(){

        return view('home.invite.invite_list_data');
    }


	public function index(){
		$model=new Lottery();
		$data=$model->one('state',0);
		$time=time();
		foreach ($data as $k => $v) {
			if(!($v['start_time']<=$time && $v['end_time']>=$time && $v['status']==1)){
				unset($data[$k]);
			}
		}
		return view('home.invite.index',['data'=>$data]);
	}
	public function adds(){
		$id=Input::get('id');
		return view('home.invite.add',['id'=>$id]);
	}
	public function add(Request $request){
		//$user_id=2;
		//验证用户是否登录
		$email=$request->input('email');
		if(!$email){
		    return $this->error('邮箱不能为空',url('invite'));
        }
		define('EMAIL', $email);
		$user_id=$request->session()->get('user_id');
		if($user_id){
			$id=base64_decode(Input::get('id'));
			//echo $id;die;
			//$user_user="老景";
			//echo $email;die;
			//用户名
			$user_user=$request->session()->get('user_user');
			$res=Mail::send('home.invite.email',
				['user_user'=>$user_user,
				 'user_id'=>base64_encode($user_id),
				 'id'=>base64_encode($id)],
				 function ($message) {
		    	$message ->to(EMAIL)->subject('邀请注册');
			});
			if($res){
			    return $this->success('邮箱发送成功',url('invite'));
			}else{
                return $this->error('邮箱发送失败',url('invite'));
			}
		}else{
            return $this->error('亲，请先登录偶',url('login'));
		}
	}

}
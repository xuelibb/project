<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Model\Home\User_details;
use DB;
use Illuminate\Http\Request;

class RechargeController extends CommonController {
    public function index(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.recharge.index');
    }
    public function fundlist(){
//        $str="<script>alert();</script>";
//        echo strip_tags($str);
//        echo phpinfo();
        if(session('islogin')!=1){
            return redirect('login');
        }
        $user_id=session('user_id');
        //查看当前用户的充值记录
        $charge=DB::table('recharge')->where('user_id',$user_id)->paginate(11);
//        dd($charge);
        return view('home.recharge.fund',['recharge'=>$charge,'page'=>$charge]);

    }

    public function withdraw(Request $request){
        //判断用户是否进行登录，没有登录无法提现
        if(session('islogin')!=1){
            return redirect('login');
        }
        //进行post提交检测，是否进行post提交数据
        if($request->isMethod('post')){
            //接收用户数据
            $post=$request->input();
            //获取体现金额
            $withdraw_money=$post['withdraw_amount'];
            //获取当前用户的ID
            $user_id=session('user_id');
            $time=date("Y-m-d H:i:s",time());
            //查询当前用户的余额，是否符合体现标准
            $balance=DB::table('user_details')->where('details_user_id',$user_id)->value('details_balance');
            if($withdraw_money>$balance){
                return back()->with('msg','余额不足');
            }
            //符合要求进行添加至提现表
            $withdraw=DB::table('withdraw')->insert(['withdraw_user_id'=>$user_id,'withdraw_money'=>$withdraw_money,'withdraw_time'=>$time,'withdraw_status'=>0]);
            if(!$withdraw){
                //添加成功减少用户余额
                return back()->with('msg','提现失败，请联系客服');
            }
            $into=DB::table('user_details')->where('details_user_id',$user_id)->decrement('details_balance', $withdraw_money);
            if($into){
                return back()->with('msg','提现成功');
            }
        }
        return view('home.recharge.withdraw');
    }
}
?>
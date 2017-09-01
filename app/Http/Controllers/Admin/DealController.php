<?php
/**
 * 后台交易记录
 */
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/6/9
 * Time: 15:37
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
class DealController extends Controller
{
    //提现记录展示
    public function carry_list(){
        $users = DB::table('withdraw')->join('user','withdraw.withdraw_user_id','=','user.user_id')->select('withdraw_id','user_user','withdraw_money','withdraw_time')->get();
        return view('admin.deal.carry_list',['carry'=>$users]);
    }
    //删除提现记录
    public function delCarry($id){
        $del=DB::table('withdraw')->where('withdraw_id',$id)->delete();
        if($del){
            return $this->success('删除成功','../carry_list',2);
        }else{
            return  $this->error('删除失败','../carry_list',2);
        }
    }
    //充值记录展示
    public function  recharge_list(){
        $recharge_list = DB::table('recharge')->join('user','recharge.user_id','=','user.user_id')->select('recharge_id','user_user','recharge_money','recharge_time','recharge_type','recharge_order')->get();
        return view('admin.deal.recharge_list',['recharge'=>$recharge_list]);
    }
    //删除充值记录
    public function delRecharge($id){
        $del=DB::table('recharge')->where('recharge_id',$id)->delete();
        if($del){
            return $this->success('删除成功','../recharge_list',2);
        }else{
            return  $this->error('删除失败','../recharge_list',2);
        }
    }
}
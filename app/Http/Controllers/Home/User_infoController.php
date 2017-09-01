<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Home\User_details;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class User_infoController extends Controller
{
    public function index(){
         if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.user_info.index');
    }
    //出借记录
    public function tender_list(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        $user_id=session('user_id');
        //回款中
        $data=DB::select("select zcm_lend.*,zcm_repayPlan.*,max(zcm_repayPlan.r_time),max(zcm_repayPlan.r_data),min(zcm_repayPlan.r_statr),zcm_invest.* from zcm_lend,zcm_repayPlan,zcm_invest where zcm_lend.lend_id=zcm_repayPlan.b_id and zcm_lend.lend_id=zcm_invest.lend_id and zcm_invest.user_id=$user_id and zcm_lend.is_success!=5  GROUP BY zcm_repayPlan.b_id");
        $msg['repay_num']=count($data);
        //投标中
        $data = DB::table('invest')
            ->join('lend', 'invest.lend_id', '=', 'lend.lend_id')
            ->select('lend.*', 'invest.*')->where('invest.user_id','=',$user_id)->where('is_success',0)->get();
        $msg['tender_num']=count($data);
        //已完成
        $data=DB::select("select zcm_lend.*,zcm_repayPlan.*,max(zcm_repayPlan.r_time),max(zcm_repayPlan.r_data),min(zcm_repayPlan.r_statr),zcm_invest.* from zcm_lend,zcm_repayPlan,zcm_invest where zcm_lend.lend_id=zcm_repayPlan.b_id and zcm_lend.lend_id=zcm_invest.lend_id and zcm_invest.user_id=$user_id and zcm_lend.is_success=5  GROUP BY zcm_repayPlan.b_id");
        $msg['finish_num']=count($data);
        //已逾期
        $data = DB::table('invest')
            ->join('lend', 'invest.lend_id', '=', 'lend.lend_id')
            ->join('repayPlan', 'invest.lend_id', '=', 'repayPlan.b_id')
            ->select('lend.*', 'invest.*','repayPlan.*')->where('invest.user_id','=',$user_id)->where('repayPlan.r_statr',3)->get();
        $msg['overdue']=count($data);
        //已失败
        $data = DB::table('invest')
            ->join('lend', 'invest.lend_id', '=', 'lend.lend_id')
            ->select('lend.*', 'invest.*')->where('invest.user_id','=',$user_id)->where('is_success',4)->get();
        $msg['fail']=count($data);


        return view('home.user_info.tender',['msg'=>$msg]);

    }
    //回款计划
    public function recover_list(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        $id=session('user_id');
        $da=DB::select("select zcm_lend.lend_number,zcm_lend.lend_repay_method,zcm_lend.lend_goods,zcm_lend.lend_id,max(zcm_repayPlan.r_time),max(zcm_repayPlan.r_data),min(zcm_repayPlan.r_statr),zcm_invest.* from zcm_lend,zcm_repayPlan,zcm_invest where zcm_lend.lend_id=zcm_repayPlan.b_id and zcm_lend.lend_id=zcm_invest.lend_id and zcm_invest.user_id=$id and zcm_lend.is_success!=5  GROUP BY zcm_repayPlan.b_id");
        if(empty($da)){
        $invest_return_money=0;
        $invest_money=0;
        $lixi=0;
        $se=0;
        $mo=0;
        }else{
            foreach ($da as $k => $v) {
                    //print_r($da);die;
                    $now = time();
                    $seven = 60 * 60 * 24 * 7;
                    $month = 60 * 60 * 24 * 30;
                    $seven_now = ($seven + $now);
                    $month_now = ($month + $now);
                    $sum[] = $v['invest_return_money'];
                    $money[] = $v['invest_money'];
                   // foreach($da as $kk=>$vv) {
                    if ($v['max(zcm_repayPlan.r_time)'] < $seven_now && $v['max(zcm_repayPlan.r_time)'] >= $now) {
                        $sev[] = $v['invest_return_money'];
                    } else {
                        $sev[] = 0;
                    }
                    if ($v['max(zcm_repayPlan.r_time)'] < $month_now && $v['max(zcm_repayPlan.r_time)'] >= $now) {

                        $mon[] = $v['invest_return_money'];
                    } else {
                        $mon[] = 0;
                    }
                }
        //回款总本息
        $invest_return_money=array_sum($sum);
        //回款总本金
        $invest_money=array_sum($money);
        //回款总利息
        $lixi=($invest_return_money-$invest_money);
        //七天内回款
        $se=array_sum($sev);
        //30天内回款
        $mo=array_sum($mon);
    }
         return view('home.user_info.recover',['invest_return_money'=>$invest_return_money,'invest_money'=>$invest_money,'lixi'=>$lixi,'se'=>$se,'mo'=>$mo]);
    }
    //出借转让
    public function transfer_list(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.user_info.transfer');

    }

    //借款管理
    public function borrow_list(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.user_info.borrow');
    }
    //还款计划
    public function refund_list(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        $b_id=Input::get("b_id");
        $re=DB::table("repayPlan")->select("r_benjin","r_sumMoney","r_sumAccrual","r_type")->where("u_id",session("user_id"))->where("r_statr","!=",2)->where("b_id",$b_id)->first();
        $res['info']=$re;
        $res['b_id']=$b_id;
        $time=time()+60*60*24*7;
        $res['sumPrice']=$this->ifs(DB::table("repayPlan")->where("r_time","<",$time)->sum("r_m_a"));
        $time30=time()+60*60*24*30;
        $sumPrice30=$this->ifs(DB::table("repayPlan")->where("r_time","<",$time30)->sum("r_m_a"));
        $res['sumPrice30']=round($sumPrice30,2);
        return view('home.user_info.refund',$res);
    }



    //质押管理
    public function pawn_list(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
        $user_id=$request->session()->get('user_id');
        $data=DB::table('user_details')->where('details_user_id',$user_id)->get();
        if($data[0]['is_new']==0){
            return redirect('register_tel');
        }
        return view('home.user_info.pawn_list');
    }

    //申请质押
    public function pawn(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.borrow.domain');
    }
    //邀请注册
    public function invite(Request $request){
        if(session('islogin')!=1){
            return redirect('login');
        }
        $id=base64_decode($request->input('id'));
        //echo $id;die;
        return view('home.user_info.invite',['id'=>$id]);
    }
    //邀请注册二
    public function invite_list(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.user_info.invite_list');
    }
    //邀请注册三
    public function award_list(){
        if(session('islogin')!=1){
            return redirect('login');
        }
        return view('home.user_info.award');
    }
    public function ifs($price)
    {
        if(empty($price))
        {
            return 0;
        }
        else
        {
            return $price;
        }
    }


}
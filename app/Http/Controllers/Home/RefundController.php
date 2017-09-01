<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/7/13
 * Time: 17:24
 */

namespace App\Http\Controllers\Home;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class RefundController extends Controller
{
    public function refund_list_data(){
        $b_id=Input::get("b_id");
        $data=DB::table("repayPlan")->select("b_id","r_id","r_data","r_oneMoney","r_oneAccrual","r_m_a","r_statr")->where("b_id",$b_id)->get();
        $start=array();
        $id=array();
        foreach($data as $k=>$v)
        {
            $start[]=$v['r_statr'];
            $id[$k]=$v['r_id'];
            $b_id=$v['b_id'];
            unset($data[$k]['r_statr']);
            unset($data[$k]['r_id']);
            unset($data[$k]['b_id']);
        }
        $res['start']=$start;
        $res['data']=$data;
        $res['id']=$id;
        $res['b_id']=$b_id;
        return view('home.refund_son.refund_list_data',$res);
    }
    public function ref(){
        $r_id=Input::get("r_id");
        $re=DB::table("repayPlan")->select("r_statr")->where("r_id",$r_id)->first();
        if($re['r_statr']!=2)
        {
            return 0;
        }
        else
        {
            return 1;
        }


    }
    public function ifprice(){
        $price=Input::get("price");
        $b_id=Input::get("b_id");
        $zfmm=md5(Input::get("zfmm"));
        $r_id=Input::get("r_id");
        $user_id=session("user_id");
        $ss="";
        $res=DB::table("user_details")->select("details_balance")->where("details_pay",$zfmm)->where("details_user_id",$user_id)->first();
        if(empty($res))
        {
            return 0;
        }else
        {
            if($res['details_balance']>=$price)
            {
                $newPrice=$res['details_balance']-$price;
                $re=DB::table("user_details")->where("details_user_id",$user_id)->update(['details_balance'=>$newPrice]);
                if($re)
                {
                    DB::table("repayPlan")->where("r_id",$r_id)->update(['r_statr'=>2]);
                    $res1=DB::table("repayPlan")->select("r_sumMoney")->where("r_id",$r_id)->first();
                    $newMoney=$res1["r_sumMoney"]-$price;
                    DB::table("repayPlan")->where("u_id",$user_id)->where("r_id","!=",$r_id)->where("b_id",$b_id)->update(["r_sumMoney"=>$newMoney]);
                    $statr=DB::table("repayPlan")->select("r_statr")->where("u_id",$user_id)->where("b_id",$b_id)->get();
                    $if=1;
                    foreach($statr as $k=>$v)
                           {
                               if($v['r_statr']==0)
                               {
                                    $if=0;
                               }
                           }
                    if($if==1)
                    {
                        DB::table("lend")->where("lend_id",$b_id)->update(['is_success'=>5]);
                    }
                    return 1;
                }
                else
                {
                    return 3;
                }
            }
            else
            {
                return 2;
            }
        }




    }
    public function jisuanlilv(){
        $lilvzhi=Input::get("lilvzhi");
        $kuanqixian=Input::get("kuanqixian");
        $typePrice=Input::get("typePrice");
        $u_id=session("user_id");
        $ben=Input::get("ben");
        if($typePrice=="等额本息")
        {
            $typePrice=1;
        }
        else
        {
            $typePrice=2;
        }
        $info['r_sumMoney']= 10464.04;
        $info['r_sumAccrual']= 464.04;
        echo json_encode($info);
    }
    public function onehuan()
    {
        $b_id=Input::get("b_id");
        $pwd=md5(Input::get("pwd"));
        $sumPrice=Input::get("sum");
        $u_id=session("user_id");
        $re=DB::table("user_details")->select("details_balance")->where("details_user_id",$u_id)->where("details_pay",$pwd)->first();
        if(empty($re)){
            echo "1";
        }
        else
        {
            if($re['details_balance']>=$sumPrice)
            {
                DB::table("lend")->where("lend_id",$b_id)->update(['is_success'=>5]);
                DB::table("repayPlan")->where("b_id",$b_id)->update(['r_statr'=>2]);
                echo "2";
            }
            else
            {
                echo "3";
            }
        }



    }
}
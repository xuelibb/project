<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
     /**
     * /成功跳转页面
     * @param  [type] $msg  [信息]
     * @param  [type] $url  [跳转路径]
     * @param  string $time [跳转时间/默认为3秒]
     */
    protected function success($msg,$url,$time='3'){
    		return  view("skip/success",['msg'=>$msg,'url'=>$url,'time'=>$time]);
    }
    /**
     * /失败跳转页面
     * @param  [type] $msg  [报错信息]
     * @param  [type] $url  [跳转路径]
     * @param  string $time [跳转时间/默认为3秒]
     */
    protected function error($msg,$url,$time='3'){
    		return  view("skip/error",['msg'=>$msg,'url'=>$url,'time'=>$time]);
    }
    public function jyzCounter($amount,$rate,$period,$type,$u_id,$b_id)
    {
        $rate=intval($rate);
        if($type==1)
        {
            return $this->jyzWait($amount,$rate,$period,$type,$u_id,$b_id);
        }
        else
        {
            return $this->jyzInterest($amount,$rate,$period,$type,$u_id,$b_id);
        }
    }
    //还款生成器等额本息
    public function jyzWait($amount,$rate,$period,$type,$u_id,$b_id){
        //计算利息
        $month_rate=$rate/100/12;
        //计算每月应还本息
        $zonge=($amount*$month_rate*pow((1+$month_rate),$period))/(pow((1+$month_rate), $period)-1);
        //计算总的本息额度
        $sumPrice=$zonge*$period;
        //计算总利息
        $sumLixi=$sumPrice-$amount;
        $time=time();
        $riqi=date("m",time());
        $data=array();
        for($i=1;$i<=$period;$i++) {
            $yueBenjin = ($amount * $month_rate * pow((1 + $month_rate), $i - 1)) / (pow((1 + $month_rate), $period) - 1);
            $yueXi=$zonge-$yueBenjin;
            $time=$this->datas($riqi,$time);
            //每月应还本金
            $data[$i]['r_oneMoney']=round($yueBenjin,2);
            //每月应还利息
            $data[$i]['r_oneAccrual']=round($yueXi,2);
            $data[$i]['r_m_a']=round($zonge,2);
            $data[$i]['r_data']=date("Y-m-d",$time);
            $data[$i]['r_time']=$time;
            $riqi=date("m",$time);
            $data[$i]['r_sumMoney']=round($sumPrice,2);
            $data[$i]['r_sumAccrual']=round($sumLixi,2);
            $data[$i]['r_type']=$type;
            $data[$i]['u_id']=$u_id;
            $data[$i]['b_id']=$b_id;
            $data[$i]['r_benjin']=$amount;
        }

        return $data;
    }
    //每月还息
    public function jyzInterest($amount,$rate,$period,$type,$u_id,$b_id)
    {
        $data=array();
        //计算利息
        $month_rate=$amount*$rate/1200;
        //计算总利息
        $sumLixi=$month_rate*$period;
        //计算总还款额
        $sumMonth=$amount+$sumLixi;
        $time=time();
        $riqi=date("m",time());
        for($i=1;$i<=$period;$i++)
        {
            $time=$this->datas($riqi,$time);
            if($i==$period)
            {
                $data[$i]['r_oneMoney']=round($amount,2);
                $data[$i]['r_m_a']=round($month_rate+$amount,2);
            }
            else{
                $data[$i]['r_oneMoney']=0;
                $data[$i]['r_m_a']=round($month_rate+0,2);
            }
            $data[$i]['r_oneAccrual']=round($month_rate,2);
            $data[$i]['r_data']=date("Y-m-d",$time);
            $data[$i]['r_time']=$time;
            $data[$i]['r_sumMoney']=$sumMonth;
            $data[$i]['r_sumAccrual']=$sumLixi;
            $data[$i]['r_type']=$type;
            $data[$i]['u_id']=$u_id;
            $data[$i]['b_id']=$b_id;
            $data[$i]['r_benjin']=$amount;
            $riqi=date("m",$time);
        }
        return $data;


    }
    //月份计算
    public function datas($yue,$time){
        $miao=0;
        $tian=0;
        if($yue>12)
        {
            $yue=1;
        }
        switch($yue)
        {
            case 1:
                $tian=31;
                break;
            case 2:$tian=28;
                break;
            case 3:$tian=31;
                break;
            case 4:$tian=30;
                break;
            case 5:$tian=31;
                break;
            case 6:$tian=30;
                break;
            case 7:$tian=31;
                break;
            case 8:$tian=31;
                break;
            case 9:$tian=30;
                break;
            case 10:$tian=31;
                break;
            case 11:$tian=30;
                break;
            case 12:$tian=31;
                break;
        }
        $miao=60*60*24*$tian;
        $time=$time+$miao;
        return $time;
    }
}

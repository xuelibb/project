<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/7/13
 * Time: 15:37
 */

namespace App\Http\Controllers\Home;

use  DB;
use App\Http\Controllers\Controller;

class TenderController extends Controller
{
    //我的投资
    public function tender_list_data(){
        $id=session('user_id');
        $type=$_POST['type'];
        //回款中
        if($type=='repay'){
            $id=session('user_id');
           // $data = DB::table('invest')
              //  ->join('lend', 'invest.lend_id', '=', 'lend.lend_id')
                //->join('refund', 'lend.user_id', '=', 'refund.user_id')
              //  ->select('lend.*', 'invest.*')->where('invest.user_id','=',$_POST['user_id'])->where('lend.is_success',1)->get();
        $data=DB::select("select zcm_lend.*,zcm_repayPlan.*,max(zcm_repayPlan.r_time),max(zcm_repayPlan.r_data),min(zcm_repayPlan.r_statr),zcm_invest.* from zcm_lend,zcm_repayPlan,zcm_invest where zcm_lend.lend_id=zcm_repayPlan.b_id and zcm_lend.lend_id=zcm_invest.lend_id and zcm_invest.user_id=$id and zcm_lend.is_success!=5  GROUP BY zcm_repayPlan.b_id");
            echo ' <table class="table table-bordered table-hover">
	     <tbody><tr class="active">
		 <th class="w180">项目名称</th>
		 <th class="w60" title="逾期年化利率">预期年化</th>
		 <th class="w65">还款方式</th>
		 <th class="w65">期限</th>
		 <th class="w65">出借金额</th>
		 <th class="w80">预计利息</th>
		 <th class="w120">到期时间</th>
		 </tr>';
         if(empty($data)){
             echo '<tr class="not-hover"><td colspan=" 8" style="text-align: center;height:900px"><div class="no_record"
               ></div>暂无记录!</td></tr>';
         }else{
           foreach ($data as  $k=>$v){
                //计算利息
                $Interest=$v['invest_return_money']-$v['invest_money'];
               //判断回款返方式
                if($v['lend_repay_method']==1){ $method='等额本息';}else{$method= '先息后本';}
                 $str='<tr class=""><td>'.$v['lend_goods'].'</td>
	            <td>'.$v['lend_return'].'</td>
	            <td>'.$method.'</td>
	            <td>'.$v['lend_repay_time'].'个月</td>
	            <td>'.$v['invest_money'].'元</td>
	            <td>'.$Interest.'元</td>
	            <td>'.$v['max(zcm_repayPlan.r_data)'].'</td>
	            </tr>';
	             echo $str;
            }}

    echo '</tbody></table>';
        }
        //已完成
        if($type=='finish'){
            $data=DB::select("select zcm_lend.*,zcm_repayPlan.*,max(zcm_repayPlan.r_time),max(zcm_repayPlan.r_data),min(zcm_repayPlan.r_statr),zcm_invest.* from zcm_lend,zcm_repayPlan,zcm_invest where zcm_lend.lend_id=zcm_repayPlan.b_id and zcm_lend.lend_id=zcm_invest.lend_id and zcm_invest.user_id=$id and zcm_lend.is_success=5  GROUP BY zcm_repayPlan.b_id");

            echo ' <table class="table table-bordered table-hover">
	      <tbody><tr class="active">
		 <th class="w180">项目名称</th>
		 <th class="w60" title="逾期年化利率">预期年化</th>
		 <th class="w65">还款方式</th>
		 <th class="w65">期限</th>
		 <th class="w65">出借金额</th>
		 <th class="w80">预计利息</th>
		 <th class="w70">完成时间 </th>
		 <th class="w55">状态</th>
		 </tr>';
            if(empty($data)){
                echo '<tr class="not-hover"><td colspan=" 8" style="text-align: center;height:900px"><div class="no_record"
               ></div>暂无记录!</td></tr>';
            }else{
                foreach($data as $k=>$v){
                    //计算利息
                    $Interest=$v['invest_return_money']-$v['invest_money'];
                    //判断回款返方式
                    if($v['lend_repay_method']==1){ $method='等额本息';}else{$method= '先息后本';}
                    $str='<tr class=""><td>'.$v['lend_goods'].'</td>
	            <td>'.$v['lend_return'].'</td>
	            <td>'.$method.'</td>
	            <td>'.$v['lend_repay_time'].'个月</td>
	            <td>'.$v['invest_money'].'元</td>
	            <td>'.$Interest.'元</td>
	            <td>'.$v['max(zcm_repayPlan.r_data)'].'</td>
	            <td>已完成</td>
	            </tr>';
                    echo $str;
                }
            }

	 echo '</tbody></table>';
        }
        //投标中
        if($type=='tender'){
            $data = DB::table('invest')
                ->join('lend', 'invest.lend_id', '=', 'lend.lend_id')
                //->join('refund', 'lend.user_id', '=', 'refund.user_id')
                ->select('lend.*', 'invest.*')->where('invest.user_id','=',$_POST['user_id'])->where('lend.is_success','=',0)->orderBy('invest.lend_id', 'desc')->get();
             echo ' <table class="table table-bordered table-hover">
	    <tbody><tr class="active">
		 <th class="w180">项目名称</th>
		 <th class="w60" title="逾期年化利率">预期年化</th>
		 <th class="w65">还款方式</th>
		 <th class="w65">期限</th>
		 <th class="w65">出借金额</th>
		 <th class="w100">预计利息</th>
		 <th class="w120">出借时间</th>
		 </tr>';
            if(empty($data)){
                echo '<tr class="not-hover"><td colspan=" 8" style="text-align: center;height:900px"><div class="no_record"
               ></div>暂无记录!</td></tr>';
            }else{
            foreach ($data as  $k=>$v){
                //计算利息
                $Interest=$v['invest_return_money']-$v['invest_money'];
               // if($v['lend_repay_money']<$v['lend_money']){
                    //判断回款返方式
                    if($v['lend_repay_method']==1){
                        $method='等额本息';
                    }else{
                        $method= '先息后本';
                    }
                $str=' <tr class="">
                <td>'.$v['lend_goods'].'</td>
	            <td>'.$v['lend_return'].'</td>
	            <td>'.$method.'</td>
	            <td>'.$v['lend_repay_time'].'个月</td>
	            <td>'.$v['invest_money'].'元</td>
	            <td>'.$Interest.'元</td>
	            <td>'.date('Y-m-d ',$v['invest_time']).'</td>
	            </tr>';
                    echo $str;
                }
            }      echo  '</tbody></table>';

        }
        //已逾期
        if($type=='overdue'){
            echo '<table class="table table-bordered table-hover">
	    <tbody><tr class="active">
		 <th class="w180">项目名称</th>
		 <th class="w80" title="逾期年化利率">预期年化</th>
		 <th class="w80">还款方式</th>
		 <th class="w80">期限</th>
		 <th class="w80">出借金额</th>
		 <th class="w80">预计利息</th>
		 <th class="w70">到期时间</th>
		 </tr>';
            $data = DB::table('invest')
                ->join('lend', 'invest.lend_id', '=', 'lend.lend_id')
                ->join('repayPlan', 'invest.lend_id', '=', 'repayPlan.b_id')
                ->select('lend.*', 'invest.*','repayPlan.*')->where('invest.user_id','=',$_POST['user_id'])->where('repayPlan.r_statr',3)->orderBy('invest.lend_id', 'desc')->get();
           if(empty($data)){
                echo '<tr class="not-hover"><td colspan=" 8" style="text-align: center;height:900px"><div class="no_record"
               ></div>暂无记录!</td></tr>';
           }else{
            foreach ($data as  $k=>$v){
                //计算利息
                $Interest=$v['invest_return_money']-$v['invest_money'];
                //到期时间
                //$month=(60*60*24*30*($v['lend_repay_time']));
               // $end_time=date('Y-m-d H:i:s',($v['success_time']+$month));
                $r_data=$v['r_data'];
                //判断回款返方式
                if($v['lend_repay_method']==1){ $method='等额本息';}else{$method= '先息后本';}
                //判断是否为回款状态
                if($v['is_success']==1){
                    //$repay=array_count_values($v);
                 $str='<tr class=""><td>'.$v['lend_goods'].'</td>
	            <td>'.$v['lend_return'].'</td>
	            <td>'.$method.'</td>
	            <td>'.$v['lend_repay_time'].'个月</td>
	            <td>'.$v['invest_money'].'元</td>
	            <td>'.$Interest.'元</td>
	            <td>'.$r_data.'</td>
	            </tr>';
                    echo $str;
                }}}
	    echo' </tbody></table>';
        }
        //已失败
        if($type=='fail'){
                $data = DB::table('invest')
                ->join('lend', 'invest.lend_id', '=', 'lend.lend_id')
                //->join('refund', 'lend.user_id', '=', 'refund.user_id')
                ->select('lend.*', 'invest.*')->where('invest.user_id','=',$_POST['user_id'])->where('lend.is_success',4)->orderBy('invest.lend_id', 'desc')->get();
             echo '<table class="table table-bordered table-hover">
	    <tbody><tr class="active">
		 <th class="w180">项目名称</th>
		 <th class="w60" title="逾期年化利率">预期年化</th>
		 <th class="w65">还款方式</th>
		 <th class="w65">期限</th>
		 <th class="w65">出借金额</th>
		 <th class="w70">失败时间</th>
		  </tr>';
            if(empty($data)){
                echo '<tr class="not-hover"><td colspan=" 8" style="text-align: center;height:900px"><div class="no_record"
               ></div>暂无记录!</td></tr>';
            }else{
                foreach ($data as  $k=>$v){
                    //计算利息
                    $Interest=$v['invest_return_money']=$v['invest_money'];
                    //到期时间
                    //$month=(60*60*24*30*($v['lend_repay_time']));
                    $end_time=date('Y-m-d ',$v['lend_end_time']);
                    //判断回款返方式
                    if($v['lend_repay_method']==1){ $method='等额本息';}else{$method= '先息后本';}


                    $str='<tr class=""><td>'.$v['lend_goods'].'</td>
	            <td>'.$v['lend_return'].'</td>
	            <td>'.$method.'</td>
	            <td>'.$v['lend_repay_time'].'个月</td>
	            <td>'.$v['invest_money'].'元</td>
	            <td>'.$end_time.'</td>
	            </tr>';
                    echo $str;
                }}
         echo'</tbody></table>';
        }
       // return view('home.tender_son.tender_list_data',['repay'=>$repay,'tender'=>$tender]);

    }


}
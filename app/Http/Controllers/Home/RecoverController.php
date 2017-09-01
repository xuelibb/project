<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/7/13
 * Time: 15:14
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use DB;

class RecoverController extends Controller
{
    public function recover_list_data(){
        $type=$_POST['type'];
        if($type=='wait'){
        $id=session('user_id');
        $data=DB::select("select zcm_lend.lend_number,zcm_lend.lend_repay_method,zcm_lend.lend_goods,zcm_lend.lend_id,max(zcm_repayPlan.r_data),min(zcm_repayPlan.r_statr),zcm_invest.* from zcm_lend,zcm_repayPlan,zcm_invest where zcm_lend.lend_id=zcm_repayPlan.b_id and zcm_lend.lend_id=zcm_invest.lend_id and zcm_invest.user_id=$id and zcm_lend.is_success!=5  GROUP BY zcm_repayPlan.b_id");
        echo'<table class="table table-bordered table-hover">
        <tbody><tr class="active">
        <th width="100">项目编号</th>
        <th width="95">质/抵押物</th>
        <th width="65">还款方式</th>
        <th width="80">应回时间</th>
        <th width="75">应回本金</th>
        <th width="75">应回利息</th>
        <th width="75">应回总额</th>
        <th width="60">状态</th>
    </tr>';
         if(empty($data)){
             echo  '<tr class="not-hover"><td colspan="9" style="text-align: center;height:900px"><div class="no_record"></div>暂无记录!</td></tr>';
         }else {
             foreach ($data as $k => $v) {
                 //判断回款方式
                 if($v['lend_repay_method']==1){
                       $lend_repay_method='等额本息';
                  }elseif ($v['lend_repay_method']==2){
                      $lend_repay_method='先息后本';
                    }
                    //计算回款利息
                 $lixi=$v['invest_return_money'] -$v['invest_money'] ;


                     echo '<tr>
                         <td>' . $v['lend_number'] . '</td>
                            <td>' . $v['lend_goods'] . '</td>
                            <td>'.$lend_repay_method.'</td>
                            <td>'.$v['max(zcm_repayPlan.r_data)'].'</td>
                            <td>' . $v['invest_money'] . '</td>
                            <td>' . $lixi . '</td>
                            <td>' . $v['invest_return_money'] . '</td>
                            <td>未回款</td>
                            </tr>';


             }
         }
echo '</tbody>
</table>';
        }
        if($type=='have'){
            $id=session('user_id');
            $data=DB::select("select zcm_lend.lend_number,zcm_lend.lend_repay_method,zcm_lend.lend_goods,zcm_lend.lend_id,max(zcm_repayPlan.r_data),min(zcm_repayPlan.r_statr),zcm_invest.* from zcm_lend,zcm_repayPlan,zcm_invest where zcm_lend.lend_id=zcm_repayPlan.b_id and zcm_lend.lend_id=zcm_invest.lend_id and zcm_invest.user_id=$id and zcm_lend.is_success=5  GROUP BY zcm_repayPlan.b_id");
        echo'<table class="table table-bordered table-hover">
        <tbody><tr class="active">
        <th width="100">项目编号</th>
        <th width="95">质/抵押物</th>
        <th width="65">还款方式</th>
        <th width="80">应回时间</th>
        <th width="75">应回本金</th>
        <th width="75">应回利息</th>
        <th width="75">应回总额</th>
        <th width="60">状态</th>
    </tr>';
            if(empty($data)){
                echo  '<tr class="not-hover"><td colspan="9" style="text-align: center;height:900px"><div class="no_record"></div>暂无记录!</td></tr>';
            }else {
                foreach ($data as $k => $v) {
                    //判断回款方式
                    if($v['lend_repay_method']==1){
                        $lend_repay_method='等额本息';
                    }elseif ($v['lend_repay_method']==2){
                        $lend_repay_method='先息后本';
                    }
                    //计算回款利息
                    $lixi=$v['invest_return_money'] -$v['invest_money'] ;

                    echo '<tr>
                           <td>' . $v['lend_number'] . '</td>
                            <td>' . $v['lend_goods'] . '</td>
                            <td>'.$lend_repay_method.'</td>
                            <td>'.$v['max(zcm_repayPlan.r_data)'].'</td>
                            <td>' . $v['invest_money'] . '</td>
                            <td>' . $lixi . '</td>
                            <td>' . $v['invest_return_money'] . '</td>
                            <td>已回款</td>
                            </tr>';


                }
            }
            echo '</tbody>
</table>';
        }


        //return view('home.recover_son.recover_list_data');
    }

}
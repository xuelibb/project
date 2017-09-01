<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
date_default_timezone_set('Asia/Shanghai');
class InvestController extends Controller
{
    /**
     * /
     * @return [type] [我要出借]
     */
    public function index(){

        return view('home.invest.index');

    }
    /**
     * /
     * @param [type] $[repy_time] [借款期限]
     * @param [type] $[rate] [年化利率]
     * @param [type] $[$repay_method] [还款方式]
     * @return [type] [多条件查询]
     */

    public  function lists(){
        //借款期限
        if($_GET['repay_time']==0){
            $repay_time= " and  lend_repay_time > '0' ";
        }else if($_GET['repay_time']==1){
            $repay_time="  and  lend_repay_time < '1' ";
        }else if($_GET['repay_time']==2){
            $repay_time="  and  lend_repay_time  >= '1'  and  lend_repay_time  <= '3' ";
        }else if($_GET['repay_time']==3){
            $repay_time="  and  lend_repay_time  >= '3'  and  lend_repay_time  <= '6' ";
        }else if($_GET['repay_time']==4){
            $repay_time="  and  lend_repay_time  >= '6'  and  lend_repay_time  <= '9' ";
        }else if($_GET['repay_time']==5){
            $repay_time="  and  lend_repay_time  >= '9'  and  lend_repay_time  <= '12' ";
        }else{
            $repay_time="  and  lend_repay_time >  '12' ";
        }
        //年化利率
        if($_GET['rate']==0){
            $rate= " and  lend_return > '0%' ";
        }else if($_GET['rate']==1){
            $rate="  and lend_return < '10%' ";
        }else if($_GET['rate']==2){
            $rate="  and  lend_return  >= '10%'  and  lend_return  <= '14%' ";
        }else{
            $rate="  and   lend_return > '14%' ";
        }

        //还款方式
        if($_GET['repay_method']==0){
            $repay_method= " and  lend_repay_method  > '0'  ";
        }else if($_GET['repay_method']==1){
            $repay_method= " and  lend_repay_method = '1' ";
        }else if($_GET['repay_method']==2){
            $repay_method="  and lend_repay_method = '2' ";
        }
        $where="1 = 1";
        if(!empty($repay_time)){
            $where.=$repay_time;
        }
        if(!empty($rate)){
            $where.=$rate;
        }
        if(!empty($repay_method)){
            $where.=$repay_method;
        }
        //1、查询数据库总条数
        $count = count( DB::select("select * from zcm_lend where $where ORDER BY `lend_id` DESC "));
        //2、设置每页显示条数
        $rev = '2';
        //3、求总页数
        $sums = ceil($count/$rev);
        //4、求单前页
        $page = $_GET['current_page'];
        if(empty($page)){
            $page = "1";
        }
        //5、设置上一页、下一页
        $prev = ($page-1)>0?$page-1:1;
        $next = ($page+1)<$sums?$page+1:$sums;
        //6、求偏移量
        $offset = ($page-1)*$rev;
        //7、sql查询数据库
        $data = DB::select("select * from zcm_lend where $where ORDER BY `lend_id` DESC limit $offset,$rev  ");
        //8、数字分页(可有可无)
        $pp = array();
        for($i=1;$i<=$sums;$i++){
            $pp[$i]=$i;
        }
        $list['pages']['prev']=$prev;$list['pages']['sums']=$sums;
        $list['pages']['next']=$next;
        $list['pages']['sums']=$sums;
        $list['pages']['page']=$page;
        $list['pages']['pag']=$pp;
        $list['data']=$data;
        echo json_encode($list);
    }
    //投资者信息
    public function info(){
        $id=Input::get('id');
        $data = $this->infoo($id);
        return view('home.invest.info',['info'=>$data]);
    }
    //查询借款信息
    public function infoo($id){
        //$id=Input::get('id');
        $data = DB::table('lend')->where('lend_id',$id)->first();
        return  $data;
    }
    //动态获取借款进度条、剩余金额
    public function lend_msg(){
        $id=Input::get('id');
        $data = $this->infoo($id);
        echo json_encode($data);
    }



    /*
     * 授权信息
     * **/
    public function empower(){
        $id=Input::get('id');
        $data = DB::table('lend')->where('lend_id',$id)->first();
        echo '<!--授信详情-->
                    <ul class="pb114">
                      <li class="ofh">
                          <div class="credit-ifo-title ofh">
                              <div class="credit-ifo-title-pic credit-ifo-title-pic1 fl dib"></div>
                                <h4 class="fl dib">质押域名</h4>
                            </div>
                            <div class="credit-ifo-ct mt20">
                              <div class="credit-ifo-ct-xx">
                                  <div><span>质押域名:</span><span class="credit-ifo-ct-xx-wd" title="'.$data['lend_goods'].'">'.$data['lend_goods'].'</span></div>
                                    <div><span>授信金额:</span><span class="credit-ifo-ct-xx-wd">'.sprintf("%.2f", $data['lend_worth']/10000).'万
</span></div>
                                </div>
                                <div class="credit-ifo-ct-xx">
                                 
                                    <div><span>本次使用金额:</span><span class="credit-ifo-ct-xx-wd">'.sprintf("%.2f", $data['lend_money']/10000).'
</span><span>万</span></div>
                                </div>
                            </div>
                        </li>
                     
                        <li class="ofh" style="position:relative;top:-10px;">
                          <div class="credit-ifo-title ofh">
                              <div class="credit-ifo-title-pic credit-ifo-title-pic2 fl dib"></div>
                                <h4 class="fl dib">域名介绍</h4>
                            </div>
                            <div class="credit-ifo-ct mt10 mr10"><p>                                
    域名借款，是指借款人以其持有的有价值易流通的域名作为质押物，通过简贷风控团队大数据分析和价格评估，目前质押域名市场价值在220.00万元以上，借款人的授信总额度不超过50%，目前该域名已经质押
到简贷指定的账号下</p></div>
                        </li>
                        
                        <li class="ofh">
                          <div class="credit-ifo-title ofh">
                              <div class="credit-ifo-title-pic credit-ifo-title-pic3 fl dib"></div>
                                <h4 class="fl dib">还款保障措施</h4>
                            </div>
                            <div class="credit-ifo-ct mt10">
                            <p>客户的域名已经办理质押手续，简贷的风险保障金由新浪支付全程托管，逾期先行垫付</p>
                            </div>
                        </li>
                        
                                                
                    </ul>';
    }
    /**
     * [lender 借款者信息]
     *
     */
    public function lender(){
        $id=Input::get('id');
        $data = DB::table('lend')
            ->join('user', 'lend.user_id', '=', 'user.user_id')
            ->join('refund', 'lend.user_id', '=', 'refund.user_id')
            ->select('lend.*', 'user.*','refund.*')->where('lend.lend_id','=',$id)->first();
        //借款次数
        $count= DB::table('lend')->where('user_id','=',$data['user_id'])->count();
        //还款次数
        $count2= DB::table('refund')->where('user_id','=',$data['user_id'])->count();
        //利息
        $lx=$data['lend_total_money']-$data['lend_money'];
        //未还利息
        $whlx=$lx-$data['refund_money'];
        $whlx=sprintf("%.2f",$whlx);
        //如果利息还完，那么开始计算未还本金
        if($whlx<=0){
            $whlx=sprintf("%.2f",0);
            $whbj=$data['lend_money']+$lx-$data['refund_money'];
            $whbj=sprintf("%.2f", $whbj/10000);
        }else{
            $whbj=sprintf("%.2f",$data['lend_money']/10000);
        }


        echo '<!--借款者信息-->
                    <ul>
                        <li class="ofh">
                          <div class="loan-ifo1 loan-ifo5">
                              <div class="loan-ifo1-pic loan-ifo1-pic1"></div>
                                <div class="loan-ifo1-txt">
                                  <h4>借款者信息</h4>
                                    <div class="mt30"> <span>用户名：</span>
                                    <span>'.$data['user_user'].'</span></div>
                                </div>
                            </div>

                        </li>
                        <li class="ofh">
                          <div class="loan-ifo1">
                              <div class="loan-ifo1-pic loan-ifo1-pic2"></div>
                                <div class="loan-ifo1-txt ofh">
                                  <h4>审核信息</h4>
                                    <div class="mt15"><span class="loan-ifo1-txt-icon fl dib"></span
>实名认证</div>
                                </div>
                            </div>
                            <div class="loan-ifo2 mt41">
                                <div class="loan-ifo2-txt ofh ">
                                  <span class="loan-ifo2-txt-icon fl dib"></span>
                                    <span>手机认证</span>
                                </div>
                            </div>
                            <div class="loan-ifo3  mt41">
                                <div class="loan-ifo2-txt ofh">
                                  <span class="loan-ifo2-txt-cion2 fl dib"></span>
                                    <span>人工审核</span>
                                </div>
                            </div>
                        </li>
                        <li class="ofh">
                          <div class="loan-ifo1">
                              <div class="loan-ifo1-pic loan-ifo1-pic3"></div>
                                <div class="loan-ifo1-txt ofh">
                                  <h4>借款信息</h4>
                                    <div class="mt10 loan-num-wd-box">
                                      <div class="ofh">
                                        <span>累计借款：</span>
                                        <span class="loan-num-wd">'.$count.'</span>
                                        <span>笔</span>
                                      </div>
                                      
                                      <div class="ofh" style="width:200px;">
                                        <span>未还利息：</span>
                                        <span class="loan-num-wd">'.$whlx.'</span>
                                        <span>元</span>
                                      </div>
                                      
                                        <div class="ofh" style="width:180px;">
                                      <span>60天内逾期还款：</span>
                                      <span class="loan-num-wd">0</span>
                                      <span>次</span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="loan-ifo2 mt35">
                                <div class="loan-ifo2-txt ofh loan-num-wd-box">
                                  <div class="ofh">
                                    <span>已还次数：</span>
                                    <span class="loan-num-wd">'.$count2.'</span>
                                    <span>次</span>
                                  </div>
                                  <div class="ofh">
                                      <span>逾期未还：</span>
                                      <span class="loan-num-wd">0</span>
                                      <span>次</span>
                                    </div>
                                    <div class="ofh">
                                    <span>90天内逾期还款：</span>
                                    <span class="loan-num-wd">0</span>
                                    <span>次</span>
                                  </div>
                                </div>
                            </div>
                            <div class="loan-ifo3 mt35 loan-num-wd-box">
                                <div class="loan-ifo2-txt ofh">
                                  <div class="ofh">
                                      <span>未还本金：</span>
                                      <span class="loan-num-wd">'.$whbj.'</span>
                                      <span>万元</span>
                                    </div>
                                  <div class="ofh">
                                    <span>30天内逾期还款：</span>
                                    <span class="loan-num-wd">0</span>
                                    <span>次</span>
                                  </div>
                                    
                                </div>
                            </div>
                        </li>
                    </ul>';
    }
    public function order_list(){
        $id=Input::get('id');
        $data = DB::table('invest')
            ->join('user', 'invest.user_id', '=', 'user.user_id')
            ->select('invest.*', 'user.*')->where('invest.lend_id','=',$id)->get();


        echo '<!--出借记录-->
<style>
    .Invest-record {
        padding: 0 30px 55px 30px !important;
    }
</style>

    <ul class="Invest-record">
        <li class="ofh Invest-record-title">
            <div class="Invest-record-list bold">出借人</div>
            <div class="Invest-record-list bold">出借金额</div>
            <div class="Invest-record-list bold">出借时间</div>
        </li>';
        foreach ($data as $k  => $v){  $time=date('Y-m-d H:i:s',$v['invest_time']);
            $str='<li class="ofh">
                <div class="Invest-record-list">'.$v['user_user'].'</div>
                <div class="Invest-record-list Invest-record-money">¥'.$v['invest_money'].'</div>
                <div class="Invest-record-list">'.date("Y-m-d H:i:s",$v['invest_time']).'</div>
            </li>';
            echo $str;
        }
        echo '</ul>';

    }
    public function user_info(){
        $id=Input::get('id');

       # $data = DB::table('recharge')->where('user_id',$id)->first();
       # echo  $data['recharge_money'];
	$data = DB::table('user_details')->where('details_id',$id)->first();
        echo  $data['details_balance'];

    }

    public function user_invest(){
        //账号资金
        $zijin=$_GET['zijin'];
        //投资金额
        $invest_money=$_GET['invest_money'];
        if($zijin<100){
            //余额不足，请充值
            echo  '3';
        }else if($invest_money<100){
            //最少充值100,亲
            echo '4';
        }else{
            $invest_return_money=$_GET['invest_return_money'];
            $user_id=$_GET['user_id'];
            $lend_id=$_GET['lend_id'];
            $data=array(
                'invest_money'=>$invest_money,
                'invest_return_money'=>$invest_return_money,
                'user_id'=>$user_id,
                'lend_id'=>$lend_id,
                'invest_time'=>time()
            );
            //获取用户剩余金额
            $lend=DB::table('lend')->where('lend_id',$lend_id)->first();
            //借款金额
            $lend_money=$lend['lend_money'];
            //已借款金额
            $lend_repay_money=$lend['lend_repay_money'];
            //可投资金额
            $yue=$lend_money-$lend_repay_money;
            if($invest_money>$yue){
                //超额
                echo  '0';
            }else{
                #$one=DB::table('recharge')->where('user_id',$user_id)->decrement('recharge_money',$invest_money);
                $one=DB::table('user_details')->where('details_id',$user_id)->decrement('details_balance',$invest_money);
		//添加投资
                $re=DB::table('invest')->insert($data);
                $res=DB::table('lend')->where('lend_id',$lend_id)->increment('lend_repay_money',$invest_money);		 
		//剩余借款金额为零时，添加满标完成时间
		$sy=DB::table('lend')->where('lend_id',$lend_id)->first();
		if($sy['lend_money']==$sy['lend_repay_money']){
		$arr=['lend_id'=>$lend_id,'is_success'=>'1','success_time'=>time()];
		DB::table('lend')->where('lend_id',$lend_id)->update($arr);}

		if($re&&$one&&$res){
                    //投资成功
                    echo '1';
                }else{
                    //投资失败
                    echo '2';
                }

            }

        }
    }


}

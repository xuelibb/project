<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
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

    //过滤已失败的标
    public function fial(){
        //过滤以失败的标
        $fail= DB::table('lend')->get();
        $now=time();
        foreach($fail as $k=>$v){
            $money=$v['lend_money'];
            $repay=$v['lend_repay_money'];
            if(($v['lend_end_time']<$now)&&($money!=1)&&($money!=$repay)){
                $up['is_success']=4;
                DB::table('lend')->where('lend_id',$v['lend_id'])->update($up);
            }
        }
    }
    public  function lists(Request $request){
        $this->fial();
        if($request->isMethod('post')){
        $paytime=$request->input('repay_time');
        //借款期限
        if($paytime==0){
            $repay_time= " and  lend_repay_time > '0' ";
        }else if($paytime==1){
            $repay_time="  and  lend_repay_time < '1' ";
        }else if($paytime==2){
            $repay_time="  and  lend_repay_time  >= '1'  and  lend_repay_time  <= '3' ";
        }else if($paytime==3){
            $repay_time="  and  lend_repay_time  >= '3'  and  lend_repay_time  <= '6' ";
        }else if($paytime==4){
            $repay_time="  and  lend_repay_time  >= '6'  and  lend_repay_time  <= '9' ";
        }else if($paytime==5){
            $repay_time="  and  lend_repay_time  >= '9'  and  lend_repay_time  <= '12' ";
        }else{
            $repay_time="  and  lend_repay_time >  '12' ";
        }
        //年化利率
            $payrate=$request->input('rate');
        if($payrate==0){
            $rate= " and  lend_return > '0%' ";
        }else if($payrate==1){
            $rate="  and lend_return < '10%' ";
        }else if($payrate==2){
            $rate="  and  lend_return  >= '10%'  and  lend_return  <= '14%' ";
        }else{
            $rate="  and   lend_return > '14%' ";
        }

        //还款方式
         $pay_method=$request->input('repay_method');
        if($pay_method==0){
            $repay_method= " and  lend_repay_method  > '0'  ";
        }else if($pay_method==1){
            $repay_method= " and  lend_repay_method = '1' ";
        }else if($pay_method==2){
            $repay_method="  and lend_repay_method = '2' ";
        }
        $where="1 = 1 ";
        $where.=" and lend_money > 1 ";
        $where.=" and is_success != 4 ";
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
        $sum= DB::select("select * from zcm_lend where $where ORDER BY `lend_id` DESC ");
        $now=time();
        foreach($sum as $k=>$v){
            $money=$v['lend_money'];
            $repay=$v['lend_repay_money'];
            if(($v['lend_end_time']<$now)&&($money!=1)&&($money!=$repay)){
                $up['is_success']=4;
                DB::table('lend')->where('lend_id',$v['lend_id'])->update($up);
            }
        }
        $count = count($sum);
        //2、设置每页显示条数
        $rev = '2';
        //3、求总页数
        $sums = ceil($count/$rev);
        //4、求单前页
            $current_page=$request->input('current_page');
        $page = $current_page;
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
    }
    //投资者信息
    public function info(Request $request){
        if($request->isMethod('get')) {
            $id = $request->input('id');
            $data = $this->infoo($id);
            if (empty($data)) {
                return $this->error('妈卖批,你在闹几！', '/');
            }
            $user_id = session('user_id');
            $one = DB::table('invest')
                ->join('lend', 'invest.lend_id', '=', 'lend.lend_id')
                //->join('refund', 'lend.user_id', '=', 'refund.user_id')
                ->select('lend.*', 'invest.*')->where('invest.user_id', '=', $user_id)->where('invest.lend_id', $id)->first();

            //此表当前用户未投资状态为0  ，已投资状态为1
            if (empty($one)) {
                $one['msg'] = '0';
            } else {
                $one['msg'] = '1';
            }
            if ($data['is_success'] == 4) {
                return $this->error('亲,此表已流标了哦！', '/');
            }

            //判断是否为自己发的标
            if ($data['user_id'] == $user_id) {
                return $this->error('亲,不能投自己的标哦！', '/');
                //return  $this->success('不能投自己的标哦~~~~~','admin_article');
            } else {
                return view('home.invest.info', ['info' => $data, 'one' => $one]);
            }
        }

    }
    //查询借款信息
    public function infoo($id){
        $this->fial();
        //$id=Input::get('id');
        $data = DB::table('lend')->where('lend_id',$id)->first();
        return  $data;
    }
    //动态获取借款进度条、剩余金额
    public function lend_msg(Request $request){
        $this->fial();
       if($request->isMethod('post')){
       $id=$request->input('lend_id');
       $data = $this->infoo($id);
        echo json_encode($data);
    }}



    /*
     * 授权信息
     * **/
    public function empower(Request $request){
        $this->fial();
        if($request->isMethod('post')){
        $id=$request->input('lend_id');
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
    }
    /**
     * [lender 借款者信息]
     *
     */
    public function lender(Request $request){
        $this->fial();
            if($request->isMethod('post')){
                $id=$request->input('lend_id');

        $data = DB::table('lend')
            ->join('user', 'lend.user_id', '=', 'user.user_id')
            //->join('refund', 'lend.user_id', '=', 'refund.user_id')
            ->select('lend.*', 'user.*')->where('lend.lend_id','=',$id)->first();
        $wh=DB::table('refund')->select('refund_money')->where('lend_id',$id)->first();


        //借款次数
        $count= DB::table('lend')->where('user_id','=',$data['user_id'])->count();
        //还款次数
        $count2= DB::table('refund')->where('user_id','=',$data['user_id'])->count();
        //利息
        $lx=$data['lend_total_money']-$data['lend_money'];
        //未还利息
        $data['refund_money']=$wh['refund_money'];
        $wh=$wh['refund_money'];
        isset($wh)?$wh:0;
        $whlx=($lx-$wh)/10000;
        $whlx=sprintf("%.2f",$whlx);
        //如果利息还完，那么开始计算未还本金
        if($whlx<=0){
            $whlx=sprintf("%.2f",0);
            $whbj=$data['lend_money']+$lx-$wh;
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
                                        <span>万元</span>
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
    }}
    //投标人信息列表
    public function order_list(Request $request){
        $this->fial();
        if($request->isMethod('post')){
        $id=$request->input('lend_id');
        $data = DB::table('invest')
            ->join('user', 'invest.user_id', '=', 'user.user_id')
            ->select('invest.*', 'user.*')->orderBy('invest_time','desc')->where('invest.lend_id','=',$id)->get();
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

    }}
    //当前会员资金
    public function user_info(Request $request){
        $this->fial();
        //当前会员id
         if($request->isMethod('post')){
         $id=$request->input('user_id');
        $data = DB::table('user_details')->where('details_id',$id)->first();
        echo  $data['details_balance'];

    }}
    //投资协议
    public function invest_msg(){
        $this->fial();
        return view('home.invest.xieyi');
    }
    //投资动作
    public function user_invest(Request $request){
        $this->fial();
        /*print_r(Redis::getFacadeRoot());
                Redis::set('name','wz');//存入redis
                echo  Redis::get('name'); //获取redis中的值
                //$redis=new Redis();
                //$redis->connect('127.0.0.1','6379');
                //$redis->select(6);
                if($redis->lpop('list')){

                }else{
                    echo '库存不足~！！';
                }
                $qw=Redis::lLen('list'); //队列的长度
                echo $qw;die;*/

        if($request->isMethod('post')){

        //账号资金
        $zijin=$request->input('zijin');
        //投资金额
        $invest_money=$request->input('invest_money');
        //密码验证
        $pwd=$request->input('zcm');
        $pwd=md5($pwd);
        $user_id=session('user_id');
        $pass=DB::table('user_details')->where('details_pay',$pwd)->where('details_id',$user_id)->first();
        if(empty($pass)){
            echo '88';
        }else if($zijin<100){
            //余额不足，请充值
            echo  '3';
        }else if($invest_money<100){
            //最少充值100,亲
            echo '4';
        }else{
            $invest_return_money=$request->input('invest_return_money');
            $user_id=$request->input('user_id');
            $lend_id=$request->input('lend_id');
            $data=array(
                'invest_money'=>$invest_money,
                'invest_return_money'=>$invest_return_money,
                'user_id'=>$user_id,
                'lend_id'=>$lend_id,
                'invest_time'=>time()
            );
            //获取用户剩余借款金额
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
                //更新用户账户金额
               // $one=DB::table('recharge')->where('user_id',$user_id)->decrement('recharge_money',$invest_money);

                $one=DB::table('user_details')->where('details_id',$user_id)->decrement('details_balance',$invest_money);
                //添加投资
                $re=DB::table('invest')->insert($data);
                $res=DB::table('lend')->where('lend_id',$lend_id)->increment('lend_repay_money',$invest_money);
                $sy=DB::table('lend')->where('lend_id',$lend_id)->first();
                //如果满标那么更新数据满标状态和时间
                if($sy['lend_money']==$sy['lend_repay_money']){
                    //总金额   期限   年化利率   借款类型   用户ID   标ID
                    $jh=$this->jyzCounter($sy['lend_money'],$sy['lend_return'],$sy['lend_repay_time'],$sy['lend_repay_method'],$sy['user_id'],$sy['lend_id']);
                    foreach($jh as $k=>$v){
                        DB::table('repayPlan')->insert($v);
                    }
                    $arr=['lend_id'=>$lend_id,'is_success'=>'1','success_time'=>time()];
                    DB::table('lend')->where('lend_id',$lend_id)->update($arr);
                    //print_r($jh);die;
                }
                if($re&&$one&&$res){
                    //投资成功
                    echo '1';
                }else{
                    //投资失败
                    echo '2';
                }

            }

        }
    }}


}
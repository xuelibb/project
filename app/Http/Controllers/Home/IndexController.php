<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    protected $path='basic/slideshow.txt';
    public function index(){
        //查询轮播图数据
        if(file_exists($this->path)){
            $arr=json_decode(file_get_contents($this->path),true);
            foreach($arr as $k=>$v){
                if($v['is_show']==0){
                    unset($arr['$k']);
                }
            }
        }else{
            $arr=[];
        }
        //查询网站基本设置
        if(file_exists("basic/settings.txt")){
            $settings=json_decode(file_get_contents("basic/settings.txt"),true);
        }
        //查询导航栏
        if(file_exists('basic/nav.txt')){
            $nav=json_decode(file_get_contents('basic/nav.txt'),true);
        }
        //查询友情链接
        $partner=DB::table('partner')->where('partner_is_show',1)->get();
        $disk = \Storage::disk('qiniu'); //使用七牛云上传
        foreach($partner as $k=>$v){
            $partner[$k]['partner_img']=$disk->getDriver()->privateDownloadUrl($v['partner_img']);
        }
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
        //查询借款信息
        $data=DB::table('lend')->where('lend_money','>',1)->where('is_success','!=',4)->orderBy('lend_id', 'desc')->limit(3)->get();
        //热门推荐
        $hot=DB::table('lend')->where('is_hot',1)->where('lend_money','>',1)->where('is_success','!=',4)->orderBy('lend_id','desc')->limit(3)->get();
        //总投资
        $sum=DB::table('lend')->sum('lend_repay_money');
        $sum=sprintf("%.2f",($sum/10000));
        //会员
        $vip=DB::table('user')->count('user_user');
        //总投资
        $invest_money=DB::table('invest')->sum('invest_money');
        //总收益（本金+利息）
        $invest_return_money=DB::table('invest')->sum('invest_return_money');
        //总利息
        $money=$invest_return_money-$invest_money;
        $money=sprintf("%.2f",($money/10000));
        $article=DB::table('article')->get();
        return view('home.index.index',['imgList'=>$arr,'settings'=>$settings,'nav'=>$nav,'sum'=>$sum,'money'=>$money,'vip'=>$vip,'article'=>$article,'invest'=>$data,'hot'=>$hot,'partner'=>$partner]);
    }
    //获取首页网站公告信息
    public function home_index_new(){
        $article=DB::table('article')->get();
        $msg=[
            'data'=>$article
        ];
        echo  \GuzzleHttp\json_encode($msg);
    }
}
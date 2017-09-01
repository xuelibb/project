<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Model\Home\Borrow;
use Illuminate\Support\Facades\DB;
class BorrowController extends CommonController
{
    //dw 后台域名审核
    public function domain(){
        $data=DB::table('lend')
            ->join('user','lend.user_id','=','user.user_id')
            ->get();
        // print_r($data);die;
        return view('admin.domain.index',['data'=>$data]);
    }
    //dw 域名审核完成
    public function domain_do(Request $request){
        $lend_worth=$request->input('lend_worth');
        $lend_worth=$lend_worth*0.8;
        $user_id=$request->input('user_id');
        $lend_goods=$request->input('lend_goods');
        //echo $lend_goods;die;
        //echo $lend_worth."<br>".$user_id;
        $res=DB::table('lend')->where(['lend_goods'=>$lend_goods,'user_id'=>$user_id])->update(['lend_worth'=>$lend_worth,'status'=>1]);
        if($res){
            return $this->success('审核完成',url('admin_domain'));
        }else{
            return $this->error('审核失败',url('admin_domain'));
        }
    }
    //dw 后台借款审核
    public function admin_bor(){
        $data=DB::table('lend')
            ->join('user','user.user_id','=','lend.user_id')
            ->select('lend.lend_id','user.user_user','lend.lend_goods','lend.borrow_state')
            ->get();
        //print_r($data);die;
        return view('admin.borrow.index',['data'=>$data]);
    }
    //后台借款详情页
    public function admin_bor_info(Request $request){
        $lend_id=base64_decode($request->input('id'));
        //echo $lend_id;
        $data=DB::table('lend')
            ->join('user','user.user_id','=','lend.user_id')
            ->select('lend.lend_id','user.user_user','lend.lend_goods','lend.lend_return','lend.lend_worth','lend.lend_repay_time','lend.lend_repay_method','lend.lend_number','lend.borrow_state','lend.lend_money')
            ->where('lend.lend_id',$lend_id)
            ->get();
        return view('admin.borrow.indexs',['data'=>$data]);
    }
    //借款审核成功
    public function admin_bor_su(Request $request){
        //echo 1;die;
        $lend_id=$request->input('lend_id');
        $lend_start_time=time();
        $lend_end_time=$lend_start_time+60*60*24*3;
        $model=new Borrow();
        $res=$model->upd('lend_id',$lend_id,['borrow_state'=>1,'lend_start_time'=>$lend_start_time,'lend_end_time'=>$lend_end_time]);
        if($res){
            return $this->success('审核完成',url('admin_bor'));
        }else{
            return $this->error('审核失败',url('admin_bor'));
        }
    }
}
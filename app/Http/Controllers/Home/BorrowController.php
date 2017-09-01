<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Home\Borrow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BorrowController extends Controller
{
    public function index(){

        return view('home.borrow.index');
    }

    public function borrow_list_data(Request $request){
        $status=$request->input('status');
        $user_id=$request->session()->get('user_id');
        //echo $status;die;
        if($status==2){
            $data=DB::table('lend')->where(['is_success'=>1,'user_id'=>$user_id])->get();
            foreach ($data as $k=>$v){
                $data[$k]['asign']=1;
            }
            //print_r($data);die;
        }else if ($status==0){
            $data=DB::table('lend')->where(['borrow_state'=>$status,'user_id'=>$user_id])->get();
        }else if($status==1){
            $data=DB::table('lend')->where(['borrow_state'=>$status,'user_id'=>$user_id,'is_success'=>0])->get();
        }else if($status==4){
            $data=DB::table('lend')->where(['borrow_state'=>1,'user_id'=>$user_id,'is_success'=>4])->get();
        }else if($status==3){
            $data=DB::table('lend')->where(['borrow_state'=>1,'user_id'=>$user_id,'is_success'=>5])->get();
        }
        //print_r($data);die;
        return view('home.borrow_son.borrow_list_data',['data'=>$data]);
    }
    //dw 域名质押入库
    public function domain_do(Request $request){
        $data=$request->input();
        unset($data['_token']);
        //print_r($data);
        $data['user_id']=$request->session()->get('user_id');
        //print_r($data);
        $model=new Borrow();
        $res=$model->add($data);
        if($res){
            return $this->success('亲，你已添加成功，请等待审核',url('pawn_list'));
            //echo "<script>alert('亲，你已添加成功，请等待审核');location.href='domain';</script>";
        }else{
            return $this->error('亲，添加失败，请重新添加',url('domain'));
            //echo "<script>alert('亲，添加失败，请重新添加');location.href='domain';</script>";
        }
    }
    //dw 我要借款
    public function borrow_insert(){
        $lend_goods=base64_decode(Input::get('lend_goods'));
        $lend_worth=base64_decode(Input::get('lend_worth'));
        //echo $lend_worth;die;
        //echo $lend_goods.$lend_worth;
        return view('home.borrow.news',['lend_goods'=>$lend_goods,'lend_worth'=>$lend_worth]);
    }
    //dw 我要借款入库
    public function borrow_bor(Request $request){
        //print_r($request->input());die;
        $lend_goods=$request->input('lend_goods');
        //echo $lend_goods;die;
        $user_id=$request->session()->get('user_id');
        //echo $user_id;die;
        $data['lend_return']=$request->input('lend_return');
        $data['lend_money']=$request->input('lend_money');
        $data['lend_repay_time']=$request->input('lend_repay_time');
        $data['lend_repay_method']=$request->input('lend_repay_method');
        $data['lend_number']=time().rand(1000,9999);
        $data['lend_few_money']=100;
        $res=DB::table('lend')->where(['lend_goods'=>$lend_goods,'user_id'=>$user_id])->update($data);
        if($res){
//            $arr=$this->jyzCounter($data['lend_money'],$data['lend_return'],$data['lend_repay_time'],$data['lend_repay_method']);
//            print_r($arr);
            return $this->success('亲，你已添加成功，请等待审核',url('pawn_list'));
        }else{
            //echo 1;
            return $this->error('亲，添加失败，请重新添加',url('pawn_list'));
        }
    }

}
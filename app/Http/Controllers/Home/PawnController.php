<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/7/13
 * Time: 19:27
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Home\Borrow;

class PawnController extends Controller
{
    public function pawn_list_data(Request $request){
        $status=$request->input('status');
        $user_id=$request->session()->get('user_id');
        $data=DB::table('lend')->where(['user_id'=>$user_id,'status'=>$status])->select('lend_goods','lend_worth','status','borrow_state')->get();
        //print_r($data);die;
        return view('home.pawn_son.pawn_list_data',['data'=>$data]);
    }
}
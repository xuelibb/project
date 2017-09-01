<?php

namespace App\Http\Controllers\Home;

use App\Model\Home\RepaymentModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RepaymentController extends Controller
{
    public function index(){

        $user_id=session("user_id");
        $model=new RepaymentModel();
        $re=$model->se(3);
        $data['lilv']=$re['lend_return'];
        $data['zonge']=$re['lend_money'];
        $data['qixian']=$re['lend_repay_time'];
        return view('home/repay/index',$data);
    }
}

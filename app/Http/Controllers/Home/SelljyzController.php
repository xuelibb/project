<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Model\Home\User_details;
use Illuminate\Support\Facades\DB;
class SelljyzController extends Controller{
    public function timeUpdate()
    {
        $time=time()+60*60*24*30;
        $re=DB::table("repayPlan")->where("r_time","<=",$time)->where("r_statr",0)->update(['r_statr'=>1]);
    }
}
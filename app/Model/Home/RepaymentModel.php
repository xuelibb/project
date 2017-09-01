<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class RepaymentModel extends Model
{
    public function se($user_id){
       return DB::table("lend")->select("lend_return","lend_money","lend_start_time","lend_end_time","lend_repay_time")->where("user_id",$user_id)->first();
    }
}

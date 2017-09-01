<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Support\Facades\Input;

class UserListController extends Controller
{
    public function userList(){
        $new="";
        $count="";
        if(Cache::store('file')->has("userList"))
        {
            $new=Cache::store('file')->pull("userList");
        }
        else
        {
            $re = DB::table("user")->select("user_id", "user_user", "user_tel", "assess")->orderBy("user_id","asc")->get();
            $user_id = "";
            foreach ($re as $k => $v) {
                $user_id[] = $v['user_id'];
            }
            foreach($re as $k=>$v)
            {
                $re[$k]['count']=DB::table("lend")->where("user_id",$v['user_id'])->count();
            }
            $res = DB::table("user_details")->select("is_new", "xyd", "details_img")->wherein("details_id", $user_id)->get();
//            print_r($re);
//            echo "<br>";
//            print_r($user_id);
//            echo "<br>";
//            print_r($res);die;
            foreach ($re as $k => $v) {
                $new[$k] = array_merge($v, $res[$k]);
            }
            Cache::store('file')->put("userList",$new,1000);
        }
        $data['new']=$new;
        return view("admin/user/userList",$data);
    }
    public function ajax(){
        $user_id=Input::get("user_id");
        if(Cache::store('file')->has($user_id))
        {
            $res=Cache::store('file')->pull($user_id);
        }
        else
        {
            $res = DB::table("user_details")->select("is_new", "xyd", "details_name","details_card","details_sex","details_address","details_balance")->where("details_id", $user_id)->first();
            foreach($res as $k=>$v)
            {
                if(empty($v))
                {
                    $res[$k]="*";
                }
            }
            Cache::store('file')->put($user_id,$res,1000);
        }

        echo json_encode($res);
    }
}

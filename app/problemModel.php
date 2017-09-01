<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class problemModel extends Model
{
    public function add_pro($table,$data)
    {
        $id=DB::table($table)->insertGetId($data);
        return $id;
    }
    public function select_pro($table)
    {
        $info=DB::table($table)->get();
        return $info;
    }
    public function select_order($table,$key,$order)
    {
        $info=DB::table($table)->orderBy($key,$order)->get();
        return $info;
    }
    public function select_max(){
        $max="select sum(q.s) m from (select max(o_grade) s from `zcm_option` GROUP BY p_id) q";
        $info=DB::select($max)[0]['m'];
        return $info;
    }
    public function select_min(){
        $min="select sum(q.s) n from (select min(o_grade) s from `zcm_option` GROUP BY p_id) q";
        $info=DB::select($min)[0]['n'];
        return $info;
    }
    public function update_user($data,$user_id,$kid="user_id",$table="user")
    {
        $info=DB::table($table)->where($kid,$user_id)->update($data);
        return $info;
    }
    public function select_where($table,$key,$id,$all="")
    {
        if($all=="one")
        {
            $g="first";
        }
        else
        {
            $g="get";
        }
        $info=DB::table($table)->where($key,$id)->$g();
        return $info;
    }
    public function count($table)
    {
        $info=DB::table($table)->count();
        return $info;
    }
    public function del($table,$kid,$id){
        $info=DB::table($table)->where($kid,"=",$id)->delete();
        return $info;
    }
}

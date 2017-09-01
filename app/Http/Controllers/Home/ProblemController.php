<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\problemModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
class ProblemController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model=new problemModel();
    }

    public function index()
    {
        $url=public_path()."/layout/home/wentimoban";
        $str=file_get_contents($url);
        $problem=$this->model->select_pro("problem");
        $option=$this->model->select_order("option","o_order","asc");
        $newArray=$this->merge($problem,$option);
        $max=$this->model->select_max();
        $min=$this->model->select_min();
        $data['newArray']=$newArray;
        $data['max']=$max;
        $data['min']=$min;
//        $rr="";
//        $i=1;
//        foreach($newArray as $k=>$v){
//            $rr.='<div class="pro"><span class="po"></span><p class="p_title">'.$i.';'.$k.'</p></div><div class="opt">';
//            foreach($v as $key=>$val){
//                $rr.='<li><input type="radio" class="opt_true" name="'.$val['p_id'].'" value="'.$val['o_grade'].'">'.$val['o_option'].'</li>';
//            }
//            $rr.='</div>';
//            $i++;
//        }
//        $mn="";
//        $mn.='<input type="hidden" value="'.$max.'" id="max"><input type="hidden" value="'.$min.'" id="min">';
//        $str=str_replace("{content}",$rr,$str);
//        $str=str_replace("{mn}",$mn,$str);
//        echo "缓存".$str;
        return view("home.problem.index",$data);
    }
    public function up_assess(){
        $data['assess']=Input::get("assess");
//        $user_id=1;//整合时将这行代码注释
//        $data['number']=3-1;//整合时将这行代码注释
        //项目整合时将注释打开
        $number=session("number")-1;
        $data['number']=$number;
        $user_id=session("user_id");
        session()->put("assess",$data['assess']);
        $re=$this->model->update_user($data,$user_id);
        echo $re;
    }
    function merge($problem,$option){
        $newArray=array();
        foreach($problem as $k=>$v)
        {
            foreach($option as $key=>$val)
            {
                if($v['id']==$val['p_id'])
                {
                    $newArray[$v['exam_title']][]=$val;
                }
            }
        }
        return $newArray;
    }
}

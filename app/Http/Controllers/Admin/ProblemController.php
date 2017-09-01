<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\problemModel;
class ProblemController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model=new problemModel();
    }

    public function index(){
        return view("admin.problem.index");
    }
    public function add()
    {
        $exam_title=array();
        $option=array();
        $order=array();
        $grade=array();
        $num=Input::get('num');
        foreach($num as $k=>$v){
            $exam_title[]=Input::get('exam_title'.$v);
            $option[]=Input::get('option'.$v);
            $order[]=Input::get('order'.$v);
            $grade[]=Input::get('grade'.$v);
        }
        foreach($option as $k=>$v) {
            $time = date("Y-m-d H:i:s", time());
            $data['exam_title'] = $exam_title[$k];
            $data['addtime'] = $time;
            $id=$this->model->add_pro("problem",$data);
            foreach($v as $key=>$val)
            {
                $arr[$k][$key]["option"]=$val;
                $arr[$k][$key]["order"]=$order[$k][$key];
                $arr[$k][$key]["grade"]=$grade[$k][$key];
                $arr[$k][$key]["id"]=$id;
            }
        }
        $ar=array();
        foreach($arr as $k=>$v)
        {
            $ar=array_merge($ar,$v);
        }
        foreach($ar as $k=>$v)
        {
            $data1["o_option"]=$v['option'];
            $data1["o_order"]=$v['order'];
            $data1["o_grade"]=$v['grade'];
            $data1["p_id"]=$v['id'];
            $this->model->add_pro("option",$data1);
        }
    }

    public function show()
    {
        $data['info']=$this->model->select_pro("problem");
        $data['sum']=$this->model->count("problem");
        return view("admin.problem.problemInfo",$data);
    }
    public function pro_ajax_info(){
        $pid=Input::get("p_id");
        $data['pro']=$this->model->select_where("problem","id",$pid,"one");
        $data['opt']=$this->model->select_where("option","p_id",$pid);
        echo json_encode($data);
    }
    public function pro_ajax_update(){
        $id=Input::get('o_id');
        $opt=Input::get('opt');
        $key=Input::get('k');
        $table=Input::get('t');
        $kid=Input::get('kid');
        $data[$key]=$opt;
        $sql="update $table set $key='$opt' where $kid=$id";
        $re=$this->model->update_user($data,$id,$kid,$table);
        if($re)
        {
            echo true;
        }
        else
        {
            echo false;
        }
    }
    public function pro_ajax_del(){
        $id=Input::get("id");
        $re=$this->model->del("problem","id",$id);
        $res=$this->model->del("option","p_id",$id);
        echo $res;
    }
}

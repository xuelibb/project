<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/6/15
 * Time: 15:42
 */

namespace App\Model\Home;


use Illuminate\Database\Eloquent\Model;
use DB;

class User_details extends  Model
{
    protected $table='user_details';
    protected $primaryKey='details_id';
    //进行添加
    public function details_add($post){
        $real_name=$post['real_name'];
        $cert_no=$post['cert_no'];
        $details_user_id=session('user_id');
        $name_exists=$this->where('details_card',$cert_no)->exists();
        if($name_exists){
            return ['code'=>5,'msg'=>'您的身份证信息已经存在！'];
        }
        $model=$this->where('details_user_id',$details_user_id)->first();
        $model->details_name=$real_name;
        $model->details_card=$cert_no;
        $model->details_user_id=$details_user_id;
        if($model->save()){
            return ['code'=>1,'msg'=>'成功'];
        }
    }
}
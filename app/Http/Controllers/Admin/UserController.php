<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Model\Admin\Role;
use App\Model\Admin\Node;
class UserController extends CommonController
{
    public function index(){
        $data=DB::table('admin_user')->get();
        return view('admin.user.add',['data'=>$data]);
    }
    public function add(){
        $model=new Role();
        $data=$model->read();
        // print_r($data);
        return view('admin.user.adds',['data'=>$data]);
    }
    public function add_do(Request $request){
        $data=$request->input();
        $role_id=$data['role_id'];
        $data['user_password']=md5($data['user_password']);
        unset($data['_token']);
        unset($data['role_id']);
        //  print_r($data);die;
        $user_id=DB::table('admin_user')->insertGetId($data);
        if($user_id){
            $res=DB::table('role_user')->insert(['user_id'=>$user_id,'role_id'=>$role_id]);
            if($res){
                echo "<script>alert('管理员添加成功');location.href='admin_user';</script>";
            }else{
                echo "<script>alert('管理员添加失败');location.href='admin_user_add';</script>";
            }
        }else{
            echo "<script>alert('管理员添加失败');location.href='admin_user_add';</script>";
        }
    }
}
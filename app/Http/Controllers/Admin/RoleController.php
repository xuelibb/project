<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Model\Admin\Role;
use App\Model\Admin\Node;
class RoleController extends CommonController
{
    public function index(Request $request){
        // $user_id=$request->session()->get('user_id');
        //define('USER_ID','1');
        $data=DB::table('role')->get();
        // ->join('role', function ($join) {
        //     $join->on('role_user.role_id', '=', 'role.role_id');
        // })
        // ->get();
        //$data=DB::table('role_user')->join('role.role_id','role_user.role_id')->where('role_user.user_id','=',$user_id)->get();
        //print_r($data);
        return view('admin.role.index',['data'=>$data]);
    }
    public function add(){
        $model=new Node();
        $data=$model->read();
        //print_r($data);die;
        return view('admin.role.add',['data'=>$data]);
    }
    public function add_do(Request $request){
        $data=$request->input();
        $node_id=$data['node_id'];
        unset($data['_token']);
        unset($data['node_id']);
        $model=new Role();
        $res=$model->add($data);
        if($res){
            foreach($node_id as $k=>$v){
                $res=DB::table('role_node')->insert(['role_id'=>$res,'node_id'=>$v]);
            }
            if($res){
                echo "<script>alert('角色添加成功');location.href='admin_role';</script>";
            }else{
                echo "<script>alert('角色添加失败');location.href='admin_role_do';</script>";
            }
        }else{
            echo "<script>alert('角色添加失败');location.href='admin_role_do';</script>";
        }
    }

}
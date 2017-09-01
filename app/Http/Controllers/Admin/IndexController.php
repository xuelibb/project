<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Model\Admin\Node;
class IndexController extends CommonController
{
    public function index(Request $request){
        //$user_id=3;
        $user_id=$request->session()->get('admin_id');
        if(empty($user_id)){
            return $this->error('对不起，请先登录',url('admin_login'));
        }
        if($user_id==1 || $user_id==2 || $user_id==3){
            $model=new Node();
            $data=$model->read();
        }else{
            $data=DB::table('admin_user')
            ->join("role_user",'admin_user.user_id','=','role_user.user_id')
            ->join('role','role_user.role_id','=','role.role_id')
            ->join('role_node','role.role_id','=','role_node.role_id')
            ->join('node','role_node.node_id','=','node.node_id')
            ->where('admin_user.user_id','=',$user_id)
            ->get();
        }
        $new='';
        foreach($data as $k=>$v){
            if($v['p_id']==0){
                $new[$v['node_name']]=array();
                //print_r($new);die;
                foreach($data as $ke=>$ve){
                    if($ve['p_id']==$v['node_id']){
                        $new[$v['node_name']][$ve['node_url']]=$ve['node_name'];
                    }
                }
            }
        }
        //print_r($new);die;
        $user_name=$request->session()->get('user_name');
        return view('admin/index/index',['data'=>$new,'user_name'=>$user_name]);
    }
    public function index_info(){
        return view('admin.index.indexs');
    }
}
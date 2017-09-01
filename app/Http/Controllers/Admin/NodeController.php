<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Model\Admin\Node;
class NodeController extends CommonController
{
	public function index(){
		$model=new Node();
		$data=$model->read();
		return view('admin.node.index',['data'=>$data]);
	}
	public function add(){
		$model=new Node();
		$datas=$model->read();
		//print_r($data);die;
		$data=$this->tree($datas);
		//print_r($data);die;
		foreach($data as $k=>$v){
			$data[$k]['node_name']=str_repeat('--',$v['Count']).$v['node_name'];
		}
		//print_r($data);die;
		return view('admin.node.add',['data'=>$data]);
	}
	public function add_do(Request $request){
		$data=$request->input();
		// print_r($data);
		unset($data['_token']);
		$model=new Node();
		$res=$model->insert($data);
		if($res){
			echo "<script>alert('权限添加成功');location.href='admin_node'</script>";
		}else{
			echo "<script>alert('权限添加失败');location.href='admin_node_add'</script>";
		}
	}
	public function tree($data, $treeList=array(),$pid = 0,$count = 1) {
		//  static $treeList=array();
        foreach ($data as $key => $value){
            if($value['p_id']==$pid){
                $value['Count'] = $count;
                $treeList[]=$value;
                //unset($data[$key]);
                $treeList=$this->tree($data,$treeList,$value['node_id'],$count+1);
            } 
        }
        return $treeList;
    }
	public function update(){
		$id=Input::get('id');
		$model=new Node();
		$data=$model->one('node_id',$id);
		$datas=$model->read();
		//print_r($data);die;
		$arr=$this->tree($datas);
		//print_r($data);die;
		foreach($arr as $k=>$v){
			$arr[$k]['node_name']=str_repeat('--',$v['Count']).$v['node_name'];
		}
		//print_r($data);
		return view('admin.node.update',['data'=>$data,'arr'=>$arr,'id'=>$id]);
	}
	public function update_do(Request $request){
		$id=Input::get('id');
		$data=$request->input();
		// print_r($data);
		unset($data['_token']);
		unset($data['id']);
		$model=new Node();
		$res=$model->upd('node_id',$id,$data);
		if($res){
			echo "<script>alert('权限修改成功');location.href='admin_node'</script>";
		}else{
			echo "<script>alert('权限修改失败');location.href='admin_node_update'</script>";
		}
	}
	public function del(){
		$id=Input::get('id');
		$model=new Node();
		$res=$model->del(['node_id'=>$id]);
		if($res){
			echo "<script>alert('权限删除成功');location.href='admin_node'</script>";
		}else{
			echo "<script>alert('权限删除失败');location.href='admin_node'</script>";
		}
	}
}
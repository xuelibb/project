<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Http\Request;
use App\Model\Admin\Lottery;
use Illuminate\Support\Facades\Input;
class LotteryController extends CommonController
{
    public function index(){
    	$model=new Lottery(); //实例化model
    	//dd($model);die;
    	$data = $model->read(); //调用model层中方法
   		//dd($data);die;
        return view('admin.lottery.index',['data'=>$data]);
    }
    public function add(){
    	return view("admin.lottery.add");
    }
    public function add_do(Request $request){
    	$data=$request->input();
        if($data['activity_name']=='大转盘活动'){
            $data['state']=1;
        }else{
            $data['state']=0;
        }
    	unset($data['_token']);
    	$data['start_time']=strtotime($data['start_time']);
    	$data['end_time']=strtotime($data['end_time']);
    	$model=new Lottery();
    	$res=$model->add($data);
    	if($res){
    	    return $this->success('活动添加成功',url('admin_lottery'));
    	}else{
            return $this->error('活动添加失败',url('admin_lottery_add'));
    	}
    }
    public function up(){
    	$id=Input::get('id');
    	$model=new Lottery();
    	$data=$model->one('activity_id',$id);
    	if($data[0]['status']==0){
    		$data=$model->upd('activity_id',$id,['status'=>1]);
    		if($data){
                return $this->success('修改成功',url('admin_lottery'));
    		}else{
                return $this->error('修改失败',url('admin_lottery'));
    		}
    	}else{
    		$data=$model->upd('activity_id',$id,['status'=>0]);
    		if($data){
                return $this->success('修改成功',url('admin_lottery'));
    		}else{
                return $this->error('修改失败',url('admin_lottery'));
    		}
    	}
    }
    public function del(){
    	$id=Input::get('id');
    	$model=new Lottery();
    	$res=$model->del(['activity_id'=>$id]);
    	if($res){
            return $this->success('删除成功',url('admin_lottery'));
    	}else{
            return $this->error('删除失败',url('admin_lottery'));
    	}
    }
    public function update(){
    	$id=Input::get('id');
    	$model=new Lottery();
    	$data=$model->one('activity_id',$id);
    	return view('admin/lottery/update',['data'=>$data]);
    }
    public function update_do(Request $request){
    	$id=Input::get('id');
    	//echo $id;die;
    	$data=$request->input();
        if($data['activity_name']=='大转盘活动'){
            $data['state']=1;
        }else{
            $data['state']=0;
        }
    	unset($data['_token']);
    	unset($data['id']);
    	$data['start_time']=strtotime($data['start_time']);
    	$data['end_time']=strtotime($data['end_time']);
    	$model=new Lottery();
    	$res=$model->upd('activity_id',$id,$data);
    	if($res){
            return $this->success('修改成功',url('admin_lottery'));
    	}else{
            return $this->error('修改失败',url('admin_lottery'));
    	}
    }
}
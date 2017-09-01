<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
class ArticleController extends Controller
{   
    /**
     * /
     * @return [type] [文章首页]
     */
    public function index(){
        $page=DB::table('article')->paginate(4);
        return view('admin/article/index',['article_info'=>$page,'page'=>$page]);
    }
    /**
     *文章添加页面渲染
     */
    public function add(){
        return view('admin/article/add');
    }
    /**
     * 文章添加动作
     */
    public function add_do(){
        unset($_POST['_token']);
        $_POST['article_time']=time();
        $_POST['update_time']=time();
        $re=DB::table('article')->insert($_POST);
        if($re){
            return  $this->success('添加成功','admin_article');
        }else{
            return  $this->error('添加失败,请重新添加！','admin_article_add');
        }
    }
    /**
     * /
     * 文章修改
     * @param  [type] $id [文章id]
     * @return [type]     [跳转到form表单]
     */
    public function update(){
        $id=Input::get('id');
        $one=DB::table('article')->where('article_id',$id)->first();
         return view('admin/article/update',['article_info'=>$one]); 
    }
    /**
     * /
     * @return [type] [文章修改动作]
     */
   public function update_do(){
            $id=Input::get('id');
            unset($_POST['_token']);
            $_POST['update_time']=time();
            $one=DB::table('article')->where('article_id',$id)->update($_POST);
            if($one){
                return  $this->success('修改成功','admin_article');
            }else{
                return  $this->error('修改失败,请重新修改！',"admin_article");
            }
   }
   /**
    * /
    * @param  [type] $id [文章id]
    * @return [type]     [根据文章id执行删除]
    */
   public function delete($id){
        $del=DB::table('article')->where("article_id",$id)->delete();
        if($del){
            
        }else{
            echo "<script>alert('删除失败');location.href='admin_article';</script>";
        }
    }
}



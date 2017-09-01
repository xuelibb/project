<?php
/**
 * 网站基本设置控制器
 * 开发人：lhb
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use App\Model;
class BasicController extends Controller
{
    //轮播图存储文件路径
    protected $path='basic/slideshow.txt';
   /*
    * 轮播图展示
    * */
   public function  slideshow(){
       if(file_exists($this->path)){
           $arr=json_decode(file_get_contents($this->path),true);
       }else{
           $arr=[];
       }
       return view('admin/basic/slideshow',['list'=>$arr]);
   }
   //添加轮播图
    public function  addSlideshow(){
        if(!empty($_POST)){
            $data=$_POST;
            unset($data['_token']);
            $file = Request()->file('img');
            if(empty($file)){
                return $this->error('请先上传图片！！','addSlideshow');
            }
            //调用上传方法
            $filepath=$this->uploads('img');
            $data['img']=$filepath;
            //存储到 public/basic/下
            if(file_exists($this->path)){
                $html=file_get_contents($this->path);
                $arr=json_decode($html,true);
                $arr[]=$data;
            }else{
                $arr[]=$data;
            }
            $res=file_put_contents('basic/slideshow.txt',json_encode($arr));
            if($res){
                return $this->success('添加成功！','slideshow');
            }else{
                return $this->error('添加失败！','slideshow');
            }
        }
        return view('admin/basic/addSlideshow');
    }
    //删除轮播图
    public  function  delSlideshow($id){
        $arr=json_decode(file_get_contents($this->path),true);
        if(count($arr)<=1){
            return $this->error('最后一张图片无法删除！','../slideshow');
        }else{
            unlink($arr[$id]['img']);
            unset($arr[$id]);
            $res=file_put_contents('basic/slideshow.txt',json_encode($arr));
            if($res){
                return  redirect('slideshow');
            }else{
                return $this->error('删除失败！','../slideshow');
            }
        }
    }
    //修改轮播图 $id为要修改的id
    public  function saveSlideshow($id){
        if(!empty($_POST)){
            $arr=json_decode(file_get_contents($this->path),true);
            $data=$_POST;
            unset($data['_token']);
            $file = Request()->file('img');
            if(empty($file)){
                $oldimg=$data['oldimg'];
                $data['img']=$oldimg;
                unset($data['oldimg']);
                if(file_exists($this->path)){
                    $arr[$id]=$data;
                    $res=file_put_contents('basic/slideshow.txt',json_encode($arr));
                    if($res){
                       return $this->success('修改成功!','../slideshow');
                    }else{
                        return $this->error('修改失败!','../slideshow');
                    }
                }else{
                    return $this->error('修改失败!','../slideshow');
                }
            }else{
               $path=$this->uploads('img');
               $data['img']=$path;
                unlink($data['oldimg']);
                unset($data['oldimg']);
                $arr[$id]=$data;
                $res=file_put_contents('basic/slideshow.txt',json_encode($arr));
                if($res){
                    return $this->success('修改成功!','../slideshow');
                }else{
                    return $this->error('修改失败!','../slideshow');
                }
            }

        }{
            if(file_exists($this->path)){
                $arr=json_decode(file_get_contents($this->path),true);
                return view('admin/basic/saveSlideshow',['list'=>$arr[$id],'id'=>$id]);
            }else{
                return $this->error('修改失败!','slideshow');
            }
        }
    }
    /*
     * 网站设置
     * */
    public function site_settings(){
        $path="basic/settings.txt";
        if(file_exists($path)){
            $data=json_decode(file_get_contents($path),true);
        }
        return view('admin.basic.site_settings',['list'=>$data]);
    }
    //设置基本信息
    public function add_site_settings(){ 
        //文件保存路径
        $path="basic/settings.txt";
        $data=$_POST;
        unset($data['_token']);
        $file = Request()->file('logo');
        if(!empty($file)){
            //调用上传方法
            $filepath=$this->uploads('logo');
            $data['img']=$filepath;
            if(file_exists($path)){
                $arr=json_decode(file_get_contents($path),true);
            }
            unlink($arr['img']);    
        }else{
            if(file_exists($path)){
                $arr=json_decode(file_get_contents($path),true);
            }
            $data['img']=$arr['img'];
        }
        //存储到 public/basic/下
        $res=file_put_contents($path,json_encode($data));
        if($res){
            return $this->success('设置成功！','admin_info');
        }else{
            return $this->error('设置失败！','admin_info');
        }
    }

    /**
     * 导航设置
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function nav(){
        if(!empty($_POST)){
            $data=$_POST;
            unset($data['_token']);
            foreach ($data['nav_title'] as $k=>$v){
                $arr[]=[
                    'nav_title'=>$v,
                    'nav_link'=>$data['nav_link'][$k]
                ];
            }
            $arr=file_put_contents('basic/nav.txt',json_encode($arr));
            if($arr){
                return $this->success('设置成功','admin_nav');
            }else{
                return $this->error('设置失败','admin_nav');
            }
        }else{
            if(file_exists('basic/nav.txt')){
                $arr=json_decode(file_get_contents('basic/nav.txt'),true);
            }
            return  view('admin.basic.nav',['arr'=>$arr]);
        }

    }

    /**
     * 友情链接展示
     */
    public function partner(){
        //查询数据
        $partner=DB::table('partner')->get();
        $disk = \Storage::disk('qiniu'); //使用七牛云上传
        foreach($partner as $k=>$v){
            $partner[$k]['partner_img']=$disk->getDriver()->privateDownloadUrl($v['partner_img']);
        }
        return view('admin.basic.partner',['partner'=>$partner]);
    }
    //友情链接添加
    public  function  add_partner(){
        if(empty($_POST)){
            return view('admin.basic.add_partner');
        }else{
            $image = $_FILES["img"]["tmp_name"];
            $fp = fopen($image, "r");
            $file = fread($fp, $_FILES["img"]["size"]); //二进制数据流
            $filePath=$this->uploadImg($file);
            if(!$filePath){
                return $this->error('图片上传失败，请重新选择文件上传！','admin_add_partner');
            }else{
                $row=['partner_link'=>$_POST['link'],'partner_img'=>$filePath,'partner_is_show'=>$_POST['is_show']];
                $res=DB::table('partner')->insert($row);
                if(!$res){
                    return $this->error('添加失败，请重新添加！！','admin_add_partner');
                }
                return $this->success('添加成功！','admin_partner');
            }
        }
    }

    /**
     * 删除友情链接
     * @param $id [要删除的数据ID]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delPartner($id){
        $disk = \Storage::disk('qiniu'); //使用七牛云上传
        $partner=DB::table('partner')->where('partner_id',$id)->get();
        $res=DB::table('partner')->where('partner_id',$id)->delete();
        if($res){
            $img=$partner[0]['partner_img'];
            $delRes=$disk->delete($img);
            if($delRes){
                return $this->success('删除成功！','../admin_partner');
            }else{
                return $this->error('删除失败！','../admin_partner');
            }
        }
    }

    /**
     * 修改友情链接
     * @param $id [数据id]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function savePartner($id){
        $partner=DB::table('partner')->where('partner_id',$id)->get();
        if(empty($_POST)){
            $disk = \Storage::disk('qiniu'); //使用七牛云上传
            foreach($partner as $k=>$v){
                $partner[$k]['partner_img']=$disk->getDriver()->privateDownloadUrl($v['partner_img']);
            }
            return view('admin.basic.save_partner',['partner'=>$partner[0]]);
        }else{
            if(!empty($image =$_FILES["img"]["tmp_name"])){
                //引入qiniu
                $disk = \Storage::disk('qiniu'); //使用七牛云上传
                $fp = fopen($image, "r");
                $file = fread($fp, $_FILES["img"]["size"]); //二进制数据流
                $filePath=$this->uploadImg($file);
                if($filePath){
                    $delRes=$disk->delete($partner[0]['partner_img']);
                    $res=DB::table('partner')->where('partner_id',$id)->update(['partner_link'=>$_POST['link'],'partner_img'=>$filePath,'partner_is_show'=>$_POST['is_show']]);
                    if($res){
                        return $this->success('修改成功','../admin_partner');
                    }else{
                        return $this->error('修改失败','../admin_partner');
                    }
                }else{
                    return $this->error('图片修改失败！','../admin_partner');
                }
            }else {
                $res=DB::table('partner')->where('partner_id',$id)->update(['partner_link'=>$_POST['link'],'partner_is_show'=>$_POST['is_show']]);
                if($res){
                    return $this->success('修改成功','../admin_partner');
                }else{
                    return $this->error('修改失败！','../admin_partner');
                }
            }

        }

    }
    /**
     * 上传图片
     * @author fangdong
     */
    public function uploadImg($request)
    {
        $disk = \Storage::disk('qiniu'); //使用七牛云上传
        $time = 'zcm_'.date('YmdHis').rand(1111,9999).'.jpg';
        $res = $disk->put($time,$request);//上传
       if($res){
           return $time;
       }else{
           return  false;
       }
    }
    /**
     *文件上传方法
     * @param $filename [上传表单name名]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string|\think\response\View
     */
    public function uploads($filename){
        $file = Request()->file($filename);
        $allowed_extensions = ["png", "jpg", "gif"];  //支持文件类型
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return $this->error('亲，只支持 png, jpg 或 gif.格式的图片！！','addSlideshow');
        }
        $destinationPath = 'uploads/'; //public 文件夹下面建 uploads 文件夹
        $extension = $file->getClientOriginalExtension();
        $Name = str_random(10).'.'.$extension;
        $filepath=$file->move($destinationPath, $Name);
        $path='uploads/'.$filepath->getFilename();
        return $path;
    }
}
<?php
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Model\Home\User_details;
use Illuminate\Http\Request;
use DB;

class Register_telController extends Controller
{
    private static $appKey = "24540158";
    private static $appSecret = "59275794e0ef4edbcd0ff8e26f19f0fe";
    //协议(http或https)://域名:端口，注意必须有http://或https://
    private static $host = "https://dm-51.data.aliyun.com";

    public function index(Request $request){
        //判断用户是否登录，没有登录跳转
        if(session('islogin')!=1){
            return redirect('/login');
        }
//        dd(session()->all());
        if($request->isMethod('post')){
            //接收用户提交的信息
            $name = $request->file('id_photos');
            if(empty($name)){
                return back()->with('msg','请选择身份证上传');
            }
            $allowed_extensions = ["png","jpg"];
            if ($name->getClientOriginalExtension() && !in_array($name->getClientOriginalExtension(), $allowed_extensions)) {
                return back()->with('msg','只支持png和jpg格式的图片');
            }
            //文件路径
            $destinationPath = 'uploads/';
            $extension = $name->getClientOriginalExtension();
            //文件名称
            $fileName = time().str_random(10).'.'.$extension;
            $name->move($destinationPath, $fileName);
            //文件全路径
            $file=$destinationPath.$fileName;
            $filePath = asset($destinationPath.$fileName);
            //echo $file;die;
            //引入接口库
            include_once app_path().'/Code/Util/Autoloader.php';
            //实例化Model
            $userinfo=json_decode($this->doPostString($file));
            //获取用户真实数据
            //print_r($userinfo);die;
            $post=json_decode($userinfo->outputs[0]->outputValue->dataValue,true);
            //获取当前用户id
//            var_dump($success=$post['success']);
            $user_id=session('user_id');
            if(!$post['success']) {
                unlink($file);
                //获取到用户信息以后进行入库操作
                return back()->with('msg','请确保照片内信息清晰可读');
            }
            //进行查询该身份证号码是否存在
            $code=$post['num'];
            $is_code=DB::table('user_details')->where('details_card',$code)->first();
            if($is_code){
                unlink($file);
                return back()->with('msg','身份证信息已经存在，请重新上传。');
            }
            $info=DB::table('user_details')->where('details_user_id', $user_id)->update(['details_name' => $post['name'], 'details_card' => $code, 'details_address' => $post['address'], 'details_sex' => $post['sex'], 'details_img' => $file,'is_new'=>1]);
            if(!$info)
            {
                unlink($file);
                return back()->with('msg','请确保照片内信息清晰可读');
            }
            $box=$request->input('box');
            if(empty($box)){
                return redirect('register_success');
            }
            else{
                return view('home.register_tel.real_name_success');

            }


        }
        return view('home.register_tel.index');
    }
    //转换base64
    public function imgToBase64($filePath){
        $img_base64 = '';
        $img_info = getimagesize($filePath);
        $img_type = $img_info[2];
        $fp = fopen($filePath,'r');
        if($fp){
            $file_content = chunk_split(base64_encode(fread($fp,filesize($filePath))));
            fclose($fp);
        }
        return $file_content;
    }

    public function doPostString($file) {
        //域名后、query前的部分
        //$path = "/poststring";
        $path = "/rest/160601/ocr/ocr_idcard.json";
        $request = new \HttpRequest($this::$host, $path, \HttpMethod::POST, $this::$appKey, $this::$appSecret);
        $base64_img_string = $this->imgToBase64("$file");

        //传入内容是json格式的字符串
        //$bodyContent = "{\"inputs\": [{\"image\": {\"dataType\": 50,\"dataValue\": \"base64_image_string\"},\"configure\": {\"dataType\": 50,\"dataValue\": \"{\\\"side\\\":\\\"face\\\"}\"}}]}";

        $bodyContent = "{\"inputs\": [{\"image\": {\"dataType\": 50,\"dataValue\": \"".$base64_img_string."\"},\"configure\": {\"dataType\": 50,\"dataValue\": \"{\\\"side\\\":\\\"face\\\"}\"}}]}";
        //设定Content-Type，根据服务器端接受的值来设置
        $request->setHeader(\HttpHeader::HTTP_HEADER_CONTENT_TYPE, \ContentType::CONTENT_TYPE_JSON);

        //设定Accept，根据服务器端接受的值来设置
        $request->setHeader(\HttpHeader::HTTP_HEADER_ACCEPT, \ContentType::CONTENT_TYPE_JSON);
        //如果是调用测试环境请设置
        //$request->setHeader(SystemHeader::X_CA_STAG, "TEST");
        //注意：业务header部分，如果没有则无此行(如果有中文，请做Utf8ToIso88591处理)
        //mb_convert_encoding("headervalue2中文", "ISO-8859-1", "UTF-8");
        //$request->setHeader("b-header2", "headervalue2");
        //$request->setHeader("a-header1", "headervalue1");
        //注意：业务query部分，如果没有则无此行；请不要、不要、不要做UrlEncode处理
        //$request->setQuery("b-query2", "queryvalue2");
        //$request->setQuery("a-query1", "queryvalue1");
        //注意：业务body部分，不能设置key值，只能有value
        if (0 < strlen($bodyContent)) {
            $request->setHeader(\HttpHeader::HTTP_HEADER_CONTENT_MD5, base64_encode(md5($bodyContent, true)));
            $request->setBodyString($bodyContent);
        }
        //指定参与签名的header
        $request->setSignHeader(\SystemHeader::X_CA_TIMESTAMP);
        //$request->setSignHeader("a-header1");
        //$request->setSignHeader("b-header2");
        $response = \HttpClient::execute($request);
        //echo mb_detect_encoding($response,'GBK,GB2312,UTF-8');
        //print_r($response);
        //var_dump($response);
        return $response->getBody();
    }

    public function register_success(){
        return view('home.register_success.index');
    }


    public function real_name_box(){
        return view('home.register_tel.real_name_box');
    }


}

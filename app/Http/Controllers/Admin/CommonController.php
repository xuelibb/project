<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/6/9
 * Time: 15:37
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
class CommonController extends Controller
{
    public function __construct(Request $request){
        $user_id=$request->session()->get('admin_id');
        if(!$user_id){
            return $this->error('对不起，请先登录',url('admin_login'));
        }
    }
}
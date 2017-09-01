<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
class InfoController extends CommonController
{
    public function index(){
        return view('admin/info/index');
    }
}
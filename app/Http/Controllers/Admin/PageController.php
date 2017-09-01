<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
class PageController extends CommonController
{
    public function index(){
        return view('admin/page/index');
    }
}
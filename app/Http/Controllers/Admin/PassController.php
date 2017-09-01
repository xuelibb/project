<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
class PassController extends CommonController
{
    public function index(){
        return view('admin/pass/index');
    }
}
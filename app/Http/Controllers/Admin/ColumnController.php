<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CommonController;
class ColumnController extends CommonController
{
    public function index(){
        return view('admin/column/index');
    }
}
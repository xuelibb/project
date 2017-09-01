<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/7/13
 * Time: 14:17
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;

class TransferController extends Controller
{
    public function can_transfer_data(){

        return view('home.transfer_son.can_transfer_data');
    }

    public function in_transfer_data(){
        return view('home.transfer_son.in_transfer_data');
    }

    public function complate_transfer_data(){
        return view('home.transfer_son.complate_transfer_data');
    }

    public function fail_transfer_data(){
        return view('home.transfer_son.fail_transfer_data');
    }
}
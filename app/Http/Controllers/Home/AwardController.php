<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/7/13
 * Time: 20:24
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;

class AwardController extends Controller
{
    public function award_list_data(){
        return view('home.invite.award_list_data');
    }
}
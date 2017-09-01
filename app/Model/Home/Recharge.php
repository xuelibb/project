<?php
/**
 * Created by PhpStorm.
 * User: 薛晁
 * Date: 2017/6/25
 * Time: 20:39
 */

namespace App\Model\Home;


use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    protected $table='recharge';
    protected $primaryKey='recharge_id';
    protected $dateFormat=false;
    const CREATEORDER = 0;
    const CHECKORDER = 1;
    const PAYFAISE = 2;
    const PAYSUCCESS = 3;

    public static $status = [
        self::CREATEORDER => '订单初始化',
        self::CHECKORDER  => '待支付',
        self::PAYFAISE   => '支付失败',
        self::PAYSUCCESS  => '支付成功',
    ];

}
<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2018/5/16
 * Time: 18:17
 */

namespace app\common\validate;


use think\Model;

class Address extends Model
{
    protected $rule =   [
        'receiver'  => 'require',
        'phone'  => 'require',
        'area'  => 'require',
    ];

    protected $message  =   [
        'receiver.require' => '请输入收货人姓名',
        'phone.require' => '请输入收货人电话',
        'area.require' => '请输入收货人地址',
    ];

}
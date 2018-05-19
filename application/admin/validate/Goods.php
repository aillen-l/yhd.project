<?php

namespace app\admin\validate;

use think\Validate;

class Goods extends Validate
{
	protected $rule =   [
		'title'  => 'require',
        'price'  => 'require',
        'total'  => 'require',
	];

	protected $message  =   [
		'title.require' => '请输入商品名称',
		'price.require' => '请输入商品价格',
		'total.require' => '请输入商品库存',
	];
}
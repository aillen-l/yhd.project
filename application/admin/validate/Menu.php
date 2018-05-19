<?php

namespace app\admin\validate;

use think\Validate;

class Menu extends Validate
{
	protected $rule =   [
		'title'  => 'require',
	];

	protected $message  =   [
		'title.require' => '请输入栏目名称',
	];
}
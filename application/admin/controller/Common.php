<?php

namespace app\admin\controller;


use think\Controller;

class Common extends Controller
{
	public function __construct ()
	{
		//登录检测
		if ( ! session ( 'admin.id' ) ) {
			return $this->redirect ( 'admin/login/index' );
		}
		//执行父级构造方法，为了不覆盖父级构造方法
		parent::__construct ();
	}
}
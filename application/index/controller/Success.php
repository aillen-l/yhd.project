<?php

namespace app\index\controller;



class Success extends Common
{
	public function index(){
		echo '支付成功';
		return $this->template('orderlist');
	}

}

<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2018/5/18
 * Time: 9:07
 */

namespace app\index\controller;


class Orderlist extends Common
{
    public function index(){
        $id = input ('param.id');
        dump($id);

        return $this->template('orderlist');
    }

}
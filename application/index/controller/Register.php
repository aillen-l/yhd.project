<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2018/5/16
 * Time: 14:08
 */

namespace app\index\controller;


class Register extends Common
{
    public function index(){
        return $this->template('register');
    }

}
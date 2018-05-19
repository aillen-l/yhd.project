<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2018/5/14
 * Time: 23:12
 */

namespace app\index\controller;


use app\common\model\Menu;

class Login extends Common
{
    public function index(Menu $menu){
//      dump(session ('logins'));

        return $this->template('Login');
    }


}
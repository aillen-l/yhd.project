<?php

namespace app\admin\controller;


use app\common\model\Admin;
use think\Controller;
use think\facade\Session;
use think\Request;
//use app\common\model\Logins;

class Entry extends Common
{
    /**
     * 登录后台首页
     * @return \think\response\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * 修改密码
     * @param Logins $admin \app\common\Logins模型对象
     * @param Request $request
     * @return \think\response\View
     */
    public function change_pass(Admin $admin){

        if ( app ( 'request' )->isPost () ) {
//            echo 11;die;
            $res = $admin->changePass ( input ( 'post.' ) );
//            dump($res);die;
            if ( $res[ 'code' ] ) {
                return $this->success ( $res[ 'msg' ] , 'admin/entry/index' );
            } else {
                return $this->error ( $res[ 'msg' ] );
            }
        }

        return view ();
    }
    /**
     * 退出登录
     */
    public function logout() {
        // 清除当前请求有效的session
        Session::delete('user');
        $this->success('退出成功','login/index');

    }

    /**
     * 个人资料模板
     * @return \think\response\View
     */
    public function user(){
        return view();
    }
    /**
     * 帮助页
     */
    public function help(){
        return view();
    }
    public function gallery(){
        return view();
    }
    public function log(){
        return view();
    }
}

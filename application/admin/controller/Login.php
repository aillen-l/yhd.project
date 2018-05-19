<?php

namespace app\admin\controller;

use app\common\model\Admin;
use think\Controller;
use think\Request;
class Login extends Controller
{
    /**
     * 登录
     *
     * @return \think\Response
     */
    public function index(Admin $admin) {
        //的app('request'):快速获取容器中实例
        //也可以用这种形式Request::instance()->isPost()代替IS_POST
        if ( app ( 'request' )->isPost () ) {
            $res = $admin->login ( input ( 'post.' ) );
            if ( $res[ 'code' ] ) {
                return $this->success ( $res[ 'msg' ] , 'admin/entry/index' );
            } else {
                return $this->error ( $res[ 'msg' ] );
            }
        }

        return view ();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}

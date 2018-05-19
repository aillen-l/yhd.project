<?php

namespace app\common\model;

use think\Model;
use think\Validate;

class Admin extends Model
{
    //模型要和数据表一直，如果不一致，用protect来用
    protected $table = 'users';
	/**
	 * 后台用户登录
	 *
	 * @param $post    post所提交数据
	 *
	 * @return array  状态码以及提示信息
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function login ( $post )
	{
		//Validate实例,等同：$validate = new \app\admin\validate\Admin;
		$validate = validate ( 'Admin' );
		if ( ! $validate->check ( $post ) ) {
			return [ 'code' => 0 , 'msg' => $validate->getError () ];
		}
		//比对用户名
		$userInfo = $this->where ( 'username' , $post[ 'username' ] )->find ();
		if ( ! $userInfo ) {
			return [ 'code' => 0 , 'msg' => '用户名不正确' ];
		}
		//比对密码
		if ( ! md5 ( $post[ 'password' ] , $userInfo->password ) ) {
			return [ 'code' => 0 , 'msg' => '用户密码不正确' ];
		}
		//将用户信息存入到session
		session ( 'admin.username' , $userInfo->username );
		session ( 'admin.id' , $userInfo->id );

		return [ 'code' => 1 , 'msg' => '登陆成功' ];
	}

	/**
	 * 后台管理员密码修改
	 * @param $post   	post数据
	 *
	 * @return array	状态码以及提示信息
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function changePass ( $post )
	{
		//因为这里验证的数据跟登录验证数据不一致，故进行独立验证[手册：验证--独立验证]
		$validate = Validate::make ( [
			'original_password' => 'require' , 'password' => 'require' , 'confirm_password' => 'require|confirm:password'
		] , [
			'original_password.require' => '请输入原始密码' , 'password.require' => '请输入新密码' , 'confirm_password.require' => '请输入确认密码' , 'confirm_password.confirm' => '确认密码跟新密码不一致' ,
		] );
		if ( ! $validate->check ( $post ) ) {
			return [ 'code' => 0 , 'msg' => $validate->getError () ];
		}
		$userInfo = $this->find ( session ( 'admin.id' ) );
		//验证原始密码是否正确
		if ( ! md5 ( $post[ 'original_password' ] , $userInfo->password ) ) {
			return [ 'code' => 0 , 'msg' => '原始密码不正确' ];
		}
		//修改密码

		$userInfo->password = password_hash ( $post[ 'password' ] , PASSWORD_DEFAULT );
		$userInfo->save ();
		return [ 'code' => 1 , 'msg' => '密码修改成功' ];
	}
}

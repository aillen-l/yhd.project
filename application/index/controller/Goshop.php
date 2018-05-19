<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2018/5/14
 * Time: 20:29
 */

namespace app\index\controller;


use app\common\model\Address;
use app\common\model\Menu;
use think\Db;
use think\Model;
use think\Request;
use \app\common\model\Orderlist;
class Goshop extends Common
{
    public function index(Menu $menu){
//        dump(session(''));
        //存入商品表
        $goshop = session ('cart');
//        p($goshop);
        //查询地址表
        $address = Db::name('address')->select();
//        halt($address);
//现在把goshop表里的内容存入orderlist表里面
        //订单列表存入session里
        $orderlist =session('orderlist');
//        halt($address);

        return $this->template('goshop',compact('goshop','address','orderlist'));
    }

    /**
     * 新增地址
     * @param Request $request
     * @param Menu $menu
     * @param Address $address
     */
    public function address(Request $request,Menu $menu,Address $address){
//        halt($request->post());
        $address->save($request->post());
//        $address = $request->input('');
//                halt($address);
        $this->success('提交成功');
    }

    /**
     * 地址删除
     * @param $id
     * @return array
     */
    public function del($id){
        $id = input('post.id');
//p($id);
        Address::destroy($id);
//        return $this->success('操作成功', 'index');
        return ['msg'=>'删除成功','code'=>1];
    }

    /**
     * 地址编辑
     */
    public function edit(){

    }


}
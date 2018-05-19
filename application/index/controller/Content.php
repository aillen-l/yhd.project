<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2018/5/11
 * Time: 16:04
 */

namespace app\index\controller;


use app\common\model\Goods;
use org\Cart;


class Content extends Common
{
    public function index($id){
//        dump($id);die;
        //根据id获取当前商品数据
        $field = Goods::find ( $id );
//       dump($field);
//        halt($field->goods_spec()->select());
        return $this->template( 'content',compact('field'));
    }

    public function addCart(Cart $cart){
//        echo 11;die;
        $post = input ('post.');
//        halt($post);
        $goodsData = Goods::find($post['id']);
//        halt($goodsData);
        $data = [
            'id'      => $post['id'] , // 商品 ID
            'name'    => $goodsData['title'] ,// 商品名称
            'num'     => $post['num'] , // 商品数量
            'price'   => $goodsData['price'] , // 商品价格
            'options' => [
                'spec'=>$post['spec'],
                'thumb'=>$goodsData['thumb']
            ] ,
        ];
//        halt($data);
        $cart->add ( $data ); // 添加到购物车
        echo 1;
    }

}
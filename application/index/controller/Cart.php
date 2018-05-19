<?php

namespace app\index\controller;



use app\common\model\Menu;

class Cart extends Common
{
    public function index(Menu $menu){
//        dump(session(''));
        $cart = session ('cart');
//        p($cart);
        return $this->template ( 'cart' ,compact ('cart'));
    }

    public function updateCart(\org\Cart $cart){
        $post = input('post.');
//        p($post);
        $data=array(
            'sid'=>input ('post.sid'),// 唯一 sid，添加购物车时自动生成
            'num'=>input ('post.num')
        );
//        halt($data);
        $cart->update($data);
        //异步提交
        $total_price = session('cart')['total_price'];
        $total_rows = session('cart')['total_rows'];
        $xiaoji = session('cart')['goods'][$post['sid']]['total'];
        $cart_data = [
            'total_rows'=>$total_rows,
            'total_price'=>$total_price,
            'xiaoji'=>$xiaoji,
        ];

//p($cart_data);
        return $cart_data;
//        echo 3;
    }
    public function del(\org\Cart $cart){
        $sid=input ('post.sid');
//        p($sid);die;
        $cart->del($sid);
    }
}

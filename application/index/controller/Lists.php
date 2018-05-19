<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2018/5/10
 * Time: 17:32
 */

namespace app\index\controller;


use app\common\model\Goods;
use app\common\model\Menu;

class Lists extends Common
{
    public function index(Menu $menu,Goods $goods){

        $id = input ('param.id');
//        dump($id);
        $price = input ('param.price','asc');
        $ids = $menu->getSon($menu->select()->toArray(),$id);
        $ids[] = $id;
//        dump($ids);
        //获取商品栏目id在$ids里面的数据
        $field = $goods->whereIn('cid',$ids)->order('price', $price)->select ();
//        dump($field);
        return $this->template( 'lists',compact ('field') );

    }

}
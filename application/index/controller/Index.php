<?php
namespace app\index\controller;


use app\common\model\Menu;
use houdunwang\arr\Arr;

class Index extends Common
{
    public function index(Menu $menu)
    {

        $field = Arr::channelLevel ( $menu->select ()->toArray () , $pid = 0 , $html = "&nbsp;" , $fieldPri = 'id' , $fieldPid = 'category_id' );
//        dump ( $field );
        return $this->template('index',compact('field'));
    }


}

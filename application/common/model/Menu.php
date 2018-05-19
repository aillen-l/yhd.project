<?php

namespace app\common\model;

use houdunwang\arr\Arr;
use think\Db;
use think\Model;
use \Category;
class Menu extends Model
{
    //数据库名category
    protected $table = 'category';
   //volist	循环数组数据输出
   /**
    *获取所有栏目数据并转为树状结构
    *
    */
    public function get_tree(){
        $data = Menu::all()->toArray();
        $res=Arr::tree($data, 'title', $fieldPri = 'id', $fieldPid = 'category_id');
//        dump($res);die;
        return $res;
    }

    /**
     * 递归找子集
     * @param Request $request
     * @return \think\response\View
     */
    public function getSon($cateData,$id) {
            static $temp = [];
            foreach ($cateData as $v){
                if($v['category_id']==$id){
                    $temp[] = $v['id'];
                    $this->getSon ($cateData,$v['id']);
                }
            }
        return $temp;

    }
}

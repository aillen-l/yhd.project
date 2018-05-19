<?php

namespace app\common\model;

use think\Model;

class Goods extends Model
{
    public function add($post)
    {
//        dump($post);
        $validate = validate('Goods');
//        halt($validate);
        if (!$validate->check($post)) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        //将pics(图册)转为字符串
        $post['pics'] = implode ('|',$post['pics']);
        //添加商品表
        $res = $this->save($post);
//        halt($res);
        //添加商品规格表

        $specs = json_decode ($post['specs'],true);
//        halt($spes
        foreach ($specs as $k=>$v){
            $specModel = new Goods_spec();
            $specModel->spec_tit = $v['spec_tit'];
            $specModel->total = $v['total'];
            $specModel->gid = $this->id;
            //halt($specModel);
            $specModel->save ();
        }
        return ['code'=>1,'msg'=>'操作成功',url('index')];
    }
    /**
     * 关联规格表
     * 一对多关系
     */
    public function goods_spec(){
        return $this->hasMany(Goods_spec::class,'gid','id');
    }
}

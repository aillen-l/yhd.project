<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Menu;
use app\common\model\Goods as GoodsModel;
class Goods extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(GoodsModel $goods)
    {
        $goods =GoodsModel::all();
//        halt($goods);
        return view('', compact('goods'));
    }

   public function add(Request $request,Menu $menu,GoodsModel $goods){

        if($request->isPost()){
            $res = $goods->add ( input ( 'post.' ) );
            if($res['code']){
                return $this->success ($res['msg'],'index');
            }else{
                return $this->error ($res['msg']);
            }

        }
       //获取所属栏目数据
       $cateData = $menu->get_tree ( $menu->select ()->toArray ());
//halt($cateData);
        return view('',compact('cateData'));
   }

    /**
     * 上传图片
     *
     * @return array
     */
    public function upload ()
    {
//        halt($_FILES);
        // 获取表单上传文件 例如上传了001.jpg
        $file = request ()->file ( 'file' );
        // 移动到框架应用根目录/uploads/ 目录下
        $path = 'static/uploads/';
        $info = $file->move ( $path );

        return [
            'code' => 0 , 'msg' => '' , 'data' => [
                'src' => '/' . $path . $info->getSaveName () ,
            ]
        ];
    }

    public function del($id){
        $id = input('post.id');
//dump($id);
        GoodsModel::destroy($id);
//        return $this->success('操作成功', 'index');
        return ['msg'=>'删除成功'];
    }

}

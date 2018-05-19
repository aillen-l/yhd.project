<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use \app\common\model\Menu as MenuModel;


class Menu extends Common
{
    /**
     * 栏目列表模板显示
     *
     * @return \think\Response
     */
    public function index(MenuModel $menu)
    {
//        echo 333;
        $cateData = $menu->get_tree($this->cate_data($menu));
//        p($cateData);die;
        return view('', compact('cateData'));
    }

    /**
     * 添加栏目模板
     *
     * @return \think\Response
     */
    public function add(Request $request, MenuModel $menu)
    {
        //input	获取输入数据 支持默认值和过滤
        $id = input('id');
//        dump($id);die;
        $menu = $id ? MenuModel::find($id) : $menu;
        if ($request->isPost()) {
            //实例化调用
            $validate = validate('menu');
            //post数据
            $post = input('post.');
            if (!$validate->check($post)) {
                return $this->error($validate->getError());
            }
            $menu->save(input('post.'));
            return $this->success('操作成功', url('index'));

        }
        //获取所有栏目数据，树状结构显示

        $cateData = $menu->get_tree($this->cate_data($menu));
        //dump($cateData);die;
        if ($id) {
            //            echo 111;die;
            //获取当前栏目所有子集栏目id集合
            $son_ids = (new MenuModel())->getSon($this->cate_data($menu), $id);
            $son_ids[] = intval($id);
        } else {
            $son_ids = [];
        }
//        dump($son_ids);die;
        return view('', compact('cateData', 'menu', 'son_ids'));
    }

    /**
     * 获取所有栏目数据
     * @param $MenuModel
     * @return mixed
     */
    public function cate_data($menuModel)
    {
        return $menuModel->select()->toArray();
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function del(Request $request, MenuModel $menu)
    {
//        echo 11;die;
        $id = input('post.id');
//halt($id);
        //检测当前删除数据是否有子集
        $data = $menu->where('category_id', $id)->select()->toArray();
        if ($data) {
            return $this->error('请先删除子集数据');
        }
        MenuModel::destroy($id);
        return $this->success('操作成功', 'index');
    }

}

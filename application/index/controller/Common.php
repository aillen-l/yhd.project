<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2018/5/10
 * Time: 15:36
 */

namespace app\index\controller;


use think\Controller;

class Common extends Controller
{
        public function __construct(){
         //要把父级的加载过来,要不然会覆盖
            parent::__construct();

        }


        public function template($tpl,$args = []){

            return view('../template/'.$tpl.'.html',$args);
        }
}
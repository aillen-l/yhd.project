##内容步骤
1.建站点连数据库
2.了解结构目录
http://thinkphp51.ishilf.com:8888
##后台管理
1. //admin用命令创建控制器 
  php think make:controller admin/Longin
  //创建模型
  php think make:model index/Blog
  //创建数据库
  php think migrate:create Users
  //迁移数据
  php think migrate:run
2.加载登录页面，判断post参数，查询表结构，再判断登录信息是否正确
  //创建模型和数据库
  //  应用调试模式
        'app_debug'              => true,
      应用Trace
        'app_trace'              => true,
  //在config/database，配置数据库
  //比对数据，
3.退出登录
  //在entry里创建loginout方法
  //清除当前请求有效的session       
4.加载后台首页  
##后台产品列表
1.Menu类和view/Menu.html，创建模型和数据表，名要一致
2.无限极分类生成树状图
  //用的hdphp3.0查找数组增强，命令composer require houdunwang/arr
  //在model里面写生成树状，在controller/menu/index的方法调用树状，再返给页面
3.在模型里面递归找子集，在方法里面调用它
  //类和模型都叫Menu 
  //在模型里静态调用空数组，循环赋值到的数据， $temp[] = $v['id'];追加到空数组里,
  //添加栏目的类里面调用模型，并判断如果  
##商品列表
1.在手册上查找资源文件加载  
  //例：{js href="/static/js/common.js" /}
      {css href="/static/css/style.css" /}
      或者
      {load href="/static/js/common.js,/static/css/style.css" /}
2. halt	变量调试输出并中断执行 
   报错：
   //SQLSTATE[23000] 主键重复，数据表的问题 
   
##前台页面
1.新建template放模板，前台页面走的是app/index
2.  /static/index/index_files/
3.加减同步增加减数量
   //在方法里面存入session数据
   //再转为json格式，把数据返出去
   //在页面js中获取数据地址的方法  
    $.post("{:url('index/cart/updateCart')}",data,function (res) {
    res是回调函数，接受返出去的数据
   //  
##商城流程
  1.首页
  2.商品列表页
  3.商品详情页
  4.商品内容页
  5.选中商品调到购物车
  6.点击去结算跳到地址页
  7.地址页下面有提交订单，点击提交订单，去付款有订单详情
  
  
     
  ##问题:
         //1.每个页面js和css需要改，最好有个公共头部，
         //2.表关联
         //3.下单页面
         //4.提交订单的时候让他读取数据库
         //5.地址的编辑没有完成
        
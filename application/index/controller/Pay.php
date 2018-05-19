<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2018/5/17
 * Time: 9:02
 */

namespace app\index\controller;

require_once "./wxpayapi/example/WxPay.NativePay.php";
use think\Db;
use WxPayUnifiedOrder;
use WxPayConfig;
use NativePay;
class Pay extends Common
{
    public function index($num)
    {

        $total=1;
        //模式二
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */
        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        $input->SetBody("1号店订单支付");
        $number = $num;
        $input->SetAttach($number);
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($total);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://tpl.aillen.top/index/pay/wxPayResult.html");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id("123456789");
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        return $this->template('pay',compact ('url2','number'));
    }
    /**
     * 微信支付之后，微信通知地址
     */
    public function wxPayResult(){
//        file_put_contents ('./data.php','111');

        $content = file_get_contents ('php://input');
        $res = simplexml_load_string ($content,'simpleXmlElement',LIBXML_NOCDATA);
        //支付成功
        if($res->result_code=='SUCCESS' && $res->return_code == 'SUCCESS'){
            //支付成功
//            file_put_contents ('./test.php','成功');
            //更新订单状态为已支付
            Db::name('orders')->where('number',$res->attach)->update (['status'=>1]);
            //告诉微信，我们收到通知
            $xml = "<xml>
                    <return_code><![CDATA[SUCCESS]]></return_code>
                    <return_msg><![CDATA[OK]]></return_msg>
                </xml>";
            echo $xml;
            return true;
        }
        return false;
    }

    /**
     * 检测是否已经支付
     * @return array
     */
    public function checkOrders(){
        $number = input ('post.number');
        //halt($number);
        //根据订单号数据表查询status=1
        $status = Db::name('orders')->where('number',$number)->value ('status');
        //halt($status);
        if($status==1){
            return ['code'=>1,'msg'=>'支付成功'];exit;
        }else{
            return ['code'=>0,'msg'=>'支付失败'];exit;
        }
    }

    public function addOrders(){

//        echo 111;die;
        dump(input('post.'));die;
        $post = input ('post.');
//        halt($post);
        $goodsData = Orders::find($post['id']);
//        halt($goodsData);
        //添加订单表
        $data = [
            'number'=>(new \org\Cart())->getOrderId(),
            'total'=> $post['total'],//先把提交的总金额设置成1
            'uid'=>$goodsData['id'],
            'address'=>$goodsData['address'],
        ];
        p($data);
        Db::name('orders')->insertGetId($data);
        //添加订单列表

        //添加完成之后跳转到结算页面(支付二维码的页面)

        return ['total'=>'','number'=>'',];
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: zls
 * Date: 2016/12/6
 * Time: 00:12
 * mail: 793179442@qq.com
 */
namespace Home\Controller;
use Think\Controller;
Vendor('Wxpay.WxPay#Api');
Vendor('Wxpay.WxPay#JsApiPay');
class WxpayController extends Controller {
	/** 链接wechat接口 */
    public function index(){
        if(empty(session('mobile'))) {
            $this->redirect('Home/User/login');
        } 
        $data=D('Order')->where(array('order_id'=>$_GET['order_id']))->find();    	
		$moeny = $data['goods_price'];
		$tal_fee = $moeny * 100;

		//①、获取用户openid
		$tools = new \JsApiPay();
		$openId = $tools->GetOpenid();
		//②、统一下单
		$input = new \WxPayUnifiedOrder();
		$input->SetBody("澳洲代沟支付");
		$input->SetAttach("澳洲代沟支付");
		$input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee($tal_fee);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("澳洲代沟支付");
		//回调地址把订单id传给回调函数处理
		$input->SetNotify_url("http://www.yuming.com/index.php/Home/Wxpay/notify/orderid/".$data['order_id']);
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$order = \WxPayApi::unifiedOrder($input);
		$jsApiParameters = $tools->GetJsApiParameters($order);
		$this->assign('jsApiParameters',$jsApiParameters);
		$this->assign('moeny',$moeny);
		$this->display();
    }

	/* 支付回调地址 只要有数据回来  那说明   肯定是支付成功的   不支付成功不会回调*/
	public function notify(){
		// $xml = $GLOBALS["HTTP_RAW_POST_DATA"];
		// /* 如果不回复这个xml  微信会给我们发送三次xml */
		// $su = '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
		// echo $su;
		//支付状态更新
		if(!empty($_GET['orderid'])){
			D('Order')->where(array('order_id'=>$_GET['order_id']))->save(array(
				'pay_status'=>1));
		}

    }
}
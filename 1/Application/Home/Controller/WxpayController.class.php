<?php
/**
 * Created by PhpStorm.
 * User: Stone
 * Date: 2016/9/19
 * Time: 00:12
 * mail: wxstones@gmail.com
 */
namespace Home\Controller;
use Think\Controller;
Vendor('Wxpay.WxPay#Api');
Vendor('Wxpay.WxPay#JsApiPay');
class WxpayController extends Controller {
	/** 链接wechat接口 */
    public function index(){

		$moeny = '1';
		$tal_fee = $moeny * 100;

		//①、获取用户openid
		$tools = new \JsApiPay();
		$openId = $tools->GetOpenid();
		//②、统一下单
		$input = new \WxPayUnifiedOrder();
		$input->SetBody("test");
		$input->SetAttach("test");
		$input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee($tal_fee);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("test");
		$input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
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
		$xml = $GLOBALS["HTTP_RAW_POST_DATA"];
		/* 如果不回复这个xml  微信会给我们发送三次xml */
		$su = '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
		echo $su;
    }
}
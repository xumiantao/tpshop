<?php

/* 组装好url链接 -> 重定向到url链接（微信授权） -> 授权完成微信给我们一个code  ->  在不在 -> openid */
/* wxstones@gmail.com */





/* 点击授权 */
function StoneOauth(){
	if(empty($_GET['code'])){
		$appid = 'wxb997ab9195650adb';
		$redirect_uri = urlencode(HttpCul());
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=stone#wechat_redirect';
		header('Location:'.$url);
	}elseif(!empty($_GET['code'])){
		$appid = 'wxb997ab9195650adb';
		$secret = '8a26a3722665e96d9fd16e52431e1e2b';
		$code = $_GET['code'];
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
		$data = json_decode(file_get_contents($url),true);
	}
	if(!empty($data['access_token'])){
		$url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$data['access_token'].'&openid='.$data['openid'].'&lang=zh_CN';
		$openid = json_decode(file_get_contents($url),true);
		return $openid;
	}
}

/* 静默授权 */
function OauthStone(){
	if(empty($_GET['code'])){
		$appid = 'wxb997ab9195650adb';
		$redirect_uri = urlencode(HttpCul());
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_base&state=stone#wechat_redirect';
		header('Location:'.$url);
	}else{
		$appid = 'wxb997ab9195650adb';
		$secret = '8a26a3722665e96d9fd16e52431e1e2b';
		$code = $_GET['code'];
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
		$openid = json_decode(file_get_contents($url),true);
		return $openid['openid'];
	}
}


/*  HTTP 请求  post/get*/
function http($url,$data,$type){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	if($type == 'POST'){
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	}
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

function HttpCul(){
	$url = "http://";
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
		$url = "https://";
	}
	if($_SERVER['SERVER_PORT'] != '80'){
		$url .= $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	}else{
		$url .= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	return $url;
}
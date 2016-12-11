<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>确认订单</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8">
			mui.init();
		</script>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="javascript:void(window.history.go(-1));" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">确认订单</h1>
		</header>
		<form action="<?php echo U('Home/Cart/pay');?>" method="post">
		<div class="mui-content mui-content-cot">
			<ul id="list" class="mui-table-view mui-table-view-chevron mui-date-news" style="margin-top: 0;">
				<li class="mui-table-view-cell mui-news-cell" style="padding-top: 15px;">
					<a href="<?php echo U('Home/User/address');?>">
						收货人信息
					</a>
				</li>
				<li class="mui-table-view-cell mui-news-cell">
					<a class="mui-navigate-right" href="<?php echo U('Home/User/address');?>">
						<?php echo ($ad["consignee"]); ?> <?php echo ($ad["mobile"]); ?><br /><?php echo ($ad["detail_address"]); ?>
						<input type="hidden" name="address" value='<?php echo ($ad["detail_address"]); ?>'>
						<input type="hidden" name="phone" value='<?php echo ($ad["mobile"]); ?>'>
						<input type="hidden" name="get_name" value='<?php echo ($ad["consignee"]); ?>'>
					</a>
				</li>
			</ul>
			<?php if(is_array($cart)): $i = 0; $__LIST__ = $cart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ct): $mod = ($i % 2 );++$i;?><div class="mui-orders-pro mui-product-news">
				<div class="mui-orders-left">
					<img src="<?php echo ($ct["original_img"]); ?>" />
				</div>
				<div class="mui-orders-news">
					<p><?php echo ($ct["goods_name"]); ?></p>
					<p>¥<?php echo ($ct["market_price"]); ?><span class="mui-pull-right">×<?php echo ($ct["num"]); ?></span></p>
					<input type="hidden" name="goods_id[]" value='<?php echo ($ct["goods_id"]); ?>'>
					<input type="hidden" name="goods_num[]" value='<?php echo ($ct["num"]); ?>'>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="mui-orders-bottom">
				<div class="mui-bto-news" style="margin-top: 20px;"><span class="mui-pull-left">商品总计：</span><span class="mui-pull-right mui-news-font">￥<?php echo ($price); ?></span></div>
				<input type="hidden" name="payprice" value='<?php echo ($price); ?>'>
				<div class="mui-bto-news"><span class="mui-pull-left">运费：</span><span class="mui-pull-right mui-news-font">包邮</span></div>
<!-- 				<a href="#">
					<div class="mui-right-news">
						<p>积分抵费></p>
					</div>
				</a>
				<a href="coupon.html">
					<div class="mui-right-news">
						<p>选择优惠券></p>
					</div>
				</a> -->
			</div>
		</div>
		<div class="distance-news" style="margin-top: 285px;"></div>
		<div class="mui-table-view-cell mui-news-cell" style="border-bottom:none;">
<!-- 			<a class="mui-time" href="#">
				请选择配送时间
			</a> -->
		</div>
		<div class="distance-news"></div>
		<div class="mui-input-row mui-search mui-sosou">
			<input type="search" name="saydetail" class="mui-input-clear" placeholder="备注说明" data-input-clear="1" data-input-search="1" >
		</div>
		<div class="mui-news-bottom">
			<div class="mui-buttom-data mui-pull-left">
				<p>应付金额：<span class="mui-news-moery">￥<?php echo ($price); ?></span></p>
			</div>
			<div class="mui-buttom-data mui-pull-right mui-news-button">
				<button type="submit" class="mui-btn mui-btn-danger" >提交订单</button>
			</div>
		</div>
</form>
		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
	</body>

</html>
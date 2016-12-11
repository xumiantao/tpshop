<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>全部订单</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<link href="/Public/aodai/css/address.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8"></script>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="<?php echo U('Home/Index/index');?>" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">全部订单</h1>
		</header>
		<div class="mui-content mui-content-cot">
			<div class="mui-input-row mui-search mui-sosou">

				
			</div>
			<div class="mui-content-pro" style="background: #fff;">
				<div id="slider" class="mui-slider" data-slider="5">
					<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted mui-segmented-control-negative mui-protitle">
						<a class="mui-control-item mui-active aa" href="<?php echo U('Home/User/orders');?>">
							全部
						</a>
						<a class="mui-control-item aa" href="javascript:void(0)">
							待付款
						</a>
						<a class="mui-control-item aa" href="javascript:void(0)">
							待收货
						</a>
						<a class="mui-control-item aa" href="javascript:void(0)">
							待评价
						</a>
						<a class="mui-control-item aa" href="javascript:void(0)">
							退换货
						</a>
					</div>
					<?php if(is_array($de)): $i = 0; $__LIST__ = $de;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div id="item1order">
					    <div class="mui-orders">
						<p>订单编号：<?php echo ($vo["order_sn"]); ?><span class="mui-pull-right"><?php echo ($vo["status"]); ?></span></p>
					</div>
					<?php if(is_array($vo['sub'])): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><div class="mui-orders-pro">
						<a href="">
							<div class="mui-orders-left">
							<img src="<?php echo ($so["original_img"]); ?>" />
						</div>
						<div class="mui-orders-cont">
							<p><?php echo ($so["goods_name"]); ?></p>
							<p><span>¥<?php echo ($so["goods_price"]); ?></span></p>
							<p><!-- 合计：<span>￥<?php echo ($so["allprice"]); ?> --></span></p>
						</div>
						<div class="mui-orders-right">
							<p style="padding-top: 30px;">×<?php echo ($so["goods_num"]); ?></p>
						</div>
						</a>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="mui-orders-bottom">
						<p> 实付金额：￥ <?php echo ($vo["goods_price"]); ?></p>
						<div class="mui-buttom-data mui-pull-right">
							<if condition="$vo['status'] eq 0 ">
															<a href="<?php echo U('Home/User/deleteorder',array('order_id'=>$vo['order_id']));?>" type="button" class="mui-btn mui-btn-danger mui-btn-outlined">取消订单</a>
			<form method="get" action="<?php echo U('Home/Wxpay/index',array('order_id'=>$vo['order_id']));?>" >
				<button type="submit" class="mui-btn mui-btn-danger mui-btn-outlined">立即支付</button>		
			</form>
						</div>
					</div>
					<div class="distance"></div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>

			</div>
							<div id="item2order">
					
				</div>
		</div>
			<script src="/Public/aodai/js/jquery-2.1.4.js"></script>
			<script type="text/javascript">
			// $('.aa').click(function(){
			// 	alert(1);
			// });
			</script>
		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
	</body>

</html>
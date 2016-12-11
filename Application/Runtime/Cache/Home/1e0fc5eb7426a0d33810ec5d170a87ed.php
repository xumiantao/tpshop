<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="国澳微信商城" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>我的收藏</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<link href="/Public/aodai/css/cart.css" rel="stylesheet" />
		<link href="/Public/aodai/css/iconfont.css" rel="stylesheet" />
		<script type="text/javascript" ></script>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="javascript:void(window.history.go(-1));" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">收藏</h1>
		</header>
		<footer class="gwc-topter">
			<div class="mui-content-pro">
				<div id="slider" class="mui-slider" data-slider="5">
					<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
						<a class="mui-control-item mui-active a" href="<?php echo U('Home/Cart/deleteshopping');?>">
							<div class="as mui-input-row mui-checkbox mui-pull-left ">

								<input name="checkbox1" value="Item 4" type="checkbox" checked="">
								<label style="color:#000;font-size:15px;">清空</label>
							</div>
						</a>


					</div>
				</div>
		</footer>
		<div class="mui-content mui-content-cot" style="margin-bottom: 100px;">
			<?php if(is_array($cart)): $i = 0; $__LIST__ = $cart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$car): $mod = ($i % 2 );++$i;?><div class="mui-card mui-shopping-cart" style="margin-top: 80px;">
				<form class="mui-input-group">
					<div class="mui-checkbox mui-left">
						<div class="mui-table-view-cell mui-media mui-list">
							<a href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$car['goods_id']));?>" class="mui-navigate">
								<img class="mui-media-object mui-pull-left" src="<?php echo ($car["original_img"]); ?>" />
								<div class="mui-media-body mui-list-data mui-shopping-cart">
									<p><?php echo ($car["goods_name"]); ?></p>
									<p>￥<?php echo ($car["shop_price"]); ?></p>

								</div>
								<div class="mui-numbox mui-number mui-pull-right mui-keep-cart">
									<a href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$car['goods_id']));?>">
										<img src="/Public/aodai/images/shoppinf_orange.png" />
									</a>
								</div>
							</a>
						</div>
						<input name="checkbox" value="Item 2" type="checkbox" checked="checked" class="checkbox-left">
					</div>
				</form>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<nav class="mui-bar mui-bar-tab mui-bar-tit" style="border-top: 0px solid #DDDDDD;">

			<a class="mui-tab-item" href="<?php echo U('Home/Index/index');?>">
				<span class="mui-icon mui-icon-home"></span>
				<span class="mui-tab-label">首页</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('Home/Cart/shopping');?>">
				<span class="mui-icon iconfont icon-jinlingy"></span>
				<span class="mui-tab-label">购物车</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('Home/User/orders');?>">
				<span class="mui-icon iconfont icon-biaodan"></span>
				<span class="mui-tab-label">我的订单</span>
			</a>
			<a class="mui-tab-item mui-active" href="<?php echo U('Home/User/system');?>">
				<span class="mui-icon iconfont icon-user"></span>
				<span class="mui-tab-label">个人中心</span>
			</a>

		</nav>
		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
		<script src="/Public/aodai/js/jquery-2.1.4.js">
		
		</script>
		<script type="text/javascript">
		</script>
	</body>

</html>
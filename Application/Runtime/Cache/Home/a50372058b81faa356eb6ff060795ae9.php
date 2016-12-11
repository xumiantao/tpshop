<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>产品详情页-选择规格</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="javascript:void(window.history.go(-1));" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">产品详情</h1>
			<div class="mui-pull-right">
			</div>
		</header>
		<div class="mui-content mui-content-cot">
			<div class="mui-product-img"><img src="<?php echo ($goods["original_img"]); ?>" width="70%" /></div>
			<div class="mui-product">
				<div class="mui-product-title">
					<p>[新品] <?php echo ($goods["goods_name"]); ?></p>
				</div>
				<div class="mui-product-button"><button type="button" class="mui-btn mui-btn-danger mui-btn-orange"><img src="/Public/aodai/images/img.png" style="padding-right: 5px; vertical-align: middle;" />图文详情</button></div>
				<div class="mui-product-money">
					<p>￥<?php echo ($goods["shop_price"]); ?><span>市场价￥<?php echo ($goods["market_price"]); ?></span><span style="padding-left: 50px;">库存：<?php echo ($goods["store_count"]); ?>　销量：<?php echo ($goods["sales_sum"]); ?></span></p>
				</div>
			</div>
			<div class="distance"></div>
			<div class="mui-content mui-content-pro">
				<ul id="list" class="mui-table-view mui-table-view-chevron" style="margin-top: 0;">
					<li class="mui-table-view-cell">
						<a class="mui-navigate-right" href="#">
							<div class="safe-left">请选择商品数量及规格</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="distance" style="margin-top: 0px;"></div>
			<div class="mui-content">

				<div class="mui-content mui-content-pro">
					<div id="slider" class="mui-slider" data-slider="4">
						<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted mui-segmented-control-negative mui-protitle">
						</div>
						<div class="mui-slider-group" style="transform: translate3d(0px, 0px, 0px) translateZ(0px); transition-duration: 0ms;">
					<div id="item1mobile" class="mui-slider-item mui-control-content mui-active mui-product-img aaa" style="padding-bottom: 80px;">
						<?php if(is_array($goods_img)): $i = 0; $__LIST__ = $goods_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gi): $mod = ($i % 2 );++$i;?><img style="width:80%;" src="<?php echo ($gi["image_url"]); ?>" />
						<br><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>

						<div class="mui-backdrop" style="z-index: 0;"></div>

						<div class="mui-bar mui-bar-tab " style="margin-top: 5px; background: #fff">
							<div class="mui-content  mui-content-inshop">
								<div class="mui-inshop-ing">
									<img src="<?php echo ($goods["original_img"]); ?>" width="80%" />
									<p>购买数量</p>
								</div>
								
								<div class="number" >
									￥
								    <span id="yuan"><?php echo ($goods["shop_price"]); ?></span>
									<span>库存：<?php echo ($goods["store_count"]); ?></span><br/>
									
								</div>
								<div class="mui-numbox" data-numbox-step='1' data-numbox-min='1' data-numbox-max='100' style="float: right;" >
									<!--<input type="button" value="-" onclick="disNum(this)"/> 
<span id="num1">0</span>
<input type="button" value="+" onclick="incNum(this)"/>-->
									
									<button class="mui-btn mui-numbox-btn-minus" type="button" onclick="disNum()">-</button>
									<input class="mui-numbox-input" type="number" id="num"/>
									<button class="mui-btn mui-numbox-btn-plus" type="button" onclick="incNum()">+</button>
									

								</div>
							</div>

							<div id="fe" style="text-align:center" class="mui-inshop-bottom">
								<a  style="text-align:center" class="mui-tab-item mui-buttom-inshop" href="javascript:void(0);">
									<span class="mui-tab-label" style="text-align:center">立即购买</span>
								</a>
							</div>

						</div>
					</div>
		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
	<script src="/Public/aodai/js/jquery-2.1.4.js"></script>
	<script type="text/javascript">
		mui('.mui-inshop-bottom').on('tap', 'a', function(e) {
			alert($(this).attr('href','11'));
		});

	</script>
	</body>

</html>
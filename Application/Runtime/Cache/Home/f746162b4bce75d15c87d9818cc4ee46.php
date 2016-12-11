<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>产品详情页</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<link href="/Public/aodai/css/product.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8"></script>
		<style type="text/css">

		</style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left left_go">
				<a href="javascript:void(window.history.go(-1));" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">产品详情</h1>
			<div class="mui-pull-right">
			</div>
		</header>
		<div class="mui-content mui-content-cot ">
			<div class="mui-product-img"><img src="<?php echo ($goods["original_img"]); ?>" width="70%" /></div>
			<div class="mui-product">
				<div class="mui-product-title">
					<p>[新品] <?php echo ($goods["goods_name"]); ?></p>
				</div>
				<div class="mui-product-button"><button type="button" class="mui-btn mui-btn-danger mui-btn-orange"><img src="/Public/aodai/images/img.png" style="padding-right: 5px; vertical-align: middle;" />图文详情</button></div>
				<div class="mui-product-money">
					<p>￥<?php echo ($goods["shop_price"]); ?><span>市场价￥<?php echo ($goods["market_price"]); ?></span><span style="padding-left: 50px;">库存：<?php echo ($goods["store_count"]); ?>　销量：36瓶</span></p>
				</div>
			</div>
			<div class="distance"></div>
			<div class="mui-content mui-content-pro">
				<ul id="list" class="mui-table-view mui-table-view-chevron" style="margin-top: 0px;">
					<li class="mui-table-view-cell">
						<a class="mui-navigate-right" href="<?php echo U('Home/Goods/product_inshop',array('goods_id'=>$goods['goods_id']));?>">
							<div class="safe-left">请选择商品数量及规格</div>
						</a>
					</li>
				</ul>
			</div>
			<div class="distance" style="margin-top: 0px;"></div>
			<div class="mui-content">

			<div class="mui-content mui-content-pro" >
				<div id="slider" class="mui-slider" data-slider="4">
					<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted mui-segmented-control-negative mui-protitle">
						<a class="mui-control-item mui-active" href="#item1mobile">
							图文详情
						</a>
						<a class="mui-control-item" href="#item2mobile">
							产品参数
						</a>
						<a class="mui-control-item" href="#item3mobile">
							用户评价
						</a>
						<a class="mui-control-item" href="#item3mobile">
							同店推荐
						</a>
					</div>
			<div class="mui-slider-group" style="transform: translate3d(0px, 0px, 0px) translateZ(0px); transition-duration: 0ms;">
					<div id="item1mobile" class="mui-slider-item mui-control-content mui-active mui-product-img aaa" style="padding-bottom: 80px;">
						<?php if(is_array($goods_img)): $i = 0; $__LIST__ = $goods_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gi): $mod = ($i % 2 );++$i;?><img style="width:80%;" src="<?php echo ($gi["image_url"]); ?>" />
						<br><?php endforeach; endif; else: echo "" ;endif; ?>
						<p ><?php echo ($goods["goods_remark"]); ?></p>
					</div>
					<div id="item2mobile" class="mui-slider-item mui-control-content mui-active mui-product-img aaa" style="padding-bottom: 80px;">
						<?php if(is_array($atr)): $i = 0; $__LIST__ = $atr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ai): $mod = ($i % 2 );++$i;?><p><i><?php echo ($ai["attr_name"]); ?>:</i><i><?php echo ($ai["attr_value"]); ?></i></p><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div id="item3mobile" class="mui-slider-item mui-control-content mui-active mui-product-img aaa" style="padding-bottom: 80px;">
							无
					</div>
					<div id="item4mobile" class="mui-slider-item mui-control-content mui-active mui-product-img aaa" style="padding-bottom: 80px;">
							无
					</div>
			</div>
			<nav class="mui-bar mui-bar-tab" style="margin-top: 5px; background: #fff">

			<a class="mui-tab-item mui-border" href="<?php echo U('Home/Goods/keep',array('goods_id'=>$goods['goods_id'],'isget'=>'1'));?>">
				<span class="mui-icon mui-icon"><img src="/Public/aodai/images/store.png" width="100%" /></span>
				<span class="mui-tab-label">收藏</span>
			</a>
			<a class="mui-tab-item mui-border" href="<?php echo U('Home/Cart/shopping');?>">
				<span class="mui-icon mui-icon-shopping"><img src="/Public/aodai/images/shopping_lax.png" width="100%" /></span>
				<span class="mui-tab-label">购物车</span>
			</a>
			<a class="mui-tab-item mui-buttom-shopping" href="<?php echo U('Home/Cart/addshop',array('goods_id'=>$goods['goods_id']));?>">
				<span class="mui-tab-label">加入购物车</span>
			</a>
			<a class="mui-tab-item mui-buttom-inshop" href="established.html">
				<span class="mui-tab-label">立即购买</span>
			</a>

		</nav>
			<script src="/Public/aodai/js/mui.min.js"></script>
			<script src="/Public/aodai/js/style.js"></script>
			<script src="/Public/aodai/js/jquery-2.1.4.js"></script>
			<script type="text/javascript">

				$('.dec').click(function() {
					var i=$(".num").val();
					i--;
					if(i==0){
						i=1;
					}
					$('.num').val(i);
				});
				$('.add').click(function() {
					var i=$(".num").val();
					i++;
					$('.num').val(i);
				});
			$('.mui-control-item').click(function(){
				var b=$(this).index();
				$(this).show();
			});
			</script>	

	</body>

</html>
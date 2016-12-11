<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>商品列表</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<link href="/Public/aodai/css/nutrition.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8"></script>
	</head>

	<body>
		<!-- 主界面不动、菜单移动 -->
		<!-- 侧滑导航根容器 -->
		<div class="mui-off-canvas-wrap mui-off-canvas-wrap-new mui-draggable mui-slide-in">
			<!-- 菜单容器 -->
			<aside class="mui-off-canvas-right" id="offCanvasSide">
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll">
						<!-- 菜单具体展示内容 -->
						<div class="mui-scroll-title">
							<a href="nutrition.html">母婴用品</a>
						</div>
						<div class="mui-scroll-title">
							<a href="nutrition.html">美肤用品</a>
						</div>
						<div class="mui-scroll-title">
							<a href="nutrition.html">营养保健</a>
						</div>
						<div class="mui-scroll-title">
							<a href="nutrition.html">时尚服饰</a>
						</div>
						<div class="mui-scroll-title">
							<a href="nutrition.html">居家日用</a>
						</div>
						<div class="mui-scroll-title">
							<a href="nutrition.html">知名品牌</a>
						</div>
						<div class="mui-scroll-title">
							<a href="nutrition.html">男士</a>
						</div>
						<div class="mui-scroll-title">
							<a href="all.html">更多</a>
						</div>
					</div>
				</div>
			</aside>
			<!-- 主页面容器 -->
			<div class="mui-inner-wrap">
				<!-- 主页面标题 -->
				<header class="mui-bar mui-bar-nav" style="background: #10a0e9;">
					<a href="<?php echo U('Home/Index/all');?>" class="mui-pull-left" style="padding-top: 6px;"><img src="/Public/aodai/images/top_arrowleft.png" width="80%" /></a>
					<h1 class="mui-title" style="color: #fff;"><?php echo ($a1["name"]); ?></h1>
					<a class="mui-pull-right" href="<?php echo U('Home/Index/all');?>" style="padding-top: 10px;"><img src="/Public/aodai/images/top_right.png" width="70%" /></a>
				</header>
				<nav class="mui-bar mui-bar-tab mui-bar-tit">
					<a class="mui-tab-item mui-active" href="<?php echo U('Home/Index/index');?>">
						<span class="mui-icon mui-icon"><img src="/Public/aodai/images/index.png" width="100%" /></span>
						<span class="mui-tab-label">首页</span>
					</a>
					<a class="mui-tab-item" href="<?php echo U('Home/Cart/shopping');?>">
						<span class="mui-icon mui-icon-shopping"><img src="/Public/aodai/images/shopping_lax.png" width="100%" /></span>
						<span class="mui-tab-label">购物车</span>
					</a>
					<a class="mui-tab-item" href="<?php echo U('Home/User/orders');?>">
						<span class="mui-icon mui-icon"><img src="/Public/aodai/images/word.png" width="100%" /></span>
						<span class="mui-tab-label">我的订单</span>
					</a>
					<a class="mui-tab-item" href="<?php echo U('Home/User/system');?>">
						<span class="mui-icon mui-icon-system"><img src="/Public/aodai/images/system.png" width="100%" /></span>
						<span class="mui-tab-label">个人中心</span>
					</a>
				</nav>
				<div class="mui-content mui-content-cot mui-scroll-wrapper">
					<div class="mui-scroll">
						<!-- 主界面具体展示内容 -->
						<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted mui-segmented-control-negative mui-protitle mui-control-nut mui-content-padded" style="margin: 0;">
							<a href="#middlePopover" class="mui-btn mui-btn-primary mui-btn-block mui-btn-outlined mui-control-item" style="padding: 5px 20px;"><?php echo ($af["name"]); ?><img src="/Public/aodai/images/bottom.png" /></a>
							<a href="#middle2Popover" class="mui-btn mui-btn-primary mui-btn-block mui-btn-outlined mui-control-item" style="padding: 5px 20px;">所有品牌<img src="/Public/aodai/images/bottom.png" /></a>
							<a href="#middle3Popover" class="mui-btn mui-btn-primary mui-btn-block mui-btn-outlined mui-control-item" style="padding: 5px 20px;">综合排序<img src="/Public/aodai/images/bottom.png" /></a>
						</div>

						<div id="middlePopover" class="mui-popover mui-popover-new" style="display: none;">
							<div class="mui-popover-arrow mui-bottom" style="left:133.5px"></div>
							<div class="mui-scroll-wrapper" data-scroll="2">
								<div class="mui-scroll" style="transform: translate3d(0px, 0px, 0px) translateZ(0px);">
									<ul class="mui-table-view">
										<?php if(is_array($twotype)): $i = 0; $__LIST__ = $twotype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><li class="mui-table-view-cell">
											<a href="<?php echo U('Home/Goods/index',array('parent_id'=>$co['id']));?>"><?php echo ($co["name"]); ?></a>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
								<div class="mui-scrollbar mui-scrollbar-vertical">
									<div class="mui-scrollbar-indicator" style=""></div>
								</div>
							</div>

						</div>
						<div id="middle2Popover" class="mui-popover mui-popover-new" style="display: none;">
							<div class="mui-popover-arrow mui-bottom" style="left:133.5px"></div>
							<div class="mui-scroll-wrapper" data-scroll="2">
								<div class="mui-scroll" style="transform: translate3d(0px, 0px, 0px) translateZ(0px);">
									<ul class="mui-table-view">
										<?php if(is_array($as)): $i = 0; $__LIST__ = $as;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$as): $mod = ($i % 2 );++$i;?><li class="mui-table-view-cell">
											<a href="<?php echo U('Home/Goods/index',array('brand_id'=>$as['id'],'parent_id'=>$twotype[0]['id']));?>"><?php echo ($as["name"]); ?></a>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
								<div class="mui-scrollbar mui-scrollbar-vertical">
									<div class="mui-scrollbar-indicator" style="transition-duration: 0ms; display: none; height: 8px; transform: translate3d(0px, -8px, 0px) translateZ(0px);"></div>
								</div>
							</div>

						</div>

						<div id="middle3Popover" class="mui-popover mui-popover-new" style="display: none;">
							<div class="mui-popover-arrow mui-bottom" style="left:133.5px"></div>
							<div class="mui-scroll-wrapper" data-scroll="2">
								<div class="mui-scroll" style="transform: translate3d(0px, 0px, 0px) translateZ(0px);">
									<ul class="mui-table-view">

										<li class="mui-table-view-cell">
											<a href="<?php echo ($dec); ?>">价格:低到高</a>
										</li>
										<li class="mui-table-view-cell">
											<a href="<?php echo ($up); ?>">价格:高到低</a>
										</li>

									</ul>
								</div>
								<div class="mui-scrollbar mui-scrollbar-vertical">
									<div class="mui-scrollbar-indicator" style="transition-duration: 0ms; display: none; height: 8px; transform: translate3d(0px, -8px, 0px) translateZ(0px);"></div>
								</div>
							</div>

						</div>

						<div class="mui-row" style="padding-top: 15px;">
							<?php if($goods[0] == '' ): ?>该分类或品牌暂无商品
							<?php else: endif; ?>
							<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$go): $mod = ($i % 2 );++$i;?><div class="product">
								<a href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$go['goods_id']));?>">
									<img  src="<?php echo ($go["original_img"]); ?>" width="100%" />
									<i style="width:100%;display:block;color:#000;font-style:normal;font-size:12px;"><?php echo ($go["goods_name"]); ?></i>
									<div class="money">
										<div class="money-line money-line-pri">
											<div class="money-text money-price"><span>￥<?php echo ($go["shop_price"]); ?></span> ￥<?php echo ($go["market_price"]); ?></div>
										</div>
									</div>
								</a>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>

					</div>
				</div>
		</div>
			<div class="mui-off-canvas-backdrop"></div>
		</div>
		</div>

		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
	</body>

</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>个人中心</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8"></script>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="<?php echo U('Home/Index/index');?>" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">个人中心</h1>
		</header>
		<div class="mui-content  mui-content-cot">
			<div class="mui-scroll-wrapper" data-scroll="1" style="z-index: 0;">
				<?php if($show == 'aa' ): ?><div class="mui-system">
					<a href="javascript:void(0);">
						<div class="mui-system-head">
							<img src="/Public/aodai/images/top_03.jpg" width="100%" />
							<p></p>
						</div>
					</a>
					<div class="mui-system-set">
						<a><img src="/Public/aodai/images/set.png" /></a>
					</div>
				</div>
				<?php else: ?> 
				<div class="mui-system">
					<a href="<?php echo U('Home/User/login');?>">
						<div class="mui-system-head">
							<img src="/Public/aodai/images/system_head.png" width="100%" />
							<p>点击登录</p>
						</div>
					</a>
					<div class="javascript:void(0);">
						<a href="set.html"><img src="/Public/aodai/images/set.png" /></a>
					</div>
				</div><?php endif; ?>

			</div>
			<div class="mui-card-content mui-container-conter" style="top: 235px;">
				<div class="mui-table-view-cell mui-media mui-list">
					<a href="<?php echo U('Home/User/orders');?>" class="mui-navigate" href="<?php echo U('Home/User/orders');?>">
						<img class="mui-media-object mui-pull-left" src="/Public/aodai/images/personal_list.png" width="10%">
						<div class="mui-media-body">
							<p>我的购物订单<span style="float: right;top: -10px;position:top;"><img src="/Public/aodai/images/arrow_right.png" width="50%"/></span></p>
						</div>
					</a>
				</div>
				<div class="mui-control-item">
					<ul class="mui-table-view mui-grid-view mui-grid-12 mui-list-shop">
						<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
							<a href="<?php echo U('Home/User/orders');?>">
								<img src="/Public/aodai/images/personal_21.png" width="60%" />
								<p>待付款</p>
							</a>
						</li>
						<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
							<a href="<?php echo U('Home/User/orders');?>">
								<img src="/Public/aodai/images/car.png" width="60%" />
								<p>待收货</p>
							</a>
						</li>
						<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
							<a href="<?php echo U('Home/User/orders');?>" >
								<img src="/Public/aodai/images/personal_24.png" width="60%" />
								<p>待评价</p>
							</a>
						</li>
						<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
							<a href="<?php echo U('Home/User/orders');?>" >
								<img src="/Public/aodai/images/personal_15.png" width="60%" />
								<p>退换货</p>
							</a>
						</li>
					</ul>
				</div>
				<div class="mui-content mui-content-cot mui-cont-date" style="margin-bottom:100px ;">
					<div class="mui-table-view-cell mui-media mui-list" style="border-top:1px solid #ddd;">
						<a href="<?php echo U('Home/User/address');?>" class="mui-navigate">
							<img class="mui-media-object mui-pull-left" src="/Public/aodai/images/personal_date.jpg" width="10%">
							<div class="mui-media-body mui-list-data">
								<p>地址管理<span><img src="/Public/aodai/images/arrow_right.png" width="50%"/></span></p>
							</div>
						</a>
					</div>
					<div class="mui-table-view-cell mui-media mui-list">
						<a href="javascript:void(0);" class="mui-navigate">
							<img class="mui-media-object mui-pull-left" src="/Public/aodai/images/personal_service.jpg" width="10%">
							<div class="mui-media-body mui-list-data">
								<p>联系客服<span><img src="/Public/aodai/images/arrow_right.png" width="50%"/></span></p>
							</div>
						</a>
					</div>
					<div class="mui-table-view-cell mui-media mui-list">
						<a href="javascript:void(0);" class="mui-navigate">
							<img class="mui-media-object mui-pull-left" src="/Public/aodai/images/personal_purse.jpg" width="10%">
							<div class="mui-media-body mui-list-data">
								<p>我的钱包<span><img src="/Public/aodai/images/arrow_right.png" width="50%"/></span></p>
							</div>
						</a>
					</div>
					<div class="mui-table-view-cell mui-media mui-list">
						<a href="<?php echo U('Home/User/data');?>" class="mui-navigate">
							<img class="mui-media-object mui-pull-left" src="/Public/aodai/images/personal_bgblue.jpg" width="10%">
							<div class="mui-media-body mui-list-data">
								<p>个人资料<span><img src="/Public/aodai/images/arrow_right.png" width="50%"/></span></p>
							</div>
						</a>
					</div>
					<div class="mui-table-view-cell mui-media mui-list">
						<a href="<?php echo U('Home/User/outlog');?>" class="mui-navigate">
							<img class="mui-media-object mui-pull-left" src="/Public/aodai/images/personal_etxt.jpg" width="10%">
							<div class="mui-media-body mui-list-data">
								<p>退出账号<span><img src="/Public/aodai/images/arrow_right.png" width="50%"/></span></p>
							</div>
						</a>
					</div>
				</div>

			</div>
		</div>
		</div>
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
		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
		
	</body>

</html>
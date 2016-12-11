<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>微信商城</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8"></script>
		<style type="text/css">
			.qq-sendUrl-btn{
				display: none;
			}
		</style>
	</head>

	<body>
		<!-- 主界面菜单同时移动 -->
		<!-- 侧滑导航根容器 -->
		<div class="mui-off-canvas-wrap mui-draggable">
			<!-- 主页面容器 -->
			<div class="mui-inner-wrap">
				<!-- 菜单容器 -->
				<aside class="mui-off-canvas-left" id="offCanvasSide">
					<div class="mui-scroll-wrapper">
						<div class="mui-scroll">
							<!-- 菜单具体展示内容 -->
                            <?php if(is_array($firsttype)): $i = 0; $__LIST__ = $firsttype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="mui-scroll-title">
								<a href="<?php echo U('Home/Index/all',array('parent_id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div class="mui-scroll-title">
                                <a href="<?php echo U('Home/Index/all');?>">更多</a>
                            </div>
						</div>
					</div>
				</aside>
				<!-- 主页面标题 -->
				<header class="mui-bar mui-bar-nav" style="background: #10a0e9;">
					<a class="mui-icon mui-action-menu mui-icon-bars mui-pull-left" href="#offCanvasSide" style="color: #fff;"></a>
					<h1 class="mui-title" style="color: #fff;">澳洲代购</h1>
					<a class="mui-pull-right" href="<?php echo U('Home/Index/sosou');?>" style="padding-top: 5px;"><img src="/Public/aodai/images/sosou.png" width="100%" /></a>
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
				<!-- 主页面内容容器 -->
				<div class="mui-content mui-content-cot mui-scroll-wrapper">
					<div class="mui-scroll">
						<!-- 主界面具体展示内容 -->
						<div class="mui-slider">
							<div class="mui-slider-group mui-slider-loop">
								<!--支持循环，需要重复图片节点-->
								<?php if(is_array($img)): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="mui-slider-item mui-slider-item-duplicate">
									<a href="<?php echo U('Home/Index/all');?>"><img src="/Public/upload/banner/<?php echo ($vo["img"]); ?>"></a>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</div>
						<div class="mui-control-item">
							<ul class="mui-table-view mui-grid-view mui-grid-12">
                                <?php if(is_array($showtype)): $i = 0; $__LIST__ = $showtype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sv): $mod = ($i % 2 );++$i;?><li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
									<a href="<?php echo U('Home/Index/all',array('parent_id'=>$sv['id']));?>"><img src="<?php echo ($sv["image"]); ?>" width="90%" />
										<p><?php echo ($sv["name"]); ?></p>
									</a>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
								<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
									<a href="<?php echo U('Home/Index/all');?>"><img src="/Public/aodai/images/index08.png" width="90%" />
										<p>更多</p>
									</a>
								</li>
							</ul>
						</div>
						<div class="mui-table-view-cell mui-media mui-ad">
							<a href=""><img class="mui-media-object mui-pull-left" src="/Public/aodai/images/voice.jpg">
								<div class="mui-media-body">
									<p class="mui-ellipsis"><strong class="mui-strong">每日公告</strong><span style="padding-left: 5px;"><?php echo ($ad["ad_content"]); ?></span></p>

								</div>
							</a>
						</div>
						<div class="mui-kong"></div>
						<div class="mui-cont-ad">
							<div class="mui-card-content mui-container-conter">
								<div class="mui-media-body mui-media-cont">
									<strong>热销产品</strong><span class="pull-right"><a href="<?php echo U('Home/Index/all');?>" >更多></a></span>
								</div>
								<div class="mui-slider">
									<div class="mui-slider-group">
										<!--第一个内容区容器-->
										<div class="mui-slider-item">
											<!-- 具体内容 -->
											<ul class="mui-table-view mui-grid-view mui-grid-12" style="padding: 0px 0px 20px 0 ;">
												<?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hots): $mod = ($i % 2 );++$i;?><li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
													<a href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$hots['goods_id']));?>"><img src="<?php echo ($hots["original_img"]); ?>" width="100%" style="border: 1px solid #E0E0E0;" />
														<p><?php echo ($host["goods_name"]); ?></p>
													</a>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
											</ul>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="mui-kong"></div>
						<div class="hot">
							<a href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$tm[0]['goods_id']));?>">
							<div class="hot-left">
								<div class="hot-left-top">
									<div class="text">
										<h2>今日特卖</h2>
										<p>品牌大咖一网打尽</p>
									</div>
								</div>
								<div class="hot-right-bot">
									<img src="<?php echo ($tm[0]["original_img"]); ?>" width="46%" />
								</div>
							</div>
							</a>
							<div class="hot_right">
								<a href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$tm[1]['goods_id']));?>">
								<div class="hot-right-top">
									<div class="hot-right-proleft">
										<h2><?php echo ($tm[1]["goods_name"]); ?></h2>
										<p></p>
									</div>
									<div class="hot-right-proright">
										<img src="<?php echo ($tm[1]["original_img"]); ?>" width="20%" />
									</div>
									</a>
								</div>
								<div class="hot-right-bottom">
									<a href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$tm[2]['goods_id']));?>">
									<div class="hot-right-botleft">
										<div class="hot-right-proleft">
											<h2><?php echo ($tm[2]["goods_name"]); ?></h2>
											<p></p>
										</div>
										<div class="hot-right-bot">
											<img src="<?php echo ($tm[2]["original_img"]); ?>" width="80%" style="text-align: center;" />
										</div>
									</div>
									</a>
									<a href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$tm[3]['goods_id']));?>">
									<div class="hot-right-botright">
										<div class="hot-right-proleft">
											<h2><?php echo ($tm[3]["goods_name"]); ?></h2>
											<p></p>
										</div>
										<div class="hot-right-bot">
											<img src="<?php echo ($tm[3]["original_img"]); ?>" width="51%" style="text-align: center;" />
										</div>
									</div>
									</a>
								</div>
							</div>
							<div class="live">
								<div class="live-line">
									<div class="live-text"><img src="/Public/aodai/images/live.png" width="25%" />猜你喜欢</div>
								</div>
							</div>
						</div>
						<div class="mui-row">
							<?php if(is_array($like)): $i = 0; $__LIST__ = $like;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$le): $mod = ($i % 2 );++$i;?><div class="product">
								<a href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$le['goods_id']));?>">
									<img src="<?php echo ($le["original_img"]); ?>" width="100%" />
									<p><?php echo ($le["goods_name"]); ?></p>
									<div class="money">
										<div class="money-line">
											<div class="money-text"><span>￥<?php echo ($le["shop_price"]); ?></span> ￥<?php echo ($le["market_price"]); ?></div>
										</div>
									</div>
								</a>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>

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
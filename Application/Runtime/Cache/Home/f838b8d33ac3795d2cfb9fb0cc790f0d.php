<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>全部分类</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8">
			mui.init();
		</script>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="<?php echo U('Home/Index/index');?>" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">全部分类</h1>
		</header>

		<div class="mui-content mui-row mui-fullscreen mui-content-cot">
			<div class="left-label">
				<div id="segmentedControls" class="mui-segmented-control mui-segmented-control-inverted mui-segmented-control-vertical">
					<?php if(is_array($firsttype)): $i = 0; $__LIST__ = $firsttype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a class="mui-control-item" href="<?php echo U('Home/Index/all',array('parent_id'=>$v['id']));?>"><?php echo ($v["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					<!-- <a class="mui-control-item" href="javascript:void(0);">其他分类</a> -->
				</div>
			</div>
			<div class="right-conten">
				<div id="segmentedControlContents" class="mui-col-xs-12">
					<div id="content1" class="mui-control-content mui-active">
						<ul class="mui-table-view">
							<li class="mui-table-view-cell">
								<div class="mui-row mui-right-all">
									<div class="product">
										<a href="<?php echo U('Home/Index/all');?>" >
											<img src="/Public/aodai/images/classify.jpg" />
											<p>全部</p>
										</a>
									</div>
									<?php if(is_array($alltype)): $i = 0; $__LIST__ = $alltype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="product">
										<a href="<?php echo U('Home/Goods/index',array('parent_id'=>$vo['id']));?>" >
											<img src="<?php echo ($vo["image"]); ?>" />
											<p><?php echo ($vo["name"]); ?> </p>

										</a>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>

								</div>
							</li>
						</ul>
					</div>

				</div>

			</div>
		<script src="/Public/aodai/js/mui.min.js"></script>
        <script src="/Public/aodai/js/style.js"></script>
	</body>

</html>
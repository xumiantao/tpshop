<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>购物车-空</title>
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
			<h1 class="mui-title">购物车</h1>
			<div class="mui-pull-right">
			</div>
		</header>
		<div class="mui-content mui-content-cot">
			<div class="shopping-icon"><img src="/Public/aodai/images/shopping_full_03.png" style="vertical-align: middle;" /></div>
			
			<p >亲、您的购物车还是空空的哦，快去装满它!</p>
			<div class="button-gray"><a href="<?php echo U('Home/Index/index');?>"><button type="button" class="mui-btn mui-btn-outlined" >前去逛逛</button></a></div>
		</div>
			
		
		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
	</body>
</html>
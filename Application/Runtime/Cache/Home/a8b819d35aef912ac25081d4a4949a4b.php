<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>搜索</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<script src="/Public/aodai/js/jquery.min.js"></script>

	</head>

	<body style="background: #f5f5f5;">
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="<?php echo U('Home/Index/index');?>" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">搜索</h1>
		</header>
		<div class="mui-content mui-content-cot">
			<div class="mui-input-row mui-search mui-sosou" style="width: 80%;">
				<form id="myForm" action="<?php echo U('Home/Index/sosou');?>" method="post">
					<input name="sosuo" type="search" class="mui-input-clear" placeholder="请输入搜索商品" data-input-clear="1" data-input-search="1">
				</form>

				<span class="mui-icon mui-icon-clear mui-hidden"></span>
				<span class="mui-placeholder">
					<span class="mui-icon mui-icon-search mui-icon-sosou"></span>
				</span>
			</div>
			<div class="mui-pull-right ">
				<input style="border:none;" value="搜索" href="javascript:void(0);" onclick="formSubmit()" class="mui-sosou-del asd"/>
			</div>
		</div>
<!-- 		<div class="mui-content" style="padding-top: 0px;">
			<p class="mui-title mui-sosou-title">热门搜索</p>
			<div class="mui-sosou-con">
				<p>
					<a href="" style="padding-left: 0px;">奶粉</a>
					<a href="">尿裤</a>
					<a href="">育儿用品</a>
					<a href="">童装童鞋</a>
					<a href="">玩具文具</a>
					<a href="">喂养洗护</a>
					<a href="">奶粉</a>
					<a href="">尿裤</a>
					<a href="">育儿用品</a>
					<a href="">童装童鞋</a>
					<a href="">玩具文具</a>
					<a href="">喂养洗护</a>
				</p>

			</div> -->
		</div>
						

		</div>
		<div class="mui-scroll" style="transform: translate3d(0px, 0px, 0px) translateZ(0px);">
			<?php if(is_array($all)): $i = 0; $__LIST__ = $all;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$al): $mod = ($i % 2 );++$i;?><div class="mui-content mui-content-pro">
				<ul id="list" class="mui-table-view mui-table-view-chevron" style="margin-top: 0;">
					<li class="mui-table-view-cell">
						<a class="mui-navigate-right" href="<?php echo U('Home/Goods/goodsInfo',array('goods_id'=>$al['goods_id']));?>">
							<img src="<?php echo ($al["original_img"]); ?>" width="20%" />
							<p class="safe-title"><?php echo ($al["goods_name"]); ?></p>
							<p class="safe-moery"><?php echo ($al["shop_price"]); ?></p>
						</a>
					</li>
				</ul>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>

			

		</div>
		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>

		<script >
function formSubmit()
  {
  document.getElementById("myForm").submit()
  }
			
		</script>

	</body>

</html>
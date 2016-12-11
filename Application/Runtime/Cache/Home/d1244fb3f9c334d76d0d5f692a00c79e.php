<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>增加收货人地址</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<link href="/Public/aodai/css/address.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8"></script>
	</head>

	<body style="background: #f5f5f5;">
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="javascript:void(window.history.go(-1));" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">增加收货人地址</h1>
		</header>
		<form id="formsend" action="<?php echo U('Home/User/add_new');?>" method="post">
		<div class="mui-content" style="margin-top: 20px;">
			<div class="mui-add-new">
				<br>
				<br>
					<div class="mui-input-row">
						<label>收货人姓名</label>
						<input name='sendname' type="text" class="mui-input-clear" placeholder="请输入收货人姓名">
					</div>

					<div class="mui-input-row">
						<label>联系方式</label>
						<input name='phone' type="text" class="mui-input-clear" placeholder="联系方式">
					</div>
					<div class="mui-input-row">
						<label>所在地区</label>
						<input name='area' type="text" class="mui-input-clear" placeholder="所在地区">
					</div>
			
			</div>

			<div class="mui-add-deta" style="background: #fff;">
				<div class="mui-input-row">
					<label>详细地址</label>
					<input name='address' type="text" class="mui-input-clear" placeholder="" id="deta">
				</div>
			</div>
			<div class="mui-input-row mui-radio mui-left mui-input-address" style="margin-left: 10px;">
				<div class="mui-input-row mui-checkbox mui-left">
					<label>设为默认</label>
					<input  name="checkbox" value="1" type="checkbox">
				</div>
			</div>
			<div class="mui-buttom-data mui-button-deta" style="">
				<button type="button" class="mui-btn mui-btn-danger mui-data-btn">增加</button>
			</div>
		</div>
	</form>
		<script src="/Public/aodai/js/jquery-2.1.4.js"></script>
		<script type="text/javascript">
			$('.mui-data-btn').click(function(){
				$('#formsend').submit();
			});
		</script>
		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
	</body>

</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>管理收货地址</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<link href="/Public/aodai/css/address.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8">
			mui.init();
		</script>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="javascript:void(window.history.go(-2));" title=""  ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">管理收货地址</h1>
			<div class="mui-pull-right">
				<a href="<?php echo U('Home/User/add_new');?>" ><img src="/Public/aodai/images/date_add.png" /></a>
			</div>
		</header>

				<div class="mui-content mui-content-cot">
					<?php if(is_array($adress)): $i = 0; $__LIST__ = $adress;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><div class="mui-card">
						<div class="mui-card-content">
							<div class="mui-card-content-inner mui-address">
								<h4>收货人：<?php echo ($s["consignee"]); ?>  <?php echo ($s["mobile"]); ?></h4>
								<p>收货地址：<?php echo ($s["detail_address"]); ?> 
								</p>

								<div class="mui-card-footer">
									<div class="mui-input-row mui-radio mui-left mui-input-address" data-url="<?php echo U('Home/User/setdefaultaddress',array('address_id'=>$s['address_id']));?>">
										<label>设为默认(使用)</label>
										<?php if($s['is_default'] == 1 ): ?><input name="radio1" type="radio" checked="checked">
										<?php else: ?> 
												<input name="radio1" type="radio" ><?php endif; ?>

									</div>
									<a class="mui-card-link" href="<?php echo U('Home/User/editadress',array('address_id'=>$s['address_id']));?>"><img src="/Public/aodai/images/date_07.jpg" /><span>编辑</span></a>
									<a href="<?php echo U('Home/User/deletedress',array('address_id'=>$s['address_id']));?>" class="mui-card-link"><span>删除 </span></a>
								</div>
							</div>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			<script src="/Public/aodai/js/jquery-2.1.4.js"></script>
			<script type="text/javascript">
			//ajax设置收获地址
					$('.mui-input-address').click(function(){
						var s =$(this).data('url');
						$.ajax({
							type:'post',
							url:s,
							dataType:'json',
							contentType:"application/x-www-form-urlencoded;charset=UTF-8",
							success:function(info){
							}
						});
					});
			</script>

		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
	</body>

</html>
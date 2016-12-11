<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>注册</title>
		<link href="/Public/aodai/css/mui.min.css" rel="stylesheet" />
		<link href="/Public/aodai/css/style.css" rel="stylesheet" />
		<script type="text/javascript" charset="utf-8">
			mui.init();
		</script>

	</head>

	<body style="background: #f5f5f5;">
		<header class="mui-bar mui-bar-nav mui-bg">
			<div class="mui-pull-left">
				<a href="<?php echo U('Home/Index/index');?>" title="" ><img src="/Public/aodai/images/top_arrowleft.png" /></a>
			</div>
			<h1 class="mui-title">登陆</h1>
		</header>
		<div class="mui-content" style="margin-top: 20px;">
			<form id="datas">
			<div class="mui-add-new">
				
					<div class="mui-input-row">
						<label>请输入手机号</label>
						<input name='phone' type="text" class="mui-input-clear" placeholder="158******56">
					</div>
				
			</div>
			<div class="mui-add-new">
				
					<div class="mui-input-row">
						<label>请输入密码</label>
						<input name='pwd' type="password" class="mui-input-password" placeholder="******">
					</div>
				
			</div>

			<div class="mui-buttom-data mui-button-deta" style="">
				<button type="button" class="mui-btn mui-btn-danger mui-data-btn aa">登陆</button>
				<a href="<?php echo U('Home/User/register');?>"  style="padding: 6px 12px;color:#fff;width:100%;margin: 10px 10px;display:block;line-height:30px;background:#ff5000;border-radius: 3px;text-align:center" class="">注册</a>
			</div>
			</form>
		</div>
		</div>
		<script src="/Public/aodai/js/mui.min.js"></script>
		<script src="/Public/aodai/js/style.js"></script>
		<script src="/Public/aodai/js/jquery.min.js"></script>
		<script src="/Public/aodai/js/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/--> 
		<script >
			$('.aa').click(function(){
				var s=$('#login').attr('checked');
				var data=$('#datas').serialize();

					$.ajax({
						type:'post',
						url:"<?php echo U('Home/User/login');?>",
						data:data,
						dataType:'json',
						contentType:"application/x-www-form-urlencoded;charset=UTF-8",
						success:function(info){
							if(info.status==0){
								layer.open({
								  title: '信息',
								  content: info.info,
								});
							}else{
								
								  	window.location.href=info.url1;
								
							}
						}
					});
				
			});
			
		</script>
	</body>

</html>
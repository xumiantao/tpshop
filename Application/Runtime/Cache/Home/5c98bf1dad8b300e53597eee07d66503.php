<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>购物车</title>
<style type="text/css">
*{
	padding: 0;
	margin: 0;
	font-family: "微软雅黑";
}
.header{
	width: 100%;
	height: 50px;
	background: #10A0E9;
}

i{
	font-style: normal;
}
h1{
	color: #fff;
	text-align: center;
	line-height: 50px;
	font-weight: 100;
	position: absolute;
	margin-left: 40%;
	font-size: 20px;
}
.e{
	float: left;

}
.e img{
	margin-top: 10px;
	margin-left: 10px;
	width: 14px;
}
.content{
	width: 100%;
	height: 80%;
	overflow: auto;
}
input[type='checkbox']{
	width: 28px;
	height: 28px;
	border: 1px solid #eee;
	border-radius: 14px;
	-webkit-border-radius: 14px;
	-ms-border-radius: 14px;
	-moz-border-radius: 14px;
	margin-top: 30px;
}
.product{
	width: 100%;
	height: 147px;
	float: left;
	position: relative;
	overflow: hidden;
	margin-bottom: 5px;
	border-bottom: 1px solid #eee;
}
.pro_img{
	width: 25%;
	height: 100%;
}
.product span{
	position: absolute;top: 20px;
}
.product i{
	position: absolute;bottom: 20px;
	color: #FF5000;
}
.in_right{
	width: 100px;
	height: 35px;
	position: absolute;
	right: 10px;
	bottom: 10px;
	overflow: hidden;
}
.in_right div{
	float: left;
	width: 25px;
	height: 25px;
	border: 1px solid #eee;
	text-align: center;
}
.bottom{
	margin-top: 10px;
	width: 100%;
	height: 111px;
	position: fixed;
	bottom: 0px;
	background: #ddd;
}
.inbox{
	position: absolute;
	top:10px;
	width: 100%;
	height: 100px;
	background: #fff;
}
.iall{
	margin-left: 20px;
	margin-top: -20px;
	display: inline-block;
	font-style: normal;
}
.price{
	width: 200px;
	height: 100%;
	position: absolute;
	right: 0;
	top: 0;
}
.getprice{
	display: inline-block;
	font-style: normal;
	margin-top: 20px;
}
.dc{
	color: #FF5000;
}
.pays{
	position: absolute;
	right: 20px;
	bottom: 50px;
	background: #FF5000;
	text-decoration: none;
	width: 100px;height: 33px;
	border-radius: 4px;
	text-align: center;
	line-height: 33px;color: #fff;
}
.deletecart{
	position: absolute;
	left: 2px;
	bottom: 50px;
	background: #FF5000;
	text-decoration: none;
	width: 100px;height: 33px;
	border-radius: 4px;
	text-align: center;
	line-height: 33px;color: #fff;
	font-size: 13px;
}
</style>
<body>
<div class='header'>
	<a href="javascript:void(window.history.go(-1));" class='e'>
		<img src="/Public/aodai/images/top_arrowleft.png">
	</a>
	<h1>购物车</h1>
</div>
<form id='sj' action="<?php echo U('Home/Cart/established');?>" method='post'>
<div class='content'>
	<?php if(is_array($cart)): $i = 0; $__LIST__ = $cart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ct): $mod = ($i % 2 );++$i;?><div class='product'>
		<input type="checkbox" checked="checked">
		<a href=""><img class='pro_img' src="<?php echo ($ct["original_img"]); ?>"></a>
		<span><?php echo ($ct["goods_name"]); ?></span>
		<i class='mm'><?php echo ($ct["market_price"]); ?></i>
		<div class='in_right'>
			<div class='dec'>-</div>
			<div class='num' >1</div>
			<div class='add'>+</div>
			<input class='aas' type='hidden' value="<?php echo ($ct["id"]); ?>" name="cart[]">
			<input class='g_num' type='hidden' value="1" name="num[]">
		</div>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
<input class='fef' type='hidden' name="allprice" value="">
</div>
</form>
<div class='bottom'>
	<div class='inbox'>
			<a class='deletecart' href="<?php echo U('Home/Cart/deletecart');?>">清空购物车</a>
			<div class='price'>
				<i class='getprice'>合计:<span class='dc'>0</span></i>
				<br>
				<i>免费派送</i>
				<a class='pays' href="javascript:void(0);">去结算</a>
			</div>
	</div>

</div>
	<script src="/Public/aodai/js/jquery-2.1.4.js"></script>
		<script type="text/javascript">
					var sc=0;
			$('.dec').click(function  () {
				var s=$(this).parent().children('.num').html();
				s--;
				if(s<=1){
					s=1;
				}
				$(this).parent().children('.num').html(s);
				$(this).parent().children('.g_num').val(s);
				allnum();
						
			});
			$('.add').click(function  () {
				var s=$(this).parent().children('.num').html();
				s++;
				$(this).parent().children('.num').html(s);
				allnum();
				$(this).parent().children('.g_num').val(s);

			});
							allnum();
			function allnum(){
				sc=0;
				$("input[type='checkbox']:checked").each(function(a,b){
					var sk=$('.product').eq(a).children('.in_right').children('.num').html();
					var sk2=$('.product').eq(a).children('.mm').html();
					var allsk=parseInt(sk)*parseInt(sk2);
					sc+=allsk;
				});

				$(".dc").html(sc);
			}
			$("input[type='checkbox']").click(function(){
				allnum();
			});
			$(".pays").click(function(){

				$("input[type='checkbox']").each(function(a,b){
				
					if($("input[type='checkbox']").eq(a).is(':checked')) {
					
					}else{
						$('.product').eq(a).remove();
				}
				});	
								
				$('.fef').val($(".dc").html());		
				$('#sj').submit();

			});
		</script>
</body>
</html>
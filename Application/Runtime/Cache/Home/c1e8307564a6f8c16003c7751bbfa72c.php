<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>购物车-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
<script src="/Public/js/jquery-1.8.2.min.js"></script>
<script src="/Public/js/global.js"></script>
<script src="/Public/js/pc_common.js"></script>
<script src="/Public/js/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/-->
</head>

<body>
    <link rel="stylesheet" href="/Template/pc/default/Static/css/index.css" type="text/css">
<div class="site-topbar">
    <div class="layout">
        <div class="t1-l">
            <ul class="t1-l-ul">
                <li class="t1font"><a target="_blank" href="<?php echo U('/Home/Article/detail',array('article_id'=>22));?>">在线客服</a></li>
                <li class="t1img">&nbsp;</li>
                <li class="t1font"><a href="javascript:void();">TPshop</a></li>
                <li class="t1img">&nbsp;</li>
            </ul>
        </div>
        <div class="t1-r">
            <ul class="t1-r-ul islogin" style="display:none;">
                <li class="t1font"> <a href="<?php echo U('Home/User/index');?>" class="logon userinfo"></a></li>
                <li class="t1img"><a href="<?php echo U('Home/user/logout');?>">安全退出</a></li>                    
                <li class="t1img">&nbsp;</li>
                <li class="t1img">&nbsp;</li>                
                <li class="t1font"><a href="<?php echo U('Home/User/order_list');?>">我的订单</a></li>
                <li class="t1img">&nbsp;</li>
                <li class="t1font"><a href="<?php echo U('Home/Cart/cart');?>">购物车</a></li>
                <li class="t1img">&nbsp;</li>
                <li class="t1font"><a href="#">网站地图</a></li>
                <li class="t1img">&nbsp;</li>                
            </ul>
            <ul class="t1-r-ul nologin" style="display:none;">
                <li class="t1font"><a href="<?php echo U('Home/user/login');?>">登录</a></li>
                <li class="t1img">&nbsp;</li>
                <li class="t1font"><a href="<?php echo U('Home/Cart/cart');?>">购物车</a></li>
                <li class="t1img">&nbsp;</li>
                <li class="t1font"><a href="#">网站地图</a></li>
                <li class="t1img">&nbsp;</li> 
            </ul>
        </div>
    </div>
</div>
    <div class="order-header">
    	<div class="layout after">
        	<div class="fl">
            	<div class="logo pa-to-36 wi345">
                	<a href="/"><img src="<?php echo ($tpshop_config['shop_info_store_logo']); ?>" alt=""></a>
                </div>
            </div>
        	<div class="fr">
            	<div class="pa-to-36 progress-area">
                	<div class="progress-area-wd">我的购物车</div>
                	<div class="progress-area-tx" style="display:none">填写核对订单信息</div>
                	<div class="progress-area-cg" style="display:none">成功提交订单</div>
                </div>
            </div>
        </div>
    </div>
    <div class="layout after-ta">
    	<div class="sc-list">        
        <form name="cart_form" id="cart_form" action="<?php echo U('Home/Cart/ajaxCartList');?>">
	         <div id="ajax_return"><!--  ajax renturn --></div>
         </form>         
            <div class="sc-acti-list ma-to-20 ma-bo-135">
            	<a class="gwc-jxgw" href="/">继续购物</a>
                <a class="gwc-qjs" href="<?php echo U('Home/Cart/cart2');?>" >去结算</a>
            </div>
        </div>
    </div>
<!--------footer-开始-------------->
<div class="footer">
    <div class="layout quality layer">
        <ul class="footer_quality">
            <li><i></i>品质保证</li>
            <li  class="f2"><i></i>7天退换 15天换货</li>
            <li  class="f3"><i></i>100元起免运费</li>
            <li  class="f4"><i></i>448家维修网点 全国联保</li>
        </ul>
    </div>
    <div class="helpful layout">
    <?php
 $md5_key = md5("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); S("sql_".$md5_key,$sql_result_v,TPSHOP_CACHE_TIME); } foreach($sql_result_v as $k=>$v): ?><dl <?php if($k != 0): ?>class="jszc"<?php endif; ?> >
                <dt><?php echo ($v[cat_name]); ?></dt>
                <dd>
                    <ol>
                    	<?php
 $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id] and is_open=1"); $sql_result_v2 = S("sql_".$md5_key); if(empty($sql_result_v2)) { $Model = new \Think\Model(); $result_name = $sql_result_v2 = $Model->query("select * from `__PREFIX__article` where cat_id = $v[cat_id] and is_open=1"); S("sql_".$md5_key,$sql_result_v2,TPSHOP_CACHE_TIME); } foreach($sql_result_v2 as $k2=>$v2): ?><li><a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id]));?>" target="_blank"><?php echo ($v2[title]); ?></a></li><?php endforeach; ?>                        
                    </ol>
                </dd>
            </dl><?php endforeach; ?>
     </div>
     <div class="keep-on-record">
        <p>
        Copyright © 2016-2025 <?php echo ($tpshop_config['shop_info_store_name']); ?>  版权所有 保留一切权利 备案号:<?php echo ($tpshop_config['shop_info_record_no']); ?>
        
        <!--您好,请您给TPshop留个友情链接-->
        &nbsp;&nbsp;<a href="http://www.tp-shop.cn/">TPshop开源商城</a>
        <!--您好,请您给TPshop留个友情链接-->
        </p>
     </div>
 </div>
 

<!--------footer-结束-------------->
<script>

$(document).ready(function(){
			
	ajax_cart_list(); // ajax 请求获取购物车列表
});



// ajax 提交购物车
var before_request = 1; // 上一次请求是否已经有返回来, 有才可以进行下一次请求
function ajax_cart_list(){
	
	
	if(before_request == 0) // 上一次请求没回来 不进行下一次请求
	    return false;
	before_request = 0;
		
	$.ajax({
		type : "POST",
		url:"<?php echo U('Home/Cart/ajaxCartList');?>",//+tab,
		data : $('#cart_form').serialize(),// 你的formid
		success: function(data){
			$("#ajax_return").html('');
			$("#ajax_return").append(data);
			before_request = 1;
		}
	});
}

/**
* 购买商品数量加加减减
* 购买数量 , 购物车id , 库存数量
*/
function switch_num(num,cart_id,store_count)
{
	var num2 = parseInt($("input[name='goods_num["+cart_id+"]']").val());
	num2 += num;
	if(num2 < 1) num2 = 1; // 保证购买数量不能少于 1
	if(num2 > store_count) 
	{   
	    error = "库存只有 "+store_count+" 件, 你只能买 "+store_count+" 件";
	    layer.alert(error, {icon: 2});	
		num2 = store_count; // 保证购买数量不能多余库存数量		
	}

	$("input[name='goods_num["+cart_id+"]']").val(num2);

	ajax_cart_list(); // ajax 更新商品价格 和数量
}


/**  全选 反选 **/				
function check_all()
{	   
	var vt = $("#select_all").is(':checked');
	$("input[name^='cart_select']").prop('checked',vt);
	// var checked = !$('#select_all').attr('checked');
	// $("input[name^='cart_select']").attr("checked",!checked); 		 	
	 ajax_cart_list(); // ajax 更新商品价格 和数量		
}
 
 
// ajax 删除购物车的商品
function ajax_del_cart(ids)
{
	$.ajax({
		type : "POST",
		url:"<?php echo U('Home/Cart/ajaxDelCart');?>",//+tab,
		data:{ids:ids}, // 
	    dataType:'json',		
		success: function(data){
		  // alert(data.msg);
		   if(data.status == 1)				
				ajax_cart_list(); // ajax 请求获取购物车列表		   			   
		}
	});
}

// 批量删除购物车的商品
function del_cart_more()
{
	if(!confirm('确定要删除吗?')) 
	  return false;
	// 循环获取复选框选中的值  
	var chk_value = [];
	$('input[name^="cart_select"]:checked').each(function(){
		var s_name = $(this).attr('name');
		var id = s_name.replace('cart_select[','').replace(']','');		
		chk_value.push(id);
	}); 
	// ajax  调用删除
	if(chk_value.length > 0)
		ajax_del_cart(chk_value.join(','));
}
</script>
</body>
</html>
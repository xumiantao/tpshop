<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>管理后台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
 	<link href="/Public/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 --
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/Public/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
    	folder instead of downloading all of them to reduce the load. -->
    <link href="/Public/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/Public/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />   
    <!-- jQuery 2.1.4 -->
    <script src="/Public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="/Public/js/global.js"></script>
    <script src="/Public/js/myFormValidate.js"></script>    
    <script src="/Public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/js/layer/layer-min.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
    <script src="/Public/js/myAjax.js"></script>
    <script type="text/javascript">
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
    
    //全选
    function selectAll(name,obj){
    	$('input[name*='+name+']').prop('checked', $(obj).checked);
    }   
    
    function get_help(obj){
        layer.open({
            type: 2,
            title: '帮助手册',
            shadeClose: true,
            shade: 0.3,
            area: ['90%', '90%'],
            content: $(obj).attr('data-url'), 
        });
    }
    
    function delAll(obj,name){
    	var a = [];
    	$('input[name*='+name+']').each(function(i,o){
    		if($(o).is(':checked')){
    			a.push($(o).val());
    		}
    	})
    	if(a.length == 0){
    		layer.alert('请选择删除项', {icon: 2});
    		return;
    	}
    	layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
    			$.ajax({
    				type : 'get',
    				url : $(obj).attr('data-url'),
    				data : {act:'del',del_id:a},
    				dataType : 'json',
    				success : function(data){
    					if(data == 1){
    						layer.msg('操作成功', {icon: 1});
    						$('input[name*='+name+']').each(function(i,o){
    							if($(o).is(':checked')){
    								$(o).parent().parent().remove();
    							}
    						})
    					}else{
    						layer.msg(data, {icon: 2,time: 2000});
    					}
    					layer.closeAll();
    				}
    			})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);	
    }
    </script>        
  </head>
  <body style="background-color:#ecf0f5;">
 

<style type="text/css">
	.wi80-BFB{width:80%}
	.wi40-BFB{width:40%}
	.seauii{ padding:7px 10px; margin-right:10px}
	.he110{ height:110px}
	.di-bl{ display:inherit}
</style>
<link rel="stylesheet" href="/Public/bootstrap/css/edit_address.css" type="text/css">
<body>
<div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): if($k == '后台首页'): ?><li></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>

<div class="adderss-add">
	<div class="ner-reac ol_box_4" style="visibility: visible; position: fixed; z-index: 500; width: 100%; height:100%">
		<section class="content">
			<div class="container-fluid">
				<div class="panel  panel-default">
					<div class="panel-heading">
								<h3 class="panel-title"><i class="fa fa-list"></i> 添加物流公司</h3>
					</div>
					<div class="box-ct">
						<form action="<?php echo U('Admin/Pickup/add');?>" method="post" onSubmit="return checkForm()">
							<input name="pickup_id" type="hidden" value="<?php echo ($pickup['pickup_id']); ?>" />
							<table width="90%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="right"><span class="xh">*</span>物流公司名称：&nbsp;</td>
									<td><input class="wi80-BFB" name="pickup_name" type="text" value="<?php echo ($pickup["pickup_name"]); ?>" maxlength="12" /></td>
								</tr>
								<tr>
									<td align="right"><span class="xh">*</span>发货地址：&nbsp;</td>
									<td>
										<select class="di-bl fl seauii" name="province_id" id="province" onChange="get_city(this)">
											<option value="0">请选择</option>
											<?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($pickup['province_id'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>

										<select class="di-bl fl seauii" name="city_id" id="city" onChange="get_area(this)">
											<option  value="0">请选择</option>
											<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($pickup['city_id'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>

										<select class="di-bl fl seauii" name="district_id" id="district">
											<option  value="0">请选择</option>
											<?php if(is_array($district)): $i = 0; $__LIST__ = $district;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($pickup['district_id'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<br>
									</td>
								</tr>

								<tr>
									<td align="right" valign="top"><span class="xh">*</span>详细地址：&nbsp;</td>
									<td><textarea class="he110 wi80-BFB re-no" name="pickup_address" id="address" placeholder="详细地址" maxlength="100"><?php echo ($pickup["pickup_address"]); ?></textarea></td>
								</tr>
								<tr>
									<td align="right">联系人：&nbsp;</td>
									<td><input class="wi80-BFB" type="text" name="pickup_contact" placeholder="联系人" value="<?php echo ($pickup["pickup_contact"]); ?>"  maxlength="10"/></td>
								</tr>
								<tr>
									<td align="right"><span class="xh">*</span>联系电话：&nbsp;</td>
									<td><input class="wi40-BFB" type="text" name="pickup_phone" value="<?php echo ($pickup["pickup_phone"]); ?>" onpaste="this.value=this.value.replace(/[^\d-]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d-]/g,'')" maxlength="15"/></td>
								</tr>
								<tr>
									<td class="pa-50-0">&nbsp;</td>
									<td align="right">
										<button type="submit" class="box-ok ma-le--70"><span>保存物流公司</span></button>
									</td>
								</tr>
							</table>

						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<script src="/Public/js/global.js"></script>
<script src="/Public/js/pc_common.js"></script>

<script>
	function checkForm(){
		var pickup_name = $('input[name="pickup_name"]').val();
		var province_id = $('select[name="province_id"]').find('option:selected').val();
		var city_id = $('select[name="city_id"]').find('option:selected').val();
		var district_id = $('select[name="district_id"]').find('option:selected').val();
		var pickup_address = $('textarea[name="pickup_address"]').val();
		var pickup_phone = $('input[name="pickup_phone"]').val();
		var error = '';
		if(pickup_name == ''){
			error += '自提点名称不能为空 <br/>';
		}
		if(province_id==0){
			error += '请选择省份 <br/>';
		}
		if(city_id==0){
			error += '请选择城市 <br/>';
		}
		if(district_id==0){
			error += '请选择区域 <br/>';
		}
		if(pickup_address == ''){
			error += '请填写地址 <br/>';
		}
		//if(!checkMobile(pickup_phone))
			//error += '手机号码格式有误 <br/>';
		if(error){
			//alert(error);
			layer.alert(error, {icon: 2});
			//	layer.msg('只想弱弱提示');
			return false;
		}
		return true;
	}
</script>
</body>
</html>
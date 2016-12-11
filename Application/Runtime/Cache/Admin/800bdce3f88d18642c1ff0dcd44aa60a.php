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
 

<div class="wrapper">
	<div class="breadcrumbs" id="breadcrumbs">
	<ol class="breadcrumb">
	<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): if($k == '后台首页'): ?><li></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>

	<style>#search-form > .form-group{margin-left: 10px;}</style>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-list"></i> 物流公司列表</h3>
				</div>
				<div class="panel-body">
					<div class="navbar navbar-default">
						<form action="" id="search-form2" class="navbar-form form-inline" method="post" onsubmit="return false">
							<div class="form-group">
								<select name="province_id" id="province_id" class="form-control" onChange="get_city(this)">
									<option value="">所有省</option>
									<?php if(is_array($province)): foreach($province as $k=>$v): ?><option value="<?php echo ($v['id']); ?>"> <?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
								</select>
							</div>
							<div class="form-group">
								<select name="city_id" id="city" class="form-control" onChange="get_area(this)">
									<option value="">所有市</option>
									<?php if(is_array($brandList)): foreach($brandList as $k=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
								</select>
							</div>
							<div class="form-group">
								<select name="district_id" id="district" class="form-control">
									<option value="">所有区/镇</option>
									<?php if(is_array($brandList)): foreach($brandList as $k=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label" for="input-order-id">公司名称</label>
								<div class="input-group">
									<input type="text" name="key_word" value="" placeholder="物流公司名称" id="input-order-id" class="form-control">
								</div>
							</div>
							<!--排序规则-->
							<input type="hidden" name="order_by_field" value="pickup_id" />
							<input type="hidden" name="order_by_mode" value="desc" />
							<button type="submit" onclick="ajax_get_table('search-form2',1)" id="button-filter search-order" class="btn btn-primary"><i class="fa fa-search"></i> 筛选</button>
							<button type="button" onclick="location.href='<?php echo U('Admin/Pickup/add');?>'" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>添加物流</button>
						</form>
					</div>
					<div id="ajax_return"> </div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
	$(document).ready(function(){
		// ajax 加载商品列表
		ajax_get_table('search-form2',1);

	});


	// ajax 抓取页面 form 为表单id  page 为当前第几页
	function ajax_get_table(form,page){
		cur_page = page; //当前页面 保存为全局变量
		$.ajax({
			type : "POST",
			url:"/index.php?m=Admin&c=Pickup&a=ajaxPickupList&p="+page,//+tab,
			data : $('#'+form).serialize(),// 你的formid
			success: function(data){
				$("#ajax_return").html('');
				$("#ajax_return").append(data);
			}
		});
	}

	// 点击排序
	function sort(field)
	{
		$("input[name='order_by_field']").val(field);
		var v = $("input[name='order_by_mode']").val() == 'desc' ? 'asc' : 'desc';
		$("input[name='order_by_mode']").val(v);
		ajax_get_table('search-form2',cur_page);
	}

</script>
</body>
</html>
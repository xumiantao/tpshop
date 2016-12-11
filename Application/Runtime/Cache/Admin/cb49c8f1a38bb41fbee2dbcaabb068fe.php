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

	<section class="content">
       <div class="row">
       		<div class="col-xs-12">
	       		<div class="box">
	           	<div class="box-header">
	               <nav class="navbar navbar-default">	     
				        <div class="collapse navbar-collapse">
				            <div class="navbar-form row">
					            <a href="<?php echo U('User/level');?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>新增等级</a>
				            </div>
				      	</div>
	    			</nav>              
	             </div>	    
	             <!-- /.box-header -->
	             <div class="box-body">	             
	           		<div class="row">
	            	<div class="col-sm-12">
		              <table id="list-table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
		                 <thead>
		                   <tr role="row">
			                   <th class="sorting" tabindex="0">等级</th>
			                   <th class="sorting" tabindex="0">等级名称</th>
			                   <th class="sorting" tabindex="0">消费额度</th>
			                   <th class="sorting" tabindex="0">折扣率</th>
			                   <th class="sorting" tabindex="0">等级描述</th>
			                   <th class="sorting" tabindex="0">操作</th>
		                   </tr>
		                 </thead>
						<tbody>
						  <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr role="row" align="center">
		                     <td><?php echo ($vo["level_id"]); ?></td>
		                     <td><?php echo ($vo["level_name"]); ?></td>
		                     <td><?php echo ($vo["amount"]); ?></td>
		                     <td><?php echo ($vo["discount"]); ?>%</td>
		                     <td><?php echo ($vo["describe"]); ?></td>		                     
		                     <td>
		                      <a class="btn btn-primary" href="<?php echo U('User/level',array('act'=>'edit','level_id'=>$vo['level_id']));?>"><i class="fa fa-pencil"></i></a>
		                      <a class="btn btn-danger" href="javascript:void(0)" data-url="<?php echo U('User/levelHandle');?>" data-id="<?php echo ($vo["level_id"]); ?>" onclick="delfun(this)"><i class="fa fa-trash-o"></i></a>
							</td>
		                   </tr><?php endforeach; endif; ?>
		                   </tbody>
		                 <tfoot>
		                 
		                 </tfoot>
		               </table>
	               </div>
	          </div>
              <div class="row">
              	    <div class="col-sm-6 text-left"></div>
                    <div class="col-sm-6 text-right"><?php echo ($page); ?></div>		
              </div>
	          </div><!-- /.box-body -->
	        </div><!-- /.box -->
       	</div>
       </div>
   </section>
</div>
<script>
function delfun(obj){
	if(confirm('确认删除')){		
		$.ajax({
			type : 'post',
			url : $(obj).attr('data-url'),
			data : {act:'del',level_id:$(obj).attr('data-id')},
			dataType : 'json',
			success : function(data){
				if(data){
					$(obj).parent().parent().remove();
				}else{
					layer.alert('删除失败', {icon: 2});  //alert('删除失败');
				}
			}
		})
	}
	return false;
}
</script>  
</body>
</html>
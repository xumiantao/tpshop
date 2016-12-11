<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>tpshop管理后台</title>
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
	<?php if(is_array($navigate_admin)): foreach($navigate_admin as $k=>$v): if($k == '后台首页'): ?><li><a href="<?php echo ($v); ?>"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo ($k); ?></a></li>
	    <?php else: ?>    
	        <li><a href="<?php echo ($v); ?>"><?php echo ($k); ?></a></li><?php endif; endforeach; endif; ?>          
	</ol>
</div>

	<section class="content">
       <div class="row">
       		<div class="col-xs-12">
	       	  <div class="box">
	           	<div class="box-header">
	               <nav class="navbar navbar-default">	     
				        <div class="collapse navbar-collapse">
				          <form class="navbar-form form-inline" action="<?php echo U('/Admin/linkList');?>" method="post">
				          	<div class="input-group"><p>数据库中共有<?php echo ($tableNum); ?>张表，共计<?php echo ($total); ?></p>
				          	
				          	</div>
				            <div class="form-group pull-right">
					            <a href="javascript:void(0)" onclick="gobackup(this)" class="btn btn-primary pull-right"><i class="fa fa-eject"></i>备份</a>
				            </div>		          
				          </form>		
				      	</div>
	    			</nav>               
	            </div>	    
	             <!-- /.box-header -->
	             <div class="box-body">	             
	           		<div class="row">
	            	<div class="col-sm-12">
	            	<form  method="post" action="">
		              <table class="table table-bordered table-striped">
		                 <thead>
		                   <tr>
		                       <th class="text-center" style="width: 2px;"><input type="checkbox" onclick="javascript:$('input[name*=backs]').prop('checked',this.checked);"></th>
			                   <th class="sorting" tabindex="0">数据库表</th>
			                   <th class="sorting" tabindex="0">记录条数</th>
			                   <th class="sorting" tabindex="0">占用空间</th>
			                   <th class="sorting" tabindex="0">编码</th>
			                   <th class="sorting" tabindex="0">创建时间</th>
			                   <th class="sorting" tabindex="0">说明</th>
			                   <th class="sorting" tabindex="0">操作</th>
		                   </tr>
		                 </thead>
						<tbody>
						  <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr>
 							 <td><input type="checkbox" name="backs[]" value="<?php echo ($vo["name"]); ?>"></td>
		                     <td><?php echo ($vo["name"]); ?></td>
		                     <td><?php echo ($vo["rows"]); ?></td>
		                     <td><?php echo (format_bytes($vo["data_length"])); ?></td>
		                     <td><?php echo ($vo["collation"]); ?></td>
		                     <td><?php echo ($vo["create_time"]); ?></td>
		                     <td><?php echo ($vo["comment"]); ?></td>
		                     <td>
		                      <a class="btn btn-success" href="<?php echo U('Tools/optimize',array('tablename'=>$vo['name']));?>">优化</a>
		                      <a class="btn btn-info" href="<?php echo U('Tools/repair',array('tablename'=>$vo['name']));?>" data-url="">修复</a>
							</td>
		                   </tr><?php endforeach; endif; ?>
		                   </tbody>
		                 <tfoot>
		                 </tfoot>
		               </table>
		           </form>
	               </div>
	           </div>
	          </div>
	        </div>
       	</div>
       </div>
   </section>
</div>
<script type="text/javascript">
function gobackup(obj){
	var a = [];
	$('input[name*=backs]').each(function(i,o){
		if($(o).is(':checked')){
			a.push($(o).val());
		}
	});
	if(a.length==0){
		layer.alert('请选择要备份的数据表', {icon: 2});  //alert('请选择要备份的数据表');
		return;
	}else{
		$(obj).addClass('disabled');
		$(obj).html('备份进行中...');
		$.ajax({
			type :'post',
			url : "<?php echo U('Admin/Tools/backup');?>",
			datatype : 'json',
			data : {tables:a},
			success : function(data){
				data = eval('('+data+')');
				if(data.stat=='ok'){
					$(obj).removeClass('disabled');
					$(obj).html('备份');
					layer.alert(data.msg, {icon: 2});  //alert(data.msg);
				}else{
					layer.alert(data.msg, {icon: 2});  //alert(data.msg);
				}
			}
		})
	}
}
</script>
</body>
</html>
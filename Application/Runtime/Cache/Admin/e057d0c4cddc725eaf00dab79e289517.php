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

    <section class="content ">
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回管理员列表"><i class="fa fa-reply"></i></a>
            	<a href="javascript:;" class="btn btn-default" data-url="http://www.tp-shop.cn/Doc/Index/article/id/1001/developer/user.html" onclick="get_help(this)"><i class="fa fa-question-circle"></i> 帮助</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 权限资源管理</h3>
                </div>
                <div class="panel-body ">   
                    <!--表单数据-->
                    <form method="post" id="adminHandle" action="">                    
                        <!--通用信息-->
                    <div class="tab-content col-md-10">                 	  
                        <div class="tab-pane active" id="tab_tongyong">                           
                            <table class="table table-bordered">
                                
                                <tr>
                                    <td class="col-sm-2">    权限资源名称：</td>
                                    <td class="col-sm-8">
                                        <input type="text" class="form-control" name="name" value="<?php echo ($info["name"]); ?>" >                                                                      
                                    </td>
                                </tr>  
                                <tr>
                                    <td>所属分组：</td>
                                    <td>
                         				<select name="group" class="form-control" style="width:150px;">
                         					<?php if(is_array($group)): foreach($group as $key=>$vo): ?><option value="<?php echo ($key); ?>" <?php if($info[group] == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                         				</select>                                                                     
                                    </td>
                                </tr>  
                                <tr>
                                    <td>添加权限码：</td>
                                    <td>
                                    	<div  class="col-xs-3">
	                             			<select id="controller" class="form-control" onchange="get_act_list(this)" style="width:200px;margin-left:-15px;">
		                          				<option value="">选择控制器</option>
		                          				<?php if(is_array($planList)): foreach($planList as $key=>$vo): ?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>           
	                         				</select>
                         				</div>
                         				<div class="col-xs-1">@</div>
                         				<div class="col-xs-2">
	                         				<select class="form-control" id="act_list" style="width:150px;">
		                          				               
	                         				</select> 
                         				</div>
                         				<div class="col-xs-1"><input type="button" value="添加" onclick="add_right()" class="btn btn-info"></div>    
                                    </td>
                                </tr>                                                           
                                <tr>
                                	<td colspan="2">
                                		<table class="table table-bordered table-hover">
                                			 <tr><th style="width:80%">权限码</th><th>操作</th></tr>
                                			 <tbody id="rightList">
                                			 	<?php if(is_array($info[right])): foreach($info[right] as $key=>$vo): ?><tr><td><input name="right[]" type="text" value="<?php echo ($vo); ?>" class="form-control" style="width:400px;"></td>
                                			 	<td><a href="javascript:;" onclick="$(this).parent().parent().remove();">删除</a></td></tr><?php endforeach; endif; ?>
                                			 </tbody>
                                		</table>
                                	</td>
                                </tr>
                                <tfoot>
                                	<tr>
                                	<td>
                                		<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
                                	</td>
                                	<td class="text-center"><input class="btn btn-primary" type="button" onclick="adsubmit()" value="保存"></td></tr>
                                </tfoot>                               
                            </table>
                        </div>                           
                    </div>              
			    	</form><!--表单数据-->
                </div>
            </div>
        </div>
    </section>
</div>
<script>
function adsubmit(){
	if($('input[name=name]').val() == ''){
		layer.msg('权限名称不能为空！', {icon: 2,time: 1000});
		return false;
	}
	
	if($('input[name="right[]"').val() == ''){
		layer.msg('权限码不能为空！', {icon: 2,time: 1000});
		return false;
	}

	$('#adminHandle').submit();
}

function add_right(){
	var a = [];
	$('#rightList .form-control').each(function(i,o){
		if($(o).val() != ''){
			a.push($(o).val());
		}
	})
	var ncode = $('#controller').val();
	if(ncode !== ''){
		var temp = ncode+'@'+ $('#act_list').val();
		if($.inArray(temp,a) != -1){
			layer.msg('此权限码已经添加！', {icon: 2,time: 1000});
			return false;
		}
	}
	var strtr = '<tr>';
	if(ncode!= ''){
		strtr += '<td><input type="text" name="right[]" value="'+ncode+'@'+ $('#act_list').val()+'" class="form-control" style="width:400px;"></td>';
	}else{
		strtr += '<td><input type="text" name="right[]" value="" class="form-control" style="width:400px;"></td>';
	}		
	strtr += '<td><a href="javascript:;" onclick="$(this).parent().parent().remove();">删除</a></td>';
	$('#rightList').append(strtr);	
}

function get_act_list(obj){
	$.ajax({
		url: "<?php echo U('System/ajax_get_action');?>",
		type:'post',
		data: {'controller':$(obj).val()},
		dataType:'html',
		success:function(res){
			$('#act_list').empty().append(res);
		}
	});
}
</script>
</body>
</html>
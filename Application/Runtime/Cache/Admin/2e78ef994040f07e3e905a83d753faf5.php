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
        <!-- Main content -->
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
           		<a href="javascript:;" class="btn btn-default" data-url="http://www.tp-shop.cn/Doc/Index/article/id/1010/developer/user.html" onclick="get_help(this)"><i class="fa fa-question-circle"></i> 帮助</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 品牌详情</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_tongyong" data-toggle="tab">商品类型</a></li>
                    </ul>
                    <!--表单数据-->
                    <form method="post" id="addEditBrandForm" onsubmit="return checkName();">             
                        <!--通用信息-->
                    <div class="tab-content">                 	  
                        <div class="tab-pane active" id="tab_tongyong">
                           
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>品牌名称:</td>
                                    <td>
                                        <input type="text" value="<?php echo ($brand["name"]); ?>" name="name" class="form-control" style="width:200px;"/>
                                        <span id="err_name" style="color:#F00; display:none;">品牌名称不能为空</span>                                        
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>品牌网址:</td>
                                    <td>
                                        <input type="text" value="<?php echo ($brand["url"]); ?>" name="url" class="form-control" style="width:250px;"/>
                                        <span id="err_url" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                </tr>                                                                
                                <tr>
                                    <td>所属分类:</td>
                                    <td>
                                        <div class="col-sm-3">
	                                        <select name="parent_cat_id" id="parent_id_1" onchange="get_category(this.value,'parent_id_2','0');" class="form-control" style="width:250px;margin-left:-15px;">
                                                    <option value="0">请选择分类</option> 
	                                            <?php if(is_array($cat_list)): foreach($cat_list as $key=>$v): ?><option value="<?php echo ($v[id]); ?>"  <?php if($v[id] == $brand[parent_cat_id]): ?>selected="selected"<?php endif; ?>><?php echo ($v[name]); ?></option><?php endforeach; endif; ?>                                            
						</select>
	                                    </div>                                    
	                                    <div class="col-sm-3">
	                                      <select name="cat_id" id="parent_id_2"  class="form-control" style="width:250px;">
	                                        <option value="0">请选择分类</option>
	                                      </select>  
	                                    </div>     
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>品牌logo:</td>
                                    <td>  
                                    	<div class="col-sm-3">                                                                              
                                        	<input type="text" value="<?php echo ($brand["logo"]); ?>" name="logo" id="logo" class="form-control" style="width:350px;margin-left:-15px;"/>
                                        </div>
                                        <div class="col-sm-3">
                                        	<input onclick="GetUploadify(1,'logo','brand');" type="button" class="btn btn-default" value="上传logo"/>
                                        </div>
                                    </td>
                                </tr> 
                                <tr>
                                    <td>品牌排序:</td>
                                    <td>
                                        <input type="text" value="<?php echo ($brand["sort"]); ?>" name="sort" class="form-control" style="width:200px;" placeholder="50"/>                                
                                    </td>
                                </tr>                                                                 
                                <tr>
                                    <td>品牌描述:</td>
                                    <td>
										<textarea rows="4" cols="60" name="desc"><?php echo ($brand["desc"]); ?></textarea>
                                        <span id="err_desc" style="color:#F00; display:none;"></span>                                        
                                    </td>
                                </tr>                                  
                                </tbody>                                
                                </table>
                        </div>                           
                    </div>              
                    <div class="pull-right">
                        <input type="hidden" name="id" value="<?php echo ($brand["id"]); ?>">
                        <input type="hidden" name="p" value="<?php echo ($_GET[p]); ?>">
                        <button class="btn btn-primary" data-toggle="tooltip" type="submit" data-original-title="保存">保存</button>
                    </div>
			    </form><!--表单数据-->
                </div>
            </div>
        </div>    <!-- /.content -->
    </section>
</div>
<script>
// 判断输入框是否为空
function checkName(){
	var name = $("#addEditBrandForm").find("input[name='name']").val();
    if($.trim(name) == '')
	{
		$("#err_name").show();
		return false;
	}
	return true;
}

window.onload = function(){
	if(<?php echo ($brand["cat_id"]); ?> > 0 ){
		get_category($("#parent_id_1").val(),'parent_id_2',<?php echo ($brand["cat_id"]); ?>);	 
	}		
}
</script>
</body>
</html>
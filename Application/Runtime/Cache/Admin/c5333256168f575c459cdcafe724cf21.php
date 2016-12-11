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
                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">增加分类</h3>
                            <div class="pull-right">
                                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>

                            </div>
                        </div>
 
                        <!-- /.box-header -->
                        <form action="<?php echo U('Goods/addEditCategory');?>" method="post" class="form-horizontal" id="category_form">
                        <div class="box-body">                         
                                <div class="form-group">
                                     <label class="col-sm-2 control-label">分类名称</label>
                                     <div class="col-sm-6">
                                        <input type="text" placeholder="名称" class="form-control large" name="name" value="<?php echo ($goods_category_info["name"]); ?>">
                                        <span class="help-inline" style="color:#F00; display:none;" id="err_name"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label0 class="control-label col-sm-2">上级分类</label0>

                                    <div class="col-sm-3">
                                        <select name="parent_id_1" id="parent_id_1" onchange="get_category(this.value,'parent_id_2','0');" class="small form-control">
                                            <option value="0">顶级分类</option>
                                            <?php if(is_array($cat_list)): foreach($cat_list as $key=>$v): ?><option value="<?php echo ($v[id]); ?>"><?php echo ($v[name]); ?></option><?php endforeach; endif; ?>                                            
                                        </select>
                                    </div>                                    
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">导航显示</label>
                                    
                                    <div class="col-sm-10">
                                        <label> 
                                            <?php if(($goods_category_info[is_show] == 1) or ($goods_category_info[is_show] == NULL)): ?><input checked="checked" type="radio" name="is_show" value="1"> 是
                                                <input type="radio" name="is_show" value="0"> 否
                                            <?php else: ?> 
                                                <input type="radio" name="is_show" value="1"> 是
                                                <input checked="checked" type="radio" name="is_show" value="0"> 否<?php endif; ?>                                                                                                                                    
                                        </label>
                                    </div>
                                </div>

                             
                  <div class="form-group">
                                        <label class="control-label col-sm-2">分类展示图片</label>

                                    <div class="col-sm-10">
                                        <input onclick="GetUploadify(1,'image','category');" type="button" value="上传图片"/>
                                        <input type="text" value="<?php echo ($goods_category_info["image"]); ?>" name="image" id="image" class="form-control large" readonly="readonly"  style="width:500px;display:initial;"/>
                                    </div>
                                </div>                                
                               <div class="form-group">
                                    <label class="control-label col-sm-2">显示排序</label>
                                    <div class="col-sm-1">
                                        <input type="text" placeholder="50" class="form-control large" name="sort_order" value="<?php echo ($goods_category_info["sort_order"]); ?>"/>
                                        <span class="help-inline" style="color:#F00; display:none;" id="err_sort_order"></span>
                                    </div>
                                </div>
                                                                                                                          
                        </div>
                        <div class="box-footer">                            
                            <input type="hidden" name="id" value="<?php echo ($goods_category_info["id"]); ?>">                           
                            <button type="reset" class="btn btn-primary pull-left"><i class="icon-ok"></i>重填  </button>                                          
                            <button type="button" onclick="ajax_submit_form('category_form','<?php echo U('Goods/addEditCategory?is_ajax=1');?>');" class="btn btn-primary pull-right"><i class="icon-ok"></i>提交  </button>
                        </div> 
                        </form>
                    </div>
                </div>
            </div>
        </section>
</div>
<script>  
    
/** 以下是编辑时默认选中某个商品分类*/
$(document).ready(function(){
    <?php if($level_cat['2'] > 0): ?>// 如果当前是二级分类就让一级父id默认选中
         $("#parent_id_1").val('<?php echo ($level_cat[1]); ?>'); 
         get_category('<?php echo ($level_cat[1]); ?>','parent_id_2','0');<?php endif; ?>    
    <?php if($level_cat['3'] > 0): ?>// 如果当前是三级分类就一级和二级父id默认 都选中
         $("#parent_id_1").val('<?php echo ($level_cat[1]); ?>');          
         get_category('<?php echo ($level_cat[1]); ?>','parent_id_2','<?php echo ($level_cat[2]); ?>');<?php endif; ?>   
});
 
</script>
   
</body>
</html>
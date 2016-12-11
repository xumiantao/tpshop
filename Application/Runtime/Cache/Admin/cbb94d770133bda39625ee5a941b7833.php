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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    	<i class="fa fa-list"></i>&nbsp;商品咨询列表
                    </h3>
                </div>
                <div class="panel-body">
                <nav class="navbar navbar-default">	     
			        <div class="collapse navbar-collapse">
			          <form action="<?php echo U('Comment/ask_list');?>" id="search-form2" class="navbar-form form-inline" role="search" method="post">
			            <div class="form-group">
			              	<input type="text" class="form-control" name="content" placeholder="搜索评论内容">
			            </div>
                          <div class="form-group">
                              <input type="text" class="form-control" name="nickname" placeholder="搜索用户">
                          </div>
                          <button type="button" onclick="ajax_get_table('search-form2',1)" class="btn btn-info"><i class="fa fa-search"></i> 筛选</button>
			          </form>		
			      </div>
    			</nav>
                    <div id="ajax_return">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center">
                                        <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                                    </td>
                                    <td class="text-center">
                                        用户
                                    </td>
                                    <td class="text-center">
                                        咨询内容
                                    </td>
                                    <td class="text-center">
                                        商品
                                    </td>
                                    <td class="text-center">
                                        显示
                                    </td>
                                    <td class="text-center">
                                        咨询时间
                                    </td>
                                    <td class="text-center">
                                        ip地址
                                    </td>
                                    <td class="text-center">操作</td>
                                </tr>
                                </thead>
                                <tbody>

                                <?php if(is_array($comment_list)): $i = 0; $__LIST__ = $comment_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="selected[]" value="<?php echo ($list["comment_id"]); ?>">
                                        </td>
                                        <td class="text-center"><?php echo ($list["username"]); ?></td>
                                        <td class="text-left"><?php echo ($list["content"]); ?></td>
                                        <td class="text-left"><a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$list[goods_id]));?>"><?php echo ($goods_list[$list[goods_id]]); ?></a></td>
                                        <td class="text-center">
                                            <img width="20" height="20" src="/Public/images/<?php if($list[is_show] == 1): ?>yes.png<?php else: ?>cancel.png<?php endif; ?>" onclick="changeTableVal('goods_consult','id','<?php echo ($list["id"]); ?>','is_show',this)"/>
                                        </td>
                                        <td class="text-center"><?php echo (date('Y-m-d H:i:s',$list["add_time"])); ?></td>
                                        <td class="text-center"><?php echo ($list["ip_address"]); ?></td>

                                        <td class="text-center">
                                            <a href="<?php echo U('Comment/consult_info',array('id'=>$list[id]));?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="编辑"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);" data-href="<?php echo U('Comment/ask_handle',array('id'=>$list[id]));?>" onclick="del('<?php echo ($list[id]); ?>',this)" id="button-delete6" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="删除"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                                </tbody>
                            </table>
                            <select name="operate" id="operate">
                                <option value="0">操作选择</option>
                                <option value="show">显示</option>
                                <option value="hide">隐藏</option>
                                <option value="del">删除</option>
                            </select>
                            <button onclick="op()">确定</button>
                            <form id="op" action="<?php echo U('Comment/op');?>" method="post">
                                <input type="hidden" name="selected">
                                <input type="hidden" name="type">
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-left"></div>
                            <div class="col-sm-6 text-right"><?php echo ($page); ?></div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    // 删除操作
    function del(id,t)
    {
        if(!confirm('确定要删除吗?'))
            return false;
        location.href = $(t).data('href');
    }

    function op(){
        //获取操作
        var op_type = $('#operate').find('option:selected').val();
        if(op_type == 0){
			layer.msg('请选择操作', {icon: 1,time: 1000});   //alert('请选择操作');
            return;
        }
        //获取选择的id
        var selected = $('input[name*="selected"]:checked');
        var selected_id = [];
        if(selected.length < 1){

			layer.msg('请选择项目', {icon: 1,time: 1000}); //            alert('请选择项目');
            return;
        }
        $(selected).each(function(){
            selected_id.push($(this).val());
        })
        $('#op').find('input[name="selected"]').val(selected_id);
        $('#op').find('input[name="type"]').val(op_type);
        $('#op').submit();
    }

    $(document).ready(function(){
        ajax_get_table('search-form2',1);
    });


    // ajax 抓取页面
    function ajax_get_table(tab,page){
        cur_page = page; //当前页面 保存为全局变量
        $.ajax({
            type : "POST",
            url:"/index.php/Admin/Comment/ajax_ask_list/p/"+page,//+tab,
            data : $('#'+tab).serialize(),// 你的formid
            success: function(data){
                $("#ajax_return").html('');
                $("#ajax_return").append(data);
            }
        });
    }

</script>

</body>
</html>
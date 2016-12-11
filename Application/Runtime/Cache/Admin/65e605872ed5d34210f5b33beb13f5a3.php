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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 用户列表</h3>
                </div>
                <div class="panel-body">
                    <div class="navbar navbar-default">

                    </div>
                    <div id="ajax_return">
                        <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></td>
    
                                    <td class="text-right">
                                        <a href="javascript:sort('user_id');">ID</a>
                                    </td>
                                    <td class="text-left">
                                        <a href="javascript:sort('username');">会员昵称</a>
                                    </td>
                                    <td class="text-left">
                                        <a href="javascript:sort('level');">会员等级</a>
                                    </td>
                                    <td class="text-left">
                                        <a href="javascript:sort('total_amount');">消费累计额度</a>
                                    </td>
                                    <td class="text-left">
                                        <a href="javascript:sort('email');">邮件地址</a>
                                    </td>
                                    
                                    <td class="text-left">
                                        <a href="javascript:void(0);"></a>
                                    </td>
                                    <td class="text-left">
                                        <a href="javascript:void(0);"></a>
                                    </td>
                                    <td class="text-left">
                                        <a href="javascript:void(0);"></a>
                                    </td>
                                    
                                    <td class="text-left">
                                        <a href="javascript:sort('mobile');">手机号码</a>
                                    </td>
                                    <td class="text-left">
                                        <a href="javascript:sort('pay_points');"></a>
                                    </td>
                                    <td class="text-left">
                                        <a href="javascript:sort('reg_time');"></a>
                                    </td>
                                    <td class="text-right">操作</td>
                                </tr>
                                </thead>
                                <tbody>
                  <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="selected[]" value="2593">
                                            <input type="hidden" name="shipping_code[]" value="flat.flat">
                                        </td>
                                        <td class="text-right"><?php echo ($vo["user_id"]); ?></td>
                                        <td class="text-left"><?php echo ($vo["username"]); ?></td>
                                        <td class="text-left"><?php echo ($vo["level"]); ?></td>
                                        <td class="text-left"><?php echo ($vo["total_amount"]); ?></td>
                                        <td class="text-left"><?php echo ($vo["email"]); ?></td>                                                                                    </td>
                                        <td class="text-left">0</td>
                                        <td class="text-left">0</td>
                                        <td class="text-left">0</td>
                                        <td class="text-left"><?php echo ($vo["mobile"]); ?></td>
                                        <td class="text-left">0</td>
                                        <td class="text-left"></td>
                                        <td class="text-right">
                                            <a href="<?php echo U('Home/Index/deluser',array('id'=>$vo['user_id']));?>" id="button-delete6" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="删除"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>                       
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    // $(document).ready(function(){
    //     ajax_get_table('search-form2',1);

    // });

    // ajax 抓取页面
    function ajax_get_table(tab,page){
        cur_page = page; //当前页面 保存为全局变量
            $.ajax({
                type : "POST",
                url:"/index.php/Admin/user/ajaxindex/p/"+page,//+tab,
                data : $('#'+tab).serialize(),// 你的formid
                success: function(data){
                    $("#ajax_return").html('');
                    $("#ajax_return").append(data);
                }
            });
    }

    // 点击排序
    function sort(field)
    {
        $("input[name='order_by']").val(field);
        var v = $("input[name='sort']").val() == 'desc' ? 'asc' : 'desc';
        $("input[name='sort']").val(v);
        ajax_get_table('search-form2',cur_page);
    }

    //发送站内信
    function send_message(id)
    {
        var obj = $("input[name*='selected']");
        var url = "<?php echo U('Admin/User/sendMessage');?>";
        if(obj.is(":checked")){
            var check_val = [];
            for(var k in obj){
                if(obj[k].checked)
                    check_val.push(obj[k].value);
            }
            url += "?user_id_array="+check_val;
        }
        layer.open({
            type: 2,
            title: '站内信',
            shadeClose: true,
            shade: 0.8,
            area: ['580px', '480px'],
            content: url
        });
    }

    //发送邮件
    function send_mail(id)
    {
        var obj = $("input[name*='selected']");
        var url = "<?php echo U('Admin/User/sendMail');?>";
        if(obj.is(":checked")){
            var check_val = [];
            for(var k in obj){
                if(obj[k].checked)
                    check_val.push(obj[k].value);
            }
            url += "?user_id_array="+check_val;
            layer.open({
                type: 2,
                title: '发送邮箱',
                shadeClose: true,
                shade: 0.8,
                area: ['580px', '480px'],
                content: url
            });
        }else{
            layer.msg('请选择会员');
        }

    }

    /**
     * 回调函数
     */
    function call_back(v) {
        layer.closeAll();
        if (v == 1) {
            layer.msg('发送成功');
        } else {
            layer.msg('发送失败');
        }
    }


</script>
</body>
</html>
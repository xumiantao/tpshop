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
            	<a href="javascript:;" class="btn btn-default" data-url="http://www.tp-shop.cn/Doc/Index/article/id/1019/developer/user.html" onclick="get_help(this)"><i class="fa fa-question-circle"></i> 帮助</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i>订单基本信息</h3>
                </div>
                <div class="panel-body">

                    <!--表单数据-->
                    <form method="post" action="<?php echo U('Admin/Order/add_order');?>" id="order-add">
                        <div class="tab-pane" >
                            <table class="table table-bordered">
                                <tbody><tr>
                                    <td>用户名:</td>
                                    <td>
                                    <div class="form-group ">
                                        <div class="col-xs-2">
                                            <input name="user_name" id="user_name" class="form-control" value="" placeholder="手机或邮箱搜索" />
                                         </div>   
                                        <div class="col-xs-2">                                         
                                            <select name="user_id" id="user_id" class="form-control">
                                                <option value="0">匿名用户</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2">
					                          <button class="btn btn-info" type="button" onclick="search_user();"><i class="ace-icon fa fa-search bigger-110"></i>搜索</button>
                                         </div>                                        
                                     </div>                                 
                                    </td>
                                </tr>
                                <tr>
                                    <td>收货人:</td>
                                    <td>
                                    <div class="form-group ">
	                                    <div class="col-xs-2">
	                                        <input name="consignee" id="consignee" value="<?php echo ($order["consignee"]); ?>" class="form-control" placeholder="收货人名字" />	                                    
                                        </div>
                                        <div class="col-xs-2">
										    <span id="err_consignee" style="color:#F00; display:none;">收货人名字不能为空</span>
                                        </div>
                                    </div>    
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>地址:</td>
                                    <td>
                                    <div class="form-group ">
                                    <div class="col-xs-2">
                                        <select onchange="get_city(this)" id="province" name="province" class="form-control">
                                            <option  value="0">选择省份</option>
                                            <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                         </div>   
                                        <div class="col-xs-2">                                        
                                        <select onchange="get_area(this)" id="city" name="city" class="form-control">
                                            <option value="0">选择城市</option>
                                            <?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                         </div>   
                                        <div class="col-xs-2">                                        
                                        <select id="district" name="district" class="form-control">
                                            <option value="0">选择区域</option>
                                            <?php if(is_array($area)): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                         </div>   
                                        <div class="col-xs-3">
                                        <input name="address" id="address" value="<?php echo ($order["address"]); ?>" class="form-control"   placeholder="详细地址"/>
									    </div>   
										<div class="col-xs-2">
										    <span id="err_address" style="color:#F00; display:none;">请完善收货地址</span>
                                        </div>                                                                             
									</div>  
                                    </td>
                                </tr>
                                <tr>
                                    <td>手机:</td>
                                    <td>
                                    <div class="form-group ">
	                                    <div class="col-xs-2">
	                                        <input name="mobile" id="mobile" value="<?php echo ($order["mobile"]); ?>" class="form-control" placeholder="收货人联系电话" />
                                        </div>
										<div class="col-xs-2">
										    <span id="err_mobile" style="color:#F00; display:none;">收货人电话不能为空</span>
                                        </div>                                                                                                                     
                                    </div>    
                                    </td>
                                </tr>
                                <tr>
                                    <td>配送物流</td>
                                    <td>
                                    <div class="form-group ">
	                                    <div class="col-xs-2">
                                        <select id="shipping" name="shipping"  class="form-control" >
                                            <?php if(is_array($shipping_list)): $i = 0; $__LIST__ = $shipping_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shipping): $mod = ($i % 2 );++$i;?><option <?php if($order[shipping_code] == $shipping[code]): ?>selected<?php endif; ?> value="<?php echo ($shipping["code"]); ?>" ><?php echo ($shipping["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        </div>
                                    </div>   
                                    </td>
                                </tr>
                                <tr>
                                    <td>支付方式</td>
                                    <td>
                                    <div class="form-group ">
	                                    <div class="col-xs-2">
                                        <select id="payment" name="payment"  class="form-control" >
                                            <?php if(is_array($payment_list)): $i = 0; $__LIST__ = $payment_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$payment): $mod = ($i % 2 );++$i;?><option <?php if($order[pay_code] == $payment[code]): ?>selected<?php endif; ?> value="<?php echo ($payment["code"]); ?>" ><?php echo ($payment["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        </div>
                                    </div>   
                                    </td>
                                </tr>
                                <tr>
                                    <td>发票抬头:</td>
                                    <td>
                                    <div class="form-group ">
	                                    <div class="col-xs-4">
	                                        <input name="invoice_title" value="<?php echo ($order["invoice_title"]); ?>" class="form-control"  placeholder="发票抬头"/>
                                        </div>
                                    </div>    
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>添加商品:</td>
                                    <td>
                                        <div class="form-group">
                                            <div class="col-xs-2">                                        
	                                            <a class="btn btn-primary" href="javascript:void(0);" onclick="selectGoods()" ><i class="fa fa-search"></i>添加商品</a>
                                            </div>                                                            
                                            <div class="col-xs-2">
                                                <span id="err_goods" style="color:#F00; display:none;">请添加下单商品</span>
                                            </div>                                            
                                        </div>                                    
                                    </td>
                                </tr>                                                                                          
                                <tr>
                                    <td>商品:</td>
                                    <td>                                    
                                       <div class="form-group ">                                       
                                            <div class="col-xs-10" id="goods_td">
                                                
                                            </div>                                                                                                                                                      
	                                   </div>                                                                      
                                    </td>
                                </tr>                                 
                                <tr>
                                    <td>管理员备注:</td>
                                    <td>
                                    <div class="form-group ">
	                                    <div class="col-xs-4">
                                        	<textarea style="width:440px; height:150px;" name="admin_note">管理员添加订单</textarea>
                                        </div>
                                    </div>    
                                    </td>
                                </tr>                                  
                                
                                </tbody>
                                </table>
                        </div>
                        <input type="hidden" name="id" value="<?php echo ($order["order_id"]); ?>">
                        <button class="btn btn-info" type="button" onclick="checkSubmit()">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            保存
                        </button>
                    </form> 
                    <script>
                        function checkSubmit()
						{							
							$("span[id^='err_']").each(function(){
								$(this).hide();
							});																				
									
						   ($.trim($('#consignee').val()) == '') && $('#err_consignee').show();
						   ($.trim($('#province').val()) == '') && $('#err_address').show();
						   ($.trim($('#city').val()) == '') && $('#err_address').show();
						   ($.trim($('#district').val()) == '') && $('#err_address').show();
						   ($.trim($('#address').val()) == '') && $('#err_address').show();
						   ($.trim($('#mobile').val()) == '') && $('#err_mobile').show();						   						   						   	
						   ($("input[name^='goods_id']").length ==0) && $('#err_goods').show();							
						   
						   if($("span[id^='err_']:visible").length > 0 ) 
						      return false;
							  
						   $('#order-add').submit();	  
						}
                    </script>
                </div>
            </div>
<!--订单商品信息--> 
			
<!--订单商品信息 end-->
            
            
        </div>    <!-- /.content -->
    </section>
</div>
<script>
    // 搜索用户 
    function search_user()
	{
		var user_name = $('#user_name').val();
		if($.trim(user_name) == '')
			return false;
			
			 $.ajax({
                type : "POST",
                url:"/index.php?m=Admin&c=User&a=search_user",//+tab,
                data :{search_key:$('#user_name').val()},// 你的formid
                success: function(data){
					data = data + '<option value="0">匿名用户</option>';
					$('#user_id').html(data);
                }
            });		
	}


    /* 用户订单区域选择 */
    $(document).ready(function(){
		/*
		$('#province').val(<?php echo ($order["province"]); ?>);
		$('#city').val(<?php echo ($order["city"]); ?>);
		$('#district').val(<?php echo ($order["district"]); ?>);
		$('#shipping_id').val(<?php echo ($order["shipping_id"]); ?>);
		*/
    })
// 选择商品
function selectGoods(){
    var url = "<?php echo U('Admin/Order/search_goods');?>";
    layer.open({
        type: 2,
        title: '选择商品',
        shadeClose: true,
        shade: 0.8,
        area: ['60%', '60%'],
        content: url, 
    });
}
// 选择商品返回
function call_back(table_html)
{
	$('#goods_td').empty().html('<table class="table table-bordered">'+table_html+'</table>');
	layer.closeAll('iframe');
}
</script>
</body>
</html>
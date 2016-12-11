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
 

<link href="/Public/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="/Public/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="/Public/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>


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
                <a href="javascript:history.go(-1)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="返回"><i class="fa fa-reply"></i></a>
				<a href="javascript:;" class="btn btn-default" data-url="http://www.tp-shop.cn/Doc/Index/article/id/1012/developer/user.html" onclick="get_help(this)"><i class="fa fa-question-circle"></i> 帮助</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> 添加公告</h3>
                </div>
                <div class="panel-body ">   
                    <!--表单数据-->
                    <form method="post" id="handleposition" action="<?php echo U('Admin/Ad/adHandle');?>">                    
                        <!--通用信息-->
                    <div class="tab-content col-md-10">                 	  
                        <div class="tab-pane active" id="tab_tongyong"> 
                        <?php if($show == 'edit' ): ?><table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="col-sm-2">公告名称：</td>
                                    <td class="col-sm-8">
                                        <input type="text" class="form-control" name="ad_name" value="<?php echo ((isset($editdata["ad_name"]) && ($editdata["ad_name"] !== ""))?($editdata["ad_name"]):"自定义广告名称"); ?>" >
                                        <span id="err_attr_name" style="color:#F00; display:none;"></span>                                    
                                    </td>
                                </tr>           
                                <tr>
                                    <td>公告内容：</td>
                                    <td width="85%">
                                        <textarea class="span12 ckeditor" id="goods_content" name="ad_content" title=""><?php echo ($editdata["ad_content"]); ?></textarea>
                                        <span id="err_goods_content" style="color:#F00; display:none;"></span>                                         
                                    </td> 
                                </tr>  
                               
                                </tbody> 
                                <tfoot>
                                    <tr>
                                    <td><input type="hidden" name="act" value="edit">
                                        <input type="hidden" name="ad_id" value="<?php echo ($editdata["ad_id"]); ?>">
                                    </td>
                                    <td class="text-right"><input class="btn btn-primary" type="button" onclick="adsubmit()" value="编辑"></td></tr>
                                </tfoot>                               
                            </table>
                            <?php else: ?> 
                                                        <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="col-sm-2">公告名称：</td>
                                    <td class="col-sm-8">
                                        <input type="text" class="form-control" name="ad_name" value="<?php echo ((isset($info["ad_name"]) && ($info["ad_name"] !== ""))?($info["ad_name"]):"自定义广告名称"); ?>" >
                                        <span id="err_attr_name" style="color:#F00; display:none;"></span>                                    
                                    </td>
                                </tr>           
                                <tr>
                                    <td>公告内容：</td>
                                    <td width="85%">
                                        <textarea style="width:400px;height；300px;" class="span12 ckeditor" id="goods_content" name="ad_content" title=""><?php echo ($goodsInfo["goods_content"]); ?></textarea>
                                        <span id="err_goods_content" style="color:#F00; display:none;"></span>                                         
                                    </td> 
                                </tr>  
                               
                                </tbody> 
                                <tfoot>
                                    <tr>
                                    <td><input type="hidden" name="act" value="add">
                                        
                                    </td>
                                    <td class="text-right"><input class="btn btn-primary" type="button" onclick="adsubmit()" value="保存"></td></tr>
                                </tfoot>                               
                            </table><?php endif; ?>                          

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
	$('#handleposition').submit();
}

$(document).ready(function() {

	$('#start_time').daterangepicker({
		format:"YYYY-MM-DD",
		singleDatePicker: true,
		showDropdowns: true,
		minDate:'2016-01-01',
		maxDate:'2030-01-01',
		startDate:'2016-01-01',
	    locale : {
            applyLabel : '确定',
            cancelLabel : '取消',
            fromLabel : '起始时间',
            toLabel : '结束时间',
            customRangeLabel : '自定义',
            daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
            monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
            firstDay : 1
        }
	});
	
	$('#end_time').daterangepicker({
		format:"YYYY-MM-DD",
		singleDatePicker: true,
		showDropdowns: true,
		minDate:'2016-01-01',
		maxDate:'2030-01-01',
		startDate:'2016-01-01',
		/*
        startDate: moment().startOf('day'),
        endDate: moment(),
        minDate: '01/01/2014',    //最小时间
        maxDate : moment(), //最大时间
        dateLimit : {
            days : 30
        }, //起止时间的最大间隔
        showDropdowns : true,
        showWeekNumbers : false, //是否显示第几周
        timePicker : true, //是否显示小时和分钟
        timePickerIncrement : 60, //时间的增量，单位为分钟
        timePicker12Hour : false, //是否使用12小时制来显示时间
        ranges : {
            '最近1小时': [moment().subtract('hours',1), moment()],
            '今日': [moment().startOf('day'), moment()],
            '昨日': [moment().subtract('days', 1).startOf('day'), moment().subtract('days', 1).endOf('day')],
            '最近7日': [moment().subtract('days', 6), moment()],
            '最近30日': [moment().subtract('days', 29), moment()]
        },
        opens : 'right', //日期选择框的弹出位置
        buttonClasses : [ 'btn btn-default' ],
        applyClass : 'btn-small btn-primary blue',
        cancelClass : 'btn-small',
        format : 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
        separator : ' to ',
        */
	    locale : {
            applyLabel : '确定',
            cancelLabel : '取消',
            fromLabel : '起始时间',
            toLabel : '结束时间',
            customRangeLabel : '自定义',
            daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
            monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
            firstDay : 1
        }
	});

});

</script>
 </body>
 </html>
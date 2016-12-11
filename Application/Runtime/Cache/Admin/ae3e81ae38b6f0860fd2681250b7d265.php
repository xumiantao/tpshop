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

        </section>
		<section class="content">
		  <div class="row">
		  	<div class="col-md-12">
		  		<div class="box box-info">
		  			<div class="box-header with-border">
		  				<div class="row">
		  					<div class="col-md-10">
		  						<form action="" method="post">		  					
					  				<div class="col-xs-5">         
					                    <div class="input-group margin">
					                      <div class="input-group-addon">
					                       		选择时间  <i class="fa fa-calendar"></i>
					                      </div>
					                      <input type="text" class="form-control pull-right" name="timegap" value="<?php echo ($timegap); ?>" id="start_time">
					                    </div>
				  					</div>
		                   		 	<div class="col-xs-1"><input class="btn btn-block btn-info margin" type="submit" value="确定"></div>
	                   		 	</form>
                   		 	</div>
		  				</div>
		  			</div>
		  			<div class="box-body">
		  				<div class="row">
				  			<div class="col-sm-3 col-xs-6">
				  				今日新增会员：<?php echo ($user["today"]); ?>
				  			</div>
				  				<div class="col-sm-3 col-xs-6">
				  				本月新增会员：<?php echo ($user["month"]); ?>
				  			</div>
				  				<div class="col-sm-3 col-xs-6">
				  				会员总数：<?php echo ($user["total"]); ?>
				  			</div>
				  				<div class="col-sm-3 col-xs-6">
				  				会员余额总额：<?php echo ($user["user_money"]); ?>
				  			</div>
			  			</div>
			  			<div class="row">
				  			<div class="col-sm-3 col-xs-6">
				  				匿名会员购物总额：
				  			</div>
				  			<div class="col-sm-3 col-xs-6">
				  				匿名会员订单数：
				  			</div>
				  			<div class="col-sm-3 col-xs-6">
				  				匿名会员评价订单额：
				  			</div>
				  			<div class="col-sm-3 col-xs-6">
				  				有单会员数：<?php echo ($user["hasorder"]); ?>
				  			</div>
			  			</div>
		  			</div>
		  		</div>
		  	</div>
		  </div>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">会员统计表</h3>
                  <div class="box-tools"></div>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    	<div id="statistics" style="height: 400px;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
   </section>
</div>
<script src="/Public/js/echart/echarts.min.js" type="text/javascript"></script>
<script src="/Public/js/echart/macarons.js"></script>
<script src="/Public/js/echart/china.js"></script>
<script src="/Public/dist/js/app.js" type="text/javascript"></script>
<script type="text/javascript">
var myChart = echarts.init(document.getElementById('statistics'),'macarons');
var res = <?php echo ($result); ?>;
option = {
	    title : {
	        text: '会员新增趋势'
	    },
	    tooltip : {
	        trigger: 'axis'
	    },
	    legend: {
	        data:['新增会员','有单会员']
	    },
	    toolbox: {
	        show : true,
	        feature : {
	            mark : {show: true},
	            dataView : {show: true, readOnly: false},
	            magicType : {show: true, type: ['line', 'bar']},
	            restore : {show: true},
	            saveAsImage : {show: true}
	        }
	    },
	    calculable : true,
	    xAxis : [
	        {
	            type : 'category',
	            boundaryGap : false,
	            data : res.time
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value',
	            axisLabel : {
	                formatter: '{value} 人'
	            }
	        }
	    ],
	    series : [
	        {
	            name:'新增会员',
	            type:'line',
	            data:res.data
	        }
	    ]
	};
	myChart.setOption(option);

	$(document).ready(function() {
		$('#start_time').daterangepicker({
			format:"YYYY-MM-DD",
			singleDatePicker: false,
			showDropdowns: true,
			minDate:'2016-01-01',
			maxDate:'2030-01-01',
			startDate:'2016-01-01',
	        showWeekNumbers: true,
	        timePicker: false,
	        timePickerIncrement: 1,
	        timePicker12Hour: true,
	        ranges: {
	           '今天': [moment(), moment()],
	           '昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
	           '最近7天': [moment().subtract('days', 6), moment()],
	           '最近30天': [moment().subtract('days', 29), moment()],
	           '上一个月': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
	        },
	        opens: 'right',
	        buttonClasses: ['btn btn-default'],
	        applyClass: 'btn-small btn-primary',
	        cancelClass: 'btn-small',
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
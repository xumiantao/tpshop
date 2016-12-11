<?php if (!defined('THINK_PATH')) exit();?><div class="table-responsive">
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
                评论内容
            </td>
            <td class="text-center">
                商品
            </td>
            <td class="text-center">
                显示
            </td>
            <td class="text-center">
                评论时间
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
                    <img width="20" height="20" src="/Public/images/<?php if($list[is_show] == 1): ?>yes.png<?php else: ?>cancel.png<?php endif; ?>" onclick="changeTableVal('comment','comment_id','<?php echo ($list["comment_id"]); ?>','is_show',this)"/>
                </td>
                <td class="text-center"><?php echo (date('Y-m-d H:i:s',$list["add_time"])); ?></td>
                <td class="text-center"><?php echo ($list["ip_address"]); ?></td>

                <td class="text-center">
                    <a href="<?php echo U('Admin/comment/detail',array('id'=>$list[comment_id]));?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="编辑"><i class="fa fa-eye"></i></a>
                    <a href="javascript:void(0);" data-href="<?php echo U('Admin/comment/del',array('id'=>$list[comment_id]));?>" onclick="del('<?php echo ($list[comment_id]); ?>',this)" id="button-delete6" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="删除"><i class="fa fa-trash-o"></i></a>
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
<script>
    $(".pagination  a").click(function(){
        var page = $(this).data('p');
        ajax_get_table('search-form2',page);
    });
</script>
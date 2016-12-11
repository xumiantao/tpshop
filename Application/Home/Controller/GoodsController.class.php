<?php

namespace Home\Controller;
use Think\AjaxPage;
use Think\Page;
use Think\Verify;
class GoodsController extends BaseController {
    //二级分类页
    public function index(){
        if(!empty($_GET['parent_id'])&&empty($_GET['brand_id'])){
            $where['cat_id']=$_GET['parent_id'];
            if($_GET['is_dec']==1){
            $goods=D('Goods')->order('shop_price asc')->where($where)->select();               
            }else{
            $goods=D('Goods')->order('shop_price desc')->where($where)->select();

            }

        }else if(!empty($_GET['brand_id'])){
            $where['brand_id']=$_GET['brand_id'];
            if($_GET['is_dec']==1){
            $goods=D('Goods')->order('shop_price asc')->where($where)->select();               
            }else{
            $goods=D('Goods')->order('shop_price desc')->where($where)->select();

            }

        }else{
            if($_GET['is_dec']==1){
            $goods=D('Goods')->order('shop_price asc')->select();               
            }else{
            $goods=D('Goods')->order('shop_price desc')->select();

            }
        }
        //下拉二级分类数据
        $af=D('goods_category')->where(array('id'=>$_GET['parent_id']))->find();
        $Twotype=D('goods_category')->where(array('parent_id' => $af['parent_id']))->select();   
        //所有品牌
        $as=D('Brand')->where(array('cat_id'=>$_GET['parent_id']))->select();
        //一级分类
        $a1=D('goods_category')->where(array('id'=>$af['parent_id']))->find();
        $dec=U('Home/Goods/index',array('parent_id'=>$_GET['parent_id'],'is_dec'=>'1','brand_id'=>$_GET['brand_id']));
        $up=U('Home/Goods/index',array('parent_id'=>$_GET['parent_id'],'is_dec'=>'2','brand_id'=>$_GET['brand_id']));
        $this->assign('dec',$dec);
        $this->assign('up',$up);
        $this->assign('as',$as);
        $this->assign('af',$af);
        $this->assign('a1',$a1);
        $this->assign('twotype',$Twotype);   
        $this->assign('goods',$goods);      
        $this->display('goods');
    }
   /**
    * 商品详情页
    */ 
    public function goodsInfo(){
        
        $where['goods_id']=$_GET['goods_id'];
        $goods=D('Goods')->where($where)->find();
        $goods_img=D('GoodsImages')->where(array('goods_id'=>$goods['goods_id']))->select();
        $atr=D('GoodsAttr')->join('tp_goods_attribute on tp_goods_attr.attr_id=tp_goods_attribute.attr_id')->where(array('goods_id'=>$_GET['goods_id']))->select();
        // echo "<meta charset='utf-8'>";
        // var_dump($atr);
        // exit();
        $this->assign('goods_img',$goods_img);
        $this->assign('atr',$atr);
        $this->assign('goods',$goods);
        $this->display("product_info");
    }
    public function goodsInfo2(){
        
        $where['goods_id']=$_GET['goods_id'];
        $goods=D('Goods')->where($where)->find();
        $goods_img=D('GoodsImages')->where(array('goods_id'=>$goods['goods_id']))->select();
        $atr=D('GoodsAttr')->join('tp_goods_attribute on tp_goods_attr.attr_id=tp_goods_attribute.attr_id')->where(array('goods_id'=>$_GET['goods_id']))->select();
        // echo "<meta charset='utf-8'>";
        // var_dump($atr);
        // exit();
        $this->assign('goods_img',$goods_img);
        $this->assign('atr',$atr);
        $this->assign('goods',$goods);
        $this->display("product_info");
    }
    
    public function product_inshop(){
        
        $where['goods_id']=$_GET['goods_id'];
        $goods=D('Goods')->where($where)->find();
        $goods_img=D('GoodsImages')->where(array('goods_id'=>$goods['goods_id']))->select();
        $atr=D('GoodsAttr')->join('tp_goods_attribute on tp_goods_attr.attr_id=tp_goods_attribute.attr_id')->where(array('goods_id'=>$_GET['goods_id']))->select();
        // echo "<meta charset='utf-8'>";
        // var_dump($atr);
        // exit();
        $this->assign('goods_img',$goods_img);
        $this->assign('atr',$atr);
        $this->assign('goods',$goods);
        $this->display();
    }
    public function goodsInfo4(){
        
        $where['goods_id']=$_GET['goods_id'];
        $goods=D('Goods')->where($where)->find();
        $goods_img=D('GoodsImages')->where(array('goods_id'=>$goods['goods_id']))->select();
        $atr=D('GoodsAttr')->join('tp_goods_attribute on tp_goods_attr.attr_id=tp_goods_attribute.attr_id')->where(array('goods_id'=>$_GET['goods_id']))->select();
        // echo "<meta charset='utf-8'>";
        // var_dump($atr);
        // exit();
        $this->assign('goods_img',$goods_img);
        $this->assign('atr',$atr);
        $this->assign('goods',$goods);
        $this->display("product_info");
    }
    //收藏
    public function keep(){
                if(empty(session('mobile'))) {
            $this->redirect('Home/User/login');
        } 
        if(!empty($_GET['isget'])&&$_GET['isget']==1){
            //判断是否已经收藏
            $ishas=D('Cart')->where(array('user_id'=>session('user_id'),'goods_id'=>$_GET['goods_id']))->find();
            if(empty($ishas)){
                D('Cart')->add(array('user_id'=>session('user_id'),'goods_id'=>$_GET['goods_id']));
            }
        }
        $cartdata=D('Goods')->join('tp_cart on tp_cart.goods_id=tp_goods.goods_id')->where(array('user_id'=>session('user_id'),'isshoucan'=>1))->select();
        $this->assign('cart',$cartdata);
        $this->display();
    }
        //提交订单数据
    public function established_date(){

        $this->display();
    }
    /**
     * 商品列表页
     */
    public function goodsList(){ 
                         
        $key = md5($_SERVER['REQUEST_URI'].$_POST['start_price'].'_'.$_POST['end_price']);
        $html = S($key);
        if(!empty($html))
        {
            exit($html);
        }
        
        $filter_param = array(); // 帅选数组                        
        $id = I('get.id',1); // 当前分类id 
        $brand_id = I('get.brand_id',0);
        $spec = I('get.spec',0); // 规格 
        $attr = I('get.attr',''); // 属性        
        $sort = I('get.sort','goods_id'); // 排序
        $sort_asc = I('get.sort_asc','asc'); // 排序
        $price = I('get.price',''); // 价钱
        $start_price = trim(I('post.start_price','0')); // 输入框价钱
        $end_price = trim(I('post.end_price','0')); // 输入框价钱        
        if($start_price && $end_price) $price = $start_price.'-'.$end_price; // 如果输入框有价钱 则使用输入框的价钱
     
        $filter_param['id'] = $id; //加入帅选条件中                       
        $brand_id  && ($filter_param['brand_id'] = $brand_id); //加入帅选条件中
        $spec  && ($filter_param['spec'] = $spec); //加入帅选条件中
        $attr  && ($filter_param['attr'] = $attr); //加入帅选条件中
        $price  && ($filter_param['price'] = $price); //加入帅选条件中
                
        $goodsLogic = new \Home\Logic\GoodsLogic(); // 前台商品操作逻辑类
        
        // 分类菜单显示
        $goodsCate = M('GoodsCategory')->where("id = $id")->find();// 当前分类
        //($goodsCate['level'] == 1) && header('Location:'.U('Home/Channel/index',array('cat_id'=>$id))); //一级分类跳转至大分类馆        
        $cateArr = $goodsLogic->get_goods_cate($goodsCate); 
         
        // 帅选 品牌 规格 属性 价格
        $cat_id_arr = getCatGrandson ($id);
        $filter_goods_id = M('goods')->where("is_on_sale=1 and cat_id in(".  implode(',', $cat_id_arr).")")->cache(true)->getField("goods_id",true);      
 
        // 过滤帅选的结果集里面找商品        
        if($brand_id || $price)// 品牌或者价格
        {
            $goods_id_1 = $goodsLogic->getGoodsIdByBrandPrice($brand_id,$price); // 根据 品牌 或者 价格范围 查找所有商品id    
            $filter_goods_id = array_intersect($filter_goods_id,$goods_id_1); // 获取多个帅选条件的结果 的交集
        }
        if($spec)// 规格
        {
            $goods_id_2 = $goodsLogic->getGoodsIdBySpec($spec); // 根据 规格 查找当所有商品id
            $filter_goods_id = array_intersect($filter_goods_id,$goods_id_2); // 获取多个帅选条件的结果 的交集
        }
        if($attr)// 属性
        {
            $goods_id_3 = $goodsLogic->getGoodsIdByAttr($attr); // 根据 规格 查找当所有商品id
            $filter_goods_id = array_intersect($filter_goods_id,$goods_id_3); // 获取多个帅选条件的结果 的交集
        }        
             
        $filter_menu  = $goodsLogic->get_filter_menu($filter_param,'goodsList'); // 获取显示的帅选菜单
        $filter_price = $goodsLogic->get_filter_price($filter_goods_id,$filter_param,'goodsList'); // 帅选的价格期间         
        $filter_brand = $goodsLogic->get_filter_brand($filter_goods_id,$filter_param,'goodsList',1); // 获取指定分类下的帅选品牌        
        $filter_spec  = $goodsLogic->get_filter_spec($filter_goods_id,$filter_param,'goodsList',1); // 获取指定分类下的帅选规格        
        $filter_attr  = $goodsLogic->get_filter_attr($filter_goods_id,$filter_param,'goodsList',1); // 获取指定分类下的帅选属性        
                                
        $count = count($filter_goods_id);
        $page = new Page($count,40);
        if($count > 0)
        {
            $goods_list = M('goods')->where("goods_id in (".  implode(',', $filter_goods_id).")")->order("$sort $sort_asc")->limit($page->firstRow.','.$page->listRows)->select();
            $filter_goods_id2 = get_arr_column($goods_list, 'goods_id');
            if($filter_goods_id2)
            $goods_images = M('goods_images')->where("goods_id in (".  implode(',', $filter_goods_id2).")")->cache(true)->select();       
        }
        // print_r($filter_menu);         
        $goods_category = M('goods_category')->where('is_show=1')->cache(true)->getField('id,name,parent_id,level'); // 键值分类数组
        $navigate_cat = navigate_goods($id); // 面包屑导航         
        $this->assign('goods_list',$goods_list);
        $this->assign('navigate_cat',$navigate_cat);
        $this->assign('goods_category',$goods_category);                
        $this->assign('goods_images',$goods_images);  // 相册图片
        $this->assign('filter_menu',$filter_menu);  // 帅选菜单
        $this->assign('filter_spec',$filter_spec);  // 帅选规格
        $this->assign('filter_attr',$filter_attr);  // 帅选属性
        $this->assign('filter_brand',$filter_brand);  // 列表页帅选属性 - 商品品牌
        $this->assign('filter_price',$filter_price);// 帅选的价格期间
        $this->assign('goodsCate',$goodsCate);
        $this->assign('cateArr',$cateArr);
        $this->assign('filter_param',$filter_param); // 帅选条件
        $this->assign('cat_id',$id);
        $this->assign('page',$page);// 赋值分页输出
        C('TOKEN_ON',false);
        $html = $this->fetch();        
        S($key,$html);
        echo $html;
    }    
   
    /**
     * 商品搜索列表页
     */
    public function search()
    {
       //C('URL_MODEL',0);
        $filter_param = array(); // 帅选数组                        
        $id = I('get.id',0); // 当前分类id 
        $brand_id = I('brand_id',0);         
        $sort = I('sort','goods_id'); // 排序
        $sort_asc = I('sort_asc','asc'); // 排序
        $price = I('price',''); // 价钱
        $start_price = trim(I('start_price','0')); // 输入框价钱
        $end_price = trim(I('end_price','0')); // 输入框价钱
        if($start_price && $end_price) $price = $start_price.'-'.$end_price; // 如果输入框有价钱 则使用输入框的价钱
        $q = urldecode(trim(I('q',''))); // 关键字搜索
        empty($q) && $this->error('请输入搜索词');
                
        $id && ($filter_param['id'] = $id); //加入帅选条件中                       
        $brand_id  && ($filter_param['brand_id'] = $brand_id); //加入帅选条件中        
        $price  && ($filter_param['price'] = $price); //加入帅选条件中
        $q  && ($_GET['q'] = $filter_param['q'] = $q); //加入帅选条件中
        
        $goodsLogic = new \Home\Logic\GoodsLogic(); // 前台商品操作逻辑类
               
        $where = "goods_name like '%{$q}%' and is_on_sale=1 ";
        if($id)
        {
            $cat_id_arr = getCatGrandson ($id);
            $where .= " and cat_id in(".  implode(',', $cat_id_arr).")";
        }
        
        $search_goods = M('goods')->where($where)->getField('goods_id,cat_id');
        $filter_goods_id = array_keys($search_goods);                
        $filter_cat_id = array_unique($search_goods); // 分类需要去重
        if($filter_cat_id)        
        {
            $cateArr = M('goods_category')->where("id in(".implode(',', $filter_cat_id).")")->select();            
            $tmp = $filter_param;
            foreach($cateArr as $k => $v)            
            {
                $tmp['id'] = $v['id'];
                $cateArr[$k]['href'] = U("/Home/Goods/search",$tmp);                            
            }                
        }                        
        // 过滤帅选的结果集里面找商品        
        if($brand_id || $price)// 品牌或者价格
        {
            $goods_id_1 = $goodsLogic->getGoodsIdByBrandPrice($brand_id,$price); // 根据 品牌 或者 价格范围 查找所有商品id    
            $filter_goods_id = array_intersect($filter_goods_id,$goods_id_1); // 获取多个帅选条件的结果 的交集
        }
        
        $filter_menu  = $goodsLogic->get_filter_menu($filter_param,'search'); // 获取显示的帅选菜单
        $filter_price = $goodsLogic->get_filter_price($filter_goods_id,$filter_param,'search'); // 帅选的价格期间         
        $filter_brand = $goodsLogic->get_filter_brand($filter_goods_id,$filter_param,'search',1); // 获取指定分类下的帅选品牌        
                                
        $count = count($filter_goods_id);
        $page = new Page($count,20);
        if($count > 0)
        {
            $goods_list = M('goods')->where("is_on_sale=1 and goods_id in (".  implode(',', $filter_goods_id).")")->order("$sort $sort_asc")->limit($page->firstRow.','.$page->listRows)->select();
            $filter_goods_id2 = get_arr_column($goods_list, 'goods_id');
            if($filter_goods_id2)
            $goods_images = M('goods_images')->where("goods_id in (".  implode(',', $filter_goods_id2).")")->select();       
        }    
                
        $this->assign('goods_list',$goods_list);  
        $this->assign('goods_images',$goods_images);  // 相册图片
        $this->assign('filter_menu',$filter_menu);  // 帅选菜单
        $this->assign('filter_brand',$filter_brand);  // 列表页帅选属性 - 商品品牌
        $this->assign('filter_price',$filter_price);// 帅选的价格期间
        $this->assign('cateArr',$cateArr);
        $this->assign('filter_param',$filter_param); // 帅选条件
        $this->assign('cat_id',$id);
        $this->assign('page',$page);// 赋值分页输出
        $this->assign('q',I('q'));
        C('TOKEN_ON',false);
        $this->display();
    }
    
    /**
     * 商品咨询ajax分页
     */
    public function ajax_consult(){        
        $goods_id = I("goods_id",'0');        
        $consult_type = I('consult_type','0'); // 0全部咨询  1 商品咨询 2 支付咨询 3 配送 4 售后
                 
        $where = " parent_id = 0 and goods_id = $goods_id";
        if($consult_type > 0)
            $where .= " and consult_type = $consult_type ";
        
        $count = M('GoodsConsult')->where($where)->count();        
        $page = new AjaxPage($count,5);
        $show = $page->show();        
        $list = M('GoodsConsult')->where($where)->order("id desc")->limit($page->firstRow.','.$page->listRows)->select();
        $replyList = M('GoodsConsult')->where("parent_id > 0")->order("id desc")->select();
        
        $this->assign('consultCount',$count);// 商品咨询数量
        $this->assign('consultList',$list);// 商品咨询
        $this->assign('replyList',$replyList); // 管理员回复
        $this->assign('page',$show);// 赋值分页输出        
        $this->display();        
    }
    
    /**
     * 商品评论ajax分页
     */
    public function ajaxComment(){        
        $goods_id = I("goods_id",'0');        
        $commentType = I('commentType','1'); // 1 全部 2好评 3 中评 4差评
        if($commentType==5){
        	$where = "is_show = 1 and  goods_id = $goods_id and parent_id = 0 and img !='' ";
        }else{
        	$typeArr = array('1'=>'0,1,2,3,4,5','2'=>'4,5','3'=>'3','4'=>'0,1,2');
        	$where = "is_show = 1 and  goods_id = $goods_id and parent_id = 0 and ceil((deliver_rank + goods_rank + service_rank) / 3) in($typeArr[$commentType])";
        }
        $count = M('Comment')->where($where)->count();                
        
        $page = new AjaxPage($count,5);
        $show = $page->show();        
        $list = M('Comment')->where($where)->order("add_time desc")->limit($page->firstRow.','.$page->listRows)->select();
        $replyList = M('Comment')->where("is_show = 1 and  goods_id = $goods_id and parent_id > 0")->order("add_time desc")->select();
        
        foreach($list as $k => $v){
            $list[$k]['img'] = unserialize($v['img']); // 晒单图片            
        }        
        $this->assign('commentlist',$list);// 商品评论
        $this->assign('replyList',$replyList); // 管理员回复
        $this->assign('page',$show);// 赋值分页输出        
        $this->display();        
    }    
    
    /**
     *  商品咨询
     */
    public function goodsConsult(){
        //  form表单提交
        C('TOKEN_ON',true);        
        $goods_id = I("goods_id",'0'); // 商品id
        $consult_type = I("consult_type",'1'); // 商品咨询类型
        $username = I("username",'TPshop用户'); // 网友咨询
        $content = I("content"); // 咨询内容
        
        $verify = new Verify();
        if (!$verify->check(I('post.verify_code'),'consult')) {
            $this->error("验证码错误");
        }
        
        $goodsConsult = M('goodsConsult');        
        if (!$goodsConsult->autoCheckToken($_POST))
        {            
                $this->error('你已经提交过了!', U('/Home/Goods/goodsInfo',array('id'=>$goods_id))); 
                exit;
        }
        
        $data = array(
            'goods_id'=>$goods_id,
            'consult_type'=>$consult_type,
            'username'=>$username,
            'content'=>$content,
            'add_time'=>time(),
        );        
        $goodsConsult->add($data);        
        $this->success('咨询已提交!', U('/Home/Goods/goodsInfo',array('id'=>$goods_id))); 
    }
    
    /**
     * 用户收藏某一件商品
     * @param type $goods_id
     */
    public function collect_goods($goods_id)
    {
        $goods_id = I('goods_id');
        $goodsLogic = new \Home\Logic\GoodsLogic();        
        $result = $goodsLogic->collect_goods(cookie('user_id'),$goods_id);
        exit(json_encode($result));
    }
    
    /**
     * 加入购物车弹出
     */
    public function open_add_cart()
    {        
         $this->display();
    }

    /**
     * 积分商城
     */
    public function integralMall()
    {
        $cat_id = I('get.id');
        $minValue = I('get.minValue');
        $maxValue = I('get.maxValue');
        $brandType = I('get.brandType');
        $point_rate = tpCache('shopping.point_rate');
        $is_new = I('get.is_new',0);
        $exchange = I('get.exchange',0);
        $goods_where = array(
            'is_on_sale' => 1,
        );
        //积分兑换筛选
        $exchange_integral_where_array = array(array('gt',0));
        // 分类id
        if (!empty($cat_id)) {
            $goods_where['cat_id'] = array('in', getCatGrandson($cat_id));
        }
        //积分截止范围
        if (!empty($maxValue)) {
            array_push($exchange_integral_where_array, array('lt', $maxValue));
        }
        //积分起始范围
        if (!empty($minValue)) {
            array_push($exchange_integral_where_array, array('gt', $minValue));
        }
        //积分+金额
        if ($brandType == 1) {
            array_push($exchange_integral_where_array, array('exp', ' < shop_price* ' . $point_rate));
        }
        //全部积分
        if ($brandType == 2) {
            array_push($exchange_integral_where_array, array('exp', ' = shop_price* ' . $point_rate));
        }
        //新品
        if($is_new == 1){
            $goods_where['is_new'] = $is_new;
        }
        //我能兑换
        $user_id = cookie('user_id');
        if ($exchange == 1 && !empty($user_id)) {
            $user_pay_points = intval(M('users')->where(array('user_id' => $user_id))->getField('pay_points'));
            if ($user_pay_points !== false) {
                array_push($exchange_integral_where_array, array('lt', $user_pay_points));
            }
        }

        $goods_where['exchange_integral'] =  $exchange_integral_where_array;
        $goods_list_count = M('goods')->where($goods_where)->count();
        $page = new Page($goods_list_count, 15);
        $goods_list = M('goods')->where($goods_where)->limit($page->firstRow . ',' . $page->listRows)->select();
        $goods_category = M('goods_category')->where(array('level' => 1))->select();

        $this->assign('goods_list', $goods_list);
        $this->assign('page', $page->show());
        $this->assign('goods_list_count',$goods_list_count);
        $this->assign('goods_category', $goods_category);//商品1级分类
        $this->assign('point_rate', $point_rate);//兑换率
        $this->assign('nowPage',$page->nowPage);// 当前页
        $this->assign('totalPages',$page->totalPages);//总页数
        $this->display();
    }
    
}
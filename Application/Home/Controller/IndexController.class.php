<?php
namespace Home\Controller;
use Think\Page;
use Think\Verify;
class IndexController extends BaseController {
    
    public function index(){         
                       
        // 如果是手机跳转到 手机模块
  //       if(true == isMobile()){
  //           header("Location: ".U('Mobile/Index/index'));
  //       }
        
  //       $hot_goods = $hot_cate = $cateList = array();
  //       $sql = "select a.goods_name,a.goods_id,a.shop_price,a.market_price,a.cat_id,b.parent_id_path,b.name from __PREFIX__goods as a left join ";
  //       $sql .= " __PREFIX__goods_category as b on a.cat_id=b.id where a.is_hot=1 and a.is_on_sale=1 order by a.sort";//二级分类下热卖商品       
  //       $index_hot_goods = M()->query($sql);//首页热卖商品
		// if($index_hot_goods){
		// 	foreach($index_hot_goods as $val){
		// 		$cat_path = explode('_', $val['parent_id_path']);
		// 		$hot_goods[$cat_path[1]][] = $val;
		// 	}
		// }

  //       $hot_category = M('goods_category')->where("is_hot=1 and level=3 and is_show=1")->select();//热门三级分类
  //       foreach ($hot_category as $v){
  //       	$cat_path = explode('_', $v['parent_id_path']);
  //       	$hot_cate[$cat_path[1]][] = $v;
  //       }
        
  //       foreach ($this->cateTrre as $k=>$v){
  //           if($v['is_hot']==1){
  //       		$v['hot_goods'] = empty($hot_goods[$k]) ? '' : $hot_goods[$k];
  //       		$v['hot_cate'] = empty($hot_cate[$k]) ? '' : $hot_cate[$k];
  //       		$cateList[] = $v;
  //       	}
  //       }
        //轮播图

        $indeximg=D('IndexImg')->select();
        //获取热卖商品
        $hot=D('Goods')->order('sort asc')->where(array('is_hot'=>1))->limit(4)->select();
        //猜你喜欢
        $Ulike=D('Goods')->order('sort asc')->where(array('is_hot'=>1))->limit(4)->select();
        // var_dump($hot);
        // exit();
        //获取分类
        $firsttype=D('goods_category')->where(array('parent_id' => 0,'is_show'=>1))->select();   
        $this->assign('firsttype',$firsttype); 
        $showtype=D('goods_category')->where(array('parent_id' => 0,'is_show'=>1))->limit('7')->select();   
        $this->assign('showtype',$showtype); 
        //获取公告
        $ad= D('ad')->order("ad_id desc")->find();
        //特卖商品 根据更新时间
        $temai=D('Goods')->order('last_update desc')->where(array('is_hot'=>1))->limit(4)->select(); 
        $this->assign('tm',$temai);       
        $this->assign('like',$Ulike);
        $this->assign('hot',$hot);
        $this->assign('ad',$ad);
        $this->assign('img',$indeximg);
        $this->display();
    }
    
    //全部分类
    public  function all(){
        $firsttype=D('goods_category')->where(array('parent_id' => 0,'is_show'=>1))->select();   
        $this->assign('firsttype',$firsttype);
        $where['parent_id']=$_GET['parent_id'];
        if(!empty($where['parent_id'])){
             $alltype=D('goods_category')->where($where)->select();   
        }else{
            $alltype=D('goods_category')->select();
            foreach ($alltype as $key => $value) {
                   if($value['parent_id']==0){
                        unset($alltype[$key]);
                   }
               }   
        }
        $this->assign('alltype',$alltype); 
        $this->display();
    }
    //搜索页
    public function sosou(){
        if(IS_POST){
            $e['goods_name']=array('like','%'.$_POST['sosuo'].'%');
           $all= D('Goods')->where($e)->select();
            
        }
        $this->assign('all',$all); 
        $this->display();
    }  
    
    public function uploadimg(){
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  'Public/upload/banner/';// 设置附件上传目录
        if(!$upload->upload()) {// 上传错误提示错误信息
        $this->error($upload->getErrorMsg());
        }else{// 上传成功 获取上传文件信息
        $info =  $upload->getUploadFileInfo();
        }
         
        // 保存表单数据 包括附件数据
        $User = M("IndexImg"); // 实例化User对象
        $User->create(); // 创建数据对象
        $User->img = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        $User->add(); // 写入用户数据到数据库
        $this->success('数据保存成功！');       
    }
    
    public function delimg(){
        D('IndexImg')->delete($_GET['id']);
        $this->success("删除成功");
    }
    public function deluser(){
        D('Users')->delete($_GET['id']);
        $this->success("删除成功");
    }
    /**
     *  公告详情页
     */
    public function notice(){
        $this->display();
    }
    
    // 二维码
    public function qr_code(){        
        // // 导入Vendor类库包 Library/Vendor/Zend/Server.class.php
        // //http://www.tp-shop.cn/Home/Index/erweima/data/www.99soubao.com
        //  require_once 'ThinkPHP/Library/Vendor/phpqrcode/phpqrcode.php';
        //   //import('Vendor.phpqrcode.phpqrcode');
        //     error_reporting(E_ERROR);            
        //     $url = urldecode($_GET["data"]);
        //     \QRcode::png($url);          
    }
    
    // 验证码
    // public function verify()
    // {
    //     //验证码类型
    //     $type = I('get.type') ? I('get.type') : '';
    //     $fontSize = I('get.fontSize') ? I('get.fontSize') : '40';
    //     $length = I('get.length') ? I('get.length') : '4';
        
    //     $config = array(
    //         'fontSize' => $fontSize,
    //         'length' => $length,
    //         'useCurve' => true,
    //         'useNoise' => false,
    //     );
    //     $Verify = new Verify($config);
    //     $Verify->entry($type);        
    // }
    
    // 促销活动页面
    // public function promoteList()
    // {                          
    //     // $Model = new \Think\Model();
    //     // $goodsList = $Model->query("select * from __PREFIX__goods as g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id   where ".time()." > start_time  and ".time()." < end_time");                        
    //     // $brandList = M('brand')->getField("id,name,logo");
    //     // $this->assign('brandList',$brandList);
    //     // $this->assign('goodsList',$goodsList);
    //     $this->display();
    // }
    
    // function truncate_tables (){
    //     $model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
    //     $tables = $model->query("show tables");
    //     $table = array('tp_admin','tp_config','tp_region','tp_system_module','tp_admin_role','tp_system_menu');
    //     foreach($tables as $key => $val)
    //     {                                    
    //         if(!in_array($val['tables_in_tpshop'], $table))                             
    //             echo "truncate table ".$val['tables_in_tpshop'].' ; ';
    //             echo "<br/>";         
    //     }                
    // }

}
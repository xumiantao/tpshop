<?php

namespace Home\Controller;
use Home\Logic\UsersLogic;
use Think\Page;
use Think\Verify;

class UserController extends BaseController {

	public $user_id = 0;
	public $user = array();
	

    /*
     * 用户中心首页
     */
    public function index(){
        $logic = new UsersLogic();
        $user = $logic->get_info($this->user_id);
        $user = $user['result'];
        $level = M('user_level')->select();
        $level = convert_arr_key($level,'level_id');
        $this->assign('level',$level);
        $this->assign('user',$user);
        $this->display();
    }
    //个人中心
    public function system(){
        if(empty(session('mobile'))) {
            $this->redirect('Home/User/login');
        } 
        if(!empty(session('mobile'))){
            $this->assign('show','aa');
        }
        $this->display();
    }
    //全部订单
    public function orders(){
        if(empty(session('mobile'))) {
            $this->redirect('Home/User/login');
        }
        // $de=D('OrderGoods')->where(array('user_id'=>session('user_id')))->select();
        // foreach ($de as $key => $value) {
        //        $de[$key]['allprice']=$value['goods_price']*$value['goods_num'];
        //         $se=D('Order')->where(array('user_id'=>session('user_id'),'order_id'=>$value['order_id']))->find();
        //         if($se['order_status']==1){
        //             $de[$key]['status']="待付款";
        //         }  
        //         $de[$key]['ordernumber']=$se['order_sn'];
        //         $fe=D('Goods')->where(array('goods_id'=>$value['goods_id']))->find();
        //         $de[$key]['goods_name']=$fe['goods_name'];
        //         $de[$key]['original_img']=$fe['original_img'];
        //         $de[$key]['original_img']=$fe['original_img'];
        // }
        $de=D('Order')->where(array('user_id'=>session('user_id')))->select();
        foreach ($de as $key => $value) {
            $fe=D('OrderGoods')->where(array('order_id'=>$value['order_id']))->select();
            foreach ($fe as $k => $v) {
                $goods=D('Goods')->where(array('goods_id'=>$v['goods_id']))->find();
                $v['original_img']=$goods['original_img'];
                $de[$key]['sub'][]=$v;
            }
        }
        $this->assign('de',$de);   
        $this->display();
    }
    //待付款订单
    public function orders1(){
        if(empty(session('mobile'))) {
            $this->redirect('Home/User/login');
        }
         $de=D('Order')->where(array('user_id'=>session('user_id')))->select();
        foreach ($de as $key => $value) {
            $fe=D('OrderGoods')->where(array('order_id'=>$value['order_id']))->select();
            foreach ($fe as $k => $v) {
                $goods=D('Goods')->where(array('goods_id'=>$v['goods_id']))->find();
                $v['original_img']=$goods['original_img'];
                $de[$key]['sub'][]=$v;
            }
            if($value['pay_status']==1){
                unset($de[$key]);
            }
        }
        $this->assign('de',$de);   
        $this->display();
    }
//取消订单
public function deleteorder(){
    D('Order')->where(array('order_id'=>$_GET['order_id']))->delete();
    D('OrderGoods')->where(array('order_id'=>$_GET['order_id']))->delete();
    $this->redirect('Home/User/orders');
}  
    //收货地址
    public function address(){
        if(empty(session('mobile'))) {
            $this->redirect('Home/User/login');
        } 
   
        $s=D('UserAddress')->where(array('user_id'=>session('user_id')))->select();
        $this->assign('adress',$s);
        $this->display();
    }
    //添加收货地址
    public function add_new(){
        if(IS_POST){
            if(empty($_POST['sendname'])||empty($_POST['phone'])||empty($_POST['area'])||empty($_POST['address'])){
                $this->error('请输入数据');
                exit();
            }else{
                $se['consignee']=trim(I('post.sendname'));
                $se['mobile']=trim(I('post.phone'));
                if(is_numeric($se['mobile'])){
                    $this->error('请输入有效手机号码');
                    exit();
                }
                $se['user_id']=session('user_id');
                $se['location_addrss']=trim(I('post.area'));
                $se['detail_address']=trim(I('post.address'));
                if(!empty($_POST['checkbox'])){
                    $se['is_default']=1;
                    $notdefault['is_default']=0;
                    D('UserAddress')->where(array('user_id'=>session('user_id')))->save($notdefault);
                }
                D('UserAddress')->where(array('user_id'=>session('user_id')))->add($se);

                $this->success('添加成功',U('Home/User/address'));
            }
            exit();
        }
        $this->display();
    }
    //个人资料   
    public function data(){ 
        $this->display();
    }     
    public function editadress(){     
        $s=D('UserAddress')->where(array('user_id'=>session('user_id'),'address_id'=>$_GET['address_id']))->find();
        $this->assign('adress',$s);
        if(IS_POST){
            if(empty($_POST['sendname'])||empty($_POST['phone'])||empty($_POST['area'])||empty($_POST['address'])){
                $this->error('请输入数据');
                exit();
            }else{
                $se['consignee']=trim(I('post.sendname'));
                $se['mobile']=trim(I('post.phone'));
                $se['user_id']=session('user_id');
                $se['location_addrss']=trim(I('post.area'));
                $se['detail_address']=trim(I('post.address'));
                if(!empty($_POST['checkbox'])){
                    $se['is_default']=1;
                    $notdefault['is_default']=0;
                    D('UserAddress')->where(array('user_id'=>session('user_id')))->save($notdefault);
                }
                D('UserAddress')->where(array('user_id'=>session('user_id'),'address_id'=>$_POST['address_id']))->save($se);

                $this->success('编辑成功',U('Home/User/address'));
            }
            exit();
        }
        $this->display();
    }
 
    public function  deletedress(){   
        D('UserAddress')->where(array('user_id'=>session('user_id'),'address_id'=>$_GET['address_id']))->delete();
        $this->success('删除成功',U('Home/User/address'));
    }
    //设置默认收货地址

    public function setdefaultaddress(){   
            $notdefault['is_default']=0;
            D('UserAddress')->where(array('user_id'=>session('user_id')))->save($notdefault);
            $default['is_default']=1;
            D('UserAddress')->where(array('user_id'=>session('user_id'),'address_id'=>$_GET['address_id']))->save($default);
       
    }  
    // public function logout(){
    // 	setcookie('uname','',time()-3600,'/');
    // 	setcookie('cn','',time()-3600,'/');
    // 	setcookie('user_id','',time()-3600,'/');
    //     session_unset();
    //     session_destroy();
    //     //$this->success("退出成功",U('Home/Index/index'));
    //     header("location:".U('Home/Index/index'));
    //     exit;
    // }

    /*
     * 账户资金
     */
    public function account(){
        $user = session('user');
        //获取账户资金记录
        $logic = new UsersLogic();
        $data = $logic->get_account_log($this->user_id,I('get.type'));
        $account_log = $data['result'];

        $this->assign('user',$user);
        $this->assign('account_log',$account_log);
        $this->assign('page',$data['show']);
        $this->assign('active','account');
        $this->display();
    }
    /*
     * 优惠券列表
     */
    public function coupon(){
        $logic = new UsersLogic();
        $data = $logic->get_coupon($this->user_id,$_REQUEST['type']);
        $coupon_list = $data['result'];
        $this->assign('coupon_list',$coupon_list);
        $this->assign('page',$data['show']);
        $this->assign('active','coupon');
        $this->display();
    }
    /**
     *  登录
     */
    public function login(){
        if(IS_POST){
            $pwd=$_POST['pwd'];
            $phone=$_POST['phone'];
            if(empty($pwd)||empty($phone)){
                echo json_encode(array('status'=>0,'info'=>'请输入数据'));
                exit();
            }
            if(strlen($phone)!=11||!is_numeric($phone)){
                echo json_encode(array('status'=>0,'info'=>'手机号码错误'));
                exit();
            }

            $data['password']=md5($pwd);
            $data['mobile']=$phone;
            if($in=D('Users')->where($data)->find()){
                session('mobile',$phone);
                session('user_id',$in['user_id']);
                $url=U('Home/Index/index');
                 echo json_encode(array('status'=>1,'info'=>'登陆成功','url1'=>$url));
                 exit();
            }

            exit();
        }
        $this->display();
    }
    public function outlog(){
        session('mobile',null);
        $this->redirect('Home/Index/index');
    }
    public function register(){
        // if($this->user_id > 0){
        // 	header("Location: ".U('Home/User/index'));
        // }           
        // $referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U("Home/User/index");
        // $this->assign('referurl',$referurl);
        if(IS_POST){
            $username = $_POST['username'];
            $pwd = $_POST['pwd'];
            $pwd2 = $_POST['pwd2'];
            $phone = $_POST['phone'];
            if(empty($pwd)||empty($pwd2)||empty($phone)||empty($phone)||empty($username)){
                echo json_encode(array('status'=>0,'info'=>'请输入数据'));
                exit();
            }
            if(strlen($phone)!=11||!is_numeric($phone)){
                echo json_encode(array('status'=>0,'info'=>'手机号码错误'));
                exit();
            }
            $ishas=D('Users')->where(array('mobile'=>$phone))->find();
            if(!empty($ishas)){
                echo json_encode(array('status'=>0,'info'=>'手机号码已被注册'));
                exit();
            }
            if($pwd2!=$pwd){
                echo json_encode(array('status'=>0,'info'=>'密码错误'));
                exit();
            }
            $data['username']=$username;
            $data['password']=md5($pwd);
            $data['mobile']=$phone;
            if(D('Users')->add($data)){
                $url=U('Home/User/login');
                 echo json_encode(array('status'=>1,'info'=>'注册成功','url'=>$url));
                 exit();
            }

            exit();
        }
        $this->display();
    }

    public function pop_login(){
    	if($this->user_id > 0){
    		header("Location: ".U('Home/User/Index'));
    	}
        $referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U("Home/User/index");
        $this->assign('referurl',$referurl);
    	$this->display();
    }
    
    public function do_login(){
    	$username = I('post.username');
    	$password = I('post.password');
        $username = trim($username);
        $password = trim($password);        
    	$verify_code = I('post.verify_code');
     
        $verify = new Verify();
        if (!$verify->check($verify_code,'user_login'))
        {
             $res = array('status'=>0,'msg'=>'验证码错误');
             exit(json_encode($res));
        }
    	         
    	$logic = new UsersLogic();
    	$res = $logic->login($username,$password);        
        
    	if($res['status'] == 1){
    		$res['url'] =  urldecode(I('post.referurl'));
    		session('user',$res['result']);
    		setcookie('user_id',$res['result']['user_id'],null,'/');
    		setcookie('is_distribut',$res['result']['is_distribut'],null,'/');
    		$nickname = empty($res['result']['nickname']) ? $username : $res['result']['nickname'];
            setcookie('uname',urlencode($nickname),null,'/');
            setcookie('cn',0,time()-3600,'/');
    		$cartLogic = new \Home\Logic\CartLogic();
    		$cartLogic->login_cart_handle($this->session_id,$res['result']['user_id']);  //用户登录后 需要对购物车 一些操作
    	}
    	exit(json_encode($res));
    }
    /**
     *  注册
     */
    public function reg(){
    	if($this->user_id > 0) header("Location: ".U('Home/User/index'));
    	
        if(IS_POST){
            $logic = new UsersLogic();
            //验证码检验
            $this->verifyHandle('user_reg');
            $username = I('post.username','');
            $password = I('post.password','');
            $password2 = I('post.password2','');
            //是否开启注册验证码机制
            if(check_mobile($username) && tpCache('sms.regis_sms_enable')){
                $code = I('post.code','');
                if(!$code)
                    $this->error('请输入短信验证码');
                $check_code = $logic->sms_code_verify($username,$code,$this->session_id);
                if($check_code['status'] != 1)
                    $this->error($check_code['msg']);

            }
            $data = $logic->reg($username,$password,$password2);
            if($data['status'] != 1)
                $this->error($data['msg']);
            session('user',$data['result']);
    		setcookie('user_id',$data['result']['user_id'],null,'/');
    		setcookie('is_distribut',$data['result']['is_distribut'],null,'/');
            $nickname = empty($data['result']['nickname']) ? $username : $data['result']['nickname'];
            setcookie('uname',$nickname,null,'/');
            $cartLogic = new \Home\Logic\CartLogic();
            $cartLogic->login_cart_handle($this->session_id,$data['result']['user_id']);  //用户登录后 需要对购物车 一些操作
            
            $this->success($data['msg'],U('Home/User/index'));
            exit;
        }
        $this->assign('regis_sms_enable',tpCache('sms.regis_sms_enable')); // 注册启用短信：
        $sms_time_out = tpCache('sms.sms_time_out')>0 ? tpCache('sms.sms_time_out') : 120;
        $this->assign('sms_time_out', $sms_time_out); // 手机短信超时时间
        $this->display();
    }

    /*
     * 订单列表
     */
    public function order_list(){
        $where = ' user_id='.$this->user_id;
        //条件搜索
       if(I('get.type')){
           $where .= C(strtoupper(I('get.type')));
       }
       // 搜索订单 根据商品名称 或者 订单编号
       $search_key = trim(I('search_key'));       
       if($search_key)
       {
          $where .= " and (order_sn like '%$search_key%' or order_id in (select order_id from `".C('DB_PREFIX')."order_goods` where goods_name like '%$search_key%') ) ";
       }
       
        $count = M('order')->where($where)->count();
        $Page = new Page($count,10);

        $show = $Page->show();
        $order_str = "order_id DESC";
        $order_list = M('order')->order($order_str)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();

        //获取订单商品
        $model = new UsersLogic();
        foreach($order_list as $k=>$v)
        {
            $order_list[$k] = set_btn_order_status($v);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
            //$order_list[$k]['total_fee'] = $v['goods_amount'] + $v['shipping_fee'] - $v['integral_money'] -$v['bonus'] - $v['discount']; //订单总额
            $data = $model->get_order_goods($v['order_id']);
            $order_list[$k]['goods_list'] = $data['result'];            
        }
        $this->assign('order_status',C('ORDER_STATUS'));
        $this->assign('shipping_status',C('SHIPPING_STATUS'));
        $this->assign('pay_status',C('PAY_STATUS'));
        $this->assign('page',$show);
        $this->assign('lists',$order_list);
        $this->assign('active','order_list');
        $this->assign('active_status',I('get.type'));
        $this->display();
    }

    /*
     * 订单详情
     */
    public function order_detail(){
        $id = I('get.id');

        $map['order_id'] = $id;
        $map['user_id'] = $this->user_id;
        $order_info = M('order')->where($map)->find();
        $order_info = set_btn_order_status($order_info);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
        
        if(!$order_info){
            $this->error('没有获取到订单信息');
            exit;
        }
        //获取订单商品
        $model = new UsersLogic();
        $data = $model->get_order_goods($order_info['order_id']);
        $order_info['goods_list'] = $data['result'];
        //$order_info['total_fee'] = $order_info['goods_price'] + $order_info['shipping_price'] - $order_info['integral_money'] -$order_info['coupon_price'] - $order_info['discount'];
        //获取订单进度条
        $sql = "SELECT action_id,log_time,status_desc,order_status FROM ((SELECT * FROM __PREFIX__order_action WHERE order_id = $id AND status_desc <>'' ORDER BY action_id) AS a) GROUP BY status_desc ORDER BY action_id";
        $items = M()->query($sql);
        $items_count = count($items);
        $region_list = get_region_list();
        
        $invoice_no = M('DeliveryDoc')->where("order_id = $id")->getField('invoice_no',true);
        $order_info[invoice_no] = implode(' , ', $invoice_no);
        //获取订单操作记录
        $order_action = M('order_action')->where(array('order_id'=>$id))->select();
        if($order_info['shipping_status'] == 1){
        	$express = queryExpress($order_info['shipping_code'],$order_info['invoice_no']);
        	$this->assign('express',$express);
        }
        $this->assign('order_status',C('ORDER_STATUS'));
        $this->assign('shipping_status',C('SHIPPING_STATUS'));
        $this->assign('pay_status',C('PAY_STATUS'));
        $this->assign('region_list',$region_list);
        $this->assign('order_info',$order_info);
        $this->assign('order_action',$order_action);
        $this->assign('active','order_list');
        $this->display();
    }

    /*
     * 取消订单
     */
    public function cancel_order(){
        $id = I('get.id');
        //检查是否有积分，余额支付
        $logic = new UsersLogic();
        $data = $logic->cancel_order($this->user_id,$id);
        if($data['status'] < 0)
            $this->error($data['msg']);
        $this->success($data['msg']);
    }

    /*
     * 用户地址列表
     */
    public function address_list(){
        $address_lists = get_user_address_list($this->user_id);
        $region_list = get_region_list();
        $this->assign('region_list',$region_list);
        $this->assign('lists',$address_lists);
        $this->assign('active','address_list');

        $this->display();
    }
    /*
     * 添加地址
     */
    public function add_address(){
        header("Content-type:text/html;charset=utf-8");
        if(IS_POST){
            $logic = new UsersLogic();
            $data = $logic->add_address($this->user_id,0,I('post.'));
            if($data['status'] != 1)
                exit('<script>alert("'.$data['msg'].'");history.go(-1);</script>');
            $call_back = $_REQUEST['call_back'];
            echo "<script>parent.{$call_back}('success');</script>";
            exit(); // 成功 回调closeWindow方法 并返回新增的id
        }
        $p = M('region')->where(array('parent_id'=>0,'level'=> 1))->select();
        $this->assign('province',$p);
        $this->display('edit_address');

    }

    /*
     * 地址编辑
     */
    public function edit_address(){
        header("Content-type:text/html;charset=utf-8");
        $id = I('get.id');
        $address = M('user_address')->where(array('address_id'=>$id,'user_id'=> $this->user_id))->find();
        if(IS_POST){
            $logic = new UsersLogic();
            $data = $logic->add_address($this->user_id,$id,I('post.'));
            if($data['status'] != 1)
                exit('<script>alert("'.$data['msg'].'");history.go(-1);</script>');

            $call_back = $_REQUEST['call_back'];
            echo "<script>parent.{$call_back}('success');</script>";
            exit(); // 成功 回调closeWindow方法 并返回新增的id
        }
        //获取省份
        $p = M('region')->where(array('parent_id'=>0,'level'=> 1))->select();
        $c = M('region')->where(array('parent_id'=>$address['province'],'level'=> 2))->select();
        $d = M('region')->where(array('parent_id'=>$address['city'],'level'=> 3))->select();
        if($address['twon']){
        	$e = M('region')->where(array('parent_id'=>$address['district'],'level'=>4))->select();
        	$this->assign('twon',$e);
        }

        $this->assign('province',$p);
        $this->assign('city',$c);
        $this->assign('district',$d);
        $this->assign('address',$address);
        $this->display();
    }

    /*
     * 设置默认收货地址
     */
    public function set_default(){
        $id = I('get.id');
        M('user_address')->where(array('user_id'=>$this->user_id))->save(array('is_default'=>0));
        $row = M('user_address')->where(array('user_id'=>$this->user_id,'address_id'=>$id))->save(array('is_default'=>1));
        if(!$row)
            $this->error('操作失败');
        $this->success("操作成功");
    }
    
    /*
     * 地址删除
     */
    public function del_address(){
        $id = I('get.id');
        
        $address = M('user_address')->where("address_id = $id")->find();
        $row = M('user_address')->where(array('user_id'=>$this->user_id,'address_id'=>$id))->delete();                
        // 如果删除的是默认收货地址 则要把第一个地址设置为默认收货地址
        if($address['is_default'] == 1)
        {
            $address2 = M('user_address')->where("user_id = {$this->user_id}")->find();            
            $address2 && M('user_address')->where("address_id = {$address2['address_id']}")->save(array('is_default'=>1));
        }        
        if(!$row)
            $this->error('操作失败',U('User/address_list'));
        else
            $this->success("操作成功",U('User/address_list'));
    }


    public function save_pickup()
    {
        $post = I('post.');
        if (empty($post['consignee'])) {
            return array('status' => -1, 'msg' => '收货人不能为空', 'result' => '');
        }
        if (!$post['province'] || !$post['city'] || !$post['district']) {
            return array('status' => -1, 'msg' => '所在地区不能为空', 'result' => '');
        }
        if(!check_mobile($post['mobile'])){
            return array('status'=>-1,'msg'=>'手机号码格式有误','result'=>'');
        }
        if(!$post['pickup_id']){
            return array('status'=>-1,'msg'=>'请选择自提点','result'=>'');
        }

        $user_logic = new UsersLogic();
        $res = $user_logic->add_pick_up($this->user_id, $post);
        if($res['status'] != 1){
            exit('<script>alert("'.$res['msg'].'");history.go(-1);</script>');
        }
        $call_back = $_REQUEST['call_back'];
        echo "<script>parent.{$call_back}({$post['province']},{$post['city']},{$post['district']});</script>";
        exit(); // 成功 回调closeWindow方法 并返回新增的id
    }
        
    /*
     * 评论晒单
     */
    public function comment(){
        $user_id = $this->user_id;
        $status = I('get.status',-1);
        $logic = new UsersLogic();
        $data = $logic->get_comment($user_id,$status); //获取评论列表
        $this->assign('page',$data['show']);// 赋值分页输出
        $this->assign('comment_list',$data['result']);
        $this->assign('active','comment');
        $this->display();
    }

    /*
     *添加评论
     */
    public function add_comment()
    {          
            $user_info = session('user');
            $comment_img = serialize(I('comment_img')); // 上传的图片文件            
            $add['goods_id'] = I('goods_id');
            $add['email'] = $user_info['email'];
            //$add['nick'] = $user_info['nickname'];
            $add['username'] = $user_info['nickname'];
            $add['order_id'] = I('order_id');
            $add['service_rank'] = I('service_rank');
            $add['deliver_rank'] = I('deliver_rank');
            $add['goods_rank'] = I('goods_rank');
            //$add['content'] = htmlspecialchars(I('post.content'));
            $add['content'] = I('content');
            $add['img'] = $comment_img;
            $add['add_time'] = time();
            $add['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $add['user_id'] = $this->user_id;
            $logic = new UsersLogic();
            //添加评论
            $row = $logic->add_comment($add);            
            exit(json_encode($row));        
    }

    /*
     * 个人信息
     */
    public function info(){
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        if(IS_POST){
            I('post.nickname') ? $post['nickname'] = I('post.nickname') : false; //昵称
            I('post.qq') ? $post['qq'] = I('post.qq') : false;  //QQ号码
            I('post.head_pic') ? $post['head_pic'] = I('post.head_pic') : false; //头像地址
            I('post.sex') ? $post['sex'] = I('post.sex') : false;  // 性别
            I('post.birthday') ? $post['birthday'] = strtotime(I('post.birthday')) : false;  // 生日
            I('post.province') ? $post['province'] = I('post.province') : false;  //省份
            I('post.city') ? $post['city'] = I('post.city') : false;  // 城市
            I('post.district') ? $post['district'] = I('post.district') : false;  //地区
            if(!$userLogic->update_info($this->user_id,$post))
                $this->error("保存失败");
            $this->success("操作成功");
            exit;
        }
        //  获取省份
        $province = M('region')->where(array('parent_id'=>0,'level'=>1))->select();
        //  获取订单城市
        $city =  M('region')->where(array('parent_id'=>$user_info['province'],'level'=>2))->select();
        //获取订单地区
        $area =  M('region')->where(array('parent_id'=>$user_info['city'],'level'=>3))->select();

        $this->assign('province',$province);
        $this->assign('city',$city);
        $this->assign('area',$area);
        $this->assign('user',$user_info);
        $this->assign('sex',C('SEX'));
        $this->assign('active','info');
        $this->display();
    }

    /*
     * 邮箱验证
     */
    public function email_validate(){
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        $step = I('get.step',1);
        if(IS_POST){
            $email = I('post.email');
            $old_email = I('post.old_email',''); //旧邮箱
            $code = I('post.code');
            $info = session('validate_code');
            if(!$info)
                $this->error('非法操作');
            if($info['time']<time()){
            	session('validate_code',null);
            	$this->error('验证超时，请重新验证');
            }
            //检查原邮箱是否正确
            if($user_info['email_validated'] == 1 && $old_email != $user_info['email'])
                $this->error('原邮箱匹配错误');
            //验证邮箱和验证码
            if($info['sender'] == $email && $info['code'] == $code){
                session('validate_code',null);
                if(!$userLogic->update_email_mobile($email,$this->user_id))
                    $this->error('邮箱已存在');
                $this->success('绑定成功',U('Home/User/index'));
                exit;
            }
            $this->error('邮箱验证码不匹配');
        }
        $this->assign('user_info',$user_info);
        $this->assign('step',$step);
        $this->display();
    }


    /*
    * 手机验证
    */
    public function mobile_validate(){
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); //获取用户信息
        $user_info = $user_info['result'];
        $config = F('sms','',TEMP_PATH);
        $sms_time_out = $config['sms_time_out'];
        $step = I('get.step',1);
        if(IS_POST){
            $mobile = I('post.mobile');
            $old_mobile = I('post.old_mobile','');
            $code = I('post.code');
            $info = session('validate_code');
            if(!$info)
                $this->error('非法操作');
            if($info['time']<time()){
            	session('validate_code',null);
            	$this->error('验证超时，请重新验证');
            }
            //检查原手机是否正确
            if($user_info['mobile_validated'] == 1 && $old_mobile != $user_info['mobile'])
                $this->error('原手机号码错误');
            //验证手机和验证码
            if($info['sender'] == $mobile && $info['code'] == $code){
                session('validate_code',null);
                //验证有效期
                if($info['time'] < time())
                    $this->error('验证码已失效');
                if(!$userLogic->update_email_mobile($mobile,$this->user_id,2))
                    $this->error('手机已存在');
                $this->success('绑定成功',U('Home/User/index'));
                exit;
            }
            $this->error('手机验证码不匹配');
        }
        $this->assign('user_info',$user_info);
        $this->assign('time',$sms_time_out);
        $this->assign('step',$step);
        $this->display();
    }
    
    /**
     * 发送手机注册验证码
     */
    public function send_sms_reg_code(){
        $mobile = I('mobile');
        $userLogic = new UsersLogic();
        if(!check_mobile($mobile))
            exit(json_encode(array('status'=>-1,'msg'=>'手机号码格式有误')));
        $code =  rand(1000,9999);
        $send = $userLogic->sms_log($mobile,$code,$this->session_id);
        if($send['status'] != 1)
            exit(json_encode(array('status'=>-1,'msg'=>$send['msg'])));
        exit(json_encode(array('status'=>1,'msg'=>'验证码已发送，请注意查收')));
    }
    /*
     *商品收藏
     */
    public function goods_collect(){
        $userLogic = new UsersLogic();
        $data = $userLogic->get_goods_collect($this->user_id);
        $this->assign('page',$data['show']);// 赋值分页输出
        $this->assign('lists',$data['result']);
        $this->assign('active','goods_collect');
        $this->display();
    }

    /*
     * 删除一个收藏商品
     */
    public function del_goods_collect(){
        $id = I('get.id');
        if(!$id)
            $this->error("缺少ID参数");
        $row = M('goods_collect')->where(array('collect_id'=>$id,'user_id'=>$this->user_id))->delete();
        if(!$row)
            $this->error("删除失败");
        $this->success('删除成功');
    }

    /*
     * 密码修改
     */
    public function password(){
        //检查是否第三方登录用户
        $logic = new UsersLogic();
        $data = $logic->get_info($this->user_id);
        $user = $data['result'];
        if($user['mobile'] == ''&& $user['email'] == '')
            $this->error('请先绑定手机或邮箱',U('Home/User/info'));
        if(IS_POST){
            $userLogic = new UsersLogic();
            $data = $userLogic->password($this->user_id,I('post.old_password'),I('post.new_password'),I('post.confirm_password')); // 获取用户信息
            if($data['status'] == -1)
                $this->error($data['msg']);
            $this->success($data['msg']);
            exit;
        }
        $this->display();
    }

    public function forget_pwd(){
    	if($this->user_id > 0){
    		header("Location: ".U('Home/User/Index'));
    	}
    	if(IS_POST){
    		$logic = new UsersLogic();
    		$username = I('post.username');
    		$code = I('post.code');
    		$new_password = I('post.new_password');
    		$confirm_password = I('post.confirm_password');
    		$pass = false;
    	
    		//检查是否手机找回
    		if(check_mobile($username)){
    			if(!$user = get_user_info($username,2))
    				$this->error('账号不存在');
    			$check_code = $logic->sms_code_verify($username,$code,$this->session_id);
    			if($check_code['status'] != 1)
    				$this->error($check_code['msg']);
    			$pass = true;
    		}
    		//检查是否邮箱
    		if(check_email($username)){
    			if(!$user = get_user_info($username,1))
    				$this->error('账号不存在');
    			$check = session('forget_code');
    			if(empty($check))
    				$this->error('非法操作');
    			if(!$username || !$code || $check['email'] != $username || $check['code'] != $code)
    				$this->error('邮箱验证码不匹配');
    			$pass = true;
    		}
    		if($user['user_id'] > 0 && $pass)
    			$data = $logic->password($user['user_id'],'',$new_password,$confirm_password,false); // 获取用户信息
    		if($data['status'] != 1)
    			$this->error($data['msg'] ? $data['msg'] :  '操作失败');
    		$this->success($data['msg'],U('Home/User/login'));
    		exit;
    	}
        $this->display();
    }
    
    public function set_pwd(){
    	if($this->user_id > 0){
    		header("Location: ".U('Home/User/Index'));
    	}
    	$check = session('validate_code');
    	if(empty($check)){
    		header("Location:".U('Home/User/forget_pwd'));
    	}elseif($check['is_check']==0){
    		$this->error('验证码还未验证通过',U('Home/User/forget_pwd'));
    	}    	
    	if(IS_POST){
    		$password = I('post.password');
    		$password2 = I('post.password2');
    		if($password2 != $password){
    			$this->error('两次密码不一致',U('Home/User/forget_pwd'));
    		}  		
    		if($check['is_check']==1){
    			//$user = get_user_info($check['sender'],1);
                $user = M('users')->where("mobile = '{$check['sender']}' or email = '{$check['sender']}'")->find();
    			M('users')->where("user_id=".$user['user_id'])->save(array('password'=>encrypt($password)));
    			session('validate_code',null);
    			header("Location:".U('Home/User/finished'));
    		}else{
    			$this->error('验证码还未验证通过',U('Home/User/forget_pwd'));
    		}
    	}
    	$this->display();
    }
    
    public function finished(){
    	if($this->user_id > 0){
    		header("Location: ".U('Home/User/Index'));
    	}
    	$this->display();
    }   
    
    public function check_captcha(){
    	$verify = new Verify();
    	$type = I('post.type','user_login');
    	if (!$verify->check(I('post.verify_code'), $type)) {
    		exit(json_encode(0));
    	}else{
    		exit(json_encode(1));
    	}
    }
    
    public function check_username(){
    	$username = I('post.username');
    	if(!empty($username)){
    		$count = M('users')->where("email='$username' or mobile='$username'")->count();
    		exit(json_encode(intval($count)));
    	}else{
    		exit(json_encode(0));
    	}  	
    }
    
    public function identity(){
    	if($this->user_id > 0){
    		header("Location: ".U('Home/User/Index'));
    	}
    	$username = I('post.username');
    	$userinfo = array();
    	if($username){
    		$userinfo = M('users')->where("email='$username' or mobile='$username'")->find();
    		$userinfo['username'] = $username;
    		session('userinfo',$userinfo);
    	}else{
    		$this->error('参数有误！！！');
    	} 	
    	if(empty($userinfo)){
    		$this->error('非法请求！！！');
    	}
    	unset($user_info['password']);
    	$this->assign('userinfo',$userinfo);
    	$this->display();
    }
    
    //发送验证码
    public function send_validate_code(){
    	$type = I('type');
    	$send = I('send');
    	$logic = new UsersLogic();
    	$logic->send_validate_code($send, $type);
    }
    
    public function check_validate_code(){
    	$code = I('post.code');
    	$send = I('send');
    	$logic = new UsersLogic();
    	$logic->check_validate_code($code, $send);
    }
    
    /**
     * 验证码验证
     * $id 验证码标示
     */
    private function verifyHandle($id)
    {
        $verify = new Verify();
        if (!$verify->check(I('post.verify_code'), $id ? $id : 'user_login')) {
            $this->error("验证码错误");
        }
    }

    /**
     * 验证码获取
     */
    public function verify()
    {
        //验证码类型
        $type = I('get.type') ? I('get.type') : 'user_login';
        $config = array(
            'fontSize' => 40,
            'length' => 4,
            'useCurve' => true,
            'useNoise' => false,
        );
        $Verify = new Verify($config);
        $Verify->entry($type);
    }

    public function order_confirm(){
        $id = I('get.id',0);
                                  
        $data = confirm_order($id,$this->user_id);
        if(!$data['status'])
            $this->error($data['msg']);
	else	
	   $this->success($data['msg']);
    }
    /**
     * 申请退货
     */
    public function return_goods()
    {
        $order_id = I('order_id',0);
        $order_sn = I('order_sn',0);
        $goods_id = I('goods_id',0);        
	$spec_key = I('spec_key');        
        
        $c = M('order')->where("order_id = $order_id and user_id = {$this->user_id}")->count();
        if($c == 0)
        {
            $this->error('非法操作');
            exit;
        }         
        
        $return_goods = M('return_goods')->where("order_id = $order_id and goods_id = $goods_id and spec_key = '$spec_key'")->find();            
        if(!empty($return_goods))
        {
            $this->success('已经提交过退货申请!',U('Home/User/return_goods_info',array('id'=>$return_goods['id'])));
            exit;
        }       
        if(IS_POST)
        {
            $data['order_id'] = $order_id; 
            $data['order_sn'] = $order_sn; 
            $data['goods_id'] = $goods_id; 
            $data['addtime'] = time(); 
            $data['user_id'] = $this->user_id;            
            $data['type'] = I('type'); // 服务类型  退货 或者 换货
            $data['reason'] = I('reason'); // 问题描述
            $data['imgs'] = I('imgs'); // 用户拍照的相片
            $data['spec_key'] = I('spec_key'); // 商品规格			
            M('return_goods')->add($data);            
            $this->success('申请成功,客服第一时间会帮你处理',U('Home/User/order_list'));
            exit;
        }
               
        $goods = M('goods')->where("goods_id = $goods_id")->find();        
        $this->assign('goods',$goods);
        $this->assign('order_id',$order_id);
        $this->assign('order_sn',$order_sn);
        $this->assign('goods_id',$goods_id);
        $this->display();
    }
    
    /**
     * 退换货列表
     */
    public function return_goods_list()
    {        
        $count = M('return_goods')->where("user_id = {$this->user_id}")->count();
        $page = new Page($count,10);
        $list = M('return_goods')->where("user_id = {$this->user_id}")->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();
        $goods_id_arr = get_arr_column($list, 'goods_id');
        if(!empty($goods_id_arr))
            $goodsList = M('goods')->where("goods_id in (".  implode(',',$goods_id_arr).")")->getField('goods_id,goods_name');        
        $this->assign('goodsList', $goodsList);
        $this->assign('list', $list);
        $this->assign('page', $page->show());// 赋值分页输出
        $this->display();
    }
    
    /**
     *  退货详情
     */
    public function return_goods_info()
    {
        $id = I('id',0);
        $return_goods = M('return_goods')->where("id = $id")->find();
        if($return_goods['imgs'])
            $return_goods['imgs'] = explode(',', $return_goods['imgs']);        
        $goods = M('goods')->where("goods_id = {$return_goods['goods_id']} ")->find();                
        $this->assign('goods',$goods);
        $this->assign('return_goods',$return_goods);
        $this->display();
    }
    
    /**
     * 安全设置
     */
    public function safety_settings()
    {
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];        
        $this->assign('user',$user_info);
        $this->display();      
    }
    
    /**
     * 申请提现记录
     */
    public function withdrawals(){
        
    	//C('TOKEN_ON',true);
    	if(IS_POST)
    	{
            $this->verifyHandle('withdrawals');                
    		$data = I('post.');
    		$data['user_id'] = $this->user_id;    		    		
    		$data['create_time'] = time();                
                $distribut_min = tpCache('distribut.min'); // 最少提现额度
                if($data['money'] < $distribut_min)
                {
                        $this->error('每次最少提现额度'.$distribut_min);
                        exit;
                }
                if($data['money'] > $this->user['user_money'])
                {
                        $this->error("你最多可提现{$this->user['user_money']}账户余额.");
                        exit;
                }     
                 
    		if(M('withdrawals')->add($data)){
    			$this->success("已提交申请");
                        exit;
    		}else{
    			$this->error('提交失败,联系客服!');
                        exit;
    		}
    	}
        
        $where = " user_id = {$this->user_id}";        
        $count = M('withdrawals')->where($where)->count();
        $page = new Page($count,10);
        $show = $page->show();
        $list = M('withdrawals')->where($where)->limit("{$page->firstRow},{$page->listRows}")->select();   
        $this->assign('show',$show);// 赋值分页输出
        $this->assign('list',$list); // 下线      
        $this->display(); 
    }
    
   public  function recharge(){
   		if(IS_POST){
   			$user = session('user');
   			$data['user_id'] = $this->user_id;
   			$data['nickname'] = $user['nickname'];
   			$data['account'] = I('account');
   			$data['order_sn'] = 'recharge'.get_rand_str(6,1);
   			$data['ctime'] = time();
   			$order_id = M('recharge')->add($data);
   			if($order_id){
   				$url = U('Payment/getPay',array('pay_radio'=>$_REQUEST['pay_radio'],'order_id'=>$order_id));
   				redirect($url);
   			}else{
   				$this->error('提交失败,参数有误!');
   			}
   		}
   		
	   	$paymentList = M('Plugin')->where("`type`='payment' and status = 1 and  scene in(0,2)")->select();
	   	$paymentList = convert_arr_key($paymentList, 'code');	   	
	   	foreach($paymentList as $key => $val)
	   	{
	   		$val['config_value'] = unserialize($val['config_value']);
	   		if($val['config_value']['is_bank'] == 2)
	   		{
	   			$bankCodeList[$val['code']] = unserialize($val['bank_code']);
	   		}
	   	}
	   	$bank_img = include 'Application/Home/Conf/bank.php'; // 银行对应图片
	   	$this->assign('paymentList',$paymentList);
	   	$this->assign('bank_img',$bank_img);
	   	$this->assign('bankCodeList',$bankCodeList);
	   	
	   	$count = M('recharge')->where(array('user_id'=>$this->user_id))->count();
	   	$Page = new Page($count,10);
	   	$show = $Page->show();
	   	$recharge_list = M('recharge')->where(array('user_id'=>$this->user_id))->limit($Page->firstRow.','.$Page->listRows)->select();
	   	$this->assign('page',$show);
	   	$this->assign('recharge_list',$recharge_list);//充值记录
	   	
	   	$count2 = M('account_log')->where(array('user_id'=>$this->user_id,'user_money'=>array('gt',0)))->count();
	   	$Page2 = new Page($count2,10);
	   	$consume_list = M('account_log')->where(array('user_id'=>$this->user_id,'user_money'=>array('gt',0)))->limit($Page2->firstRow.','.$Page2->listRows)->select();
	   	$this->assign('consume_list',$consume_list);//消费记录
	   	$this->assign('page2',$Page2->show());
   		$this->display();
   } 

    /**
     *  用户消息通知
     * @author dyr
     * @time 2016/09/01
     */
    public function message_notice()
    {
        $this->display();
    }
    /**
     * ajax用户消息通知请求
     * @author dyr
     * @time 2016/09/01
     */
    public function ajax_message_notice()
    {
        $type = I('type',0);
        $user_logic = new UsersLogic();
        if ($type == 1) {
            //系统消息
            $user_sys_message = D('Message')->getUserMessageNotice();
            $user_logic->setSysMessageForRead();
        } else if ($type == 2) {
            //活动消息：后续开发
            $user_sys_message = array();
        } else {
            //全部消息：后续完善
            $user_sys_message = D('Message')->getUserMessageNotice();
        }
        $this->assign('messages', $user_sys_message);
        $this->display();
    }

}
<?php


namespace Admin\Controller;

class AdController extends BaseController{
    public function ad(){       

        $this->display();
    }
    
    public function adList(){
        
    delFile(RUNTIME_PATH.'Html'); // 先清除缓存, 否则不好预览
            
        $Ad =  M('ad'); 

        $data=$Ad->select();
       // $this->assign('act',$_GET['act']);
        $this->assign('list',$data);

        $this->display();
    }

    //添加公告
    public function adHandle(){
    	$data = $_POST;
    	$data['start_time'] = 1;
    	$data['end_time'] = 1;
    	//act是什么等
    	if($data['act'] == 'add'){
    	$r = D('ad')->add($data);
    	}
    	if($data['act'] == 'edit'){
    		$r = D('ad')->where(array('ad'=>$_GET['ad_id']))->save($data);
    	}
    	
    	if($data['act'] == 'del'){
    		$r = D('ad')->delete($data['del_id']);
    		if($r) exit(json_encode(1));
    	}
    	$referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U('Admin/Ad/adList');
        // 不管是添加还是修改广告 都清除一下缓存
        delFile(RUNTIME_PATH.'Html'); // 先清除缓存, 否则不好预览
        
    	if($r){
    		$this->success("操作成功",U('Admin/Ad/adList'));
    	}else{
    		$this->error("操作失败",$referurl);
    	}
    }
    public function adedit(){

        $editdata=D('Ad')->where(array('ad_id'=>$_GET['ad_id']))->find();
        $this->assign('editdata',$editdata);
        $this->assign('show','edit');
        $this->display('ad');
    }

}
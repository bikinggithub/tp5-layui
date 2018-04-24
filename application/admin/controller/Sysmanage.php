<?php
namespace app\admin\controller;

class Sysmanage extends Base
{
	public function __construct(){
		parent::__construct();
	}

	//系统变量列表
    public function index()
    {

    	$pagenum = config('paginate')['list_rows'];

    	$name = request()->get('name');
    	$status = request()->get('status');
    	$where = array();

    	if(!empty($name)){
			$where['name'] = array('like','%'.$name.'%');
    	}

    	if(!empty($status)){
			$where['status'] = array('eq',$status);
    	}

		$data = model('SysConfig')->getListPageData('*',$where,'id desc',$pagenum);
		//echo '<pre/>';var_dump($data);die();

		if($data){
			// 模板变量赋值
			$this->assignSysTips();//显示系统提示
			$this->assign('list', $data['list']['data']);
			$this->assign('page', $data['page']);
		}
        return view();
    }

    //新增
    public function add(){
    	if(request()->isPost()){
            //var_dump($_POST);die();
            unset($_POST['file']);

    		$vcode = $_POST['v_code'];
    		$tmpd = model('SysConfig')->getListData('*',array('v_code'=>array('eq',trim($vcode))),'id desc',1);
    		if($tmpd){
                echo json_encode(array('code'=>101,'msg'=>'该变量已经存在'));exit();
    		}

			$_POST['create_at'] = date('Y-m-d H:i:s');
			$res = model('SysConfig')->data($_POST)->save();
			
			if($res){
				$this->setSysTips(1,'新增成功');
                echo json_encode(array('code'=>200,'msg'=>'success'));exit();
			}else{
				$this->setSysTips(2,'新增失败');
                echo json_encode(array('code'=>100,'msg'=>'新增失败'));exit();
			}
    	}
    	return view('add');
    }

    //用户编辑
    public function edit(){

    	if(request()->isPost()){
    		//判断用户是否存在
    		$edituid = $_POST['edituid'];

    		unset($_POST['edituid']);

    		unset($_POST['file']);
    		
			$res = model('SysConfig')->save($_POST,array('id'=>array('eq',$edituid)));
			
			if($res){
				$this->setSysTips(1,'编辑成功');
                echo json_encode(array('code'=>200,'msg'=>'编辑成功'));exit();
			}else{
				$this->setSysTips(2,'编辑失败');
                echo json_encode(array('code'=>100,'msg'=>'编辑失败'));exit();
			}


    	}


    	$uid = request()->param('uid');
    	if(empty($uid)){
    		echo '参数丢失了';exit();
    	}

    	$ud = model('SysConfig')->getListData('*',array('id'=>array('eq',trim($uid))),'id desc',1);
		if($ud){
			$this->assign('datainfo',$ud);			
		}else{
			echo '数据丢失了';exit();
		}

    	return view('edit');
    }

    //用户删除
    public function delete(){
    	//判断是否包含admin
    	$delidstr = request()->param('idstr');
    	if($delidstr){
    		$tmpd= explode(',', $delidstr);
			$delres = model('SysConfig')->destroy($delidstr);	
			if($delres){
				$this->setSysTips(1,'删除成功');
			}else{
				$this->setSysTips(2,'删除失败');	
			}
    	}
    }

}


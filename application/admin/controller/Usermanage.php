<?php
namespace app\admin\controller;

class Usermanage extends Base
{
	public function __construct(){
		parent::__construct();
	}

	//用户列表
    public function userlist()
    {
    	// 查询状态为1的用户数据 并且每页显示10条数据
    	$pagenum = config('paginate')['list_rows'];

    	$account = request()->get('account');
    	$status = request()->get('status');
    	$where = array();

    	if(!empty($account)){
			$where['account'] = array('like','%'.$account.'%');
    	}

    	if(!empty($status)){
			$where['status'] = array('eq',$status);
    	}

		$data = model('Users')->getListPageData('*',$where,'id desc',$pagenum);
		//echo '<pre/>';var_dump($data);die();

		if($data){
			// 模板变量赋值
			$this->assignSysTips();//显示系统提示
			$this->assign('list', $data['list']['data']);
			$this->assign('page', $data['page']);
		}
        return view('userlist');
    }

    //用户新增
    public function add(){
    	if(request()->isPost()){
    		//判断用户是否存在
    		$account = $_POST['account'];
    		$ud = model('Users')->getListData('*',array('account'=>array('eq',trim($account))),'id desc',1);
    		if($ud){
    			//用户已经存在
    			$this->error('该用户已经存在');exit();
    		}

    		unset($_POST['file']);
    		$_POST['nickname'] = empty($_POST['nickname'])?$_POST['account']:$_POST['nickname'];
    		$_POST['head_img'] = empty($_POST['head_img'])?config('domname').DS.'static'.DS.'admin'.DS.'images'.DS.'headimg.jpg':$_POST['head_img'];
			$_POST['create_at'] = date('Y-m-d H:i:s');
    		$_POST['password'] = md5('sys'.$_POST['password']);
			$res = model('Users')->data($_POST)->save();
			
			if($res){
				$this->setSysTips(1,'新增成功');
				//$this->success('新增成功',url('admin/Usermanage/userlist'));exit();
			}else{
				$this->setSysTips(2,'新增失败');
				// $this->error('新增失败');exit();
			}
    	}
    	return view('add');
    }

    //用户编辑
    public function edit(){

    	if(request()->isPost()){
    		//判断用户是否存在
    		$edituid = $_POST['edituid'];
            if($edituid == 1){
                $this->setSysTips(2,'管理员账号不可编辑');exit();
            }

    		unset($_POST['edituid']);
    		$ud = model('Users')->getListData('*',array('id'=>array('eq',trim($edituid))),'id desc',1);
    		if(empty($ud)){
    			//用户不存在
    			$this->redirect(url('admin/Usermanage/userlist'));exit();
    		}

    		unset($_POST['file']);
    		$_POST['nickname'] = empty($_POST['nickname'])?$_POST['account']:$_POST['nickname'];
    		if(empty($_POST['head_img'])){
    			unset($_POST['file']);
    		}

			$_POST['update_at'] = date('Y-m-d H:i:s');

			if(empty($_POST['password'])){
				unset($_POST['password']);
			}else{
				$_POST['password'] = md5('sys'.$_POST['password']);
			}
    		

			$res = model('Users')->save($_POST,array('id'=>array('eq',$edituid)));
			
			if($res){
				$this->setSysTips(1,'编辑成功');
				// $this->success('编辑成功',url('admin/Usermanage/userlist'));exit();
			}else{
				$this->setSysTips(2,'编辑失败');
				// $this->error('编辑失败');exit();
			}
    	}


    	$uid = request()->param('uid');
    	if(empty($uid)){
    		echo '用户参数丢失了';exit();
    	}

    	$ud = model('Users')->getListData('*',array('id'=>array('eq',trim($uid))),'id desc',1);
		if($ud){
			$this->assign('userinfo',$ud);			
		}else{
			echo '用户数据丢失了';exit();
		}

    	return view('edit');
    }

    //用户删除
    public function delete(){
    	//判断是否包含admin
    	$delidstr = request()->param('idstr');
    	if($delidstr){
    		 $tmpd= explode(',', $delidstr);
    		if(!in_array(1, $tmpd)){
				$delres = model('Users')->destroy($delidstr);	
				if($delres){
					$this->setSysTips(1,'删除成功');
				}else{
					$this->setSysTips(2,'删除失败');	
				}
    		}
    	}
    }

}


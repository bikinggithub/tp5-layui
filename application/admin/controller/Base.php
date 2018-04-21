<?php
namespace app\admin\controller;
use \think\Controller;
class Base extends controller
{
    public function __construct(){
    	parent::__construct();

		$request = request();
		$modulename = $request->module();
		$controlname = $request->controller();
		$actname = $request->action();

		$linkurl = '/'.$modulename.'/'.$controlname.'/'.$actname;//请求的url地址

		//获取一级菜单
		$headmenuesw = array(
			'pid'=>0,
			'is_show'=>array('eq',1),
			'menues_status'=>array('eq',1)	
		);
		$headmenues = model('Menues')->getListData('*',$headmenuesw,'sortnum desc');
		//echo '<pre/>';var_dump($headmenues);die();

		//获取当前所在的首级菜单
		$headmenuesid = $this->getHeandMenuesId($linkurl);
		//echo $headmenuesid;die();

		//向模板传递参数
		if($headmenues && $headmenuesid){
			//根据首级菜单，获取左侧二级，三级菜单
			$subdataarr = array();
			$submenues = $this->getSubMenues($headmenuesid,$subdataarr);
			//echo '<pre/>';var_dump($submenues);die();

			$this->assign('headmenues',$headmenues);
			if($submenues){
				$this->assign('submenues',$submenues);
			}else{
				$this->assign('submenues',array());
			}

			//系统用户
			$sysuser = array(
				'username' => 'hello world',
			);

			$this->assign('sysuser',$sysuser);

			//当前菜单等级
			$tmpmunueinfo = model('Menues')->getListData('gradenum,markid',array('link_Url'=>array('eq',$linkurl),'gradenum'=>array('gt',1)),'sortnum desc',1);

			if($tmpmunueinfo){
				$this->assign('gradenum',$tmpmunueinfo['gradenum']);
				$this->assign('markid',$tmpmunueinfo['markid']);
			}else{
				$this->assign('gradenum',0);
			}
			

		}else{//没有获取到首级菜单，跳转至登录页TODO

		}
		

    }

    //获取首级菜单ID
    public function getHeandMenuesId($url){
    	$tmpd = model('Menues')->getListData('*',array('link_url'=>array('eq',$url)),'sortnum desc');
    	if($tmpd){
    		foreach($tmpd as $v){
				if($v['pid'] != '0'){
						continue;
	    		}else{
	    			return $v['id'];
	    		}
    		}
    		foreach($tmpd as $v){
    			$linkurlinfo = model('Menues')->getListData('*',array('id'=>array('eq',$v['pid'])),'sortnum desc',1);
				return $this->getHeandMenuesId($linkurlinfo['link_url']);
    		}
    		return false;
    	}

    }

    //获取首级菜单下的左侧菜单
    public function getSubMenues($headid,&$darray){
    	$d = model('Menues')->getListData('*',array('pid'=>array('eq',$headid),'is_show'=>array('eq',1)),'sortnum desc');

    	if($d){
    		foreach($d as $v){
    			$tmp = model('Menues')->getListData('*',array('pid'=>array('eq',$v['id']),'is_show'=>array('eq',1)),'sortnum desc');
    			if($tmp){
					$v['is_has_sub'] = true;
					$v['subdata'] = array();
					$v['subdata'] = $this->getSubMenues($v['id'],$v['subdata']);
    			}else{
    				$v['is_has_sub'] = false;
    			}
    			array_push($darray,$v);
    		}
    	}

    	return $darray;

    }

    //显示提示信息
    public function assignSysTips(){
    	$syscode = session('syscode');
		$sysmsg = session('sysmsg');
		session('sysmsg',null);
		session('syscode',null);
		$this->assign('sysmsg', $sysmsg);
		$this->assign('syscode', $syscode);
    }

    //设置系统提示信息 $type 1成功提示 其它失败提示 ，$msg 提示信息
    public function setSysTips($type,$msg){
    	if($type == '1'){
    	//成功提示
			session('syscode',200);
    	}else{
    	//失败提示
    		session('syscode',100);
    	}
		session('sysmsg',$msg);
    }


}
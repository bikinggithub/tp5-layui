<?php
namespace app\admin\controller;
use \think\Controller;
class Base extends controller
{
    public function __construct(){
    	parent::__construct();

    	//检测用户是否登陆
    	$this->checkUserLogin();
    	$sysuserinfo = session('sysuser');

		if($sysuserinfo['roleid'] == '0'){
			//无访问权限页面
    		session('sysuser',null);
    		$this->redirect('admin/Userlogin/noaccesspage');exit();
		}
    	

		$request = request();
		$modulename = $request->module();
		$controlname = $request->controller();
		$actname = $request->action();

		$linkurl = '/'.$modulename.'/'.$controlname.'/'.$actname;//请求的url地址

		
		//echo '<pre/>';var_dump($headmenues);die();
		if(strtolower($sysuserinfo['account']) != 'admin'){
			//判断用户是否拥有一级菜单权限
			//获取一级菜单
			$headmenuesw = array(
				'm.pid'=>0,
				'm.is_show'=>array('eq',1),
				'm.menues_status'=>array('eq',1),
				'rn.role_id'=>array('eq',$sysuserinfo['roleid'])	
			);

			$headmenues = model('Menues')->alias('m')->field('m.*')->join('roles_nodes rn','rn.node_id = m.id')->where($headmenuesw)->order('sortnum desc')->select()->toArray();
			//echo '<pre/>';var_dump($headmenues);die();
			if(!$headmenues){
				//无访问权限页面
	    		session('sysuser',null);
	    		$this->redirect('admin/Userlogin/noaccesspage');exit();
			}

		}else{
			//获取一级菜单
			$headmenuesw = array(
				'pid'=>0,
				'is_show'=>array('eq',1),
				'menues_status'=>array('eq',1)	
			);
			$headmenues = model('Menues')->getListData('*',$headmenuesw,'sortnum desc');
		}


		//获取当前所在的首级菜单
		$headmenuesid = $this->getHeandMenuesId($linkurl);
		//echo $headmenuesid;die();

		//向模板传递参数
		if($headmenues && $headmenuesid){
			//根据首级菜单，获取左侧二级，三级菜单
			$subdataarr = array();
			$submenues = $this->getSubMenues($headmenuesid,$subdataarr);
			//echo '<pre/>';var_dump($submenues);die();
			
			if(strtolower($sysuserinfo['account']) != 'admin'){
				//判断当前链接是否有权限
				$hasaccessw = array(
					'm.pid'=>array('gt',0),
					'm.link_url'=>array('eq',$linkurl),
					'rn.role_id'=>array('eq',$sysuserinfo['roleid'])	
				);

				$hasaccess = model('Menues')->alias('m')->field('m.*')->join('roles_nodes rn','rn.node_id = m.id')->where($hasaccessw)->find();

				$ismenushow = model('Menues')->getListData('id,is_show',array('link_url'=>array('eq',$linkurl)),'sortnum desc',1);
				 
				if(!$hasaccess && $ismenushow['is_show'] == '1'){
					if($submenues){
						if($submenues[0]['is_has_sub']){
							$tmpsubarr = $submenues[0]['subdata'];
							$this->redirect($tmpsubarr[0]['link_url']);exit();
						}else{
							$this->redirect($submenues[0]['link_url']);exit();
						}
					}
					//无访问权限页面
		    		session('sysuser',null);
		    		$this->redirect('admin/Userlogin/noaccesspage');exit();
				}

				if(!$hasaccess && $ismenushow['is_show'] == '2'){
					if(strpos(strtolower($linkurl),'delete')!==false || strpos(strtolower($linkurl),'deluserrole')!==false){
						$this->setSysTips(2,'暂无该操作权限');exit();
					}else{
						echo '<style type="text/css">*{ padding: 0; margin: 0; }.accessdeny h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } .accessdeny p{ line-height: 1.6em; font-size: 42px }</style><div class="accessdeny" style="padding: 24px 48px;"><h1>:(</h1><p> Access Deny<br/><span style="font-size:30px">暂无操作权限</span></p></div>';die();
					}
				}
				
			}
			


			$this->assign('headmenues',$headmenues);
			if($submenues){
				$this->assign('submenues',$submenues);
			}else{
				$this->assign('submenues',array());
			}

			//系统用户
			$sysuser = array(
				'username' => $sysuserinfo['account'],
				'headimg' => $sysuserinfo['head_img'],
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
    	$sysuserinfo = session('sysuser');

    	if(strtolower($sysuserinfo['account']) != 'admin'){
    		$where = array(
				'm.pid'=>array('eq',$headid),
				'm.is_show'=>array('eq',1),
				'rn.role_id'=>array('eq',$sysuserinfo['roleid'])
    		);
			$d = model('Menues')->alias('m')->field('m.*')->join('roles_nodes rn','rn.node_id = m.id')->where($where)->order('sortnum desc')->select()->toArray();
    	}else{
    		$d = model('Menues')->getListData('*',array('pid'=>array('eq',$headid),'is_show'=>array('eq',1)),'sortnum desc');
    	}
    	

    	if($d){
    		foreach($d as $v){

    			if(strtolower($sysuserinfo['account']) != 'admin'){
		    		$tmpwhere = array(
						'm.pid'=>array('eq',$v['id']),
						'm.is_show'=>array('eq',1),
						'rn.role_id'=>array('eq',$sysuserinfo['roleid'])
		    		);
					$tmp = model('Menues')->alias('m')->field('m.*')->join('roles_nodes rn','rn.node_id = m.id')->where($tmpwhere)->order('sortnum desc')->select()->toArray();
		    	}else{
		    		$tmp = model('Menues')->getListData('*',array('pid'=>array('eq',$v['id']),'is_show'=>array('eq',1)),'sortnum desc');
		    	}

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

    //检测用户是否登陆，如果没有登陆，则跳转到登陆页
    public function checkUserLogin(){
    	$sysuser = session('sysuser');
    	if(empty($sysuser)){
			$this->redirect('Admin/Userlogin/login');
			exit();
    	}
    }


}
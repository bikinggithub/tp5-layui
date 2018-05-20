<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function checknodeaccess($roleid,$nodeid){
	$res = model('RolesNodes')->getListData('*',array('role_id'=>array('eq',$roleid),'node_id'=>array('eq',$nodeid)),'id desc',1);
	if($res){
		return 'checked';
	}else{
		return '';
	}
}

//获取角色名称
function getRoleName($roleid){
	$res = model('Roles')->getListData('name',array('id'=>array('eq',$roleid)),'id desc',1);
	if($res){
		return $res['name'];
	}else{
		return '/';
	}
}

//获取系统变量
function getSysVar($varcode){
	$varcode = trim($varcode);
	if($varcode){
		$res = model('SysConfig')->getListData('v_value',array('v_code'=>array('eq',$varcode),'status'=>array('eq',1)),'id desc',1);
	if($res){
		return $res['v_value'];
	}else{
		return false;
	}
	}else{
		return false;
	}
}



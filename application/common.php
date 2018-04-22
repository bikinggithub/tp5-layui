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

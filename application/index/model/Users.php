<?php
namespace app\index\model;
use \think\Model;

class Users extends Model{
	protected $connection = 'db_config1';
    public function getListData($fields,$where,$sortstr,$listnum = ''){

    	$data = $this->field($fields)->where($where)->order($sortstr)->select();

    	if($data){
			return $data->toArray();
    	} else{
    		return false;
    	}
        
    }
}
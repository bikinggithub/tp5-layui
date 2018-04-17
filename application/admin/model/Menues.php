<?php
namespace app\admin\model;
use \think\Model;

class Menues extends Model{
	protected $connection = 'db_config1';
    public function getListData($fields='*',$where=array(),$sortstr='id desc',$listnum = ''){
    	if($listnum == '1'){
    		$data = $this->field($fields)->where($where)->order($sortstr)->find();
    	}else{
    		$data = $this->field($fields)->where($where)->order($sortstr)->select();
    	}

    	if($data){
			return $data->toArray();
    	} else{
    		return false;
    	}
        
    }
}
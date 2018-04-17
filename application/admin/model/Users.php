<?php
namespace app\admin\model;
use \think\Model;

class Users extends Model{
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


    public function getListPageData($fields='*',$where=array(),$sortstr='id desc',$pagenum = 10){

        $data = $this->field($fields)->where($where)->order($sortstr)->paginate($pagenum );

        if($data){
            $tmpdata = array();
            $tmpdata['page'] = $data->render();;
            $tmpdata['list'] = $data->toArray();
            return $tmpdata;
        } else{
            return false;
        }
    }

}
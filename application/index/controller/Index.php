<?php
namespace app\index\controller;
use \think\Controller;
use \think\Db;
class Index extends Controller
{
    public function index()
    {
    	$where = array(	
    	);

        $data = model('Users')->getListData('*',$where,'id desc',1);

        echo '<pre/>';var_dump($data);exit();

        return $this->fetch('hello');

    }
}

<?php
namespace app\admin\controller;

class Powermanage extends Base
{
	public function __construct(){
		parent::__construct();
	}
    public function rolelist()
    {
        return view('rolelist');
    }
}

<?php
namespace app\admin\controller;

class Index extends Base
{
	public function __construct(){
		parent::__construct();
	}
    public function index()
    {
        return view('index');
    }
}

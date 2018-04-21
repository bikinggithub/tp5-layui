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


    //节点列表
    public function nodelist()
    {
        $data = array();
        $where = array('pid'=>array('eq',0));
        $tmpdata = model('Menues')->getListData('*',$where,'id asc');
        //获取所有的一级菜单，进行遍历
        //
        foreach($tmpdata as $value){
                array_push($data,$value);
                $this->pushSubMenues($data,$value['id']);
        }

        // echo '<pre/>';var_dump($data);die();

        if($data){
            // 模板变量赋值
            $this->assignSysTips();//显示系统提示
            $this->assign('list', $data);
        }
        return view('nodelist');
    }

    //获取子菜单
    public function pushSubMenues(&$data,$pid,$field='*')
    {
        $tmpd = model('Menues')->getListData($field,array('pid'=>array('eq',$pid)),'id asc');
        if($tmpd){
           foreach($tmpd as $val){
                array_push($data,$val);
                $this->pushSubMenues($data,$val['id'],$field);
           } 
        }
    }

    //获取上级节点
    public function getParentsMenues()
    {
        $data = array();
        $field = 'id,name,pid,gradenum';
        $tmpdata = model('Menues')->getListData($field,array('pid'=>array('eq',0)),'id asc');
        //获取所有的一级菜单，进行遍历
        foreach($tmpdata as $value){
                array_push($data,$value);
                $this->pushSubMenues($data,$value['id'],$field);
        }
        return $data;
    }

    //节点新增
    public function add()
    {
        if(request()->isPost()){
            // echo '<pre/>';var_dump($_POST);die();

            //判断该条数据是否存在
            $modulename = $_POST['module_name'];
            $controlname = $_POST['control_name'];
            $methodname = $_POST['method_name'];

            $linkurl = '/'.$modulename.'/'.$controlname.'/'.$methodname;


            $md = model('Menues')->getListData('*',array('link_url'=>array('eq',trim($linkurl))),'id desc',1);

            if($md){
                //已经存在
                $this->error('该节点已经存在');exit();
            }


            $_POST['markid'] = empty($_POST['markid'])?$methodname:$_POST['markid'];

            $_POST['link_url'] = $linkurl;
            $_POST['name'] = addslashes($_POST['name']);

            //节点等级
            if($_POST['pid'] == 0){
                $_POST['gradenum'] = 1;//一级菜单
            }else{
                $tmpinfo = model('Menues')->getListData('gradenum',array('id'=>array('eq',trim($_POST['pid']))),'id desc',1);
                $_POST['gradenum'] = $tmpinfo['gradenum']+1;

            }
            

            $nowtime = date('Y-m-d H:i:s');
            $_POST['create_at'] = $nowtime;
            $_POST['update_at'] = $nowtime;

            $res = model('Menues')->data($_POST)->save();
            
            if($res){
                $this->setSysTips(1,'新增成功');
                //$this->success('新增成功',url('admin/Usermanage/userlist'));exit();
            }else{
                $this->setSysTips(2,'新增失败');
                // $this->error('新增失败');exit();
            }
            echo 200;exit();
        }

        $parentsmenues = $this->getParentsMenues();
        $this->assign('pidsarr',$parentsmenues);
        return view('add');
    }

    //节点删除
    public function delete()
    {
        $delidstr = request()->param('idstr');
        if($delidstr){
            $tmpd= explode(',', $delidstr);
            //循环判断该节点下是否还有其它节点，如果包含则无法删除
            foreach($tmpd as $val){
                $downnodes = model('Menues')->getListData('*',array('pid'=>array('eq',$val)),'id asc',1);
                if($downnodes){
                    $this->setSysTips(2,'删除节点要求节点下不包含任何其他节点');
                    exit();
                }
            }

            $delres = model('Menues')->destroy($delidstr);   
            if($delres){
                $this->setSysTips(1,'删除成功');
            }else{
                $this->setSysTips(2,'删除失败');    
            }
   
        }
    }

    //编辑节点
    public function edit(){

        if(request()->isPost()){
            //echo '<pre/>';var_dump($_POST);die();
            $edituid = $_POST['edituid'];

            $_POST['markid'] = empty($_POST['markid'])?$_POST['method_name']:$_POST['markid'];
            
            unset($_POST['edituid']);
            unset($_POST['module_name']);
            unset($_POST['control_name']);
            unset($_POST['method_name']);

            $_POST['name'] = addslashes($_POST['name']);

            //节点等级
            if($_POST['pid'] == 0){
                $_POST['gradenum'] = 1;//一级菜单
            }else{
                $tmpinfo = model('Menues')->getListData('gradenum',array('id'=>array('eq',trim($_POST['pid']))),'id desc',1);
                $_POST['gradenum'] = $tmpinfo['gradenum']+1;

            }

            $_POST['update_at'] = date('Y-m-d H:i:s');

            $res = model('Menues')->save($_POST,array('id'=>array('eq',$edituid)));
            
            if($res === false){
                $this->setSysTips(2,'编辑失败');
            }else{
                $this->setSysTips(1,'编辑成功');
            }
            echo 200;exit();
            
        }


        $eid = request()->param('eid');
        if(empty($eid)){
            echo '参数丢失了';exit();
        }

        $bd = model('Menues')->getListData('*',array('id'=>array('eq',trim($eid))),'id desc',1);
        if($bd){
            $this->assign('datainfo',$bd);          
        }else{
            echo '数据丢失了';exit();
        }

        $parentsmenues = $this->getParentsMenues();
        $this->assign('pidsarr',$parentsmenues);

        return view('edit');
    }



}

<?php
namespace app\admin\controller;

class Sysmanage extends Base
{
	public function __construct(){
		parent::__construct();
	}

	//系统变量列表
    public function index()
    {

    	$pagenum = config('paginate')['list_rows'];

    	$name = request()->get('name');
    	$status = request()->get('status');
    	$where = array();

    	if(!empty($name)){
			$where['name'] = array('like','%'.$name.'%');
    	}

    	if(!empty($status)){
			$where['status'] = array('eq',$status);
    	}

		$data = model('SysConfig')->getListPageData('*',$where,'id desc',$pagenum);
		//echo '<pre/>';var_dump($data);die();

		if($data){
			// 模板变量赋值
			$this->assignSysTips();//显示系统提示
			$this->assign('list', $data['list']['data']);
			$this->assign('page', $data['page']);
		}
        return view();
    }

    //新增
    public function add(){
    	if(request()->isPost()){
            //var_dump($_POST);die();
            unset($_POST['file']);

    		$vcode = $_POST['v_code'];
    		$tmpd = model('SysConfig')->getListData('*',array('v_code'=>array('eq',trim($vcode))),'id desc',1);
    		if($tmpd){
                echo json_encode(array('code'=>101,'msg'=>'该变量已经存在'));exit();
    		}

			$_POST['create_at'] = date('Y-m-d H:i:s');
			$res = model('SysConfig')->data($_POST)->save();
			
			if($res){
				$this->setSysTips(1,'新增成功');
                echo json_encode(array('code'=>200,'msg'=>'success'));exit();
			}else{
				$this->setSysTips(2,'新增失败');
                echo json_encode(array('code'=>100,'msg'=>'新增失败'));exit();
			}
    	}
    	return view('add');
    }

    //用户编辑
    public function edit(){

    	if(request()->isPost()){
    		//判断用户是否存在
    		$edituid = $_POST['edituid'];

    		unset($_POST['edituid']);

    		unset($_POST['file']);

            //判断是否为系统级变量
            $varinfo = model('SysConfig')->getListData('*',array('id'=>array('eq',$edituid)),'id desc',1);

            if($varinfo['is_sys'] == '1'){
                //$this->setSysTips(2,'系统变量不可编辑');
                echo json_encode(array('code'=>100,'msg'=>'系统变量不可编辑'));exit();
            }
    		
			$res = model('SysConfig')->save($_POST,array('id'=>array('eq',$edituid)));
			
			if($res){
				$this->setSysTips(1,'编辑成功');
                echo json_encode(array('code'=>200,'msg'=>'编辑成功'));exit();
			}else{
				//$this->setSysTips(2,'编辑失败');
                echo json_encode(array('code'=>100,'msg'=>'编辑失败'));exit();
			}


    	}


    	$uid = request()->param('uid');
    	if(empty($uid)){
    		echo '参数丢失了';exit();
    	}

    	$ud = model('SysConfig')->getListData('*',array('id'=>array('eq',trim($uid))),'id desc',1);
		if($ud){
			$this->assign('datainfo',$ud);			
		}else{
			echo '数据丢失了';exit();
		}

    	return view('edit');
    }

    //用户删除
    public function delete(){
    	//判断是否包含admin
    	$delidstr = request()->param('idstr');
    	if($delidstr){
    		$tmpd= explode(',', $delidstr);
            foreach($tmpd as $v){
                $varinfo = model('SysConfig')->getListData('*',array('id'=>array('eq',$v)),'id desc',1);

                if($varinfo['is_sys'] == '1'){
                    $this->setSysTips(2,'系统变量不可删除');exit();
                }
            }


			$delres = model('SysConfig')->destroy($delidstr);	
			if($delres){
				$this->setSysTips(1,'删除成功');
			}else{
				$this->setSysTips(2,'删除失败');	
			}
    	}
    }


    //邮件功能测试
    public function checkEmailFunc(){

        if(request()->isPost()){
            require_once dirname(dirname(dirname(__FILE__)))."/extra/class.smtp.php";
            $email_smtp_conf = getSysVar('email_smtp_conf');
            $email_smtp_conf = json_decode($email_smtp_conf,true);
            if(empty($email_smtp_conf) || empty($email_smtp_conf['smtpserver']) || empty($email_smtp_conf['port']) || empty($email_smtp_conf['usermail']) || empty($email_smtp_conf['smtpuser']) || empty($email_smtp_conf['smtppass'])){
                echo json_encode(array('code'=>100,'msg'=>'未配置相关参数'));exit();
            }

            if(empty(request()->param('recemail'))){
                echo json_encode(array('code'=>100,'msg'=>'收件方不能为空'));exit();
            }

            $emailtitle = request()->param('emailtitle');
            $emailcontent = request()->param('emailcontent');

            //******************** 配置信息 ********************************
            
            $smtpserver = $email_smtp_conf['smtpserver'];//SMTP服务器
            $smtpserverport =$email_smtp_conf['port'];//SMTP服务器端口
            $usermail = $email_smtp_conf['usermail'];//SMTP服务器的用户邮箱
            $recemail = request()->param('recemail');//发送给谁
            $recemail = trim($recemail);//发送给谁
            $smtpuser = $email_smtp_conf['smtpuser'];//SMTP服务器的用户帐号
            $smtppass = $email_smtp_conf['smtppass'];//SMTP服务器的用户密码
            $mailtitle = empty($emailtitle)?"测试邮件":$emailtitle;//邮件主题
            $mailcontent = empty($emailcontent)?"<h1>这是一封测试邮件</h1>":"<p>".$emailcontent."</p>";//邮件内容

            $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件

            //************************ 配置信息 ****************************

            $smtp = new \smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
            $smtp->debug = false;//是否显示发送的调试信息
            $state = $smtp->sendmail($recemail, $usermail, $mailtitle, $mailcontent, $mailtype);

            if($state==""){
                echo json_encode(array('code'=>100,'msg'=>"对不起，邮件发送失败！请检查邮箱填写是否有误。"));
                exit();
            }
            echo json_encode(array('code'=>200,'msg'=>"邮件发送成功！！"));exit();

        }
        return view('checkemail');
    }



}


<?php
namespace app\admin\controller;
use \think\Controller;
class Userlogin extends Controller
{
    //用户登陆
    public function login(){
        if(request()->isPost()){
            $account = request()->post('account');
            $password = request()->post('password');
            $checkcode = trim(request()->post('checkcode'));

            if(!captcha_check($checkcode)){
             //验证失败
                echo json_encode(array('code'=>100,'msg'=>'验证码不正确'));exit();
            };

            if(empty($account)){
                echo json_encode(array('code'=>101,'msg'=>'账号不能为空'));exit();
            }

            if(empty($password)){
                echo json_encode(array('code'=>102,'msg'=>'密码不能为空'));exit();
            }

            $ud = model('Users')->getListData('*',array('account'=>array('eq',$account),'status'=>array('eq',1)),'id desc',1);

            if($ud){
                $upasswd = $ud['password'];

                if($upasswd == md5('sys'.$password)){
                    session('sysuser',$ud);
                    echo json_encode(array('code'=>200,'msg'=>'登陆成功'));exit();
                }else{
                    echo json_encode(array('code'=>104,'msg'=>'密码不正确'));exit();
                }

            }else{
               echo json_encode(array('code'=>103,'msg'=>'用户不存在或已被禁用'));exit(); 
            }

        }
        $uinfo = session('sysuser');
        if(!empty($uinfo)){
            $this->redirect('admin/Index/index');exit();
        }

        return view();
    }

    //用户退出
    public function logout(){
        session('sysuser',null);
        $this->redirect('admin/Userlogin/login');
    }



}


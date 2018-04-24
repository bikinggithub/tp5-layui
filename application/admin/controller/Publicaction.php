<?php
namespace app\admin\controller;

class Publicaction extends Base
{
    public $uploadlimits = array(
        'size'=>10485760,//10M
        'ext'=>'jpg,png,gif'
    );

    //文件上传 array('code'=>200,'msg'=>'success','data'=>$data)
    public function upload(){
        // 获取表单上传文件
        $file = request()->file('file');
        // 移动到框架应用根目录/uploads/ 目录下
        if($file){
            $info = $file->validate($this->uploadlimits)->move(ROOT_PATH .DS.'public'. DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                // echo $info->getExtension();
                // echo $info->getSaveName();
                // echo $info->getFilename(); 
                $src = config('domname').DS.'uploads'.DS.$info->getSaveName();
                echo json_encode(array('code'=>200,'msg'=>'success','data'=>array('src'=>$src)));
            }else{
                // 上传失败获取错误信息
                $errorinfo =  $file->getError();
                echo json_encode(array('code'=>100,'msg'=>'error','data'=>$errorinfo));
            }
        }
    }

    //编辑器上传图片
    //返回格式
    /**
    {
      "code": 0 //0表示成功，其它失败
      ,"msg": "" //提示信息 //一般上传失败后返回
      ,"data": {
        "src": "图片路径"
        ,"title": "图片名称" //可选
      }
    }
    **/
    public function eidtupload(){
        // 获取表单上传文件
        $file = request()->file('file');
        // 移动到框架应用根目录/uploads/ 目录下
        if($file){
            $info = $file->validate($this->uploadlimits)->move(ROOT_PATH .DS.'public'. DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                // echo $info->getExtension();
                // echo $info->getSaveName();
                // echo $info->getFilename(); 
                $src = config('domname').DS.'uploads'.DS.$info->getSaveName();
                echo json_encode(array('code'=>0,'msg'=>'success','data'=>array('src'=>$src,'title'=>$info->getFilename())));
            }else{
                // 上传失败获取错误信息
                $errorinfo =  $file->getError();
                echo json_encode(array('code'=>100,'msg'=>$errorinfo,'data'=>''));
            }
        }
    }


}


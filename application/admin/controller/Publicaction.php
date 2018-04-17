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


}


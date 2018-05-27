<?php
namespace app\admin\controller;

class Usermanage extends Base
{
	public function __construct(){
		parent::__construct();
	}

    public function index(){
        return view('public/accessdeny');
    }

	//用户列表
    public function userlist()
    {
    	// 查询状态为1的用户数据 并且每页显示10条数据
    	$pagenum = config('paginate')['list_rows'];

    	$account = request()->get('account');
    	$status = request()->get('status');
        $outputd = request()->param('dao');
    	$where = array();

    	if(!empty($account)){
			$where['account'] = array('like','%'.$account.'%');
    	}

    	if(!empty($status)){
			$where['status'] = array('eq',$status);
    	}

		$data = model('Users')->getListPageData('*',$where,'id desc',$pagenum);
		//echo '<pre/>';var_dump($data);die();

        if(!empty($outputd)){
            //数据导出
            $outputdata = model('Users')->getListData('*',$where,'id desc');
            if($outputdata){
                $this->outputExcelData($outputdata);
                exit();
            }else{
                $this->setSysTips(2,'获取不到导出数据');
            }
            
        }

		if($data){
			// 模板变量赋值
			$this->assignSysTips();//显示系统提示
			$this->assign('list', $data['list']['data']);
			$this->assign('page', $data['page']);
		}
        return view('userlist');
    }

    //数据导出 
    protected function outputExcelData($data){
        //echo '<pre/>';var_dump($data);die();

        $rpath = dirname(dirname(dirname(__FILE__))).'/extra/';
        require_once $rpath.'PHPExcel.php';
        require_once $rpath.'PHPExcel/Writer/Excel2007.php';
        require_once $rpath.'PHPExcel/Writer/Excel5.php';
        include_once $rpath.'PHPExcel/IOFactory.php';
        $objExcel = new \PHPExcel();
        //设置属性 (这段代码无关紧要，其中的内容可以替换为你需要的)
        /*$objExcel->getProperties()->setCreator("andy");
        $objExcel->getProperties()->setLastModifiedBy("andy");
        $objExcel->getProperties()->setTitle("Office 2003 XLS Test Document");
        $objExcel->getProperties()->setSubject("Office 2003 XLS Test Document");
        $objExcel->getProperties()->setDescription("Test document for Office 2003 XLS, generated using PHP classes.");
        $objExcel->getProperties()->setKeywords("office 2003 openxml php");
        $objExcel->getProperties()->setCategory("Test result file");*/
        $objExcel->setActiveSheetIndex(0);
        //表头
        $objExcel->getActiveSheet()->setCellValue('A1', "编号");
        $objExcel->getActiveSheet()->setCellValue('B1', "账号");
        $objExcel->getActiveSheet()->setCellValue('C1', "昵称");
        $objExcel->getActiveSheet()->setCellValue('D1', "创建时间");

        $i=2;
        foreach($data as $k=>$v) {
          /*----------写入内容-------------*/
          $objExcel->getActiveSheet()->setCellValue('A'.$i, $v["id"]);
          $objExcel->getActiveSheet()->setCellValue('B'.$i, $v["account"]);
          $objExcel->getActiveSheet()->setCellValue('C'.$i, $v["nickname"]);
          $objExcel->getActiveSheet()->setCellValue('D'.$i, $v["create_at"]);
          $i++;
        }
        // 高置列的宽度
        $objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        $timestamp = date('Ymd');
        $ex  = 2007;
        if($ex == '2007') { //导出excel2007文档
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header('Content-Disposition: attachment;filename="'.$timestamp.'.xlsx"');
          header('Cache-Control: max-age=0');
          $objWriter = \PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
          ob_clean();
          $objWriter->save('php://output');
          exit;
        } else { //导出excel2003文档
          header('Content-Type: application/vnd.ms-excel; charset="UTF-8"'); 
          header('Content-Disposition: attachment; filename='.urlencode($timestamp.'.xls'));
          header("Content-Transfer-Encoding: binary");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");  
          $objWriter = \PHPExcel_IOFactory::createWriter($objExcel, 'Excel5'); 
          ob_clean(); 
          $objWriter->save('php://output');
          exit;
        }
    }

    //用户导入
    public function importUser(){
        if(request()->isPost()){
            $filepath = $_POST['excelpath'];
            if(empty($filepath)){
                $this->error('您还没有上传文件');exit();
            }else{
                $rpath = dirname(dirname(dirname(dirname(__FILE__)))).'/public';
                $impdata = $this->importExcelData($rpath.$filepath);
                $totalnum = 0;
                $success = 0;
                if($impdata){
                    foreach($impdata as $v){
                        $totalnum += 1;

                        $ud = model('Users')->getListData('*',array('account'=>array('eq',trim($v['A']))),'id desc',1);
                        if($ud){
                            continue;
                        }

                        $tmpaddarr = array();
                        $tmpaddarr['account'] = $v['A'];
                        $tmpaddarr['password'] = md5('sys'.$v['B']);
                        $tmpaddarr['create_at'] = date('Y-m-d H:i:s');
                        $res = model('Users')->save($tmpaddarr);
                        if($res){
                            $success += 1;
                        }
                    }
                    if($success >0){
                        $this->setSysTips(1,'总共'.$totalnum.'条,成功写入'.$success.'条');
                    }else{
                        $this->setSysTips(2,'总共'.$totalnum.'条,成功写入'.$success.'条');  
                    }
                    
                    @unlink($rpath.$filepath);
                    echo 200;exit();

                }else{
                    $this->setSysTips(2,'excel数据读取失败');
                    echo 200;exit();
                }

            }
        }
        return view('importUser');
    }

    //获取导入数据
    protected function importExcelData($file, $sheet=0){
        if(empty($file) OR !file_exists($file)) {  
            die('file not exists!');  
        }  
        require_once dirname(dirname(dirname(__FILE__))).'/extra/PHPExcel.php';
        $objRead = new \PHPExcel_Reader_Excel2007();   //建立reader对象  
        if(!$objRead->canRead($file)){  
            $objRead = new \PHPExcel_Reader_Excel5();  
            if(!$objRead->canRead($file)){  
                die('No Excel!');  
            }  
        }  
      
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');  
      
        $obj = $objRead->load($file);  //建立excel对象  
        $currSheet = $obj->getSheet($sheet);   //获取指定的sheet表  
        $columnH = $currSheet->getHighestColumn();   //取得最大的列号  
        $columnCnt = array_search($columnH, $cellName);  
        $rowCnt = $currSheet->getHighestRow();   //获取总行数  
      
        $data = array();  
        for($_row=2; $_row<=$rowCnt; $_row++){  //读取内容  
            for($_column=0; $_column<=$columnCnt; $_column++){  
                $cellId = $cellName[$_column].$_row;  
                $cellValue = $currSheet->getCell($cellId)->getValue();  
                 //$cellValue = $currSheet->getCell($cellId)->getCalculatedValue();  #获取公式计算的值  
                if($cellValue instanceof PHPExcel_RichText){   //富文本转换字符串  
                    $cellValue = $cellValue->__toString();  
                }  
      
                $data[$_row][$cellName[$_column]] = $cellValue;  
            }  
        }  
        return $data; 
    }

    //用户新增
    public function add(){
    	if(request()->isPost()){
    		//判断用户是否存在
    		$account = $_POST['account'];
    		$ud = model('Users')->getListData('*',array('account'=>array('eq',trim($account))),'id desc',1);
    		if($ud){
    			//用户已经存在
    			$this->error('该用户已经存在');exit();
    		}

    		unset($_POST['file']);
    		$_POST['nickname'] = empty($_POST['nickname'])?$_POST['account']:$_POST['nickname'];
    		$_POST['head_img'] = empty($_POST['head_img'])?config('domname').DS.'static'.DS.'admin'.DS.'images'.DS.'headimg.jpg':$_POST['head_img'];
            $_POST['create_at'] = date('Y-m-d H:i:s');
			$_POST['roleid'] = isset($_POST['roleid'])?$_POST['roleid']:0;
    		$_POST['password'] = md5('sys'.$_POST['password']);
			$res = model('Users')->data($_POST)->save();
			
			if($res){
				$this->setSysTips(1,'新增成功');
                echo 200;exit();
				//$this->success('新增成功',url('admin/Usermanage/userlist'));exit();
			}else{
				$this->setSysTips(2,'新增失败');
                echo 200;exit();
				// $this->error('新增失败');exit();
			}
    	}

        //用户角色
        $rolelist = model('roles')->order('create_at desc')->select();
        $this->assign('rolelist',$rolelist);

    	return view('add');
    }

    //用户编辑
    public function edit(){

    	if(request()->isPost()){
    		//判断用户是否存在
    		$edituid = $_POST['edituid'];

            if($edituid == 1){
                $this->setSysTips(2,'管理员账号不可编辑');exit();
            }

    		unset($_POST['edituid']);
    		$ud = model('Users')->getListData('*',array('id'=>array('eq',trim($edituid))),'id desc',1);
    		if(empty($ud)){
    			//用户不存在
    			$this->redirect(url('admin/Usermanage/userlist'));exit();
    		}

    		unset($_POST['file']);
    		$_POST['nickname'] = empty($_POST['nickname'])?$_POST['account']:$_POST['nickname'];
    		if(empty($_POST['head_img'])){
    			unset($_POST['file']);
    		}

			$_POST['update_at'] = date('Y-m-d H:i:s');

			if(empty($_POST['password'])){
				unset($_POST['password']);
			}else{
				$_POST['password'] = md5('sys'.$_POST['password']);
			}

			$res = model('Users')->save($_POST,array('id'=>array('eq',$edituid)));
			
			if($res !== false){
				$this->setSysTips(1,'编辑成功');
                echo 200;exit();
				// $this->success('编辑成功',url('admin/Usermanage/userlist'));exit();
			}else{
				$this->setSysTips(2,'编辑失败');
                echo 200;exit();
				// $this->error('编辑失败');exit();
			}
    	}


    	$uid = request()->param('uid');
    	if(empty($uid)){
    		echo '用户参数丢失了';exit();
    	}

    	$ud = model('Users')->getListData('*',array('id'=>array('eq',trim($uid))),'id desc',1);
		if($ud){
			$this->assign('userinfo',$ud);			
		}else{
			echo '用户数据丢失了';exit();
		}

        //用户角色
        $rolelist = model('roles')->order('create_at desc')->select();
        $this->assign('rolelist',$rolelist);

    	return view('edit');
    }

    //用户删除
    public function delete(){
    	//判断是否包含admin
    	$delidstr = request()->param('idstr');
    	if($delidstr){
    		 $tmpd= explode(',', $delidstr);
    		if(!in_array(1, $tmpd)){
				$delres = model('Users')->destroy($delidstr);	
				if($delres){
					$this->setSysTips(1,'删除成功');
				}else{
					$this->setSysTips(2,'删除失败');	
				}
    		}
    	}
    }

}


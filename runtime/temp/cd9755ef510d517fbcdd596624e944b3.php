<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:78:"D:\phpStudy\WWW\tp5\public/../application/admin\view\powermanage\nodelist.html";i:1524300961;s:64:"D:\phpStudy\WWW\tp5\public/../application/admin\view\layout.html";i:1525529271;s:70:"D:\phpStudy\WWW\tp5\public/../application/admin\view\public\menue.html";i:1525500366;s:68:"D:\phpStudy\WWW\tp5\public/../application/admin\view\public\nav.html";i:1525500301;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>后台管理</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/static/admin/css/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="/static/admin/css/main.css" media="all" />

	<script type="text/javascript" src="https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K/r/www/cache/static/protocol/https/jquery/jquery-1.10.2.min_65682a2.js"></script>

	<script type="text/javascript" src="/static/admin/layui/layui.js"></script>
</head>
<body class="main_body">
	<div class="layui-layout layui-layout-admin">
		<!-- 顶部 -->
		<div class="layui-header header">
			<div class="layui-main">
				<a href="#" class="logo">后台管理</a>

				<!-- 顶部右侧菜单 -->
				<ul class="layui-nav top_menu">
					
					
<?php if(is_array($headmenues) || $headmenues instanceof \think\Collection || $headmenues instanceof \think\Paginator): $i = 0; $__LIST__ = $headmenues;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
	<li class="layui-nav-item showNotice" pc>
	<a href="<?php echo $vo['link_url']; ?>"><i class="iconfont icon-gonggao"></i><cite><?php echo $vo['name']; ?></cite></a>
	</li>
<?php endforeach; endif; else: echo "" ;endif; ?>

<!-- <li class="layui-nav-item showNotice" id="showNotice" pc>
	<a href="javascript:;"><i class="iconfont icon-gonggao"></i><cite>系统公告</cite></a>
</li>
<li class="layui-nav-item showNotice" id="showNotice" pc>
	<a href="javascript:;"><i class="iconfont icon-gonggao"></i><cite>系统公告</cite></a>
</li>
<li class="layui-nav-item showNotice" id="showNotice" pc>
	<a href="javascript:;"><i class="iconfont icon-gonggao"></i><cite>系统公告</cite></a>
</li> -->

					<li class="layui-nav-item" pc>
						<a href="javascript:;">
							<img src="<?php echo $sysuser['headimg']; ?>" class="layui-circle" width="35" height="35">
							<cite><?php echo $sysuser['username']; ?></cite>
							<span class="layui-nav-more"></span>
						</a>
						<dl class="layui-nav-child" style="background-color:#ffffff !important;">
							<dd><a href="javascript:;" data-url="page/user/userInfo.html"><i class="iconfont icon-zhanghu" data-icon="icon-zhanghu"></i><cite>个人资料</cite></a></dd>
							<dd><a href="javascript:;" data-url="page/user/changePwd.html"><i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i><cite>修改密码</cite></a></dd>
							<dd><a href="<?php echo url('admin/Userlogin/logout'); ?>"><i class="iconfont icon-loginout"></i><cite>退出</cite></a></dd>
						</dl>
					</li>
				</ul>
			</div>
		</div>
		<!-- 左侧导航 -->
		<div class="layui-side layui-bg-black">
			<div class="user-photo">
				<a class="img" title="我的头像" ><img src="<?php echo $sysuser['headimg']; ?>"></a>
				<p>你好！<span class="userName"><?php echo $sysuser['username']; ?></span>, 欢迎登录</p>
			</div>
			<div class="navBar layui-side-scroll">
				<ul class="layui-nav layui-nav-tree">
					<?php if(is_array($submenues) || $submenues instanceof \think\Collection || $submenues instanceof \think\Paginator): $i = 0; $__LIST__ = $submenues;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['is_has_sub']): ?> 

							<li class="layui-nav-item">

								<a href="javascript:;">
									<i class="layui-icon" data-icon="&#xe62d;"></i>
									<cite><?php echo $vo['name']; ?></cite>
									<span class="layui-nav-more"></span>
								</a>
								<dl class="layui-nav-child">
									<?php if(is_array($vo['subdata']) || $vo['subdata'] instanceof \think\Collection || $vo['subdata'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['subdata'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subvo): $mod = ($i % 2 );++$i;?>
										<dd>
											<a href="<?php echo $subvo['link_url']; ?>" id="<?php echo $subvo['markid']; ?>">
											<i class="layui-icon" data-icon="&#xe62d;"></i>
											<cite><?php echo $subvo['name']; ?></cite>
											</a>
										</dd>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</dl>
							</li>
						<?php else: ?>
							<li class="layui-nav-item">
								<a href="<?php echo $vo['link_url']; ?>" id="<?php echo $vo['markid']; ?>">
									<i class="iconfont icon-computer" data-icon="icon-computer"></i>
									<cite><?php echo $vo['name']; ?></cite>
								</a>
							</li>	 
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>

					
					<!-- <li class="layui-nav-item">
						<a href="javascript:;" data-url="page/systemParameter/systemParameter.html">
							<i class="layui-icon" data-icon="&#xe62d;">&#xe60c;</i>
							<cite>系统基本参数</cite>
						</a>
					</li>
					<li class="layui-nav-item">
						<a href="javascript:;">
							<i class="layui-icon" data-icon="&#xe62d;"></i>
							<cite>二级菜单演示</cite>
							<span class="layui-nav-more"></span>
						</a>
						<dl class="layui-nav-child">
							<dd>
								<a href="javascript:;" data-url="">
								<i class="layui-icon" data-icon="&#xe62d;"></i>
								<cite>二级菜单1</cite>
								</a>
							</dd>
							<dd>
								<a href="javascript:;" data-url="">
									<i class="layui-icon" data-icon="&#xe62d;"></i>
									<cite>二级菜单2</cite>
								</a>
							</dd>
						</dl>
					</li> -->
					<span class="layui-nav-bar" style="top: 247.5px; height: 0px; opacity: 0;"></span>
				</ul>
			</div>
		</div>
		<script>
			var navgradenum = "<?php echo $gradenum; ?>";
			var navmarkid = "<?php echo $markid; ?>";
		</script>

		<!-- 右侧内容 -->
		<div class="layui-body layui-form">
			<div class="layui-tab marg0" lay-filter="bodyTab">
				<ul class="layui-tab-title top_tab">
					<li class="layui-this" lay-id=""><i class="iconfont icon-computer"></i>
					 <cite>
					 	<a href="<?php echo url('admin/Index/index'); ?>" style="display:inline-block;">后台管理</a> &nbsp;》
					 	<a href="<?php echo $brandurl; ?>" style="display:inline-block;"><?php echo $brandname; ?></a>

					 </cite>
					</li>
				</ul>
				
				<div class="layui-tab-content clildFrame">
					<div class="layui-tab-item layui-show" style="padding:20px;overflow-y: scroll;">
						<style>
	.level1{
		    background-color: rgba(103, 58, 183, 0.48);
	}
	.level2{
		    background-color: rgba(255, 152, 0, 0.32);
	}
	.level3{
		background-color: rgba(255, 87, 34, 0.48);
	}

</style>

<div class="layui-row" style="margin-bottom:10px;">
    <div class="layui-col-md12">
      <form action="/admin/Usermanage/userlist" method="get" id="searchform">
      	<input type="hidden" name="page" id="pagenum" value='1' />
      	<div class="actionbtn">
      		<button type="button" onclick="addDataAction();" class="layui-btn layui-btn-primary">
			  <i class="layui-icon">&#xe608;</i> 添加
			</button>	
    		
            <button onclick="deleteAll();" type="button" class="layui-btn layui-btn-primary">
            	<i class="layui-icon">&#xe640;</i>删除
            </button>
    	</div>
      	<div class="searchformdiv" >
      		<!-- <div style="clear:both;float:right;">
      			<label class="search_lab_css">账号：</label>
      					    <div class="layui-inline">
      					      <input type="text" name="account" value="<?php echo \think\Request::instance()->get('account'); ?>" placeholder="请输入账号"  class="layui-input">
      					    </div>
      		
      					    <label class="search_lab_css">状态</label>
      					    <div class="layui-inline">
      					      <select name="status">
      					        <option  value="">请选择</option>
      					        <option <?php if(\think\Request::instance()->get('status') == '1'): ?>selected<?php endif; ?> value="1">正常</option>
      					        <option <?php if(\think\Request::instance()->get('status') == '2'): ?>selected<?php endif; ?> value="2">禁用</option>
      					      </select>
      					    </div>
      		
      					    <button class="layui-btn layui-btn-normal">搜索</button>
      		</div> -->
		 </div>

      </form>
    </div>
</div>
<div style="clear:both;"></div>
<hr class="layui-bg-gray">


<div class="layui-form">
<table class="layui-table">
  <thead>
    <tr>
      <th>
      	<div class="laytable-cell-checkbox">
      		<input type="checkbox" lay-skin="primary" lay-filter="allChoose">
      	</div>
      </th>
      <!-- <th>节点ID</th> -->
      <th>菜单名称</th>
      <th>模块名</th>
      <th>控制器名</th>
      <th>方法名</th>
      <th>是否显示</th>
      <th>状态</th>
      <!-- <th>菜单等级</th> -->
      <!-- <th>创建时间</th> -->
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
    
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
	    <tr class="level<?php echo $vo['gradenum']; ?>">
	      <td>
	      	<div class="laytable-cell-checkbox">
	      		<input type="checkbox" lay-filter="itemChoose"  name="selectedidstr" lay-skin="primary" value="<?php echo $vo['id']; ?>" />
	      	</div>
	      </td>
	      <!-- <td><?php echo $vo['id']; ?></td> -->
	      <td>|
	      	<?php $__FOR_START_28924__=1;$__FOR_END_28924__=$vo['gradenum'];for($i=$__FOR_START_28924__;$i < $__FOR_END_28924__;$i+=1){ ?>
			--
			<?php } ?>
	      	<?php echo $vo['name']; ?>
	      </td>
	      <td><?php echo $vo['module_name']; ?></td>
	      <td><?php echo $vo['control_name']; ?></td>
	      <td><?php echo $vo['method_name']; ?></td>
	      <td>
	      	<?php if($vo['is_show'] == '1'): ?>
	      	显示
	      	<?php else: ?>
	      	隐藏
	      	<?php endif; ?>
	      </td>
	      <td>
	      	<?php if($vo['menues_status'] == '1'): ?>
	      	正常
	      	<?php else: ?>
	      	禁用
	      	<?php endif; ?>
	      </td>
	      <!-- <td><?php echo $vo['gradenum']; ?></td> -->
	      <!-- <td><?php echo $vo['create_at']; ?></td> -->
	      <td>
	      	<button class="layui-btn layui-btn-warm" onclick="editDataAction(<?php echo $vo['id']; ?>)">修改</button>
	      	<button onclick="confirmdel(<?php echo $vo['id']; ?>)" class="layui-btn layui-btn-danger">删除</button>
	      </td>
	    </tr>
	<?php endforeach; endif; else: echo "" ;endif; ?>
  </tbody>
</table>
</div>


<script>
	var layer = '';
	var form = '';
	var edituserbox;
	layui.use(['form','layer'], function(){
  		form = layui.form; //只有执行了这一步，部分表单元素才会自动修饰成功
 		layer = layui.layer;
  		/*layer.open({
		  type: 2, 
		  content: "<?php echo url('admin/Usermanage/edit'); ?>" //不想让iframe出现滚动条，可以content: ['http://sentsin.com', 'no']
		}); */

		form.on('checkbox(allChoose)', function(data){
		    var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
		    child.each(function(index, item){
		        item.checked = data.elem.checked;
		    });
		    form.render('checkbox');
		});
		form.on('checkbox(itemChoose)',function(data){
		    var sib = $(data.elem).parents('table').find('tbody input[type="checkbox"]:checked').length;
		    var total = $(data.elem).parents('table').find('tbody input[type="checkbox"]').length;
		    if(sib == total){
		        $(data.elem).parents('table').find('thead input[type="checkbox"]').prop("checked",true);
		        form.render();
		    }else{
		        $(data.elem).parents('table').find('thead input[type="checkbox"]').prop("checked",false);
		        form.render();
		    }
		});

		showSysTips(layer);
	});

	function editDataAction(uid){
		edituserbox = layer.open({
		  type: 2,
		  title:'节点编辑',
		  area: ['700px', '500px'], 
		  content: "/admin/Powermanage/edit/eid/"+uid //不想让iframe出现滚动条，可以content: ['http://sentsin.com', 'no']
		});
	}

	function addDataAction(){
		edituserbox = layer.open({
		  type: 2,
		  title:'节点新增',
		  area: ['700px', '500px'], 
		  content: "<?php echo url('admin/Powermanage/add'); ?>" //不想让iframe出现滚动条，可以content: ['http://sentsin.com', 'no']
		});
	}

	function closebox(){
		layer.close(edituserbox);
	}
	function reloadpage(){
		window.location.reload();
	}

	function confirmdel(dataid){
		layer.confirm(
			'确认要删除吗，删除后数据不可恢复！?', 
			{icon: 3, title:'提示'},
			 function(index){
			 	//确认删除操作
		  		layer.close(index);
		  		$.ajax({
		  			type:"post",
		  			url:"/admin/Powermanage/delete",
		  			data:{"idstr":dataid},
		  			success:function(){
		  				reloadpage();
		  			},
		  			error:function(){}
		  		});
			},
			function(){
				//取消删除操作
			}
		);
	}

	function deleteAll(){
		layer.confirm(
			'确认要删除吗，删除后数据不可恢复！?', 
			{icon: 3, title:'提示'},
			 function(index){
			 	
			 	var delidstr = '';
			 	$("input:checkbox[name='selectedidstr']:checked").each(function() { // 遍历多选框
					var tmpid =$(this).val(); 
					delidstr += tmpid + ',';
				});


			 	if(delidstr.length > 0){
					delidstr = delidstr.substring(0,delidstr.length-1);
			 	}

			 	if(delidstr == ''){
					//确认删除操作
		  			layer.close(index);
					layer.msg('请先选择');
					return false;
			 	}
			 	
				//确认删除操作
		  		layer.close(index);

		  		$.ajax({
		  			type:"post",
		  			url:"/admin/Powermanage/delete",
		  			data:{"idstr":delidstr},
		  			success:function(){
		  				reloadpage();
		  			},
		  			error:function(){}
		  		});
			},
			function(){
				//取消删除操作
			}
		);
	}

	function showSysTips(layerobj){
		var sysmsg = "<?php echo $sysmsg; ?>";
		var syscode = "<?php echo $syscode; ?>";
		if(sysmsg != ''){
			if(syscode != '200'){
				layerobj.msg(sysmsg,{icon:2,time:4000});
			}else{
				layerobj.msg(sysmsg,{icon:1,time:4000});
			}
			
		}
	}
	

</script>


					</div>
				</div>
			</div>
		</div>
		<!-- 底部 -->
		<div class="layui-footer footer">
			<p>copyright @2017 <a href="http://www.mycodes.net/" target="_blank"></a></p>
		</div>
	</div>



	<script type="text/javascript" src="/static/admin/js/index.js"></script>
</body>
</html>


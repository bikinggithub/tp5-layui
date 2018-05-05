<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\phpStudy\WWW\tp5\public/../application/admin\view\index\index.html";i:1524283474;s:64:"D:\phpStudy\WWW\tp5\public/../application/admin\view\layout.html";i:1525500763;s:70:"D:\phpStudy\WWW\tp5\public/../application/admin\view\public\menue.html";i:1525500366;s:68:"D:\phpStudy\WWW\tp5\public/../application/admin\view\public\nav.html";i:1525500301;}*/ ?>
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
					 	<a href="" style="display:inline-block;">后台首页</a>

					 </cite>
					</li>
				</ul>
				
				<div class="layui-tab-content clildFrame">
					<div class="layui-tab-item layui-show" style="padding:20px;overflow-y: scroll;">
						

ssss
					</div>
				</div>
			</div>
		</div>
		<!-- 底部 -->
		<div class="layui-footer footer">
			<p>copyright @2017 <a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
		</div>
	</div>



	<script type="text/javascript" src="/static/admin/js/index.js"></script>
</body>
</html>


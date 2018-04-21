<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\WWW\tp5\public/../application/admin\view\powermanage\roleusers.html";i:1524320439;}*/ ?>

<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/font_eolqem241z66flxr.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/main.css" media="all" />

  <script type="text/javascript" src="https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K/r/www/cache/static/protocol/https/jquery/jquery-1.10.2.min_65682a2.js"></script>

  <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
  <style>
	  .pagination .active {
	    height: 28px;
	}
  </style>

<div class="dialogbox" style="width:95%;">
	<div class="layui-row" style="margin-bottom:10px;">
	    <div class="layui-col-md12">
	      <form action="/admin/Powermanage/roleusers" method="get" id="searchform">
	      	<input type="hidden" name="page" id="pagenum" value='1' />
	      	<input type="hidden" name="rid"  value="<?php echo $rid; ?>" />
	      	<div class="searchformdiv" >
	      		<div style="clear:both;float:right;">
	      			<label class="search_lab_css">账号：</label>
				    <div class="layui-inline">
				      <input type="text" name="account" value="<?php echo \think\Request::instance()->get('account'); ?>" placeholder="请输入账号"  class="layui-input">
				    </div>
				    <button class="layui-btn layui-btn-normal">搜索</button>
	      		</div>
			 </div>

	      </form>
	    </div>
	</div>
	<div style="clear:both;"></div>
	<hr class="layui-bg-gray">

	<div class="layui-form">
	<table class="layui-table" lay-even>
	  <thead>
	    <tr>
	      <th>帐号ID</th>
	      <th>账号</th>
	      <th>头像</th>
	      <th>状态</th>
	      <th>创建时间</th>
	      <th>操作</th>
	    </tr> 
	  </thead>
	  <tbody>
	    
	    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
		    <tr>
		      <td><?php echo $user['id']; ?></td>
		      <td><?php echo $user['account']; ?></td>
		      <td>
		      	<img src="<?php echo $user['head_img']; ?>" style="max-width:30px"/>
	  		  </td>
		      <td>
		      	<?php if($user['status'] == '1'): ?>
		      	正常
		      	<?php else: ?>
		      	禁用
		      	<?php endif; ?>
		      </td>
		      <td><?php echo $user['create_at']; ?></td>
		      <td>
	      		<button onclick="confirmdel(<?php echo $user['id']; ?>)" class="layui-btn layui-btn-danger">取消授权</button>
		      </td>
		    </tr>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	  </tbody>
	</table>
	</div>

	<div style="max-height:30px;"><?php echo $page; ?></div>
</div>


<script>
	var layer = '';
	var edituserbox;
	layui.use(['layer'], function(){
 		layer = layui.layer;
		showSysTips(layer);
	});


	function confirmdel(uid){
		edituserbox = layer.confirm(
			'确认要取消授权吗?', 
			{icon: 3, title:'提示'},
			 function(index){
		  		layer.close(index);
		  		$.ajax({
		  			type:"post",
		  			url:"/admin/Powermanage/deluserrole",
		  			data:{"idstr":uid},
		  			success:function(){
		  				$("#searchform").submit();
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


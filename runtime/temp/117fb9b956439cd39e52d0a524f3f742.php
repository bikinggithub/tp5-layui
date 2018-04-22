<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\WWW\tp5\public/../application/admin\view\powermanage\rolenodes.html";i:1524413687;}*/ ?>

<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/font_eolqem241z66flxr.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/main.css" media="all" />

  <script type="text/javascript" src="https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K/r/www/cache/static/protocol/https/jquery/jquery-1.10.2.min_65682a2.js"></script>

  <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
	<style>
		.layui-form-checkbox span {
		    height: auto;
		}
	</style>
<div class="dialogbox" style="width:95%;">
    <form class="layui-form" id="addform" action="<?php echo url('admin/Powermanage/rolenodes'); ?>" method="post">

	<input type="hidden" name="rid" value="<?php echo $rid; ?>" />
  <div class="layui-form-item">
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if($vo['gradenum'] == '1'): if($k != '1'): ?>
				<hr/>
    		<?php endif; ?>
			<input type="checkbox" id="<?php echo $vo['id']; ?>" pid="<?php echo $vo['pid']; ?>"  class="level<?php echo $vo['id']; ?> pid<?php echo $vo['pid']; ?> gradenum<?php echo $vo['gradenum']; ?>" <?php echo checknodeaccess($rid,$vo['id']); ?> lay-filter="accesscheckbox" name="roleaccess[]" title="<?php echo $vo['name']; ?>" lay-skin="primary" value="<?php echo $vo['id']; ?>" > <hr/>
    		
		<?php else: if($vo['gradenum'] == '2'): ?>
				<div style="float:left;width:100%;">
					<input type="checkbox" <?php echo checknodeaccess($rid,$vo['id']); ?> id="<?php echo $vo['id']; ?>" pid="<?php echo $vo['pid']; ?>" class="level<?php echo $vo['id']; ?> pid<?php echo $vo['pid']; ?> gradenum<?php echo $vo['gradenum']; ?>" lay-filter="accesscheckbox" name="roleaccess[]" title="<?php echo $vo['name']; ?>" lay-skin="primary"  value="<?php echo $vo['id']; ?>"><br />
				</div>
			<?php else: ?>
				<div style="float:left;width:33%;">
						&emsp;&emsp;<input type="checkbox" <?php echo checknodeaccess($rid,$vo['id']); ?> pid="<?php echo $vo['pid']; ?>" id="<?php echo $vo['id']; ?>" class="level<?php echo $vo['id']; ?> pid<?php echo $vo['pid']; ?> gradenum<?php echo $vo['gradenum']; ?>" lay-filter="accesscheckbox" name="roleaccess[]" title="<?php echo $vo['name']; ?>" value="<?php echo $vo['id']; ?>" lay-skin="primary">
				</div>
			<?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
  </div>



  <!-- <div class="layui-form-item">
    <label class="layui-form-label">复选框</label>
    <div class="layui-input-block">
      <input type="checkbox" name="like[write]" title="写作">
      <input type="checkbox" name="like[read]" title="阅读" checked>
      <input type="checkbox" name="like[dai]" title="发呆">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">开关</label>
    <div class="layui-input-block">
      <input type="checkbox" name="switch" lay-skin="switch">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">单选框</label>
    <div class="layui-input-block">
      <input type="radio" name="sex" value="男" title="男">
      <input type="radio" name="sex" value="女" title="女" checked>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">文本域</label>
    <div class="layui-input-block">
      <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
  </div> -->
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button type="button" id="addbtn" class="layui-btn" lay-submit lay-filter="formgo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
</div>

 
<script>

layui.use(['layer','form','element'], function(){
  var layer = layui.layer;
  var form = layui.form;


	form.on('submit(formgo)', function(data){
	    $.ajax({
	        url:"<?php echo url('admin/Powermanage/rolenodes'); ?>",
	        type:"POST",
	        data:$('#addform').serialize(),
	        success: function(bdata) {
	            if(bdata == '200'){
	              top.closebox();
	              top.reloadpage();
	            }
	        }
	    });

	    return false;
	  
	});

	form.on('checkbox(accesscheckbox)', function(data){
	  /*console.log(data.elem); //得到checkbox原始DOM对象
	  console.log(data.elem.checked); //是否被选中，true或者false
	  console.log(data.value); //复选框value值，也可以通过data.elem.value得到
	  console.log(data.othis); //得到美化后的DOM对象*/
		/*console.log(data.elem);
		console.log($(data.elem).attr('pid'));*/
		if($(data.elem).attr('pid') == '0'){
			checkagain();
		}
		

		var id = data.elem.id;
		var pid = $(data.elem).attr('pid');
		if(data.elem.checked){
			$(".pid"+id).prop('checked','checked');
			/*var totalnum = $(".pid"+pid).length;
			var selectnum = $(".pid"+pid+":checked").length;
			if(totalnum == selectnum){*/
				$(".level"+pid).prop('checked','checked');
			/*}*/
			form.render('checkbox');
			
		}else{
			$(".pid"+id).removeProp('checked');
			//$(".level"+pid).removeProp('checked');
			form.render('checkbox');
		}

	});

	function checkagain(){
		$(".gradenum1").each(function(){
			var id = $(this).attr('id');
			if($(this).is(':checked')){
				$(".pid"+id).prop('checked','checked');
			}else{
				$(".pid"+id).removeProp('checked');
			}
		});

		$(".gradenum2").each(function(){
			var id = $(this).attr('id');
			var pid = $(this).attr('pid');
			if($(this).is(':checked')){
				$(".pid"+id).prop('checked','checked');
			}else{
				$(".pid"+id).removeProp('checked');
				$(".level"+pid).removeProp('checked');

			}
		});

		//form.render('checkbox');
	}

	

});





/*layui.use('layer', function(){
  var layer = layui.layer;

  layer.msg('同上', {
		  icon: 9,
		  time: 2000 //2秒关闭（如果不配置，默认是3秒）
		}, function(){
			  //do something
	});
});*/

</script>

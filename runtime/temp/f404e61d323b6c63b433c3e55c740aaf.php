<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpStudy\WWW\tp5\public/../application/admin\view\powermanage\roleadd.html";i:1524314760;}*/ ?>

<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/font_eolqem241z66flxr.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/main.css" media="all" />

  <script type="text/javascript" src="https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K/r/www/cache/static/protocol/https/jquery/jquery-1.10.2.min_65682a2.js"></script>

  <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
<div class="dialogbox">
    <form class="layui-form" id="addform" action="<?php echo url('admin/Powermanage/roleadd'); ?>" method="post">


  <div class="layui-form-item">
    <label class="layui-form-label">角色名称*</label>
    <div class="layui-input-inline">
      <input type="text" name="name" required  lay-verify="required" placeholder="请输入角色名称" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">必填,角色名称</div>
  </div>

  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">角色描述</label>
    <div class="layui-input-block">
      <textarea name="remark" placeholder="请输入内容" class="layui-textarea" style="width:90%;"></textarea>
    </div>
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
      <button id="addbtn" class="layui-btn" lay-submit lay-filter="formgo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
</div>

 
<script>

layui.use(['layer','form'], function(){
  var layer = layui.layer;
  var form = layui.form;


	form.on('submit(formgo)', function(data){
    $.ajax({
        url:"<?php echo url('admin/Powermanage/roleadd'); ?>",
        type:"POST",
        data:$('#addform').serialize(),
        success: function(bdata) {
            if(bdata == '200'){
              top.closebox();
              top.reloadpage();
            }
        }
    });

	  
	});
	

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

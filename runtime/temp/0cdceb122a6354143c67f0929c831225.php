<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy\WWW\tp5\public/../application/admin\view\sysmanage\add.html";i:1524587704;}*/ ?>

<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/font_eolqem241z66flxr.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/main.css" media="all" />

  <script type="text/javascript" src="https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K/r/www/cache/static/protocol/https/jquery/jquery-1.10.2.min_65682a2.js"></script>

  <script type="text/javascript" src="/static/admin/layui/layui.js"></script>

<div class="dialogbox">

<form class="layui-form" id="addform" onsubmit="return false;" action="<?php echo url('admin/Sysmanage/add'); ?>" method="post">

  <div class="layui-form-item">
    <label class="layui-form-label">变量名*</label>
    <div class="layui-input-inline">
      <input type="text" name="name" required  lay-verify="required" placeholder="请输入变量名" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">必填,变量名</div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">变量标识*</label>
    <div class="layui-input-inline">
      <input type="text" name="v_code" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">必填,变量标识</div>
  </div>


  <div class="layui-form-item">
    <label class="layui-form-label">状态*</label>
    <div class="layui-input-inline">
      <select name="status" lay-verify="required">
        <option value="1">正常</option>
        <option value="2">禁用</option>
      </select>
    </div>
    <div class="layui-form-mid layui-word-aux">必填</div>
  </div>

  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">变量值</label>
    <div class="layui-input-block" style="max-width:550px;">
      <textarea name="v_value" id="varcontent" style="display: none;" placeholder="请输入内容"></textarea>
    </div>
  </div>

  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">备注</label>
    <div class="layui-input-block" style="max-width:550px;">
      <textarea name="remark" placeholder="请输入内容"  class="layui-textarea"></textarea>
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

layui.use(['upload','layer','form','layedit'], function(){
  var upload = layui.upload;
  var layer = layui.layer;
  var form = layui.form;
  var layedit = layui.layedit;

  //编辑器图片上传
  layedit.set({
    uploadImage: {
      url: "<?php echo url('admin/Publicaction/eidtupload'); ?>", //接口url
      type: "post" //默认post
    }
  });

  var editorc = layedit.build('varcontent',{height:150}); //建立编辑器
  

	form.on('submit(formgo)', function(data){
    layedit.sync(editorc)
	  //$("#addform").submit();
    $.ajax({
      url:$("#addform").attr('action'),
      type:"POST",
      data:$("#addform").serialize(),
      async:false,
      success:function(bdata){
        var d = eval("("+bdata+")");
        if(d.code == 200){
          top.closebox();
          top.reloadpage();
        }else{
          layer.msg(d.msg);

        }
        
      },
      error:function(){}
    });
	  
	});
	
});
</script>

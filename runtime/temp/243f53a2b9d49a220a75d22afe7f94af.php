<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\tp5\public/../application/admin\view\usermanage\add.html";i:1524304697;}*/ ?>

<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/font_eolqem241z66flxr.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/main.css" media="all" />

  <script type="text/javascript" src="https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K/r/www/cache/static/protocol/https/jquery/jquery-1.10.2.min_65682a2.js"></script>

  <script type="text/javascript" src="/static/admin/layui/layui.js"></script>

<div class="dialogbox">

<form class="layui-form" id="addform" action="<?php echo url('admin/Usermanage/add'); ?>" method="post">

  <div class="layui-form-item">
    <label class="layui-form-label">账号*</label>
    <div class="layui-input-inline">
      <input type="text" name="account" required  lay-verify="required" placeholder="请输入账号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">必填,登录账号</div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">昵称</label>
    <div class="layui-input-inline">
      <input type="text" name="nickname" placeholder="请输入昵称" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">选填,默认与账号一致</div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码*</label>
    <div class="layui-input-inline">
      <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">必填,用户密码</div>
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
  <div class="layui-form-item">
    <label class="layui-form-label">头像</label>
    <div class="layui-input-inline">
      <button type="button" class="layui-btn layui-btn-primary" id="headimg">

      <i class="layui-icon">&#xe681;</i>上传图片
    </button>

    </div>
    <div class="layui-form-mid layui-word-aux">选填</div>
  </div>
  <div class="layui-form-item" id="handimgview">
    <label class="layui-form-label">头像预览</label>
    <div class="layui-input-inline"  style="border:1px solid #eee;width:113px;max-height:113px;">
      <img src="" id="handimgsrc" style="width:100%"/>
      <input type="hidden" id="inpheadimgsrc" name="head_img" value="" />  
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

layui.use(['upload','layer','form'], function(){
  var upload = layui.upload;
  var layer = layui.layer;
  var form = layui.form;

  
  
  //执行实例
  var uploadInst = upload.render({
    elem: '#headimg', //绑定元素
    url: "<?php echo url('admin/Publicaction/upload'); ?>", //上传接口
    done: function(res){
      //上传完毕回调
      if(res.code != '200'){
      	//图片上传失败
      	layer.msg(res.data,{icon:2,time:3000});
      }else{
      	//图片上传成功
      	$("#handimgview").css({"display":"block"});
      	$("#handimgsrc").attr('src',res.data.src);
      	$("#inpheadimgsrc").attr('value',res.data.src);
      }

    },
    error: function(){
      //请求异常回调
    }
  });


	form.on('submit(formgo)', function(data){
	  $("#addform").submit();
	  top.closebox();
	  top.reloadpage();
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

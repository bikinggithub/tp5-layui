<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy\WWW\tp5\public/../application/admin\view\powermanage\add.html";i:1527304664;}*/ ?>

<link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/font_eolqem241z66flxr.css" media="all" />
  <link rel="stylesheet" href="/static/admin/css/main.css" media="all" />

  <script type="text/javascript" src="https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K/r/www/cache/static/protocol/https/jquery/jquery-1.10.2.min_65682a2.js"></script>

  <script type="text/javascript" src="/static/admin/layui/layui.js"></script>
<div class="dialogbox">
    <form class="layui-form" id="addform" action="<?php echo url('admin/Powermanage/add'); ?>" method="post">

  <div class="layui-form-item">
    <label class="layui-form-label">上级菜单*</label>
    <div class="layui-input-inline">
      <select name="pid" lay-verify="required">
        <option value="0">一级菜单</option>
        <?php if(is_array($pidsarr) || $pidsarr instanceof \think\Collection || $pidsarr instanceof \think\Paginator): $i = 0; $__LIST__ = $pidsarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pids): $mod = ($i % 2 );++$i;if($pids['gradenum'] != '3'): ?>
            <option value="<?php echo $pids['id']; ?>"> <?php if($pids['gradenum'] != '1'): ?>|<?php endif; $__FOR_START_12933__=1;$__FOR_END_12933__=$pids['gradenum'];for($i=$__FOR_START_12933__;$i < $__FOR_END_12933__;$i+=1){ ?>--<?php } ?><?php echo $pids['name']; ?></option>
          <?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
    <div class="layui-form-mid layui-word-aux">必填</div>
  </div>
  

  <div class="layui-form-item">
    <label class="layui-form-label">菜单名称*</label>
    <div class="layui-input-inline">
      <input type="text" name="name" required  lay-verify="required" placeholder="请输入菜单名" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">必填,菜单名称</div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">模块名*</label>
    <div class="layui-input-inline">
      <input type="text" name="module_name" placeholder="请输入模块名" required  lay-verify="required"  value="admin" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">必填</div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">控制器名*</label>
    <div class="layui-input-inline">
      <input type="text" name="control_name" placeholder="请输入控制器" required  lay-verify="required" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">必填</div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">方法名*</label>
    <div class="layui-input-inline">
      <input type="text" name="method_name" placeholder="请输入方法名" required  lay-verify="required"   class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">必填</div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">是否显示*</label>
    <div class="layui-input-inline">
      <select name="is_show" lay-verify="required">
        <option value="1">显示</option>
        <option value="2">隐藏</option>
      </select>
    </div>
    <div class="layui-form-mid layui-word-aux">必填</div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">状态*</label>
    <div class="layui-input-inline">
      <select name="menues_status" lay-verify="required">
        <option value="1">正常</option>
        <option value="2">禁用</option>
      </select>
    </div>
    <div class="layui-form-mid layui-word-aux">必填</div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">菜单标识</label>
    <div class="layui-input-inline">
      <input type="text" name="markid" placeholder="请输入菜单标识" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">选填，不填写默认与方法名一致</div>
  </div>


  <div class="layui-form-item">
    <label class="layui-form-label">排序</label>
    <div class="layui-input-inline">
      <input type="text" name="sortnum"  placeholder="请输入排序" value="10" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">选填</div>
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

layui.use(['upload','layer','form'], function(){
  var upload = layui.upload;
  var layer = layui.layer;
  var form = layui.form;


	form.on('submit(formgo)', function(data){
	  //$("#addform").submit();
    $.ajax({
        url:"<?php echo url('admin/Powermanage/add'); ?>",
        type:"POST",
        data:$('#addform').serialize(),
        success: function(bdata) {
            if(bdata == 200){
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

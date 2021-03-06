<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy\WWW\tp5\public/../application/admin\view\userlogin\login.html";i:1527302888;}*/ ?>


<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

<meta charset="utf-8">
<title>后台系统管理</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- CSS -->

<link rel="stylesheet" href="/static/admin/css/supersized.css">
<link rel="stylesheet" href="/static/admin/css/login.css">
<link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="js/html5.js"></script>
<![endif]-->
<script>
var rootimgpath = "/static/admin/images/";
</script>
</head>

<body>

<div class="page-container">
  <div class="main_box">
    <div class="login_box">
      <div class="login_logo">
        <!-- <img src="/static/admin/images/logo.png" > -->
      </div>
    
      <div class="login_form">
        <form action="<?php echo url('admin/Userlogin/login'); ?>" id="login_form" method="post">
          <div class="form-group">
            <label for="j_username" class="t">账 号：</label> 
            <input id="account" value="<?php echo $username; ?>" name="account" type="text" class="form-control x319 in" 
            autocomplete="off">
          </div>
          <div class="form-group">
            <label for="j_password" class="t">密 码：</label> 
            <input id="password" value="" name="password" type="password" 
            class="password form-control x319 in">
          </div>
          <div class="form-group">
            <label for="checkcode" class="t">验证码：</label>
             <input id="checkcode" name="checkcode" type="text" class="form-control x164 in">
            <img src="<?php echo captcha_src(); ?>" title="点击更换" id="checkcodeimg" class="m" onclick="this.src=this.src+'?'"  alt="captcha" />
          </div>

          <div class="form-group">
            <label class="t"></label>
            <label for="rememberme" class="m">
            <input id="rememberme" name="rememberme" type="checkbox" checked>&nbsp;记住登陆账号!</label>
            <span class="errormsg" style="display:none;color:#ff0000;display:inline-block;margin-left:20px;"></span>
          </div>
          <div class="form-group space">
            <label class="t"></label>　　　
            <button type="button"  id="submit_btn" 
            class="btn btn-primary btn-lg">&nbsp;登&nbsp;录&nbsp </button>
            <input type="reset" value="&nbsp;重&nbsp;置&nbsp;" class="btn btn-default btn-lg">
          </div>
        </form>
      </div>
    </div>
    <div class="bottom">Copyright &copy; 2018 - 2025</div>
  </div>
</div>

<!-- Javascript -->

<script type="text/javascript" src="/static/admin/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="/static/admin/layui/layui.js"></script>
<script src="/static/admin/js/supersized.3.2.7.min.js"></script>
<script src="/static/admin/js/supersized-init.js"></script>

<script>
layui.use('layer', function(){
  var layer = layui.layer;
  // layer.msg('sss');
});


$("#submit_btn").click(function(){
    $(".errormsg").html('');
    $(".errormsg").hide();

    var account = $.trim($("#account").val());
    var password = $.trim($("#password").val());
    var checkcode = $.trim($("#checkcode").val());

    if(account == ''){
        $(".errormsg").html('账号不能为空');
        $(".errormsg").show();
        return false;
    }

    if(password == ''){
        $(".errormsg").html('密码不能为空');
        $(".errormsg").show();
        return false;
    }

    if(checkcode == ''){
        $(".errormsg").html('验证码不能为空');
        $(".errormsg").show();
        return false;
    }

    $.ajax({
      type:"POST",
      url:$("#login_form").attr('action'),
      data:$("#login_form").serialize(),
      async:true,
      success:function(bdata){
        var tmpd = eval("("+bdata+")");
        if(tmpd.code == 200){
          window.location.href="<?php echo url('admin/Index/index'); ?>";
          return;
        }else if(tmpd.code == 100){
          $("#checkcodeimg").attr('src',$("#checkcodeimg").attr('src')+'?');
        }
          $(".errormsg").html(tmpd.msg);
          $(".errormsg").show();
      },
      error:function(){}
    });

});

$("#login_form input").focus(function(){
    $(".errormsg").html('');
    $(".errormsg").hide();
});

$("body").keydown(function(){
  if(event.keyCode==13){
    //回车提交表单
    $("#submit_btn").click();
  }
});

</script>

</body>
</html>









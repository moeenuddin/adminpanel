<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="viewport" content = "width = device-width, initial-scale = 1, minimum-scale = 1, maximum-scale = 5" />
<title>HEALvetia Health Care</title>
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="apple-touch-icon-precomposed" href="<?=$this->config->base_url()?>assets2/images/icon.png"/>
<link rel="apple-touch-icon" href="<?=$this->config->base_url()?>assets2/images/icon.png"/>
<link href="<?=$this->config->base_url()?>assets2/stylesheets/base.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700,800' rel='stylesheet' type='text/css'>

<script src='<?=$this->config->base_url()?>js/jquery-1.7.2.js'></script>
<script src='<?=$this->config->base_url()?>js/validator.js'></script>
<script src='<?=$this->config->base_url()?>js/login.js'>

</script>
</head>
<body class="login-body">

<div id="login"><img src="<?=$this->config->base_url()?>assets2/images/login-screen-logo.png" alt="HEALvetia Health Care Logo" class="login_logo">
 <? if(isset($_GET['msg'])){?>
	<script>$("#UserMessage").show();
setTimeout(function() { $("#UserMessage").hide(); }, 5000);</script>
<? }

	if(@$_GET['error']==0){
?>
<div class="alert-success" style="text-align:center;" id="UserMessage" style="display:none;">
  <?=@$_GET['msg'];?>
</div>
<?  }else if($_GET['error']==1){?>
<div class="alert-error" style="text-align:center;" id="UserMessage" style="display:none;">
  <?=@$_GET['msg'];?>
</div>
<? } ?> 
  <form id="loginfrm" action="<?=$this->config->base_url()?>index.php/dashboard/signup/" method="post" onsubmit="$('BtnSave').disabled=true;">
    <input id="username" name="username" type="text" class="input_field" placeholder="Username">
    <input id="password" name="password" type="password" class="input_field" placeholder="Password">
    <label class="keepme">
    <input name="agree" type="radio" value="Keep me signed in." class="signedin">
    Keep me signed in.
    </label>
    <div class="clear"></div>
    <input id="BtnSave" name="BtnSave" type="submit" class="signin-btn" value="Sign in" onclick="return validateForm( );">
    <center><a href="#" class="forgotuserpass">Forgot Username or Password?</a></center>
  </form>
</div>
</body>
</html>
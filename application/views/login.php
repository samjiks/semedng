<html>
<head>
<title>SEMED: Login</title>
<link rel="stylesheet" href="<?php echo $site;?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo $site;?>/css/login.css">

</head>

<body style="margin-top:80px; background-color:#f5f5f5;">
<div class="container" style="width:900px">
	<?php if(isset($show)): ?>
		<div class="alert alert-error"><?php echo $message['invalid_login'];?> </div>
	<?php endif ?>
    <div class="row-fluid" style="margin-bottom:20px; text-align:center;"><img src="<?php echo $site;?>/images/welcome.png"/></div>
    <div class="row-fluid" style="border-bottom:1px #000 solid; height:5px; background-color:#000; margin-bottom:5px;">&nbsp;</div>
	<div class="row-fluid">
        <div class="span4">
        	<div style="margin-bottom:10px; text-align:center"><img src="<?php echo $site;?>/images/logo.png"/></div>
        	<div class="clearfix" id="login-content">
			<form action="" method="post">
				<fieldset>
					<div class="control-group">
						<label for="username" class="control-label">Username</label>
						<div class="controls">
							<input type="text" id="username" name="username" required>
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Password</label>
						<div class="controls">
							<input type="password" id="password" name="password" required>
						</div>
					</div>
				</fieldset>
				
				<div class="pull-left" id="remember-me">
					<input type="checkbox" id="remember" name="remember">
					<label for="remember" id="remember-label">Remember Me</label>
				</div>
				
				<div class="pull-right">
					<button class="btn btn-warning btn-large" type="submit" name="login">
						Login
					</button>
				</div>
    </form>
			<br>
<a style="display:none" href="<?php echo $site;?>/hmo/register">Sign Up</a>
  </div>
        </div>
        <div class="span8"><img src="<?php echo $site;?>/images/clipart.png"/></div>
  	</div>
    <div class="row-fluid" style="background-color:#000; color:#fff; padding:10px; margin-top:20px">
    	Copyright &copy; 2013. All rights reserved.
    
	</div>
</div> 

<script type="application/javascript" language="javascript" src="<?php echo $site?>/js/jquery-1.7.2.min.js"></script>
<script type="application/javascript" language="javascript" src="<?php echo $site?>/js/bootstrap.min.js"></script>

</body>
</html>
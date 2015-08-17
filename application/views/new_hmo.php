<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="<?php echo $site;?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo $site;?>/css/login.css">

</head>

<body style="margin-top:80px; background-color:#fff;">
<div class="container" style="width:900px">
 <div class="row-fluid" style="margin-bottom:20px; text-align:center;"><img src="<?php echo $site;?>/images/welcome.png"/></div>
    <div class="row-fluid" style="border-bottom:1px #000 solid; height:5px; background-color:#000; margin-bottom:5px;">&nbsp;</div>
<div class="row-fluid">
<?php if ($errors): ?>
<div class="alert alert-error"><?php echo $message['submit_error'];?>
<ul class="errors">
<?php foreach ($errors as $msg):if($msg!=''): ?>
	<li><?php echo $msg ?></li>
<?php endif; endforeach; ?>
</ul>
</div>
<?php endif ?>
<?php if(Cookie::get('msg')): Cookie::delete('msg');?>
<div class="alert alert-success"> <?php echo $message['sucess_msg'];?></div>
<?php endif;?>
<div class="span4">
        	<div style="margin-bottom:10px; text-align:center"><img src="<?php echo $site;?>/images/logo.png"/></div>
</div>
<div class="sapn8">
<form enctype="multipart/form-data" method="post" class="form-horizontal" id="form1">
	<fieldset>
		<!-- name -->
		<div class="control-group">
			<label class="control-label" for="name">HMO Name </label>
			<div class="controls">
<input placeholder="name" type="text" id="name" value="<?php if(isset($post['name']))echo Html::chars($post['name']);?>" name="name" required/>
		</div>
		</div>
        <div class="control-group">
			<label class="control-label" for="phoneno">Phone No </label>
			<div class="controls">
				<input type="text" id="phoneno" value="<?php if(isset($post['phoneno']))echo Html::chars($post['phoneno']);?>" name="phoneno"/>
		</div>
		</div>
        
         <div class="control-group">
			<label class="control-label" for="mobile">Mobile No </label>
			<div class="controls">
				<input type="text" id="mobile" value="<?php if(isset($post['mobile']))echo Html::chars($post['mobile']);?>" name="mobile"/>
		</div>
		</div>
                 <div class="control-group">
			<label class="control-label" for="address">Address </label>
			<div class="controls">
              <textarea name="address" id="address"><?php if(isset($post['address']))echo Html::chars($post['address']);?>
              </textarea>
		    </div>
		</div>
        


        <h4>Admin Contact Details/Login</h4><br />

        <div class="control-group">
			<label class="control-label" for="firstname">First Name </label>
			<div class="controls">
			<input placeholder="User First Name" type="text" id="name" value="<?php if(isset($post['firstname']))echo Html::chars($post['firstname']);?>" name="firstname" required/>
		</div>
		</div>
         <div class="control-group">
			<label class="control-label" for="middlename">Middle Name </label>
			<div class="controls">
			<input placeholder="User Middle Name" type="text" id="name" value="<?php if(isset($post['middlename']))echo Html::chars($post['middlename']);?>" name="middlename" required/>
		</div>
		</div>
        
         <div class="control-group">
			<label class="control-label" for="lastname">Last Name </label>
			<div class="controls">
			<input placeholder="User Lastname Name" type="text" id="name" value="<?php if(isset($post['lastname']))echo Html::chars($post['lastname']);?>" name="lastname" required/>
		</div>
		</div>
        
         <div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
			<input placeholder="User Email" type="text" id="name" value="<?php if(isset($post['email']))echo Html::chars($post['email']);?>" name="email" required/>
		</div>
		</div>
         <div class="control-group">
			<label class="control-label" for="password">Password </label>
			<div class="controls">
			<input type="password" id="name" value="<?php if(isset($post['password']))echo Html::chars($post['password']);?>" name="password" required/>
		</div>
		</div>
         <div class="control-group">
			<label class="control-label" for="password">Confirm Password </label>
			<div class="controls">
			<input type="password" id="name" value="<?php if(isset($post['copassword']))echo Html::chars($post['copassword']);?>" name="copassword" required/>
		</div>
		</div>
        
		<div class="control-group">
				<label>&nbsp;</label>
			<div class="controls">
				<input type="submit" value="Register" name="submit" class="btn" />
		</div>
		</div>
	</fieldset>
</form>
</div>
</div>
 <div class="row-fluid" style="background-color:#000; color:#fff; padding:10px; margin-top:20px">
    	Copyright &copy; 2013. All rights reserved.
    
	</div>
    <script type="application/javascript" language="javascript" src="<?php echo $site?>/js/jquery-1.7.2.min.js"></script>
<script type="application/javascript" language="javascript" src="<?php echo $site?>/js/bootstrap.min.js"></script>

</div>
</body>
</head>
<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"></i> Change Password</h3>
</div> 
<div class="widget-content">
<?php if ($errors): ?>
<p class="message"><?php echo $message['submit_error'];?> </p>
<ul class="alert alert-warning">
<?php foreach ($errors as $msg):if($msg!=''): ?>
	<li><?php echo $msg ?></li>
<?php endif; endforeach; ?>
</ul>
<?php endif ?>
<?php if(Cookie::get('msg')): ?>
<div class="alert alert-success"> <?php echo Cookie::get('msg');Cookie::delete('msg');?></div>
<?php endif;?>
<script>
function validate()
{
	if(document.getElementById("password").value!=document.getElementById("cpass").value)
	{
		alert('Password do not match');
		return true;
	}
}
</script>

<form enctype="multipart/form-data" method="post" name="" action="" class="myform" onsubmit="validate();">
        			<label for="oldpass">Current Password: </label>
<input type="password" id="oldpass" name="oldpass" />
		<div class="break"></div>
				<label for="password">New Password: </label>
<input type="password" id="password" name="password" />
		<div class="break"></div>
					<label for="cpass">Confirm Password: </label>
<input type="password" id="cpass" name="cpass" />
		<div class="break"></div>
        <label>&nbsp;</label>
				<input type="submit" value="<?php echo $btName;?>" name="submit" />
</form>
</div>
</div>
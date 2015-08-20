<div class="breadcrumb">
<ul>
    <li><a href="<?php echo $site?>">Home</a></li>
    <li><a href="#">Change Info</a></li>
</ul>
</div>

<?php if ($errors): ?>
<p class="message"><?php echo $message['submit_error'];?> </p>
<ul class="errors">
<?php foreach ($errors as $msg):if($msg!=''): ?>
	<li><?php echo $msg ?></li>
<?php endif; endforeach; ?>
</ul>
<?php endif ?>
<?php if(Cookie::get('msg')): Cookie::delete('msg');?>
<div class="sucessMsg"> <?php echo $message['sucess_msg'];?></div>
<?php endif;?>

<form enctype="multipart/form-data" method="post" name="" action="" class="myform">
				<label for="firstname">First Name: </label>
<input type="text" id="firstname" value="<?php if(isset($post['firstname']))echo Html::chars($post['firstname']);?>" name="firstname" />
		<div class="break"></div>
					<label for="middlename">Middle Name: </label>
<input type="text" id="middlename" value="<?php if(isset($post['middlename']))echo Html::chars($post['middlename']);?>" name="middlename" />
		<div class="break"></div>

					<label for="lastname">Last Name: </label>
<input type="text" id="lastname" value="<?php if(isset($post['lastname']))echo Html::chars($post['lastname']);?>" name="lastname" />
		<div class="break"></div>
        
				<label for="phoneno">Phone No: </label>
<input type="text" id="phoneno" value="<?php if(isset($post['phoneno']))echo Html::chars($post['phoneno']);?>" name="phoneno" />
		<div class="break"></div>
        <label> &nbsp;</label>
        <input type="submit" value="<?php echo $btName;?>" name="submit" />
</form>

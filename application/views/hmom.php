<div class="widget">
<div class="widget-header">
    <h3><i class="icon-plus-sign"></i> New HMO's</h3>
</div> 
<div class="widget-content">
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
			<input placeholder="User Middle Name" type="text" id="name" value="<?php if(isset($post['middlename']))echo Html::chars($post['middlename']);?>" name="middlename"/>
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
        <?php if(isset($_REQUEST['id'])):?>
        <div class="control-group">
       <label> <input type="checkbox" name="update_password" value="1"/> Update Password</label>
       </div>
        <?php endif;?>
         <div class="control-group">
			<label class="control-label" for="password">Password </label>
			<div class="controls">
			<input type="password" id="name"  name="password"/>
		</div>
		</div>
         <div class="control-group">
			<label class="control-label" for="password">Confirm Password </label>
			<div class="controls">
			<input type="password" id="name" name="copassword"/>
		</div>
		</div>
        
		<div class="control-group">
				<label>&nbsp;</label>
			<div class="controls">
				<input type="hidden" id="id" value="<?php if(isset($_REQUEST['id']))echo Html::chars($_REQUEST['id']);?>" name="id" />
				<input type="submit" value="<?php echo $btName;?>" name="submit" class="btn" />
		</div>
		</div>
	</fieldset>
</form>
</div>
</div>
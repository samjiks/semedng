<div class="widget">
<div class="widget-header">
    <h3><i class="icon-plus-add"></i> Create new consultant</h3>
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
			<input placeholder="User Lastname Name" type="text" id="name" value="<?php if(isset($post['lastname']))echo Html::chars($post['lastname']);?>" name="lastname"/>
			</div>
		</div>
         <div class="control-group">
          <label class="control-label" for="provider">Unit </label>
            <div class="controls">
              <select name="unit" required>
                <option value="">--Select--</option>
                <?php if(isset($units)): foreach($units as $s):?>
                    <option value="<?php echo $s['id']?>" <?php if(isset($post["unit"]) AND $post["unit"]==$s["id"])echo 'selected="selected"';?>><?php echo $s['name']?></option>
                <?php endforeach; endif;?>
              </select>
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
				<input type="submit" value="<?php echo $btName;?>" name="submit" class="btn" />
		</div>
		</div>
	</fieldset>
</form>
</div>
</div>
<div class="widget">
<div class="widget-header">
    <h3><i class="icon-plus-sign"></i> Register New Patient</h3>
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
		<!-- hospitalno -->
		<div class="control-group">
			<label class="control-label" for="hospitalno">Hospital No </label>
			<div class="controls">
<input placeholder="hospitalno" type="text" id="hospitalno" value="<?php if(isset($post['hospitalno']))echo Html::chars($post['hospitalno']);?>" name="hospitalno"/>
		</div>
		</div>
		<!-- surname -->
		<div class="control-group">
			<label class="control-label" for="surname">Surname </label>
			<div class="controls">
<input placeholder="surname" type="text" id="surname" value="<?php if(isset($post['surname']))echo Html::chars($post['surname']);?>" name="surname" required/>
		</div>
		</div>
		<!-- othernames -->
		<div class="control-group">
			<label class="control-label" for="othernames">Other Names </label>
			<div class="controls">
<input placeholder="othernames" type="text" id="othernames" value="<?php if(isset($post['othernames']))echo Html::chars($post['othernames']);?>" name="othernames" required/>
		</div>
		</div>
		<!-- gender -->
		<div class="control-group">
			<label class="control-label" for="gender">Gender </label>
			<div class="controls">
            	<select name="gender">
                	<option value="">--Select--</option>
                    <?php foreach($gender as $g):?>
                    	<option <?php if(isset($post['gender']) AND $post['gender']==$g) echo 'selected="selected"'?>><?php echo $g;?></option>
                    <?php endforeach;?>
                </select>
			</div>
		</div>
		<!-- phoneno -->
		<div class="control-group">
			<label class="control-label" for="phoneno">Phone No </label>
			<div class="controls">
<input placeholder="phoneno" type="text" id="phoneno" value="<?php if(isset($post['phoneno']))echo Html::chars($post['phoneno']);?>" name="phoneno" required/>
		</div>
		</div>
		<!-- email -->
		<div class="control-group">
			<label class="control-label" for="email">Email </label>
			<div class="controls">
<input placeholder="email" type="text" id="email" value="<?php if(isset($post['email']))echo Html::chars($post['email']);?>" name="email"/>
		</div>
		</div>
		<!-- address -->
		<div class="control-group">
			<label class="control-label" for="address">Address </label>
			<div class="controls">
              <textarea name="address" id="address" placeholder="address" required="required"><?php if(isset($post['address']))echo Html::chars($post['address']);?>
              </textarea>
	      </div>
		</div>
		<!-- nhisno -->
		<div class="control-group">
			<label class="control-label" for="nhisno">NHIS NO </label>
			<div class="controls">
<input placeholder="NHIS No" type="text" id="nhisno" value="<?php if(isset($post['nhisno']))echo Html::chars($post['nhisno']);?>" name="nhisno"/>
		</div>
		</div>
		<!-- hmono -->
		<div class="control-group">
			<label class="control-label" for="hmono">HMO NO </label>
			<div class="controls">
<input placeholder="HMO No" type="text" id="hmono" value="<?php if(isset($post['hmono']))echo Html::chars($post['hmono']);?>" name="hmono"/>
		</div>
		</div>
		<!-- hmono -->
		<div class="control-group">
			<label class="control-label" for="dob">Date of Birth </label>
			<div class="controls">
				<input placeholder="Date of Birth" type="date" id="dob" value="<?php if(isset($post['dob']))echo Html::chars($post['dob']);?>" name="dob" data-date-format="yyyy/mm/dd" class="datepicker"/>
			</div>
		</div>
		<div class="control-group">
				<label>&nbsp;</label>
			<div class="controls">
<input type="hidden" id="id" value="<?php if(isset($_REQUEST['id']))echo Html::chars($_REQUEST['id']);?>" name="id" />
				<input type="submit" value="<?php echo $btName;?>" name="submit" class="btn btn-danger" />
		</div>
		</div>
	</fieldset>
</form>

</div>
</div>
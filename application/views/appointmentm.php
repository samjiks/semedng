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
		<!-- patientid -->
		<div class="control-group">
			<label class="control-label" for="patientid">patientid </label>
			<div class="controls">
<input placeholder="patientid" type="text" id="patientid" value="<?php if(isset($post['patientid']))echo Html::chars($post['patientid']);?>" name="patientid" required/>
		</div>
		</div>
		<!-- doctorid -->
		<div class="control-group">
			<label class="control-label" for="doctorid">doctorid </label>
			<div class="controls">
<input placeholder="doctorid" type="text" id="doctorid" value="<?php if(isset($post['doctorid']))echo Html::chars($post['doctorid']);?>" name="doctorid" required/>
		</div>
		</div>
		<!-- date -->
		<div class="control-group">
			<label class="control-label" for="date">date </label>
			<div class="controls">
<input placeholder="date" type="text" id="date" value="<?php if(isset($post['date']))echo Html::chars($post['date']);?>" name="date" required/>
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

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
		<!-- proposedstartdate -->
		<div class="control-group">
			<label class="control-label" for="proposedstartdate">proposedstartdate </label>
			<div class="controls">
<input placeholder="proposedstartdate" type="text" id="proposedstartdate" value="<?php if(isset($post['proposedstartdate']))echo Html::chars($post['proposedstartdate']);?>" name="proposedstartdate" required/>
		</div>
		</div>
		<!-- proposedenddate -->
		<div class="control-group">
			<label class="control-label" for="proposedenddate">proposedenddate </label>
			<div class="controls">
<input placeholder="proposedenddate" type="text" id="proposedenddate" value="<?php if(isset($post['proposedenddate']))echo Html::chars($post['proposedenddate']);?>" name="proposedenddate" required/>
		</div>
		</div>
		<!-- userid -->
		<div class="control-group">
			<label class="control-label" for="userid">userid </label>
			<div class="controls">
<input placeholder="userid" type="text" id="userid" value="<?php if(isset($post['userid']))echo Html::chars($post['userid']);?>" name="userid" required/>
		</div>
		</div>
		<!-- authorisationcode -->
		<div class="control-group">
			<label class="control-label" for="authorisationcode">authorisationcode </label>
			<div class="controls">
<input placeholder="authorisationcode" type="text" id="authorisationcode" value="<?php if(isset($post['authorisationcode']))echo Html::chars($post['authorisationcode']);?>" name="authorisationcode" required/>
		</div>
		</div>
		<!-- approvalstatus -->
		<div class="control-group">
			<label class="control-label" for="approvalstatus">approvalstatus </label>
			<div class="controls">
<input placeholder="approvalstatus" type="text" id="approvalstatus" value="<?php if(isset($post['approvalstatus']))echo Html::chars($post['approvalstatus']);?>" name="approvalstatus" required/>
		</div>
		</div>
		<!-- refferedclinic -->
		<div class="control-group">
			<label class="control-label" for="refferedclinic">refferedclinic </label>
			<div class="controls">
<input placeholder="refferedclinic" type="text" id="refferedclinic" value="<?php if(isset($post['refferedclinic']))echo Html::chars($post['refferedclinic']);?>" name="refferedclinic" required/>
		</div>
		</div>
		<!-- investigationform -->
		<div class="control-group">
			<label class="control-label" for="investigationform">investigationform </label>
			<div class="controls">
<input placeholder="investigationform" type="text" id="investigationform" value="<?php if(isset($post['investigationform']))echo Html::chars($post['investigationform']);?>" name="investigationform" required/>
		</div>
		</div>
		<!-- drugform -->
		<div class="control-group">
			<label class="control-label" for="drugform">drugform </label>
			<div class="controls">
<input placeholder="drugform" type="text" id="drugform" value="<?php if(isset($post['drugform']))echo Html::chars($post['drugform']);?>" name="drugform" required/>
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

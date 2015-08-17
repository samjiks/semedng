<div class="widget">
<div class="widget-header">
    <h3><i class="icon-plus-sign"></i> Add new Provider</h3>
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
			<label class="control-label" for="name">Unit Name </label>
			<div class="controls">
<input placeholder="name" type="text" id="name" value="<?php if(isset($post['name']))echo Html::chars($post['name']);?>" name="name" required/>
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

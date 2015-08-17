<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"> </i> Diagnosis Costing</h3>
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
<a class="btn btn-link" href="<?php echo $site?>/patient/details?pid=<?php if(is_array($patient))echo $patient['id'];?>">Go to <?php if(is_array($patient))echo $patient['surname']." ".$patient['othernames'];?> menu</a>
<form enctype="multipart/form-data" method="post" class="form-horizontal" id="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table table-stripped">
  <tr>
    <th width="34%">Treatment</th>
    <th width="46%">Diagnosis</th>
    <th width="3%">Cost</th>
    </tr>
  <?php $me=Model::factory('technicianmd')->SelectByUser($user->id);
  	if(count($treatments)>0): foreach($treatments as $t):
 	 $diagnosis=Model::factory('patientdiagnosismd')->SelectByTreatment($t['id']);if($me['id']!=$t['consultant'])continue;
  ?>
  <tr>
    <td><?php echo $t['treatment'];?></td>
    <td><textarea readonly="readonly" name="diagnosis<?php echo $t['id'];?>" id="diagnosis" placeholder="diagnosis" required="required" style="width:100%; height:40px;"><?php if(is_array($diagnosis)) echo $diagnosis['diagnosis'];?></textarea></td>
    <td><input name="cost<?php echo $t['id'];?>" type="text" id="diagnosis" size="14" placeholder="cost" style="width:90px" required value="<?php if(is_array($diagnosis)) echo $diagnosis['cost'];?>" <?php if(!is_array($diagnosis))echo 'disabled="disabled"'; ?>/></td>
    </tr>
  <?php endforeach; endif;?>
</table>

		<div class="control-group">
	    <label>&nbsp;</label>
			<div class="controls">
<input type="hidden" id="id" value="<?php if(isset($_REQUEST['id']))echo Html::chars($_REQUEST['id']);?>" name="id" />
                <input type="submit" value="Approve and submit costing" name="submit" class="btn btn-danger" />
		</div>
</div>
	</fieldset>


</form>
</div>
</div>
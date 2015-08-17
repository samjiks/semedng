
<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"> </i> Treatment Diagnosis</h3>
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
    <th width="46%">Result</th>
    <th width="3%">Cost</th>
    <th width="17%">&nbsp;</th>
    <th width="17%">&nbsp;</th>
  </tr>
  <?php $me=Model::factory('technicianmd')->SelectByUser($user->id);if(count($treatments)>0): foreach($treatments as $t): if($me['id']!=$t['consultant'] AND Auth::instance()->logged_in("technician"))continue;
 	 $diagnosis=Model::factory('patientdiagnosismd')->SelectByTreatment($t['id']);
  ?>
  <tr>
    <td><?php echo $t['treatment'];?></td>
    <td>
    <?php if(Auth::instance()->logged_in("consultant")):?>
    	<?php if(is_array($diagnosis)) echo $diagnosis['diagnosis'];?>
    <?php else:?>
    <textarea <?php if(is_array($diagnosis) AND $diagnosis['locked']==1)echo 'disabled="disabled"'; ?> name="diagnosis<?php echo $t['id'];?>" id="diagnosis" placeholder="diagnosis" required="required" style="width:100%; height:40px;"><?php if(is_array($diagnosis)) echo $diagnosis['diagnosis'];?></textarea>
    <?php endif;?>
    </td>
    <td><input name="cost<?php echo $t['id'];?>" type="text" id="diagnosis" size="14" placeholder="cost" style="width:90px" required value="<?php if(is_array($diagnosis)) echo $diagnosis['cost'];?>" <?php if(is_array($diagnosis) AND $diagnosis['locked']==1)echo 'disabled="disabled"'; ?>/></td>
    <td title="Attach any supporting document"> <?php if(is_array($diagnosis) AND $diagnosis['locked']==1): ?>file locked<?php else:?><input name="attachment<?php echo $t['id'];?>" type="file" /><?php endif;?>
    
    </td>
    <td><?php $diagnosis=Model::factory('patientdiagnosismd')->SelectByTreatment($t['id']); if(is_array($diagnosis) AND $diagnosis['attachment']!=""):?>
                     <a href="<?php echo $site."/".$diagnosis['attachment']?>" class="btn btn-danger" rel="prettyPhoto[gallery1]" target="_blank">view attached file</a>
                     <img src="<?php echo $site."/".$diagnosis['attachment']?>" style="height:80px; width:80px" />
    <?php endif;?></td>
  </tr>
  <?php endforeach; endif;?>
</table>

		<div class="control-group">
	    <label>&nbsp;</label>
			<div class="controls">
<input type="hidden" id="id" value="<?php if(isset($_REQUEST['id']))echo Html::chars($_REQUEST['id']);?>" name="id" />
				<?php if(Auth::instance()->logged_in("technician")):?>
               <input type="submit" value="<?php echo $btName;?>" name="submit" class="btn btn-danger" /> <?php endif;?>
		</div>
</div>

	</fieldset>


</form>
</div>
</div>
<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"> </i> Other Details for <?php echo $patient['surname']." ".$patient['othernames']?></h3>
</div> 
<div class="widget-content">
<style>
textarea{ width:100%; height:80px;}
</style>
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
<div class="row-fluid">
<div class="span4">
<h2>Patient Details</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table table-stripped">
         <tr>
          <th>NHIS No</th>
          <td><?php echo $patient['nhisno'];?></td>
        </tr>
         <tr>
           <th>HMO</th>
           <td><?php $hmo=Model::factory('hmomd')->SelectById($patient['hmoid']); if(is_array($hmo)) echo $hmo['name'];?>&nbsp;</td>
         </tr>
        <tr>
          <th>Surname</th>
          <td><?php echo $patient['surname'];?></td>
        </tr>
        <tr>
          <th>Other Names</th>
          <td><?php echo $patient['othernames'];?></td>
        </tr>
        <tr>
          <th>Gender</th>
          <td><?php echo $patient['gender'];?></td>
        </tr>
      </table>
</div>
<div class="span8">
<h2>Other Details</h2>
<form enctype="multipart/form-data" method="post" class="form-vertical" id="form1">
		<!-- proposedstartdate -->
		<div class="control-group">
			<label class="control-label" for="clicnicinformation">Brief History of Complaints & Major Physical Findings</label>
			<div class="controls">
              <textarea name="clicnicinformation" id="clicnicinformation" required="required"><?php if(isset($treatmentcycle['clicnicinformation']))echo html_entity_decode($treatmentcycle['clicnicinformation']);?>
              </textarea>
	      </div>
		</div>

		<!-- complications -->
		<div class="control-group">
			<label class="control-label" for="complications">Complications </label>
			<div class="controls">
              <textarea name="complications" id="complications"><?php if(isset($treatmentcycle['complications']))echo html_entity_decode($treatmentcycle['complications']);?>
              </textarea>
	      </div>
		</div>
		<!-- complications -->
		<div class="control-group">
			<label class="control-label" for="surgicaloperations">Surgical Operations, Minor/Major</label>
			<div class="controls">
              <input name="surgicaloperations" type="text" id="surgicaloperations" value="<?php if(isset($treatmentcycle['surgicaloperations']))echo html_entity_decode($treatmentcycle['surgicaloperations']);?>
              " />
	        </div>
		</div>

		<!-- indicationforsurgery -->
		<div class="control-group">
			<label class="control-label" for="indicationforsurgery">Indication for Surgery </label>
			<div class="controls">
              <textarea name="indicationforsurgery2" id="indicationforsurgery2"><?php if(isset($treatmentcycle['indicationforsurgery2']))echo html_entity_decode($treatmentcycle['indicationforsurgery2']);?>
              </textarea>
	      </div>
		</div>
        
		<!-- conditionondischarge -->
		<div class="control-group">
			<label class="control-label" for="conditionondischarge">Condition on Discharge </label>
			<div class="controls">
              <textarea name="conditionondischarge" id="conditionondischarge" required="required"><?php if(isset($treatmentcycle['conditionondischarge']))echo html_entity_decode($treatmentcycle['conditionondischarge']);?>
              </textarea>
	      </div>
		</div>
        
		<!-- nextappointment -->
		<div class="control-group">
			<label class="control-label" for="nextappointment">Appointment for FollowUp</label>
			<div class="controls">
<input placeholder="Next Appointment Date" type="text" id="date" value="<?php if(isset($post['nextappointment']))echo Html::chars($post['nextappointment']);?>" name="nextappointment" required data-date-format="yyyy-mm-dd" class="datepicker"/>	      </div>
		</div>

		<div class="control-group">
	    <label>&nbsp;</label>
			<div class="controls">
				<input type="submit" value="Submit" name="submit" class="btn btn-danger" />
			</div>
		</div>
 </form> 
 </div>
 </div>

</div>
</div>
<script type="application/javascript" language="javascript" src="<?php echo $site?>/media/js/tim/tiny_mce.js"></script>
  <?php include Kohana::find_file("views","jref");?>
  <link rel="stylesheet" href="<?php echo $site?>/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="<?php echo $site?>/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<div class="widget">

<div class="widget-header">
    <h3><i class="icon-list"> </i> Fill investigation form and drug form</h3>
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
      </table><br />
<h2>Investigative Results</h2>
<form enctype="multipart/form-data" method="post" class="form-vertical" id="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table table-stripped">
  <tr>
    <th width="34%">Treatment</th>
    <th width="46%">Diagnosis</th>
    <th width="46%">Attached File</th>
    <th width="3%">Cost</th>
    </tr>
  <?php if(count($treatments)>0): foreach($treatments as $t):
 	 $diagnosis=Model::factory('patientdiagnosismd')->SelectByTreatment($t['id']);
  ?>
  <tr>
    <td><?php echo $t['treatment'];?></td>
    <td><?php if(is_array($diagnosis)) echo $diagnosis['diagnosis'];?></td>
    <td>
    <?php if(is_array($diagnosis) AND $diagnosis['attachment']!=""):?>
                     <a href="<?php echo $site."/".$diagnosis['attachment']?>" rel="prettyPhoto[gallery1]" target="_blank">view</a>
    <?php endif;?>
    </td>
    <td><?php if(is_array($diagnosis)) echo $diagnosis['cost'];?></td>
    </tr>
  <?php endforeach; endif;?>
</table>

<h2>Definitive Diagnosis</h2>
		<!-- proposedstartdate -->
		<div class="control-group">
			<label class="control-label" for="investigationform">&nbsp;</label>
			<div class="controls">
              <textarea name="investigationform" id="investigationform" required="required"><?php if(isset($treatmentcycle['investigationform']))echo html_entity_decode($treatmentcycle['investigationform']);?>
              </textarea>
	      </div>
		</div>
<h2>Treatment</h2>
		<div class="control-group">
			<label class="control-label" for="drugform">&nbsp; </label>
			<div class="controls">
              <textarea name="drugform" id="drugform" required="required"><?php if(isset($treatmentcycle['drugform']))echo html_entity_decode($treatmentcycle['drugform']);?>
              </textarea>
	      </div>
		</div>

		<div class="control-group">
	    <label>&nbsp;</label>
			<div class="controls">
				<input type="submit" value="Submit" name="submit" class="btn btn-danger" />
		</div>
</div>
	</fieldset>


</form>
</div>
</div>
<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:3000, autoplay_slideshow: true,social_tools:false});
			$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:20000, hideflash: true});
		});
</script>
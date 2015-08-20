<script>
$(document).ready(function()
{
	$(".table #delete").click(function() {
		if(confirm('<?php echo $message['confirm_delete'];?>')){
			var img = $(this);
			var jqxhr=$.get("<?php echo $site?>/treatmentcycle/del_treatment?what=del&id="+$(this).attr("data"),function(response, status, xhr){
				$("#delMsg").show();img.parents("tr").fadeOut();
			});
		}
	});
});
</script>
<div class="widget">
<div class="widget-header">
    <h3><i class="icon-user-md"></i> Refer <?php if(is_array($patient))echo $patient['surname']." ".$patient['othernames'];?> to consultant for treatment</h3>
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
<div class="row-fluid">

<div class="span4">
<form enctype="multipart/form-data" method="post" class="form-vertical" id="form1">
	<fieldset>
		<!-- patientid -->
		<div class="control-group">
			<label class="control-label" for="patientid">Date </label>
			<div class="controls">
<input placeholder="Date" type="text" id="date" value="<?php if(isset($post['date']))echo Html::chars($post['date']);?>" name="date" required  data-date-format="yyyy/mm/dd" class="datepicker"/>
		</div>
		</div>
		<!-- proposedstartdate -->
		<div class="control-group">
			<label class="control-label" for="treatment">Treatment </label>
			<div class="controls">
              <textarea name="treatment" id="treatment" required><?php if(isset($post['treatment']))echo Html::chars($post['treatment']);?>
              </textarea>
	      </div>
		</div>
        <div class="control-group">
          <label class="control-label" for="provider">Unit </label>
            <div class="controls">
              <select name="provider" required>
                <option value="">--Select--</option>
                <?php if(isset($shp)): foreach($shp as $s):?>
                    <option value="<?php echo $s['id']?>" <?php if(isset($post["provider"]) AND $post["provider"]==$s["id"])echo 'selected="selected"';?>><?php echo $s['name']?></option>
                <?php endforeach; endif;?>
              </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="consultant">Technician </label>
            <div class="controls">
              <select name="consultant" required>
                <option value="">--Select--</option>
                <?php if(isset($technicians)): foreach($technicians as $s): ?>
                    <option value="<?php echo $s['id']?>" <?php if(isset($post["consultant"]) AND $post["consultant"]==$s["id"])echo 'selected="selected"';?>><?php echo $s['names']?></option>
                <?php endforeach; endif;?>
              </select>
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
<div class="span8">
<blockquote>
	<table border="0" cellspacing="0" cellpadding="5" class="table">
		 <thead>
		<tr>
			<th>
		 Date</th>
			<th>
		  Treatment</th>
			<th>
			  Provider</th>
			<th>From</th>
			<th>Technician</th>
              <?php if(Auth::instance()->logged_in("nhis")):?>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
            <?php endif;?>
		</tr>
			 </thead>
					<?php if(count($list)>0):foreach($list as $l):?>
		 <tbody>
		<tr>
				<td><?php echo $l['date'];?></td>
				<td><?php echo $l['treatment'];?></td>
				<td><?php echo $l['provider'];?></td>
				<td><?php $user=Model::factory('usermd')->SelectById($l['userid']);if(is_array($user))echo $user['firstname']." ".$user['lastname'];?></td>
				<td><?php echo $l['names'];?></td>
                <?php if(Auth::instance()->logged_in("nhis")):?>
				<td><a href="<?php echo $site?>/treatmentcycle/treatment/<?php echo $patient['id']?>?id=<?php echo $l['id'];?>" class="label label-info"><i class="icon-edit"></i> edit</a></td>
				<td><a id="delete" data="<?php echo $l['id'];?>" href="#" class="label label-error"><i class="icon-trash"></i> delete</a></td>
                <?php endif;?>
		</tr>
		 </tbody>
		<?php endforeach;endif; ?>

	</table>
</blockquote>
</div>
</div>

</div>
</div>
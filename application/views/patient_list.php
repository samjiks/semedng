<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"></i> Patients List</h3>
</div> 
<div class="widget-content">
<?php if(isset($hmos)):?>
<form action="" method="get">
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table">
  <tr>
    <td width="12%"> Select HMO</td>
    <td width="12%">
    <select name="hmo">
    <option value="">--Select HMO--</option>
    <?php foreach($hmos as $h):?>
    	<option value="<?php echo $h['id']?>" <?php if(isset($_REQUEST['hmo']) AND $_REQUEST['hmo']==$h['id']) echo 'selected="selected"'?>><?php echo $h['name'];?></option>
    <?php endforeach;?>
    </select>
    </td>
    <td width="72%"> <input type="submit" value="Submit" name="submit" class="btn btn-danger" />&nbsp;</td>
    <td width="4%">&nbsp;</td>
  </tr>
</table>

</form>

<?php endif;?>
<?php 
				if(isset($paging) AND $paging->render()!=" "  AND $paging->render()!=""):?>
					<div class="render"><?php echo $paging->render(); ?></div>
				<?php endif ?>
<a href="#" class="btn btn-warning pull-right">Printable</a>
	<table border="0" cellspacing="0" cellpadding="5" class="table">
		 <thead>
		<tr>
			<th>
		  Hospital No</th>
			<th>
		  Surname</th>
			<th>
Othernames</th>
			<th>
Gender</th>
			<th>
PhoneNo</th>
			<th>
Email</th>
			<th>
Address</th>
			<th>
NHIS No</th>
			<th>HMO No</th>
			<th>&nbsp;</th>
		</tr>
			 </thead>
					<?php if(count($list)>0):foreach($list as $l):?>
		 <tbody>
		<tr>
				<td><?php echo $l['hospitalno'];?></td>
				<td><?php echo $l['surname'];?></td>
				<td><?php echo $l['othernames'];?></td>
				<td><?php echo $l['gender'];?></td>
				<td><?php echo $l['phoneno'];?></td>
				<td><?php echo $l['email'];?></td>
				<td><?php echo $l['address'];?></td>
				<td><?php echo $l['nhisno'];?></td>
				<td><?php echo $l['hmono'];?></td>
				<td><a href="<?php echo $site?>/patient/details/<?php echo $l['id'];?>" class="label label-warning">details</a></td>
		</tr>
		 </tbody>
		<?php endforeach;endif; ?>

	</table>

		<?php if(count($list)<=0): ?>
<div class="alert alert-info"> <?php echo $message['not_found'];?> </div>
		<?php endif; ?>
</div>
</div>
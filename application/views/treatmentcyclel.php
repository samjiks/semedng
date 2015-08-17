<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"></i> Patient</h3>
</div> 
<div class="widget-content">
<form action="" method="get">
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table">
  <tr>
    <td width="12%"> <input placeholder="From" type="text" id="date" name="from" required data-date-format="yyyy-mm-dd" class="datepicker" value="<?php if(isset($_REQUEST['from'])) echo $_REQUEST["from"];?>"/></td>
    <td width="12%"><input placeholder="To" type="text" id="date" name="to" required data-date-format="yyyy-mm-dd" class="datepicker" value="<?php if(isset($_REQUEST['to'])) echo $_REQUEST["to"];?>"/></td>
    <td width="72%">  <select name="h">
    <option value="">--Select HMO--</option>
    <?php foreach($hmos as $h):?>
    	<option value="<?php echo $h['id']?>" <?php if(isset($_GET['h']) AND $_GET['h']==$h['id']) echo 'selected="selected"';?>><?php echo $h['name'];?></option>
    <?php endforeach;?>
    </select>&nbsp;</td>
    <td width="4%"><input type="submit" value="Submit" name="submit" class="btn btn-danger" />&nbsp;</td>
  </tr>
</table>

</form>

<?php 
				if(isset($paging) AND $paging->render()!=" "  AND $paging->render()!=""):?>
					<div class="render"><?php echo $paging->render(); ?></div>
				<?php endif ?>
				<div id="delMsg" class="alert alert-success">
				<?php echo $message['deleted'];?>
				</div>
	<table border="0" cellspacing="0" cellpadding="5" class="table">
		 <thead>
		<tr>
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
			<th>&nbsp;</th>
		</tr>
			 </thead>
					<?php if(count($list)>0):foreach($list as $l):?>
		 <tbody>
		<tr>
				<td><?php echo $l['surname'];?></td>
				<td><?php echo $l['othernames'];?></td>
				<td><?php echo $l['gender'];?></td>
				<td><?php echo $l['phoneno'];?></td>
				<td><?php echo $l['email'];?></td>
				<td><?php echo $l['address'];?></td>
				<td><?php echo $l['nhisno'];?></td>
				<td><?php echo $l['hmono'];?></td>
				<td><a href="<?php echo $site?>/patient/details/<?php echo $l['patientid'];?>" class="label label-warning">details</a>&nbsp;</td>
				<td><?php if($l['elapsed']==1):?><a href="<?php echo $site?>/patient/discharge_summary/<?php echo $l['patientid'];?>" target="_blank" class="label label-info"><i class="icon-file"></i> discharge summary </a><?php endif;?></td>
		</tr>
		 </tbody>
		<?php endforeach;endif; ?>

	</table>

		<?php if(count($list)<=0): ?>
<div class="alert alert-info"> <?php echo $message['not_found'];?> </div>
		<?php endif; ?>
</div>
</div>
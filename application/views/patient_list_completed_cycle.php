<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"></i> Completed 21 days cycle</h3>
</div> 
<div class="widget-content">
<?php 
				if(isset($paging) AND $paging->render()!=" "  AND $paging->render()!=""):?>
					<div class="render"><?php echo $paging->render(); ?></div>
				<?php endif ?>

<a href="#" class="btn btn-warning">Printable</a>
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
				<td><a href="<?php echo $site?>/patient/discharge_summary/<?php echo $l['id'];?>" target="_blank"><i class="icon-file"></i> Discharge Summary </a></td>
		</tr>
		 </tbody>
		<?php endforeach;endif; ?>

	</table>

		<?php if(count($list)<=0): ?>
<div class="alert alert-info"> <?php echo $message['not_found'];?> </div>
		<?php endif; ?>
</div>
</div>
<script>
$(document).ready(function()
{
	$(".table #delete").click(function() {
		if(confirm('<?php echo $message['confirm_delete'];?>')){
			var img = $(this);
			var jqxhr=$.get("<?php echo $site?>/patientdiagnosis/del?what=del&id="+$(this).attr("data"),function(response, status, xhr){
				$("#delMsg").show();img.parents("tr").fadeOut();
			});
		}
	});
	$(".table #edit").click(function() {
		var item = $(this);
		var jqxhr=$.get($(this).attr("url"),function(response, status, xhr){
			 $("#mypage").html(response);
		 });
	 });
});
</script>
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
PatientID</th>
			<th>
Date</th>
			<th>
Diagnosis</th>
			<th>
UserID</th>
			<th>
Provider</th>
			<th>
TreatmentCycle</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
			 </thead>
					<?php if(count($list)>0):foreach($list as $l):?>
		 <tbody>
		<tr>
				<td><?php echo $l['patientid'];?></td>
				<td><?php echo $l['date'];?></td>
				<td><?php echo $l['diagnosis'];?></td>
				<td><?php echo $l['userid'];?></td>
				<td><?php echo $l['provider'];?></td>
				<td><?php echo $l['treatmentcycle'];?></td>
				<td><a href="<?php echo $site?>/patientdiagnosis?id=<?php echo $l['id'];?>" class="label label-info"><i class="icon-edit"></i> edit</a></td>
				<td><a id="delete" data="<?php echo $l['id'];?>" href="#" class="label label-error"><i class="icon-trash"></i> delete</a></td>
		</tr>
		 </tbody>
		<?php endforeach;endif; ?>

	</table>

		<?php if(count($list)<=0): ?>
		<div class="alert alert-info"> <?php echo $message['not_found'];?> </div>
		<?php endif; ?>

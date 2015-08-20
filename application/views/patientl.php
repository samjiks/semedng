<script>
$(document).ready(function()
{
	$(".table #delete").click(function() {
		if(confirm('<?php echo $message['confirm_delete'];?>')){
			var img = $(this);
			var jqxhr=$.get("<?php echo $site?>/patient/del?what=del&id="+$(this).attr("data"),function(response, status, xhr){
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
<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"></i> List of Registered Patients</h3>
</div> 
<div class="widget-content">
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
			<th>&nbsp;</th>
		</tr>
			 </thead>
					<?php if(count($list)>0):foreach($list as $l):?>
		 <tbody>
		<tr>
				<td><?php echo $l['surname'];?> <?php echo $l['othernames'];?></td>
				<td><?php echo $l['gender'];?></td>
				<td><?php echo $l['phoneno'];?></td>
				<td><?php echo $l['email'];?></td>
				<td><?php echo $l['address'];?></td>
				<td><?php echo $l['nhisno'];?></td>
				<td><?php echo $l['hmono'];?></td>
				<td><a href="<?php echo $site?>/patient/details/<?php echo $l['id'];?>" class="label">details</a>&nbsp;</td>
				<td><a href="<?php echo $site?>/patient?id=<?php echo $l['id'];?>" class="label label-info"><i class="icon-edit"></i> edit</a></td>
				<td><a id="delete" data="<?php echo $l['id'];?>" href="#" class="label label-warning"><i class="icon-trash"></i> delete</a></td>
		</tr>
		 </tbody>
		<?php endforeach;endif; ?>

	</table>

		<?php if(count($list)<=0): ?>
<div class="alert alert-info"> <?php echo $message['not_found'];?> </div>
		<?php endif; ?>
</div>
</div>
<script>
$(document).ready(function()
{
	$(".table #status").click(function() {
		if(confirm('Are you sure you want to change the status of the selected hmo?')){
			var img = $(this);
			var jqxhr=$.get("<?php echo $site?>/hmo/status?what=del&id="+$(this).attr("data"),function(response, status, xhr){
				alert(response);
				img.html('Activated');
			});
		}
	});
	$(".table #edit").click(function() {
		var item = $(this);
		var jqxhr=$.get($(this).attr("url"),function(response, status, xhr){
			 $("#mypage").html(response);
		 });
	 });
	  $(".table #delete").click(function() {
	  if(confirm('<?php echo $message['confirm_delete'];?>')){
		  var img = $(this);
		  var jqxhr=$.get("<?php echo $site?>/hmo/del?what=del&id="+$(this).attr("data"),function(response, status, xhr){
			  $("#delMsg").show();img.parents("tr").fadeOut();
		  });
	  }
  });

});
</script>
<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"></i> List of HMO's</h3>
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
Name</th>
			<th>Phone No</th>
			<th>Mobile</th>
			<th>Address</th>
			<th>Status</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		   </tr>
			 </thead>
					<?php if(count($list)>0):foreach($list as $l):?>
		 <tbody>
		<tr>
				<td><?php echo $l['name'];?></td>
				<td><?php echo $l['phoneno'];?></td>
				<td><?php echo $l['mobile'];?></td>
				<td><?php echo $l['address'];?></td>
				<td><a id="status" data="<?php echo $l['hmid'];?>" href="javascript:;" class="label label-important"><?php echo $l['status'];?></a></td>
				<td><a href="<?php echo $site?>/hmo?id=<?php echo $l['hmid'];?>" class="label label-info"><i class="icon-edit"></i> edit</a></td>
				<td><a id="delete" data="<?php echo $l['hmid'];?>" href="javascript:;" class="label label-error"><i class="icon-trash"></i> delete</a>&nbsp;</td>
		   </tr>
		 </tbody>
		<?php endforeach;endif; ?>

	</table>

		<?php if(count($list)<=0): ?>
<div class="alert alert-info"> <?php echo $message['not_found'];?> </div>
		<?php endif; ?>
</div>
</div>
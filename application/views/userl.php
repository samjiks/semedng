<?php 
				if(count($list)>0):
				if(isset($paging) AND $paging->render()!=''):?>
				<div class="paging">
					<div class="render"><?php echo $paging->render(); ?></div>

				</div>
				<?php endif ?>
                
      <div class="widget widget-table">
                                  
              <div class="widget-header">
                  <i class="icon-th-list"></i>
                  <h3>List of Users</h3>
              </div> <!-- /widget-header -->
              
              <div class="widget-content">           
	<table width="100%" border="0" cellspacing="0" cellpadding="5" class="table table-striped table-bordered">
		<tr>
			<th width="15%">
First Name</th>
			<th width="16%">
Middle Name</th>
			<th width="14%">
		  Last Name</th>
			<th width="25%">
		  Email</th>
			<th width="11%">Role</th>
			<th width="4%">&nbsp;</th>
		</tr>
					<?php foreach($list as $l):?>
		<tr <?php echo Text::alternate('', 'class="odd"' ) ?>>
				<td><?php echo $l['firstname'];?></td>
				<td><?php echo $l['middlename'];?></td>
				<td><?php echo $l['lastname'];?></td>
				<td><?php echo $l['email'];?></td>
				<td><?php echo $l['role'];?></td>
				<td>
                <?php if(Auth::instance()->logged_in("admin") AND $user->id!=$l["id"]): ?>
                <a href="#" url="<?php echo $site?>/user?id=<?php echo $l['id'];?>&what=del" onclick="javascript:return confirm('<?php echo $message['confirm_delete'];?>');">delete</a>
				<?php endif;?>				</td>
		</tr>
		<?php endforeach ?>
	</table>

<?php else: ?>
<div class="alert alert-warning"> <?php echo $message['not_found'];?> </div>
		<?php endif; ?>
		
</div>
</div>
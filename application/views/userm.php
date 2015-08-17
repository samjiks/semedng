<script type="text/javascript">

$(document).ready(function(){
	$("#submit").click( function(){  $(this).attr("disabled","disabled");$(this).attr("value","..please wait");
	$.ajax({
		type: "POST",
		url: "<?php echo $site;?>/user/register",
		 data: $("#form1").serialize()+"&submit=",
		cache: false,
		success: function(html){$(this).attr("disabled","");$(this).attr("value","<?php echo $btName;?>"); $("#mypage").html(html);}
	});
	});

});
</script>

<?php if ($errors): ?>
<p class="message"><?php echo $message['submit_error'];?> </p>
<ul class="errors">
<?php foreach ($errors as $msg):if($msg!=''): ?>
	<li><?php echo $msg ?></li>
<?php endif; endforeach; ?>
</ul>
<?php endif ?>

 <div class="widget widget-table">
              <div class="widget-header">
                  <i class="icon-th-list"></i>
                  <h3>New User</h3>
              </div> <!-- /widget-header -->
              
              <div class="widget-content">

<form enctype="multipart/form-data" method="post" class="form-vertical" id="form1">
				<label for="firstname">First Name </label>
<input type="text" id="firstname" value="<?php if(isset($post['firstname']))echo Html::chars($post['firstname']);?>" name="firstname" />
		 <div class="break"></div>

					<label for="middlename">Middle Name </label>
<input type="text" id="middlename" value="<?php if(isset($post['middlename']))echo Html::chars($post['middlename']);?>" name="middlename" />
		 <div class="break"></div>

					<label for="lastname">Last Name </label>
<input type="text" id="lastname" value="<?php if(isset($post['lastname']))echo Html::chars($post['lastname']);?>" name="lastname" />
		 <div class="break"></div>
         					<label for="phoneno">Phone No </label>
<input type="text" id="phoneno" value="<?php if(isset($post['phoneno']))echo Html::chars($post['phoneno']);?>" name="phoneno" />
		 <div class="break"></div>
        			<label for="email">Email </label>
<input type="text" id="email" value="<?php if(isset($post['email']))echo Html::chars($post['email']);?>" name="email" />
		 <div class="break"></div>
	  			<label for="password">Password </label>
<input type="password" id="password" name="password" />
		 <div class="break"></div>

					<label for="cpass">Confirm Password </label>
<input type="password" id="cpass" name="cpass" />
		
		 <div class="break"></div>
			<label>&nbsp;</label>
			  <input type="submit" value="<?php echo $btName;?>" name="submit" id="submit" class="btn" />
               <div class="break"></div>
</form>
</div>
</div>
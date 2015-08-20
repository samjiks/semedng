        <style>
			/* Toolbar */
.toolbar1   { height: 26px; background-image: url(<?php echo $site?>/media/wysiwyg/images/background_silver.jpg); }
/*.toolbar1   { height: 26px; background-color: #F4F4F4; border-bottom:1px solid #C9C9C9; }*/

		</style>
		<link rel="stylesheet" href="<?php echo $site;?>/media/wysiwyg/docs/style.css" type="text/css">
		
		<!-- 
			Include the WYSIWYG javascript files
		-->
		<script type="text/javascript" src="<?php echo $site;?>/media/wysiwyg/scripts/wysiwyg.js"></script>
		<!-- 
			Attach the editor on the textareas
		-->
		
		<script type="text/javascript">
			// Use it to attach the editor to all textareas with full featured setup
			//WYSIWYG.attach('all', full);
			
			// Use it to attach the editor directly to a defined textarea
			
			var mysettings = new WYSIWYG.Settings();

// define the location of the openImageLibrary addon
mysettings.ImagePopupFile = "<?php echo $site."/openwysiwyg";?>";
// define the width of the insert image popup
mysettings.ImagePopupWidth = 800;
// define the height of the insert image popup
mysettings.ImagePopupHeight = 400; 

			WYSIWYG.attach('textarea1',mysettings); // default setup
			//WYSIWYG.attach('textarea1', full); // full featured setup
			//WYSIWYG.attach('textarea3', small); // small setup
			
			// Use it to display an iframes instead of a textareas
			//WYSIWYG.display('all', full);  
		</script>
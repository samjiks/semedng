<html>
<head>

<title>HMO NHIS:</title>
<script src="<?php echo $site;?>/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo $site;?>/js/jquery.autocomplete.js"></script>
<script src="<?php echo $site;?>/js/jquery.textchange.min.js"></script>
<script src="<?php echo $site;?>/js/bootstrap.min.js"></script>
<script src="<?php echo $site;?>/js/bootstrap-datepicker.js"></script>


<link href="<?php echo $site?>/css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />

<link href="<?php echo $site?>/css/font.awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $site?>/css/datepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $site?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $site?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $site?>/themes/blue/blue.css" rel="stylesheet" type="text/css" />

<script>
$(document).ready(function(){
	$("#loading").ajaxStart(function(){
	 $(this).show();
   });
   
   $("#loading").ajaxStop(function(){
      	$(this).hide();
      });
   $('.header_top').ajaxError(function(event,xhr,setting) {
	   if(xhr.responseText=="kolewole")
	   		alert("Logged out");
	   else alert('error processing....'+xhr.responseText );
	});
	
	 $('.url').click(function() {
		 $.ajax({
				type: "GET",
				url: $(this).attr("url"),
				cache: true,
				success: function(html){$("#body_full").css("display","none"); $("#body").css("display","block"); $("#mypage").html(html);}
		  });
	});
	 $('.link2').click(function() {
		 $.ajax({
				type: "GET",
				url: $(this).attr("url"),
				cache: true,
				success: function(html){$("#body").css("display","none"); $("#body_full").css("display","block"); $("#body_full").html(html);}
		  });
	});

	$(".datepicker" ).datepicker();
});
 </script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
        <div class="navbar navbar-inverse navbar-fixed-top" id="header">
         <div class="navbar-inner" style="margin-bottom:20px;">
         
         <div class="container">
          <div class="row-fluid">
                      <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
                 <div class="nav-collapse collapse">
                    <?php include Kohana::find_file("views","hmo_menu");?>
                </div>
          </div>
        </div>
       </div>
    </div>
    
    
    
    
    

    <!--BEGIN OF BODY-->
<div class="container" id="body">

<div class="row-fluid">

<div id="body2"> </div>
<div id="body">
<div class="span3" style="background-color:#fff; padding:10px;border: 1px solid rgb(213, 213, 213); border-radius: 5px 5px 5px 5px;">
				
				<div class="account-container">
				
					<div class="account-avatar">
						<img class="thumbnail" alt="" src="<?php echo $site?>/media/uploads/yomi.jpg" height="50" width="50">
					</div> <!-- /account-avatar -->
				
					<div class="account-details">
					
						<span class="account-name">
                        	<?php if(Auth::instance()->logged_in()): echo $user->firstname." ".$user->lastname; endif;?>
                        </span>
						
						<span class="account-role">Role: <?php if(Auth::instance()->logged_in("admin")) echo "Administrator"; elseif(Auth::instance()->logged_in("nhis") OR Auth::instance()->logged_in("nhisuser")) echo "NHIS"; elseif(Auth::instance()->logged_in("hmo") OR Auth::instance()->logged_in("hmouser")) echo "HMO"; elseif(Auth::instance()->logged_in("consultant")) echo "Consultant"; elseif(Auth::instance()->logged_in("technician")) echo "Technician";?></span>
						
						<span class="account-actions">
							<a href="<?php echo $site?>/user/changepass">Change Password</a> |
							<a href="<?php echo $site?>/login/logout">Logout</a>
						</span>
					
					</div> <!-- /account-details -->
				
				</div> <!-- /account-container -->
				
				<hr>
				
				<ul class="nav nav-tabs nav-stacked" id="main-nav">
                
					<li class="active"><a href="<?php echo $site."?x=".Text::random()?>"><i class="icon-dashboard"></i> Dashboard </a></li>
                     <?php if(Auth::instance()->logged_in("hmo") OR Auth::instance()->logged_in("hmouser")):?>
					 	 <li><a href="<?php echo $site?>/patient"><i class="icon-plus-sign"></i> Register Patient</a></li>
                         <li><a href="<?php echo $site?>/patient/list"><i class="icon-th-list"></i> View Patients</a></li>
                     <?php elseif(Auth::instance()->logged_in("nhis") OR Auth::instance()->logged_in("admin")):?>
                         <li><a href="<?php echo $site?>/patient/referer"><i class="icon-th-list"></i> View Patients</a></li>
                         <li><a href="<?php echo $site?>/patient/status/"><i class="icon-cogs"></i> Pending Approval</i></a>
                         <li><a href="<?php echo $site?>/treatmentcycle/completed/"><i class="icon-user-md"></i> 21 days cycle</i></a>
                     <?php elseif(Auth::instance()->logged_in("consultant")):?>
                         <li><a href="<?php echo $site?>/patient/consultant"><i class="icon-th-list"></i> View Patients</a></li>
                      <?php endif;?>
                </ul>	
                <form class="form-search" name="form1" id="form1" method="get" action="<?php echo $site?>/patient/details">
                    <div class="input-append">
                    <input name="pid" class="search-query span9" type="text">
                    <button id="" type="submit" class="btn btn-danger">Search</button>
                    </div>
                </form>

			<hr/>
           Welcome to the HMO NHIS management platform.
            <div style="margin-top:17px;">
            	<img src="<?php echo $site;?>/images/logo.png" />
            </div>
			</div>
        <div class="span9" id="page">
     			<?php if(isset($content))echo $content;?>
    	</div>
</div>    
</div>
<div class="nav navbar-inverse footer"> Copyright &copy;2013.</div>
</div>
<script src="<?php echo $site;?>/js/bootstrap.datepicker.js"></script>
</body>
</html>

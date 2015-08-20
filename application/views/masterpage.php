<!DOCTYPE html>
<html lang="en">
<head>

<title>HMO NHIS: <?php echo $churchname?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="<?php echo $site?>/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo $site?>/js/bootstrap.min.js"></script>

<link href="<?php echo $site?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $site?>/themes/blue/blue.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $site?>/css/datepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $site?>/css/jscrollpane.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $site?>/js/jquery.jscrollpane.min.js"></script>
<script src="<?php echo $site?>/js/jquery.mousewheel.js"></script>
<?php
echo Html::style("css/font-awesome.css");
echo Html::script("$site/media/js/tim/tiny_mce.js");
?>
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
	
	$(function()
	{
		$('.divFiles').jScrollPane();
	});
});
 </script>
</head>
<body>

<div class="header_top">
      <div class="container">
          <div class="header">
            <div class="row-fluid" style="height:70px;">
                  <div class="container">
                      <div class="navbar navbar-inverse">
                          <div class="navbar-inner">
                                  <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  </a>
                                  <div class="nav-collapse collapse">
                                 
                                  <ul class="nav">
                                    <li class="active"><a href="<?php echo $site?>"><i class="icon-dashboard icon-2x"></i> Home</a></li>
                                    <li class="dropdown">
                                      <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user icon-2x"></i> Member <b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                        <li><a href="#" url="<?php echo $site?>/member" class="url"><i class="icon-user"></i> Register Member</a></li>
                                        <li><a href="#" url="<?php echo $site?>/member/list" class="url"><i class="icon-list"></i> List Member</a></li>
                                        <li><a href="#" url="<?php echo $site?>/member/group" class="url"><i class="icon-cogs"></i> List Member by Group</a></li>
                                        <li class="divider"></li>
                                        
                                         <li><a href="#" url="<?php echo $site?>/donation" class="url"><i class="icon-bar-chart"></i> Add Member Donation</a></li>
                                         <li><a href="#" url="<?php echo $site?>/tithe" class="url"><i class="icon-bell"></i> Add Member Tithe</a>
                                         <li class="divider"></li>
                                         <li class="nav-header">Donation/Tithe List</li>
                                         <li><a href="#" url="<?php echo $site?>/donation/list" class="url"><i class="icon-bar-chart"></i> List Member Donation</a></li>
                                        <li><a href="#" url="<?php echo $site?>/tithe/list" class="url"><i class="icon-list"></i> List Member Tithe</a> </li>
                                        <li><a href="#" url="<?php echo $site?>/tithe/monthly" class="url"><i class="icon-table"></i> Monthly Tithe Report</a> </li>
                                      </ul>
                                    </li>
                                     <li class="dropdown">
                                      <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-phone icon-2x"></i> Messaging <b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                        <li><a href="#" url="<?php echo $site?>/messaging" class="url"><i class="icon-phone"></i> Send General SMS</a></li>
                                        <li><a href="#" url="<?php echo $site?>/messaging/email" class="url"><i class="icon-envelope"></i> Send General Email</a></li>
                                        <li class="divider"></li>
                                        
                                         <li><a href="#" url="<?php echo $site?>/messaging/msms" class="url"><i class="icon-phone"></i> Send SMS to Members</a></li>
                                         <li><a href="#" url="<?php echo $site?>/messaging/memail" class="url"><i class="icon-envelope"></i> Send Email to Members</a></li>
                                         <li class="divider"></li>
                                         <li class="nav-header">Log</li>
                                         <li><a href="#" url="<?php echo $site?>/messaging/log" class="url"><i class="icon-list"></i>SMS History</a></li>
                                      </ul>
                                    </li>
                                    
                                    <li class="dropdown">
                                      <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-credit-card icon-2x"></i> Account <b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                         <li><a href="#" url="<?php echo $site?>/posting/cash/io" class="url"><i class="icon-credit-card"></i> Post Income</a></li>
                                         <li><a href="#" url="<?php echo $site?>/posting/cash/eo" class="url"><i class="icon-edit"></i> Post Expenses</a></li>
                                         <li><a href="#" url="<?php echo $site?>/posting/cash/bie" class="url"><i class="icon-circle"></i> Other Posting</a></li>
                                         
                                          <li class="dropdown-submenu">
                                          <a href="#"data-toggle="dropdown" class="dropdown-toggle"><i class="icon-credit-card"></i> Report</a>
                                          <ul class="dropdown-menu">
                                                <li><a href="#" url="<?php echo $site?>/report/posting" class="url"><i class="icon-credit-card"></i> Posting Report</a></li>
                                                <li><a href="#" url="<?php echo $site?>/report/profitloss" class="url"><i class="icon-money"></i> Profit and Loss</a></li>
                                                <li><a href="#" url="<?php echo $site?>/report/oposting" class="url"><i class="icon-list"></i> Grouped Posting Report</a></li>
                                                <li><a href="#" url="<?php echo $site?>/report" class="url"><i class="icon-money"></i> Trial Balance</a></li>
                                                <li><a href="#" url="<?php echo $site?>/report?t2=" class="url"><i class="icon-money"></i> Trial Balance 2</a></li>
                                          </ul>
                                          </li>
                                           <li class="divider"></li>
                                           <li><a href="#" url="<?php echo $site?>/particular" class="url"><i class="icon-money"></i> Add Particular</a></li>
                                          <li><a href="#" url="<?php echo $site?>/particular/list" class="url"><i class="icon-list"></i> List Particular</a></li>
                                          
                                  
                                  </ul>
                                    </li>
                                    
                                  <li class="dropdown">
                                      <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-circle icon-2x"></i> Others <b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                        <li><a href="#" url="<?php echo $site?>/group" class="url"><i class="icon-group"></i> Create Group</a></li>
                                        <li><a href="#" url="<?php echo $site?>/group/list" class="url"><i class="icon-list"></i> List Groups</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" url="<?php echo $site?>/particular" class="url"><i class="icon-money"></i> Add Particular</a></li>
                                        <li><a href="#" url="<?php echo $site?>/particular/list" class="url"><i class="icon-list"></i> List Particular</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" url="<?php echo $site?>/particulartype" class="url"><i class="icon-money"></i> Add Account section</a></li>
                                        <li><a href="#" url="<?php echo $site?>/particulartype/list" class="url"><i class="icon-list"></i> List Account Section</a></li>
                                      </ul>
                                    </li>    
                                  <li class="dropdown">
                                      <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-cog icon-2x"></i> Options <b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                        <li><a href="#" url="<?php echo $site?>/occupation" class="url"><i class="icon-certificate"></i> Occupation</a></li>
                                        <li><a href="#" url="<?php echo $site?>/occupation/list" class="url"><i class="icon-desktop"></i> List Occupation</a></li>
                                        <li><a href="#" url="<?php echo $site?>/qualification" class="url"><i class="icon-certificate"></i> Create Qualification</a></li>
                                        <li><a href="#" url="<?php echo $site?>/qualification/list" class="url"><i class="icon-columns"></i> List Qualification</a></li>
                                      </ul>
                                    </li>                           
                                    <li class="dropdown">
                                      <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user-md icon-2x"></i> User Mgt. <b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                        <li class="nav-header">User Management</li>
                                  
                                       <li><a href="#" url="<?php echo $site?>/user/register" class="url"><i class="icon-user"></i> New User</a></li>
                                       <li><a href="#" url="<?php echo $site?>/user" class="url"><i class="icon-columns"></i> List Users</a></li>
                                      </ul>
                                    </li> 
                                    
                                   
                                   </ul>
                                  </div><!--/.nav-collapse -->
                          </div><!-- /.navbar-inner -->
                      </div><!-- /.navbar -->
                      
                  </div>
            </div>
          </div>
      </div>
</div>
<div class="container">
	<div id="loading" class="span5 offset3">...loading &nbsp;<img src="<?php echo $site?>/images/loading6.gif" /></div>
</div>
<div class="container_body">
    <div class="container">
    	
    	<div class="row-fluid body">
            <div class="span12">
            <div class="span3" style="background-color:#fff; padding:10px;border: 1px solid rgb(213, 213, 213); border-radius: 5px 5px 5px 5px;">
				
				<div class="account-container">
				
					<div class="account-avatar">
						<img class="thumbnail" alt="" src="<?php echo $site?>/images/no_pics.jpg" height="50" width="50">
					</div> <!-- /account-avatar -->
				
					<div class="account-details">
					
						<span class="account-name"><?php if(is_object($user))echo $user->firstname." ".$user->lastname?> </span>
						
						<span class="account-role">Administrator</span>
						
						<span class="account-actions">
							<a href="javascript:;">Profile</a> |
							
							<a href="<?php echo $site?>/login/logout">Logout</a>
                            <div id="loading"></div>
						</span>
					
					</div> <!-- /account-details -->
				
				</div> <!-- /account-container -->
				
				<hr>
				
				<ul class="nav nav-tabs nav-stacked" id="main-nav">
					
					<li class="active">
						<a href="#">
							<i class="icon-home"></i>
							Dashboard 		
						</a>
					</li>
					
					<li>
						<a href="#" url="<?php echo $site?>/member" class="url">
                        <i class="icon-user"></i>
							New Member	
						</a>
					</li>
					
					<li>
						<a href="#" url="<?php echo $site?>/member/list" class="url">
                        <i class="icon-arrow-down"></i>
							View Members	
                             <span class="label label-info pull-right"><?php echo $total_members;?></span>
						</a>
					</li>
					<li>
						<a href="#" url="<?php echo $site?>/messaging" class="url">
							<i class="icon-phone"></i>
							Send SMS	
						</a>
					</li>
					<li>
						<a url="<?php echo $site?>/messaging/email" class="url" href="#">
							<i class="icon-envelope"></i>
							Send Email	
						</a>
					</li>                    
					<li>
						<a href="#" url="<?php echo $site?>/donation" class="url"><i class="icon-bar-chart"></i> Add Donation</a>
					</li>
					
					<li><a href="#" url="<?php echo $site?>/tithe" class="url"><i class="icon-bell"></i> Add Tithe</a></li>
				</ul>	
				
				<hr>
				
				<div class="sidebar-extra">
					<p>&nbsp;</p>
				</div> <!-- .sidebar-extra -->
				
				<br>
		
			</div>
            <div class="span9">

            	<div id="mypage">
					<?php echo $content;?>
                </div>
             </div>
            </div>
            <div id="body_full"></div>
        </div>
        
         <div class="nav navbar-inverse footer"> Copyright &copy;2013</div>
	</div>
    <script src="<?php echo $site;?>/js/bootstrap-datepicker.js"></script>
</div>
</body>
</html>

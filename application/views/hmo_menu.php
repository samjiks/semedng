<ul class="nav">
		<a class="brand">NHIS HMO</a>
        <?php if(Auth::instance()->logged_in("admin") OR Auth::instance()->logged_in("nhis")):?>
         <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user-md icon-2x"></i> Patient <i class="caret"></i></a>
        		<ul class="dropdown-menu">
              	  <li><a href="<?php echo $site?>/patient/status/approved"><i class="icon-user-md"></i> Approved Patients</a></li>
                  <li><a href="<?php echo $site?>/patient/status"><i class="icon-user-md"></i> Pending Approval</a></li>
                  <li><a href="<?php echo $site?>/patient/referer"><i class="icon-user-md"></i> List By HMO</a></li>
                </ul>
         </li>
        	
            <li><a href="<?php echo $site?>/treatmentcycle/completed"><i class="icon-user-md icon-2x"></i> Completed 21 days cycle</a></li>
            <li><a href="<?php echo $site?>/treatmentcycle/search"><i class="icon-search icon-2x"></i> Search Treatment Cycle</a></li>
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-wrench icon-2x"></i> Stakeholders <i class="caret"></i></a>
        		<ul class="dropdown-menu">
                     <li class="nav-header">Provider</li>
					 <li><a href="<?php echo $site?>/provider"><i class="icon-plus-sign"></i> Add Unit</a></li>
					 <li><a href="<?php echo $site?>/provider/list"><i class="icon-th"></i> View Units</a></li>
                     <li class="divider"></li>
                     <li class="nav-header">HMO</li>
					 <li><a href="<?php echo $site?>/hmo"><i class="icon-plus-sign"></i> Register HMO</a></li>
					 <li><a href="<?php echo $site?>/hmo/list"><i class="icon-th"></i> View HMO's</a></li>
                     <li class="divider"></li>
                     <li class="nav-header">Specialist</li>
                     <li><a href="<?php echo $site?>/specialist"><i class="icon-plus-sign"></i> Register Consultant</a></li>
                     <li><a href="<?php echo $site?>/specialist/list"><i class="icon-th"></i>View Consultants</a></li>
                     <li class="divider"></li>
                     <li class="nav-header">Technician</li>
                     <li><a href="<?php echo $site?>/technician"><i class="icon-plus-sign"></i> Register Technician</a></li>
                     <li><a href="<?php echo $site?>/technician/list"><i class="icon-th"></i>View Technician</a></li>
        		</ul>
        	</li>
            <?php elseif(Auth::instance()->logged_in("hmo") OR Auth::instance()->logged_in("hmouser")):?>
            	 <li><a href="<?php echo $site?>/patient"><i class="icon-plus-sign icon-2x"></i>Register Patient</a></li>
				 <li><a href="<?php echo $site?>/patient/list"><i class="icon-th-list icon-2x"></i> View Patient</a></li>
                  <li><a href="<?php echo $site?>/patient/sht">Approve Patient<i class="icon-cogs icon-2x"></i></a></li>
            <?php elseif(Auth::instance()->logged_in("consultant")):?>
				 <li><a href="<?php echo $site?>/patient/consultant"><i class="icon-th-list icon-2x"></i> View Patient</a></li>
            <?php endif;?>
            <?php if(Auth::instance()->logged_in("admin") OR Auth::instance()->logged_in("nhis")):?>
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-book icon-2x"></i> Report <i class="caret"></i></a>
        		<ul class="dropdown-menu">
					 <li><a href="<?php echo $site?>/hmo/summary"><i class="icon-credit-card"></i> Summary Report</a></li>
                     <li><a href="<?php echo $site?>/hmo/treatmentsummary"><i class="icon-money"></i> Treatment Summary</a></li>
                      <li><a href="<?php echo $site?>/hmo/approvalform"><i class="icon-plus-sign"></i> Approval Form</a></li>
					 <li><a href="<?php echo $site?>/hmo/cost"><i class="icon-money"></i> Cost Summary</a></li>
                    
        		</ul>
        	</li>
             <?php endif;?>
</ul>
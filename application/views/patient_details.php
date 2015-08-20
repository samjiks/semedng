<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"> </i> Patient Details</h3>
</div> 
<div class="widget-content">

<div class="row-fluid">
	<div class="span8">
    		<?php if(is_array($treatmentcycle)):?>
    			<div class="alert alert-warning">
                	<?php if($treatmentcycle['elapsed']==0):?>
                    	The patient currently has a treatment cycle which ends on <?php echo $treatmentcycle['proposedenddate'];?>
                     <?php else:?>
                     	The patient last treatment cycle ended on <?php echo $treatmentcycle['proposedenddate'];?>
                     <?php endif;?>
                </div>
            	<?php endif;?>
	  <table width="100%" border="0" cellspacing="0" cellpadding="5" class="table table-stripped">
         <tr>
          <th>NHIS No</th>
          <td><?php echo $patient['nhisno'];?></td>
        </tr>
         <tr>
          <th>HMO No</th>
          <td><?php echo $patient['hmono'];?></td>
        </tr>
         <tr>
           <th>HMO</th>
           <td><?php $hmo=Model::factory('hmomd')->SelectById($patient['hmoid']); if(is_array($hmo)) echo $hmo['name'];?>&nbsp;</td>
         </tr>
        <tr>
          <th>Surname</th>
          <td><?php echo $patient['surname'];?></td>
        </tr>
        <tr>
          <th>Other Names</th>
          <td><?php echo $patient['othernames'];?></td>
        </tr>
        <tr>
          <th>Gender</th>
          <td><?php echo $patient['gender'];?></td>
        </tr>
        <tr>
          <th>&nbsp;</th>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <th>&nbsp;</th>
          <td>&nbsp;</td>
        </tr>
      </table>
</div>
    <div class="span4">
     <?php if(is_array($treatmentcycle) AND $treatmentcycle['elapsed']==1 AND Auth::instance()->logged_in("nhis")):?>
 <div class=""><a class="btn btn-danger" onclick="javascript:return confirm('Are you sure you want to start a new treatment cycle for this patient?');" href="<?php echo $site;?>/treatmentcycle/start/<?php if(is_array($patient))echo $patient['id'];?>"> BEGIN NEW TREATMENT CYCLE</a></div>
<?php endif;?>
    		<h3>Patient Operations</h3>
            <?php if(is_array($patient)):?>
    		<ul class="nav nav-tabs nav-stacked" id="main-nav">
            <?php if(Auth::instance()->logged_in("hmo") OR Auth::instance()->logged_in("hmouser") OR Auth::instance()->logged_in("consultant")):?>
             <li>
            <a href="<?php echo $site?>/patient/sht/<?php echo $patient['id'];?>"><i class="icon-ambulance"></i> New Treatment/Approve Patient<i class="icon-chevron-right pull-right"></i></a>
            </li>
            <?php endif;?>
             <?php if(Auth::instance()->logged_in("nhis") OR Auth::instance()->logged_in("nhisuser")):?>
            <?php if(!is_array($treatmentcycle OR $treatmentcycle['proposedstartdate']==null)):?>
            <li>
            <a href="<?php echo $site?>/treatmentcycle/index/<?php echo $patient['id'];?>"><i class="icon-medkit"></i> SHT Request<i class="icon-chevron-right pull-right"></i></a>
            </li>
             <?php endif;?>
             <?php endif;?>
             <?php if(is_array($treatmentcycle)):?>
              <?php if(Auth::instance()->logged_in("consultant")):?>
             <li><a href="<?php echo $site?>/treatmentcycle/treatment/<?php echo $patient['id'];?>"><i class="icon-retweet"></i> Refer<i class="icon-chevron-right pull-right"></i></a></li>
              <?php endif;?>
              
              <?php if(Auth::instance()->logged_in("technician")):?>
             <li><a href="<?php echo $site?>/patientdiagnosis/index/<?php echo $patient['id'];?>"><i class="icon-beaker"></i> Patient Treatment Result<i class="icon-chevron-right pull-right"></i></a></li>
              <li><a href="<?php echo $site?>/patientdiagnosis/costing/<?php echo $patient['id'];?>"><i class="icon-money"></i> Costing<i class="icon-chevron-right pull-right"></i></a></li>
            <?php endif;?>
            
              
              <?php  if(Auth::instance()->logged_in("consultant")/* AND $user->id==$treatmentcycle['refertodoctor']*/):?>
             <li><a href="<?php echo $site?>/patient/last_form/<?php echo $patient['id'];?>"><i class="icon-user-md"></i> Dignosis & Treatment<i class="icon-chevron-right pull-right"></i></a></li>
             <li><a href="<?php echo $site?>/patient/others/<?php echo $patient['id'];?>"><i class="icon-circle"></i> Other Secondary HC. Details<i class="icon-chevron-right pull-right"></i></a></li>
             <?php endif;?>
             
             
              <?php if(Auth::instance()->logged_in("nhis") OR Auth::instance()->logged_in("nhisuser") OR Auth::instance()->logged_in("hmo") OR Auth::instance()->logged_in("hmouser") OR Auth::instance()->logged_in("consultant")):?>
              <li><a href="<?php echo $site?>/patient/approval_form?pid=<?php echo $patient['id'];?>" target="_blank"><i class="icon-file"></i>Approval Form<i class="icon-chevron-right pull-right"></i></a></li>
             <li><a href="<?php echo $site?>/patient/discharge_summary/<?php echo $patient['id'];?>" target="_blank"><i class="icon-file"></i> Discharge Summary<i class="icon-chevron-right pull-right"></i></a></li>
             <?php endif;?>
             
             <?php if(Auth::instance()->logged_in("consultant") AND is_array($treatmentcycle) AND $treatmentcycle['elapsed']==0):?>
             	<li><a href="<?php echo $site?>/treatmentcycle/end/<?php echo $patient['id'];?>"><i class="icon-signout"></i> Close Treatment<i class="icon-chevron-right pull-right"></i></a></li>
             <?php endif;?>
             
              <?php endif;?>
            </ul>	
            
            <?php endif;?>
  </div>
</div>


</div>
</div>

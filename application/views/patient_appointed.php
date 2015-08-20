<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"> </i> Patients appointed on <?php echo $date;?></h3>
</div> 
<div class="widget-content">
<div class="row-fluid">
	<div class="span6">
	<?php if(count($list)>0):?>
    <ul class="nav nav-tabs nav-stacked nav-pills afix-top">
    <?php foreach($list as $l):?>
              <li><a href="<?php echo $site?>/patient/details/<?php echo $l['patientid'];?>"><?php echo $l['surname']." ".$l['othernames']." [".$l['formno']."]";?><i class="icon-chevron-right pull-right"></i></a></li>
            <?php endforeach;?>
            </ul>
          <?php endif; ?>
    </div>
    <div class="span6">
    	<?php include Kohana::find_file("views","appointment");?>
    </div>
</div>
</div>
</div>
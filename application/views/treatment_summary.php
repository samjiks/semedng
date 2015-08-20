<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UNIVERSITY COLLEGE HOSPITAL: TREATMENT SUMMARY</title>
<link href="<?php echo $site?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
<style>
.container { width:750px; height:auto; background:#fff; margin:auto; padding:10px; margin-top:10px; margin-bottom:10px;}
#wrapper{ }
body{
    font-size: 9px;
    color: #000000;
}
th{ font-size:14px;}
</style>
</head>
<body>
<div class="container">
<div style="margin:auto; text-align:center; color:#060; font-size:25px; background:url(<?php echo $site?>/images/logo.png) no-repeat left; height:80px; width:100%; margin-top:15px;"><h2>UNIVERSITY COLLEGE HOSPITAL</h2></div>

<center><h3>SUMMARY REPORT</h3></center>
<div class="row-fluid" style="font-size:16px; font-weight:bold">
	<div class="span6">HMO: <?php echo strtoupper($hmo['name'])?></div>
	<div class="span6 pull-right"><?php echo "PERIOD: $from TO $to"?></div>
</div>
<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse">
<thead>
  <tr>
    <th>PATIENT</th>
    <th>DEPARTMENT</th>
    <th>TREATMENT ON-GOING</th>
    <th>TREATMENT COMPLETED</th>
  </tr>
  </thead>
  <tbody>
  <?php $x=0;if(count($list)>0): foreach($list as $p):$x++;?>
  <tr>
    <td><?php echo $p['surname'].' '.$p['othernames'];?>&nbsp;</td>
    <td><?php $unit=Model::factory('providermd')->SelectById($p['referringto']); if(is_array($unit))echo $unit['name']?>&nbsp;</td>
    <td><?php if($p['elapsed']==0)echo "ON-GOING";else echo "-"?>&nbsp;</td>
    <td>
    <?php if($p['elapsed']==1)echo "COMPLETED";else echo "-"?>
    	<!--<div class="row-fluid">
        	<div class="span6">COMPLETED: <span class="badge badge-warning"> <?php $thlist=Model::factory('treatmentcyclemd')->GetTreatmentStatus($hmo['id'],'1',$_GET["from"],$_GET["to"]);if(is_array($thlist))echo count($thlist);else echo 0?></span></div>
            <div class="span6">PENDING:<span class="badge badge-warning"> <?php $thlist=Model::factory('treatmentcyclemd')->GetTreatmentStatus($hmo['id'],'0',$_GET["from"],$_GET["to"]);if(is_array($thlist))echo count($thlist);else echo 0?></span></div>
        </div>-->
        
        
    </td>
    
    
  </tr>
  <?php endforeach; endif;?>
  </tbody>
</table>

</div>

</body>
</html>

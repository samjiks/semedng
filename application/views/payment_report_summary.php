<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UNIVERSITY COLLEGE HOSPITAL: PAYMENT SUMMARY</title>
<style>
.container { width:750px; height:auto; background:#fff; margin:auto; padding:10px; margin-top:10px; margin-bottom:10px;}
#wrapper{ }
body{
    font-size: 9px;
    color: #000000;
}

th{ font-size:14px; text-align:left}
</style>
</head>
<body>
<div class="container">
<div style="margin:auto; text-align:center; color:#060; font-size:25px; background:url(<?php echo $site?>/images/logo.png) no-repeat left; height:80px; width:100%; margin-top:15px;"><h2>UNIVERSITY COLLEGE HOSPITAL</h2></div>

<h2>PAYMENT SUMMARY</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse">
  <tr>
    <th width="7%">#</th>
    <th>Patient Names</th>
    <th>Cost</th>
  </tr>
  <?php $total=0;$x=0;if(count($list)>0): foreach($list as $l):$x++;?>
  <tr>
    <td><?php echo $x;?></td>
    <td><?php echo $l['surname']." ".$l['othernames'];?></td>
    <td><?php echo number_format($l['cost'],2); $total+=$l['cost'];?>&nbsp;</td>
  </tr>
   <?php endforeach; endif;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo number_format($total,2);?>&nbsp;</td>
  </tr>
 
</table>

</div>

</body>
</html>

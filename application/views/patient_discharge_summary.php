<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UNIVERSITY COLLEGE HOSPITAL: PATIENT DISCHARGE SUMMARY</title>
<style>
.container { width:750px; height:auto; background:#fff; margin:auto; padding:10px; margin-top:10px; margin-bottom:10px; border:1px #f5f5f5 solid}
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
<div style="margin:auto; text-align:center; color:#060; font-size:25px; background:url(<?php echo $site?>/images/logo.png) no-repeat left; height:80px; width:100%; margin-top:15px;"><h2>DISCHARGE SUMMARY</h2></div>
<hr />
<h3>PATIENT DETAILS</h3>
<table width="100%" cellspacing="0" cellpadding="5" border="1" style="border-collapse:collapse">
         <tr>
          <th width="22%">NHIS No</th>
          <td width="28%"><?php echo $patient['nhisno'];?></td>
          <th width="21%">Hospital No</th>
          <td width="29%"><?php echo $patient['hospitalno'];?></td>
        </tr>
        <tr>
          <th>Surname</th>
          <td><?php echo $patient['surname'];?></td>
          <th>Other Names</th>
          <td><?php echo $patient['othernames'];?></td>
        </tr>
        <tr>
          <th>Gender</th>
          <td><?php echo $patient['gender'];?></td>
          <th>Date of Birth</th>
          <td><?php echo $patient['dob'];?></td>
        </tr>
        <tr>
          <th>Date of Admission</th>
          <td><?php echo $treatmentcycle['proposedstartdate'];?></td>
          <th>Date of Discharge</th>
          <td><?php echo $treatmentcycle['proposedenddate'];?></td>
        </tr>
        <tr>
          <th>HMO</th>
          <td colspan="3"><?php $hmo=Model::factory('hmomd')->SelectById($patient['hmoid']); if(is_array($hmo)) echo $hmo['name'];?>&nbsp;</td>
        </tr>
      </table>
<br />
<table width="100%" cellspacing="0" cellpadding="5" border="1" style="border-collapse:collapse">
  <tr>
    <th width="38%">LABORATORY AND OTHER INVESTIGATIONS</th>
    <th width="17%">Cost</th>
    </tr>
  <?php $total=0; if(count($treatments)>0): foreach($treatments as $t):
 	 $diagnosis=Model::factory('patientdiagnosismd')->SelectByTreatment($t['id']);
  ?>
  <tr>
    <td><?php echo $t['treatment'];?></td>
    <td><?php if(is_array($diagnosis)){ echo number_format($diagnosis['cost'],2);$total+=$diagnosis['cost'];}?></td>
    </tr>
    <?php endforeach; endif;?>
  <tr style="background-color:#ccc;">
    <th align="right">Total</th>
    <td><?php echo number_format($total,2);?></td>
  </tr>
 
</table>
<h3>INVESTIGATION/DRUG FORM REPORT</h3>
<table width="100%" cellspacing="0" cellpadding="5"  border="1" style="border-collapse:collapse">
    <tr>
    <th>DEFINITIVE DIAGNOSIS ON DISCHARGE</th>
  </tr>
  <tr>
    <td><?php if(isset($treatmentcycle['investigationform']))echo html_entity_decode($treatmentcycle['investigationform']);?></td>
  </tr>

   <tr>
    <th>BRIEF HISTORY OF COMPLAINT AND MAJOR PHYSICAL FINDINGS</th>
  </tr>
  <tr>
    <td><?php if(isset($treatmentcycle['clicnicinformation']))echo html_entity_decode($treatmentcycle['clicnicinformation']);?></td>
  </tr>
  <tr>
    <th>TREATMENTS</th>
  </tr>
  <tr>
    <td><?php if(isset($treatmentcycle['drugform']))echo html_entity_decode($treatmentcycle['drugform']);?></td>
  </tr>
  <tr>
    <th>COMPLICATIONS</th>
  </tr>
  <tr>
    <td><?php if(isset($treatmentcycle['complications']))echo html_entity_decode($treatmentcycle['complications']);?></td>
  </tr>
  <tr>
    <th>SURGICAL OPERATION, MINOR/MAJOR</th>
  </tr>
  <tr>
    <td><?php if(isset($treatmentcycle['surgicaloperations']))echo html_entity_decode($treatmentcycle['surgicaloperations']);?></td>
  </tr>
  <tr>
    <th>INDICATIONS FOR SURGERY</th>
  </tr>
  <tr>
    <td><?php if(isset($treatmentcycle['indicationforsurgery2']))echo html_entity_decode($treatmentcycle['indicationforsurgery2']);?></td>
  </tr>
  <tr>
    <th>CONDITION ON DISCHARGE</th>
  </tr>
  <tr>
    <td><?php if(isset($treatmentcycle['conditionondischarge']))echo html_entity_decode($treatmentcycle['conditionondischarge']);?></td>
  </tr>
    <tr>
    <th>DRUG REPORT</th>
  </tr>
  <tr>
    <td><?php if(isset($treatmentcycle['drugform']))echo html_entity_decode($treatmentcycle['drugform']);?></td>
  </tr>

  <tr>
    <th>APPOINTMENT FOR FOLLOW UP</th>
  </tr>
  <tr>
    <td><?php if(isset($treatmentcycle['nextappointment']))echo html_entity_decode($treatmentcycle['nextappointment']);?>&nbsp;</td>
  </tr>
  <tr>
    <th>HOUSE OFFICER OR RESIDENT</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <th>CONSULTANT IN CHARGE</th>
  </tr>
  <tr>
    <td><?php echo $doctor['names'];?><br>
      __________________________________________<br>
      &nbsp;&nbsp;&nbsp;&nbsp;(NAME &amp; SIGN.) </td>
  </tr>
</table><br>

<?php if(count($attachments)>0): foreach($attachments as $at): if(empty($at['attachment']))continue;?>
<img src="<?php echo $site."/".$at['attachment']?>" />
<?php endforeach; endif;?>
</div>

</body>
</html>

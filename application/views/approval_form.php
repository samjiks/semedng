<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UNIVERSITY COLLEGE HOSPITAL: PATIENT DISCHARGE SUMMARY</title>
<style>
.container { width:750px; height:auto; background:#fff; margin:auto; padding:10px; margin-top:10px; margin-bottom:10px; border:1px #eee solid}
#wrapper{ }
body{
    color: #000000;
}

th{ font-size:14px; text-align:left}
</style>
</head>
<body>
<div class="container">
<div style="margin:auto; text-align:center; color:#060; font-size:25px; background:url(<?php echo $site?>/images/logo.png) no-repeat left; height:80px; width:100%; margin-top:15px;">
 <h2>APPROVAL FORM</h2>
 </div>
 <hr/>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="14%"><span style="color:#930; text-decoration:underline">FORM NO:</span></td>
    <td width="22%"><span style="color:#930; text-decoration:underline"><?php echo $treatmentcycle['formno'];?></span></td>
    <td width="23%">Authorisation Code</td>
    <td width="41%"><?php if(is_array($treatmentcycle))echo $treatmentcycle['authorisationcode']?></td>
  </tr>
</table>
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
          <th>HMO #</th>
          <td><?php echo $patient['hmono'];?></td>
          <th>HMO</th>
          <td><?php $hmo=Model::factory('hmomd')->SelectById($patient['hmoid']); if(is_array($hmo)) echo $hmo['name'];?>&nbsp;</td>
</tr>
      </table>
<br />
<h3>DATA FROM REFERRING DEPARTMENT/UNIT</h3>
  <table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse">
    <tr>
      <th width="42%">Referring From</th>
      <td width="58%"><?php echo $treatmentcycle['referringfrom'];//$ref=Model::factory('providermd')->SelectById($treatmentcycle['referringfrom']);if(is_array($ref))echo $ref['name'];?></td>
    </tr>
    <tr>
      <th>Referred To</th>
    <td><?php $re=Model::factory('providermd')->SelectById($treatmentcycle['referringto']);if(is_array($re))echo $re['name'];?></td></tr>
    <tr>
      <th>Name of Referring Doctor</th>
      <td><?php echo $treatmentcycle['referringdoctor'];//$re=Model::factory('specialistmd')->SelectById($treatmentcycle['referringdoctor']);if(is_array($re))echo $re['names'];?></td>
    </tr>
    <tr>
      <th>Clinic Information</th>
      <td><?php echo html_entity_decode($treatmentcycle['clicnicinformation']);?></td>
    </tr>
    <tr>
      <th>Investigation Results</th>
      <td><?php echo html_entity_decode($treatmentcycle['investigationform']);?></td>
    </tr>
    <tr>
      <th>Indication for Referral/Diagnosis</th>
      <td>
        <?php echo html_entity_decode($treatmentcycle['indicationforsurgery']);?>
      </td>
    </tr>
  </table>
       

<?php if(is_array($treatmentcycle)):?>

<h2>ACKNOWLEDGEMENT SLIP</h2>
<h4>DATA FROM SECONDARY/TERTIARY LEVEL OF CARE(ACCEPTING MEDICAL UNIT)</h4>
 <table width="100%" border="1" cellspacing="0" cellpadding="5" class="table" style="border-collapse:collapse">
  <tr>
    <th width="41%"><strong>Date seen by specialist/service provider</strong></th>
    <td width="59%"><?php echo $treatmentcycle['dateseen'];?></td>
  </tr>
  <tr>
    <th><strong>Name of clinic/service provider</strong></th>
    <td><?php echo $treatmentcycle['serviceprovider'];?></td>
  </tr>
  <tr>
    <th><strong>Presumptive Diagnosis</strong></th>
    <td>
    <?php echo $treatmentcycle['presumptivediagnosis'];?>
    </td>
  </tr>
  <tr>
    <th><strong>Plan/Action taken</strong></th>
    <td><?php echo $treatmentcycle['actiontaken'];?></td>
  </tr>
 </table>
<?php endif;?>
 

</div>

</body>
</html>

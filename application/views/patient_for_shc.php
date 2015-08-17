<div class="widget">
<div class="widget-header">
    <h3><i class="icon-list"> </i> Approve patient for secondary health treatment</h3>
</div> 
<div class="widget-content">
<?php if ($errors): ?>
<div class="alert alert-error"><?php echo $message['submit_error'];?>
<ul class="errors">
<?php foreach ($errors as $msg):if($msg!=''): ?>
	<li><?php echo $msg ?></li>
<?php endif; endforeach; ?>
</ul>
</div>
<?php endif ?>
<?php if(Cookie::get('msg')):?>
<div class="alert alert-success"> <?php echo $message['sucess_msg'];Cookie::delete('msg');?></div>
<?php endif;?>
<a class="btn btn-link" href="<?php echo $site?>/patient/details?pid=<?php if(is_array($patient))echo $patient['id'];?>">Go to <?php if(is_array($patient))echo $patient['surname']." ".$patient['othernames'];?> menu</a>
 <form enctype="multipart/form-data" method="post" class="form-horizontal" id="form1">
 <h3><span style="color:#930; text-decoration:underline">FORM NO: <?php echo $formno;?></span></h3>
 <?php if(is_array($treatmentcycle) AND $treatmentcycle['elapsed']==1 AND Auth::instance()->logged_in("nhis")):?>
 <div class="pull-right span4"><a class="btn btn-danger" onclick="javascript:return confirm('Are you sure you want to start a new treatment cycle for this patient?');" href="<?php echo $site;?>/treatmentcycle/start/<?php if(is_array($patient))echo $patient['id'];?>"> BEGIN NEW TREATMENT CYCLE</a></div>
<?php endif;?>
<div class="row-fluid">
	<div class="span6">
     <h4> PATIENT DATA</h4>
	  <table width="100%" border="0" cellspacing="0" cellpadding="5" class="table" style="background-color:#060; color:#fff;">
        <tr>
          <th>Patient Names <input type="hidden" name="formno" value="<?php echo $formno;?>" /></th>
          <td><?php echo $patient['surname']." ".$patient['othernames'];?></td>
        </tr>
        <tr>
          <th>Gender</th>
          <td><?php echo $patient['gender'];?></td>
        </tr>
         <tr>
          <th>Phone Number</th>
          <td><?php echo $patient['phoneno'];?></td>
        </tr>
      </table>
       <h4> HMO/NHIS DETAILS</h4>
	  <table width="100%" border="0" cellspacing="0" cellpadding="5" class="table" style="background-color:#CC0; color:#fff;">
         <tr>
          <th width="33%">NHIS Number</th>
          <td width="67%"><?php echo $patient['nhisno'];?></td>
        </tr>
         <tr>
          <th>HMO Number</th>
          <td><?php echo $patient['hmono'];?></td>
        </tr>
         <tr>
           <th>HMO</th>
           <td><?php $hmo=Model::factory('hmomd')->SelectById($patient['hmoid']); if(is_array($hmo)) echo $hmo['name'];?>&nbsp;</td>
         </tr>
       
      </table> 
</div>
    <div class="span6 pull-right">
    <h5>DATA FROM REFERRING DEPARTMENT/UNIT</h5>
    <table width="100%" border="0" cellspacing="0" class="table table-condensed" style="background-color:#900; color:#FFF">
  <tr>
    <th width="20%">Referring From</th>
    <td width="80%">
<!--    <select name="referringfrom" required>
      <option value="">--Select--</option>
      <?php if(isset($units)): foreach($units as $s): ?>
          <option value="<?php echo $s['id']?>" <?php if(isset($post["referringfrom"]) AND $post["referringfrom"]==$s["id"])echo 'selected="selected"';?>><?php echo $s['name']?></option>
      <?php endforeach; endif;?>
    </select>-->

    <input <?php if(isset($disable_main))echo 'disabled="disabled"';?>  type="text" id="referringfrom" value="<?php if(isset($post['referringfrom']))echo Html::chars($post['referringfrom']);?>" name="referringfrom" required="required"/>
    
    </td>
  </tr>
  <tr>
    <th>Referred To</th>
    <td>
   	 <select name="referringto" required>
      <option value="">--Select--</option>
      <?php if(isset($units)): foreach($units as $s): ?>
          <option value="<?php echo $s['id']?>" <?php if(isset($post["referringto"]) AND $post["referringto"]==$s["id"])echo 'selected="selected"';?>><?php echo $s['name']?></option>
      <?php endforeach; endif;?>
    </select>
<!--    <input <?php if(isset($disable_main))echo 'disabled="disabled"';?>  type="text" id="referringto" value="<?php if(isset($post['referringto']))echo Html::chars($post['referringto']);?>" name="referringto" required="required"/>
--> </td> </tr>
  <tr>
    <th>Name of Referring Doctor</th>
    <td>
<!--     <select name="referringdoctor" required>
        <option value="">--Select--</option>
        <?php if(isset($consultants)): foreach($consultants as $s): ?>
            <option value="<?php echo $s['id']?>" <?php if(isset($post["referringdoctor"]) AND $post["referringdoctor"]==$s["id"])echo 'selected="selected"';?>><?php echo $s['names']?></option>
        <?php endforeach; endif;?>
      </select>-->
    <input <?php if(isset($disable_main))echo 'disabled="disabled"';?>  type="text" id="referringdoctor" value="<?php if(isset($post['referringdoctor']))echo Html::chars($post['referringdoctor']);?>" name="referringdoctor" required="required"/>
    
    </td>
  </tr>
  <tr>
    <th>Clinic Information</th>
    <td><textarea <?php if(isset($disable_main))echo 'disabled="disabled"';?>  name="clicnicinformation" id="clicnicinformation" required="required"><?php if(isset($post['clicnicinformation']))echo (html_entity_decode($post['clicnicinformation']));?>
    </textarea></td>
  </tr>
  <tr>
    <th>Investigation Results</th>
    <td><textarea <?php if(isset($disable_main))echo 'disabled="disabled"';?>  name="investigationform" id="investigationform" required="required"><?php if(isset($post['investigationform']))echo (html_entity_decode($post['investigationform']));?>
              </textarea></td>
  </tr>
  <tr>
    <th>Indication for Referral/Diagnosis</th>
    <td>
      <textarea <?php if(isset($disable_main))echo 'disabled="disabled"';?>  name="indicationforsurgery" id="indicationforsurgery" required="required"><?php if(isset($post['indicationforsurgery']))echo (html_entity_decode($post['indicationforsurgery']));?>
              </textarea>
    </td>
  </tr>
    </table>
       
    </div>
</div>
<?php if(is_array($treatmentcycle) AND $treatmentcycle['referringto']!=''):?>
<h3>HMO Authorisation Code</h3>
<input type="text" id="authorisationcode" <?php if(isset($disable_hmo))echo 'disabled="disabled"';?> value="<?php if(isset($post['authorisationcode']))echo Html::chars($post['authorisationcode']);?>" name="authorisationcode" required="required" class="span7"/>
<?php endif?>
<?php if(is_array($treatmentcycle) AND $treatmentcycle['referringto']!=''):?>

<h2>ACKNOWLEDGEMENT SLIP</h2>
<h4>DATA FROM SECONDARY/TERTIARY LEVEL OF CARE(ACCEPTING MEDICAL UNIT)</h4>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <td width="32%">Date seen by specialist/service provider</td>
    <td width="68%"><input <?php if(isset($disable_as))echo 'disabled="disabled"';?> placeholder="Seen date" type="text" id="date" value="<?php if(isset($post['dateseen']))echo Html::chars($post['dateseen']);?>" name="dateseen" required data-date-format="yyyy/mm/dd" class="datepicker"/></td>
  </tr>
  <tr>
    <td>Name of clinic/service provider</td>
    <td><input <?php if(isset($disable_as))echo 'disabled="disabled"';?> type="text" id="serviceprovider" value="<?php if(isset($post['serviceprovider']))echo Html::chars($post['serviceprovider']);?>" name="serviceprovider"/></td>
  </tr>
  <tr>
    <td>Presumptive Diagnosis</td>
    <td><textarea name="presumptivediagnosis" cols="70" id="presumptivediagnosis" <?php if(isset($disable_as))echo 'disabled="disabled"';?>><?php if(isset($post['presumptivediagnosis']))echo Html::chars($post['presumptivediagnosis']);?>
    </textarea></td>
  </tr>
  <tr>
    <td>Plan/Action taken</td>
    <td><textarea name="actiontaken" cols="70" id="actiontaken" <?php if(isset($disable_as))echo 'disabled="disabled"';?>><?php if(isset($post['actiontaken']))echo Html::chars($post['actiontaken']);?>
    </textarea></td>
  </tr>
  <?php if(Auth::instance()->logged_in("consultant")):?>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Submit" name="as" class="btn btn-danger" />&nbsp;</td>
  </tr>
  <?php endif;?>
 </table>
<?php endif;?>
 
        
 <?php if(is_array($treatmentcycle) AND Auth::instance()->logged_in("hmo") AND $treatmentcycle['authorisationcode']==""):?>
          <input type="submit" value="Submit" name="tc" class="btn btn-danger" />
 <?php endif;?>
   <?php if(!is_array($treatmentcycle) OR $treatmentcycle['referringto']==''):if(Auth::instance()->logged_in("consultant") OR Auth::instance()->logged_in("nhis")):?>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Submit for secondary health treatment" name="submit" class="btn btn-danger" />&nbsp;</td>
  </tr>
  <?php endif;endif;?>



</form>

</div>
</div>

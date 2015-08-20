<div class="widget">
<div class="widget-header"><h3><i class="icon-list"> </i> Begin patient treatment cycle</h3></div>

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
<div class="alert alert-success"> <?php echo $message['sucess_msg']." The treatment cycle is expected to end on ".Cookie::get('msg');Cookie::delete('msg');?></div>
<?php endif;?>
<a class="btn btn-link" href="<?php echo $site?>/patient/details?pid=<?php if(is_array($patient))echo $patient['id'];?>">Go to <?php if(is_array($patient))echo $patient['surname']." ".$patient['othernames'];?> menu</a>
<div class="row-fluid">
<div class="alert alert-warning">Select the date and the provider to begin patient treatment cycle which last for 21 days from the the start date</div>
	<div class="span8">
	 	<div class="row-fluid">
        	<div class="span7">
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
                  <th colspan="2">
                  <?php if(isset($treatmentcycle) AND is_array($treatmentcycle) AND $treatmentcycle['proposedstartdate']!=null):?>
                  		<div class="label label-warning">The treatment cycle is ending on <?php echo $treatmentcycle['proposedenddate'];?></div>
                  <?php endif;?>
                  </th>
                  </tr>
              </table>
                    </div>
            <div class="span5">
            	<form enctype="multipart/form-data" method="post" class="form-horizontal" id="form1">
                    <fieldset>
                        <!-- patientid -->
                        <div class="control-group">
                            <label class="control-label" for="authorisationcode">Authorisation Code </label>
                            <div class="controls">
                <input placeholder="Enter authorisation code" type="text" id="authorisationcode" value="<?php if(isset($post['authorisationcode']))echo Html::chars($post['authorisationcode']);?>" name="authorisationcode" required/>
                        </div>
                        </div>
                    
                        <!-- patientid -->
                        <div class="control-group">
                            <label class="control-label" for="patientid">Proposed Start Date </label>
                            <div class="controls">
                <input placeholder="Proposed start date" type="text" id="date" value="<?php if(isset($post['proposedstartdate']))echo Html::chars($post['proposedstartdate']);?>" name="proposedstartdate" required data-date-format="yyyy-mm-dd" class="datepicker"/>
                        </div>
                        </div>
                        
                        
                        <!-- proposedstartdate -->
                        <div class="control-group">
                          <label class="control-label" for="refertodoctor">Consultant. </label>
                            <div class="controls">
                              <select name="refertodoctor" required>
                              	<option value="">--Select--</option>
                                <?php if(isset($shp)): foreach($shp as $s):?>
                                	<option value="<?php echo $s['id']?>" <?php if(isset($post["refertodoctor"]) AND $post["refertodoctor"]==$s["id"])echo 'selected="selected"';?>><?php echo $s['names']?></option>
                                <?php endforeach; endif;?>
                              </select>
                          </div>
                        </div>
                        <div class="control-group">
                                <label>&nbsp;</label>
                            <div class="controls">
                            <?php if(!is_array($treatmentcycle) OR $treatmentcycle['proposedstartdate']==null):?>
                <input type="hidden" id="id" value="<?php if(isset($_REQUEST['id']))echo Html::chars($_REQUEST['id']);?>" name="id" />
                              <input type="submit" value="Start patient treatment cycle" name="submit" class="btn btn-danger" />
                            <?php endif;?>
                        </div>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
	</div>
    <div class="span4">
  </div>
</div>


</div>
</div>

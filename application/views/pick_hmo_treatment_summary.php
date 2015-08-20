<div class="widget">
<div class="widget-header">
    <h3><i class="icon-plus-add"></i> Select HMO</h3>
</div> 
<div class="widget-content"> 

<form enctype="multipart/form-data" method="get" class="form-horizontal" id="form1" target="_blank" action="<?php echo $site?>/hmo/treatment_summary_report">
	<fieldset>
        <div class="control-group">
			<label class="control-label" for="firstname">Select HMO </label>
			<div class="controls">
				<select name="h">
                	<?php foreach($hmos as $h):?>
                    	<option value="<?php echo $h['id'];?>"><?php echo $h['name']?></option>
                    <?php endforeach;?>
                </select>
			</div>
		</div>
        <div class="control-group">
           <label class="control-label" for="from">From</label>
             <div class="controls">
                <input type="date" id="date" name="from" data-date-format="yyyy-mm-dd" class="datepicker"/>
             </div>
         </div>
        <div class="control-group">
           <label class="control-label" for="to">To</label>
             <div class="controls">
                <input type="date" id="date" name="to" data-date-format="yyyy-mm-dd" class="datepicker"/>
             </div>
         </div>
         
                        
		<div class="control-group">
				<label>&nbsp;</label>
			<div class="controls">
				<input type="submit" value="Submit" name="submit" class="btn" />
		</div>
		</div>
	</fieldset>
</form>
</div>
</div>
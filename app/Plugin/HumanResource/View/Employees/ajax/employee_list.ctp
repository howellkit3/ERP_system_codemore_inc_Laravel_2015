<?php
if (!empty($employees)) {
foreach ($employees as $KeyId => $value) { ?>
    <li> 

        <div class="checkbox-nice">
            <input type="checkbox" name="data[WorkSchedule][empId][]" checked="checked" class="select_employee" value="<?php echo $KeyId; ?>" id="checkbox-<?php echo $KeyId; ?>">
            <label for="checkbox-<?php echo $KeyId; ?>">
                <?php echo $value ?>
            </label>
        </div>


    </li>
<?php } ?>
<?php } else { ?>
		
		<div style="color:red">No Result</div>
	
<?php } ?>
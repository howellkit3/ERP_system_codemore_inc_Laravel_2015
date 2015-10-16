<?php foreach ($attendances as $KeyId => $value) { ?>
    <li> 

        <div class="checkbox-nice">
            <input type="checkbox" name="data[Employee][id][<?php echo $KeyId ?>]" class="select_employee employee" value="<?php echo  $value['Employee']['id']; ?>" id="checkbox-<?php echo $KeyId; ?>">

            <input type="hidden" name="data[Attendance][id][<?php echo $KeyId ?>]" class="select_employee attendance" value="<?php echo $value['Attendance']['in'] ?>" id="checkbox-<?php echo $KeyId; ?>">

            <span class="time-in"> <?php echo !empty( $value['Attendance']['in']) ? 'Time in ( '.date('h:i a',strtotime($value['Attendance']['in'])).' )' : ''; ?>  </span>
            <label for="checkbox-<?php echo $KeyId; ?>">
                <?php 
                $name = $value['Employee']['first_name'];

                $name .= !empty($value['Employee']['middle_name']) ? ' '.$value['Employee']['middle_name'][0] : '';
                $name .= !empty($value['Employee']['last_name']) ? ' '.$value['Employee']['last_name'] : '';
                $name .= !empty($value['Employee']['suffix']) ? ' '.$value['Employee']['suffix'] : '';

                echo ucwords($name); ?>  
            </label>
        </div>


    </li>
<?php } ?>
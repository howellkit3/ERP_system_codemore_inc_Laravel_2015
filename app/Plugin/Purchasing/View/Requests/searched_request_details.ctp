<?php  foreach ($requestData as $key => $value) { 

	pr($requestData); exit;
	$counter = '10'; ?>

    <tr class="optionValue<?php echo $dynamicId ?>">
    <td>
        <input type="radio" data-name="<?php echo $value[$ModelName]['name'] ?>" data-holder="<?php echo $counter ;?>" value="<?php echo $value[$ModelName]['id'] ?>" class="radioMe selectSpecProduct<?php //echo $getCounter ?>" name="<?php echo $ModelName ?>">
    </td>

  
    <td><?php echo $value[$ModelName]['uuid'] ?></td>
    <td><?php echo $value[$ModelName]['name'] ?></td>
   </tr>
<?php } ?>
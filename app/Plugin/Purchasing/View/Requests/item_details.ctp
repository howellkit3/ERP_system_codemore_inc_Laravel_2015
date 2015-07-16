<?php  foreach ($searchedProduct as $key => $value) { ?>

    <tr class="optionValue<?php echo $dynamicId ?>">
    <td>
        <input type="radio" data-name="<?php echo $value[$ModelName]['name'] ?>" value="<?php echo $value[$ModelName]['id'] ?>" class="radioMe selectSpecProduct<?php  ?>" name="<?php echo $ModelName ?>">
    </td>

  
    <td><?php echo $value[$ModelName]['uuid'] ?></td>
    <td><?php echo $value[$ModelName]['name'] ?></td>
   </tr>
<?php } ?>
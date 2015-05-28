<?php foreach ($searchedProduct as $key => $value) { ?>

	<tr class="optionValue<?php echo $dynamicId ?>">
    <td>
        <input type="radio" value="<?php echo $value[$ModelName]['name'] ?>" class="radioMe selectSpecProduct<?php echo $dynamicId ?>" name="optionsRadios">
    </td>
    <td><?php echo $value[$ModelName]['uuid'] ?></td>
    <td><?php echo $value[$ModelName]['name'] ?></td>
   </tr>
<?php } ?>
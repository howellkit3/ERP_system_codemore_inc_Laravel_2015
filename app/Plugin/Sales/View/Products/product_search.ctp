<?php foreach ($categoryData as $key => $value) { ?>

	<tr class='optionValue"+dynamicId+"'>
    <td>
        <input type="radio" value="" class="selectSpecProduct" name="optionsRadios">
    </td>
    <td><?php echo $value['GeneralItem']['uuid'] ?></td>
    <td><?php echo $value['GeneralItem']['name'] ?></td>
   </tr>
<?php } ?>
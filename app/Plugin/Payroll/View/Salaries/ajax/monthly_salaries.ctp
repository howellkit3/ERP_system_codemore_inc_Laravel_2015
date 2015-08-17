
	<?php  if(!empty($employees)) { ?>

	<?php foreach ($employees as $key => $employee): ?>

	<tr >
		<td> <?php echo $employee['Employee']['code']; ?></td>
		<td class="">
	      <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
	    </td>
		<td class="text-center">
	        <?php echo $employee['first_half']; $total = $employee['first_half']; ?>
	    </td>
	    <td class="text-center">
	        <?php echo $employee['second_half']; $total += $employee['second_half']; ?>
	    </td>
	    <td class="text-center">
	        <?php echo $total; ?>
	    </td>
	  
	</tr>


	<?php  endforeach;  ?>
	<?php } ?> 

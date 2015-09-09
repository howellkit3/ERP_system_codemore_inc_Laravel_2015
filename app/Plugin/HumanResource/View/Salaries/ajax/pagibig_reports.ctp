<?php foreach ($employees as $key => $emp) : ?>
<tr>
<td> <?php echo $emp['GovernmentRecord']['value']; ?></td>
<td class="text-center"> <?php echo ucwords($emp['Employee']['first_name']); ?></td>
<td class="text-center"> <?php echo ucwords($emp['Employee']['last_name']); ?> </td>
<td class="text-center"> <?php echo ucwords($emp['Employee']['suffix']); ?> </td>
<td class="text-center"> <?php echo ucwords($emp['Employee']['middle_name']); ?> </td>

<td class="text-center"> <?php echo !empty($emp['Employee']['status']) ? $status[$emp['Employee']['status']] : ''  ?> </td>
</tr>
<?php endforeach; ?>

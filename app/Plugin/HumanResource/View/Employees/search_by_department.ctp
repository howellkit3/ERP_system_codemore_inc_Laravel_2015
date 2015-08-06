<?php 
if(!empty($employeeData)){
    foreach ($employeeData as $key => $employee): ?>
		
		<tr class="">
			<td class="">
                <?php echo $employee['Employee']['code'];?> 
            </td>
			<td class="">
                <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
            </td>
            
            <td class="text-center">
               <?php echo !empty($employee['Department']['name']) ? $employee['Department']['name'] : '';  ?>
            </td>

             <td class="text-center">
               <?php echo !empty($employee['Position']['name']) ? $employee['Position']['name'] : '';  ?>
            </td>

            <td class="text-center">


               <?php echo !empty($employee['Employee']['status']) ? ' <span class="label label-success">'.ucwords($employee['Status']['name']).'</span>'  : '';  ?>
            </td>

            <td>
               <?php echo !empty($employee['Employee']['gender']) ? $employee['Employee']['gender'] : '';  ?>
            </td>

           	<td>
                <?php echo $this->Html->link('<span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ', array('controller' => 'employees', 'action' => 'view',$employee['Employee']['id']), array('class' =>' table-link','escape' => false, 'title'=>'View Sales Invoice'
                    ));

                ?>

			<?php
			echo $this->Html->link('<span class="fa-stack">
			<i class="fa fa-square fa-stack-2x"></i>
			<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
			</span> ', array('controller' => 'employees', 'action' => 'edit',$employee['Employee']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));
			?>
            </td>
        </tr>

<?php 
    endforeach; 
} ?>
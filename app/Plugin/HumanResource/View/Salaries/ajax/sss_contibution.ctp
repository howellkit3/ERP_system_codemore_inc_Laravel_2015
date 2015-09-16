<div class="ajax">
	<div id="sss-result-cont">
        
        <table class="table table-bordered">
                    <thead>
                    <tr>
                      <th><a href="#"><span>SSS Number</span></a></th>
                      <th class="text-center"><a href="#" class="asc"><span>Last Name</span></a></th>
                      <th class="text-center"><span>First Name</span></th>
                      <th class="text-center"><span>Middle Initial</span></th>
                      <th class="text-center"><span>Date Hired</span></th>
                      <th class="text-center"><span>Emp Status</span></th>

                      <th class="text-center"><span>First Half</span></th>
					  <th class="text-center"><span>Second Half</span></th>
					  <th class="text-center"><span>ER</span></th>
					  <th class="text-center"><span>EC</span></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if(!empty($employees)) : ?>
                      <?php foreach ($employees as $key => $emp) : ?>
                        <tr>
                            <td> <?php echo !empty($emp['SSS']['number']) ? $emp['SSS']['number'] : '';  ?></td>
                            <td class="text-center"> <?php echo ucwords($emp['Employee']['first_name']); ?></td>
                            <td class="text-center"> <?php echo ucwords($emp['Employee']['last_name']); ?> </td>
                            <td class="text-center"> <?php echo ucwords($emp['Employee']['middle_name'][1]); ?> </td>
                            <td class="text-center"> 
                            <?php echo !empty($emp['Employee']['date_hired']) ? date('F/d/Y',strtotime($emp['Employee']['date_hired'])) : ''  ?>
                            </td>
                            <td class="text-center"> 
                            <?php echo !empty($emp['Employee']['status']) ? '<span class="label label-success">'.ucwords($statuses[$emp['Employee']['status']]) .'</span>' : ''; ?>
                            </td>
                            <td class="text-center"> <?php echo !empty($emp['SSS']['first_half']) ? $emp['SSS']['first_half'] : '';  ?> </td>
                            <td class="text-center"> <?php echo !empty($emp['SSS']['second_half']) ? $emp['SSS']['second_half'] : '';  ?> </td>
                            <td class="text-center"> <?php echo !empty($emp['SSS']['first_half_employer']) ? $emp['SSS']['first_half_employer'] : '';  ?> </td>
                            <td class="text-center"> <?php echo !empty($emp['SSS']['first_half_compensation']) ? $emp['SSS']['first_half_compensation'] : '';  ?> </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
               </tbody>
          </table>
		  <div class="paging" id="item_type_pagination" data-result="#sss-result-cont">
	          <?php
	              echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
	              echo $this->Paginator->numbers(array('separator' => ''));
	              echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	          ?>
	     </div>
	</div>
</div>
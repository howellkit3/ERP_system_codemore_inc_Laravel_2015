<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="#"><span>Employee Name</span></a></th>
					<th class="text-center"><a href="#"><span>Date</span></a></th>
					<th class="text-center"><a href="#"><span>Shift</span></a></th>
					<th class="text-center"><a href="#"><span>Type</span></a></th>
					<th class="text-right"><a href="#"><span>Actions</span></a></th>
				</tr>
			</thead>
			<?php 
		        if(!empty($workSchedules)){
		            foreach ($workSchedules as $key => $schedule): ?>
						<tbody aria-relevant="all" aria-live="polite" role="alert">
							<tr class="">

								<td class="">
		                          <?php 
		                          if ($schedule['WorkSchedule']['model'] == 'Employee') {

		                          		echo $this->CustomText->getFullname($schedule['Employee']);

		                          } else if ($schedule['WorkSchedule']['model'] == 'Department') {

		                          		echo "Department";
		                          }
		                          
		                           ?>
		                        </td>
								<td class="text-center"> 
		                           <?php echo $schedule['WorkSchedule']['day']; ?> 
		                        </td>

		                        <td class="text-center">
		                           <?php echo $schedule['WorkShift']['name']; ?> (<?php echo date('h:i a',strtotime($schedule['WorkShift']['from'])).' - '.date('h:i a',strtotime($schedule['WorkShift']['to'])) ?>) 
		                        </td>
		                         <td class="text-center">
		                           <?php echo !empty($schedule['WorkSchedule']['type']) ? $schedule['WorkSchedule']['type'] : '';  ?> 
		                        </td>
		                       	<td class="text-right">
		                      	<?php

		                      	echo $this->Html->link('<span class="fa-stack">
								<i class="fa fa-square fa-stack-2x"></i>
								<i class="fa fa-search fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
								</span> ', array('controller' => 'schedules', 'action' => 'view',$schedule['WorkSchedule']['id'],$schedule['WorkSchedule']['foreign_key']),array('class' =>' table-link','escape' => false,'title'=>'View Information'));
		                      	

								echo $this->Html->link('<span class="fa-stack">
								<i class="fa fa-square fa-stack-2x"></i>
								<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
								</span> ', array('controller' => 'work_schedules', 'action' => 'edit',$schedule['WorkSchedule']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'));


								 	echo $this->Form->postLink('<span class="fa-stack">
								<i class="fa fa-square fa-stack-2x"></i>
								<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
								</span> ', array('controller' => 'work_schedules', 'action' => 'delete',$schedule['WorkSchedule']['id']),array('class' =>' table-link','escape' => false,'title'=>'Edit Information'),
									 array('escape' => false), 
				                          __('Are you sure you want to delete %s?', 
				                                $schedule['WorkSchedule']['id']));



								?>	
		                        </td>
		                    </tr>

		                </tbody>
		        <?php 
		            endforeach; 
		        } ?> 
		
		</table>	
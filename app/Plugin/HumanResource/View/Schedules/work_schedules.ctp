<?php 
 echo $this->Html->css(array( 'HumanResource.default' ));


	echo $this->element('hr_options');

	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/schedules',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-calendar">
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Work Schedules</b> </h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
			                            <input placeholder="Search..." class="form-control searchCustomer"  />
			                            <i class="fa fa-search search-icon"></i>
			                         <?php //echo $this->Form->end(); ?>
			                    </div>
			                    <?php
			                   		
			                   	$links = array('controller' => 'schedules', 'action' => 'holiday');

			                   	echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add', 
			                            array('controller' => 'work_schedules', 
			                                    'action' => 'add'),
			                            array('class' =>'btn btn-primary pull-right',
			                                'escape' => false));

			                    ?> 
			                  
			                   <br><br>
			               </div>
			            </header>

			            <div class="main-box-body clearfix">
			            		 <div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th><a href="#"><span>Employee Name</span></a></th>
											<th class="text-center"><a href="#"><span>Date</span></a></th>
											<th class="text-center"><a href="#"><span>Shift</span></a></th>
											<th><a href="#"><span>Actions</span></a></th>
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
								                           <?php echo date('Y/m/d',strtotime($schedule['WorkSchedule']['day'])); ?> 
								                        </td>

								                        <td class="text-center">
								                           <?php echo $schedule['WorkShift']['name']; ?> 
								                        </td>
								                       	<td>
								                      	<?php
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
										                                $schedule['WorkSchedule']['id'])
														);

														?>	
								                        </td>
								                    </tr>

								                </tbody>
								        <?php 
								            endforeach; 
								        } ?> 
								
								</table>	

								<hr>

								<div class="paging modal-pagination" id="item_type_pagination">
								<?php
								echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
								echo $this->Paginator->numbers(array('separator' => ''));
								echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
								?>
								</div>
						</div>
					</div>		
	            </div>
			</div>
		</div>	




	    </div>
    </div>
</div>

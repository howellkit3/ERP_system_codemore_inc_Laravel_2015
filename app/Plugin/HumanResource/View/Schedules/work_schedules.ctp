<?php 
 echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker',
)); 

echo $this->Html->script(array(
					'jquery.maskedinput.min',
					'HumanResource.select2.min',
					'HumanResource.moment',
					'HumanResource.custom',
					'HumanResource.work_schedules'

)); 


if (!empty($userData['User']['in_charge']) && $userData['User']['in_charge'] == 1) {

echo $this->element('in_charge_option'); 

$incharge = true;
} else {
$incharge = false;
echo $this->element('hr_options'); 
} 


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
				                	 <?php

				                   	echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Add', 
				                            array('controller' => 'work_schedules', 
				                                    'action' => 'add'),
				                            array('class' =>'btn btn-primary',
				                                'escape' => false));


				                   	echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Change Sched', 
				                            array('controller' => 'work_schedules', 
				                                    'action' => 'change_schedule'),
				                            array('class' =>'btn btn-primary',
				                                'escape' => false));

				                    ?> 
				                  	
				                  	<a data-toggle="modal" href="#myWorkSched" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>
				                  	
				                </div>
				                <div class="clearfix"></div>
				                <?php echo $this->Form->create('Schedule',array('url' => array( 'controller' => 'schedules','action' => 'search_schedules') , 'id' => 'search_schedules','type' => 'GET')) ?>
				                <div class="filter-block pull-left">
				                 
						             <div class="form-group pull-left">
										<div class="radio inline-block">
											<input type="radio" checked="" value="employee" id="optionsRadios1" name="by">
											<label for="optionsRadios1">
												By Employee
											</label>
										</div>
									</div>

				                 	<div class="form-group pull-left" style="min-width:200px;">
				                 		<?php echo $this->Form->input('employee_id',array(
				                 			'type' => 'select',
				                 			'options' => $employeeList,
				                 			'class' => 'autocomplete',
				                 			'label' => false,
				                 			'id' => 'selectEmployee'
				                 		)); ?>
				                    </div>
				                   

				                   	<div class="form-group pull-left">

				                 	<!-- date range -->
				                 	
									<div class="form-group pull-left">

											<input type="text" name="from" id="changeDate" class="form-control datepick" value="<?php echo $date ?>">

										    <i class="fa fa fa-calendar calendar-icon"></i>

											
									</div>

									<div class="form-group pull-left">
										-
									</div>

									<div class="form-group pull-left">
										
											<input type="text" name="to" id="changeDate" class="form-control datepick" value="<?php echo $date ?>">

									    	<i class="fa fa fa-calendar calendar-icon"></i>

									</div>
									<div class="form-group pull-left">
										
										<button class="btn btn-success">Go</button>

									</div>


				                 	</div>
				               </div>
				               <?php echo $this->Form->end(); ?>
				            </header>

				            <div class="main-box-body clearfix">
				            	<div class="table-responsive result-cont">
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
									                           <?php echo $schedule['WorkShift']['name']; ?> 
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
<div class="modal fade" id="myWorkSched" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Work Schedule </h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('WorkSchedule',array('url'=>(array('controller' => 'work_schedules','action' => 'export')),'class' => 'form-horizontal'));?>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Select Employee</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('WorkSchedule.employee_id', array(
                                                                'type' => 'select',
                                                                'label' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '---Select Employee---',
                                                                'options' => array($employeeList)

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Shift Name</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('WorkSchedule.work_shift_id', array(
                                                                'type' => 'select',
                                                                'label' => false,
                                                                'class' => 'form-control ',
                                                                'empty' => '---Select Shift---',
                                                                'options' => array($workshiftList)

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>  
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    
        jQuery(document).ready(function($){
              
               $("#WorkScheduleWorkSchedulesForm").validate();
               
        });

</script>

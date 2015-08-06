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
				                            array('class' =>'btn btn-primary',
				                                'escape' => false));

				                    ?> 
				                  	
				                  	<a data-toggle="modal" href="#myWorkSched" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>
				                  	
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
															<i class="fa fa-search fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
															</span> ', array('controller' => 'schedules', 'action' => 'view',$schedule['WorkSchedule']['id']),array('class' =>' table-link','escape' => false,'title'=>'View Information'));
									                      	

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

                    <!-- <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Date Range</label>

                       <div class="col-lg-6">
                            <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input  placeholder="Date Range" name="from_date" data="1" type="text" class="form-control required myDateRange datepickerDateRange high-z-index" id="datepickerDateRange" >
                                                </div>
                        </div>

                       
                    </div> -->

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

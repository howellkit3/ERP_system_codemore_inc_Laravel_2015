<?php 
 echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker'
)); 

echo $this->Html->script(array(
					'jquery.maskedinput.min',
					'HumanResource.moment',
					'HumanResource.custom',

)); 


echo $this->element('hr_options');

	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/salaries',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-calendar">
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Salaries</b> </h2>
			                <div class="filter-block pull-right">
			                 <div class="form-group pull-left">
			                 	<?php echo $this->Form->create('Attendance',array('controller' => 'attendances','action' => 'index', 'type'=> 'get')); ?>
			                 		<input type="text" name="data[date]" id="changeDate" class="form-control datepick" value="<?php echo $date ?>">

			                            <i class="fa fa fa-calendar calendar-icon"></i>
								</div>
			                    <div class="form-group pull-left">
			                 		 <input placeholder="Search..." class="form-control searchCustomer" value="<?php echo $search ?>" name="data[name]" />
			                            <i class="fa fa-search search-icon"></i>

			                           
			                         
			                    </div>
			                     <div class="form-group pull-left">
			                    	 <button class="btn btn-success">Go</button> 
			                     </div>

			                     <a data-toggle="modal" href="#myAttendance" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>


			                     
			                    <?php echo $this->Form->end(); ?>
			                   <br><br>
			               </div>
			            </header>

			          <div class="main-box-body clearfix">
			            	<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th><a href="#"><span>Code</span></a></th>
											<th><a href="#"><span>Employee Name</span></a></th>
											<th><a href="#"><span>Type</span></a></th>
											<th><a href="#" class="text-center"><span>From</span></a></th>
											<th><a href="#" class="text-center"><span>To</span></a></th>
											<th><a href="#"><span>In</span></a></th>
											<th><a href="#"><span>Out</span></a></th>
											<th><a href="#"><span>Duration</span></a></th>
											<th><a href="#"><span>Remarks</span></a></th>
											<th><a href="#"><span>Actions</span></a></th>
										</tr>
									</thead>

									<tbody aria-relevant="all" aria-live="polite" role="alert">
									<?php 
								        if(!empty($attendances)){

								            foreach ($attendances as $key => $schedule): ?>
													<tr class="parent-tr-<?php echo $schedule['Attendance']['id'] ?>">
														<td> <?php echo $schedule['Employee']['code']; ?></td>
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

								                        	<?php echo !empty($overtime['Overtime']['status']) ? $overtime['Overtime']['status'] : ''; ?>
															<span class="label <?php echo $schedule['Attendance']['type'] == 'work' ? 'label-success' : 'label-default' ?>"><?php echo $schedule['Attendance']['type'] ?></span>

								                        </td>
														<td> 
								                           <?php echo date('Y/m/d',strtotime($schedule['Attendance']['date'])).' '.date('h:i a',strtotime($schedule['WorkShift']['from'])); ?> 
								                        </td>
								                        <td > 
								                           <?php echo date('Y/m/d',strtotime($schedule['Attendance']['date'])).' '.date('h:i a',strtotime($schedule['WorkShift']['to'])); ?> 
								                        </td>
								                         </td>
								                        <td class="text-center time-in"> 
								                           <?php 
								                           $timeIn = (!empty($schedule['Attendance']['in']) && $schedule['Attendance']['in']  != '00:00:00') ? date('h:i a',strtotime($schedule['Attendance']['in'])) : '';
															echo $timeIn;
								                            ?> 
								                        </td>
								                        </td>
								                        <td class="text-center time-out"> 
								                           <?php 
								                           $timeOut = (!empty($schedule['Attendance']['out']) && $schedule['Attendance']['out']  != '00:00:00') ? date('h:i a',strtotime($schedule['Attendance']['out'])) : '';

								                           	echo $timeOut;
								                           ?> 
								                        </td>
								                         <td class="text-center" > 
								                           <?php echo $this->CustomTime->getDuration($timeIn,$timeOut); ?> 
								                        </td>
								                        <td class="text-center notes-td"> 
								                           <?php echo $schedule['Attendance']['notes']; ?> 
								                        </td>
								                       	<td>
								                      	<?php
														echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> view </font></span>
														</span> ','#personalAttendance',
														array('class' =>'view_attendance table-link',
															   'escape' => false,
															   'data-url' => '/attendances/view/'.$schedule['Attendance']['id'],
															   'title'=>'Edit Information',
															   'data-toggle' => 'modal',
															   'data-id' => $schedule['Attendance']['id'],
															));
														if (!empty($timeIn)) {

															$sign = 'fa-sign-out';
														
															$title = 'Time Out';

														} else {

															$sign =  'fa-sign-in';

															$title = 'Time In';
														}
														
														if (empty($timeIn) || empty($timeOut)) {

															echo $this->Html->link('<span class="fa-stack">
															<i class="fa fa-square fa-stack-2x"></i>
															<i class="fa '.$sign.' fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Log </font></span>
															</span> ','#timeKeep',
															array('class' =>'add-timekeep table-link',
																   'escape' => false,
																   'title' => $title ,
																   'data-toggle' => 'modal',
																   'data-id' => $schedule['Attendance']['id'],
																   'onClick' => 'getEmployeeData(this,'.$schedule['Attendance']['id'].')'
																));

														}
														?>

								                        </td>
								                    </tr>

								                
								        <?php 
								            endforeach; 
								        } ?> 
									</tbody>
								</table>	

								<hr>

			                    <div class="paging" id="item_type_pagination">
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
<?php echo $this->element('modals/personnal_attendance'); ?>

<?php echo $this->element('modals/time_in_attendance'); ?>

<div class="modal fade" id="myAttendance" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Attendance </h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Attendance',array('url'=>(array('controller' => 'attendances','action' => 'export')),'class' => 'form-horizontal'));?>

                	<div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Select Department</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Attendance.department_id', array(
                                                                'type' => 'select',
                                                                'label' => false,
                                                                'class' => 'form-control',
                                                                'empty' => '---Select Employee---',
                                                                'options' => array($departmentList)

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Select Employee</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Attendance.employee_id', array(
                                                                'type' => 'select',
                                                                'label' => false,
                                                                'class' => 'form-control ',
                                                                'empty' => '---Select Employee---',
                                                                'options' => array($employeeList)

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label"> Date</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Attendance.from_date', array(
                                                                'label' => false,
                                                                'class' => 'form-control  datepick',
                                                                'placeholder' => 'Date from'

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
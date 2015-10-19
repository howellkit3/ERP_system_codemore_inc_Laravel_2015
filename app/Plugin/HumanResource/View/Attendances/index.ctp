<?php 
 echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker',
                    
                    'datetimepicker/jquery.datetimepicker'
)); 

echo $this->Html->script(array(
                    'datetimepicker/jquery.datetimepicker',
                    'jquery.maskedinput.min',
					'HumanResource.moment',
					'HumanResource.custom',
                    'HumanResource.select2.min',
                    'HumanResource.attendance',

)); 


echo $this->element('hr_options');

$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/attendances',array('active_tab' => $active_tab)); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-calendar">
			                <h2 class="pull-left"><b>Attendances</b> </h2>
						<header class="main-box-header clearfix">
							<br>
			                <div class="filter-block">
								<?php echo $this->Form->create('Attendance',array('controller' => 'attendances','action' => 'index', 'type'=> 'get')); ?>
			                 <div class="form-group pull-left">
			                 	<div class="input-group">
	                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                                <input placeholder="Date Range" name="data[date]" data="1" type="text" class="form-control myDateRange"  value="<?php echo $dateSelected ?>" >
	                            </div>
							</div>

			                    <div class="form-group pull-left">
			                 		 <input placeholder="Search..." class="form-control searchCustomer" value="<?php echo $search ?>" name="data[name]" />
			                            <i class="fa fa-search search-icon"></i>
								</div>


			                	<div class="form-group pull-left" style="min-width:200px;">
			                 		<?php echo $this->Form->input('employee_id',array(
			                 			'type' => 'select',
			                 			'options' => $employeeList,
			                 			'class' => 'autocomplete',
			                 			'label' => false,
			                 			'id' => 'selectEmployee',
			                 			'empty' => '--- Select Employee ---',
			                 			'default' => $empId
			                 		)); ?>
			                    </div>
 

			                     <div class="form-group pull-left">
			                    	 <button class="btn btn-success">Go</button> 
			                     </div>

			                   	 <?php echo $this->Form->end(); ?>

			                     <?php echo $this->Form->create('Attendance',array('controller' => 'attendances','action' => 'export_attendance', 'type'=> 'POST'),array('id' => 'exportAttendance')); ?>

			                      <input type="hidden" name="date" id="hidden_date" value="" />

			                      <input type="hidden"  name="search" id="hidden_search" value="" />



			                     <!-- <a data-toggle="modal" href="#myAttendance" class="btn btn-primary pull-right"><i class="fa fa-share-square-o fa-lg"></i> Export</a> -->

			                      <button class="btn btn-primary pull-right"><i class="fa fa-share-square-o fa-lg"></i> Export</button>

			                      	 <?php echo $this->Form->end(); ?>
			                   	 



			                     	

			                     <div class="form-group pull-left">
			                    	 <a data-toggle="modal" class="btn btn-success" href="#timeKeep"> <i class="fa fa-clock-o"></i> Add Attendances </a> 
			                     </div>

			                   <br><br>

			               </div>
			            </header>
	            	<div class="main-box-body clearfix">
		               <div class="form-group">
	                                     <div class="col-lg-11">
	                                    <div class="form-group">
	                                        <?php echo $this->Form->create('Attendance',array( 
	                                        	'url' => array('controller' => 'salaries','action' => 'export_all_attendance', 'type'=> 'POST'))); ?>   	
	                                        <div class="col-lg-9">
	                                           <div class="form-group pull-left">
	                                            <div class="radio inline-block">
	                                            <input type="radio" checked="checked" value="1:15" data-key="First Half ( 1- 15 )" class="mode_type required" id="optionsRadios1" name="data[Payroll][date]">
	                                                <label for="optionsRadios1">
	                                                    First Half ( 1- 15)
	                                                </label>
	                                            </div>
	                                            <div class="radio inline-block">
	                                            <input type="radio" class="mode_type required" value="16:31" data-key="Second Half ( 16 - 30 / 31 ) " id="optionsRadios2" name="data[Payroll][date]">
	                                                <label for="optionsRadios2">
	                                                    Second Half ( 16 - 30 / 31 )
	                                                </label>
	                                            </div>
	                                            </div>
	                                            <button class="btn btn-primary pull-left"><i class="fa fa-share-square-o fa-lg"></i> Export All</button>

	                                        </div>


	                                        <?php echo $this->Form->end(); ?>
	                                     </div>
	                                </div>      
	                            </div>
                        </div>

			          	<div class="main-box-body clearfix">
			            	<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th><a href="#"><span>Code</span></a></th>
											<th><a href="#"><span>Employee Name</span></a></th>
											<th><a href="#"><span>Type</span></a></th>
											<!-- <th><a href="#" class="text-center"><span>From</span></a></th>
											<th><a href="#" class="text-center"><span>To</span></a></th> -->
											<th>Schedule</th>
											<th><a href="#"><span>In</span></a></th>
											<th><a href="#"><span>Out</span></a></th>
											<th><a href="#"><span>OT</span></a></th>
											<th><a href="#"><span>Time Work</span></a></th>
											<th><a href="#"><span>Duration</span></a></th>
											<th><a href="#" class="text-center"><span>Status</span></a></th>
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
								                          <?php $name =  $this->CustomText->getFullname($schedule['Employee']);

								                          	echo !empty($name) ? $name : '';

									                        ?>
								                        </td>
								                        <td class="text-center"> 

								                        	<?php echo !empty($overtime['Overtime']['status']) ? $overtime['Overtime']['status'] : ''; ?>
															<span class="label <?php echo $schedule['Attendance']['type'] == 'work' ? 'label-success' : 'label-default' ?>"><?php echo Inflector::humanize($schedule['Attendance']['type']) ?></span>

								                        </td>
														<!-- <td> 
								                           <?php echo date('Y/m/d',strtotime($schedule['Attendance']['date'])).' '.date('h:i a',strtotime($schedule['WorkShift']['from'])); ?> 
								                        </td>
								                        <td > 
								                           <?php echo date('Y/m/d',strtotime($schedule['Attendance']['date'])).' '.date('h:i a',strtotime($schedule['WorkShift']['to'])); ?> 
								                        </td> -->

								                        <td>
								                        <?php if (!empty($schedule['MyWorkshift']['to'])) : ?>

								                          <?php echo date('h:i a',strtotime($schedule['MyWorkshift']['from'])); ?> 
								                          - 
								                          <?php echo date('h:i a',strtotime($schedule['MyWorkshift']['to'])); ?> 
								                    	<?php else : ?>
								                    		<span class="label label-default"> No Sched </span>
								                        <?php endif; ?>
								                        </td>
								                        <td class="text-center time-in"> 
								                           <?php 
								                        	 echo (!empty($schedule['Attendance']['in']) && $schedule['Attendance']['in']  != '0000-00-00 00:00:00') ? date('y/m/d h:i a',strtotime($schedule['Attendance']['in'])) : '';
															 $timeIn;
								                            $timeIn = !empty($schedule['Attendance']['in']) ? date('Y/m/d h:i a',strtotime($schedule['Attendance']['in'])) : '';
								                            ?> 
								                        </td>
								                        </td>
								                        <td class="text-center time-out"> 
								                           <?php 
								                          echo  (!empty($schedule['Attendance']['out']) && $schedule['Attendance']['out']  != '0000-00-00 00:00:00') ? date('y/m/d h:i a',strtotime($schedule['Attendance']['out'])) : '';

								                            $timeOut = !empty($schedule['Attendance']['out']) ? date('Y/m/d h:i a',strtotime($schedule['Attendance']['out'])) : '' ;
								                           ?> 
								                        </td>
								                        <td class="text-center" > 
								                           	<?php 
								                           		if (!empty($schedule['Attendance']['overtime_id'])) {
								                           			if ($schedule['Overtime']['status'] == 'approved') {
								                           				$from = $schedule['Overtime']['from'];
									                           			$ex1 = explode(' ', $from);
									                           			$to = $schedule['Overtime']['to'];
									                           			$ex2 = explode(' ', $to);

									                           			$diff = $ex2[1] - $ex1[1];

									                           			if (strtotime($schedule['Attendance']['out']) >= strtotime($to)) {
									                           				$to = $to;
									                           			} else {
									                           				$to = $schedule['Attendance']['out'];
									                           			}
									                           			
																		echo $this->CustomTime->getDuration($from,$to); 

									                           		}else {
									                           			
									                           			echo "-----";
									                           		}

								                           		} else {
								                           			echo "-----";
								                           		}
								                           	?> 
								                        </td> 
								                         <td class="text-center duration" > 
								                           <?php 


								                           echo $this->CustomTime->getDurationSchedule($schedule['Attendance']['in'],$schedule['Attendance']['out'],$schedule['MyWorkshift'],$schedule['MyBreakTime']); ?> 
								                        </td>
								                         <td class="text-center duration" > 
								                           <?php echo $this->CustomTime->getDuration($timeIn,$timeOut); ?> 
								                        </td>
								                        <td class="attendance-status"> 
								                           <?php 
								                           		// if ($schedule['Attendance']['status'] == 'OnTime') {
								                           		// 	echo "<span class='label label-success'>OnTime</span>";
								                           		// }
								                           		// if ($schedule['Attendance']['status'] == 'Late') {
								                           		// 	echo "<span class='label label-danger'>&nbsp;&emsp;&emsp;Late&emsp;&emsp;&nbsp;</span>";
								                           		// }
								                           			
								                           ?> 
								                        </td>
								                        <td class="text-center notes-td"> 
								                           <?php echo $schedule['Attendance']['notes']; ?> 
								                        </td>
								                       	<td>
								                      	<?php
														echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
														</span> ','#personalAttendance',
														array('class' =>'view_attendance table-link',
															   'escape' => false,
															   'data-url' => '/attendances/view/'.$schedule['Attendance']['id'],
															   'title'=>'Edit Information',
															   'data-toggle' => 'modal',
															   'data-id' => $schedule['Attendance']['id'],
															));




														if ($schedule['Attendance']['type'] != 'leave') {
															
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
																</span> ','#timeKeepAttendance',
																array('class' =>'add-timekeep table-link',
																	   'escape' => false,
																	   'title' => $title,
																	   'data-toggle' =>'modal',
																	   'data-id' => $schedule['Attendance']['id'],
																	   'onClick' => 'getEmployeeData(this,'.$schedule['Attendance']['id'].')'
																	));

															}

															echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Edit </font></span>
														</span> ','#editAttendance',
														array('class' =>'edit_attendance table-link',
															   'escape' => false,
															   'data-url' => '/attendances/edit_attendance/'.$schedule['Attendance']['id'],
															   'title'=>'Edit Information',
															   'data-toggle' => 'modal',
															   'data-id' => $schedule['Attendance']['id'],
															));


																echo $this->Html->link('<span class="fa-stack">
														<i class="fa fa-square fa-stack-2x"></i>
														<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Delete </font></span>
														</span> ',array(
															'controller' => 'attendances',
															'action' =>'delete',
															 $schedule['Attendance']['id']
															),
														array('class' =>'table-link',
															   'escape' => false,
															   'data-url' => '/attendances/view/'.$schedule['Attendance']['id'],
															   'title'=>'Edit Information',
															   'confirm' => 'Are you sure you want to delete this attendances ? ',
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
<?php echo $this->element('modals/personnal_attendance',array('employeeList' => $employeeList)); ?>

<?php echo $this->element('modals/time_in_attendance',array('employeeList' => $employeeList)); ?>

<?php echo $this->element('modals/time_in_attendance_log',array('employeeList' => $employeeList)); ?>

<?php echo $this->element('modals/time_in_edit',array('employeeList' => $employeeList )); ?>

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
                                                                'class' => 'form-control required',
                                                                'empty' => '---Select Department---',
                                                                'options' => array($departmentList)

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label">Date</label>
                        
                        <div class="col-lg-6">
                            <?php 
                                   echo $this->Form->input('Attendance.from_date', array(
                                                                'label' => false,
                                                                'class' => 'form-control datepick required',
                                                                'placeholder' => 'Date'

                                                              ));
                            ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary export-close"><i class="fa fa-share-square-o fa-lg"></i> Export</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>  
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){  

    	$('body').on('change','.datetimepick',function(){
			$('#myAttendance').close();

		});

		$('#AttendanceIndexForm').validate();

		$('.myDateRange').daterangepicker();

	});
</script>
<style type="text/css">
	.error.appended-error {
	    top: 0px;
	}
</style>
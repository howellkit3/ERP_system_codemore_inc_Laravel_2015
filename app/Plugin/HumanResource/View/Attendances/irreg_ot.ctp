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
			             
						<header class="main-box-header clearfix">
						   <h2 class=""><b>Irregular Overtime</b> </h2><br>
			                <div class="filter-block pull-left">
			                 <div class="form-group pull-left">
			                 	<?php echo $this->Form->create('Attendance',array('controller' => 'attendances','action' => 'irreg_ot', 'type'=> 'get')); ?>
			                 		

									<div class="input-group">
									    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									    <input placeholder="Date Range" name="data[date]" data="1" type="text" value="<?php echo $date ?>" class="form-control myDateRange datepickerDateRange" id="datepickerDateRange" >
									</div>


			                    </div>
			                    <div class="form-group pull-left">
			                 		 <input placeholder="Search..." class="form-control searchCustomer" value="<?php echo $search ?>" name="data[name]" />
			                            <i class="fa fa-search search-icon"></i>
								</div>
			                     <div class="form-group pull-left">
			                    	 <button class="btn btn-success">Go</button> 
			                     </div>

			                   <!--   <a data-toggle="modal" href="#myAttendance" class="btn btn-primary pull-right "><i class="fa fa-share-square-o fa-lg"></i> Export</a>
			                      -->
			                    <?php echo $this->Form->end(); ?>
			                   <br><br>
			               </div>
			            </header>

			          	<div class="main-box-body clearfix">
			            	<div class="table-responsive">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th><a href="#"><span>Code</span></a></th>
											<th><a href="#"><span>Employee Name</span></a></th>
											<th><a href="#" class="text-center"><span>From</span></a></th>
											<th><a href="#" class="text-center"><span>To</span></a></th>
											<th><a href="#" class="text-center"><span>Excess</span></a></th>
											<!-- <th><a href="#"><span>Actions</span></a></th> -->
										</tr>
									</thead>

									<tbody aria-relevant="all" aria-live="polite" role="alert">
									<?php 
								        if(!empty($overtimes)){

								        foreach ($overtimes as $key => $overtime): ?>

								        <tr>
								        	<td class="">
								            <?php echo $overtime['Employee']['code']; ?>
								            </td>
								            <td class="">
								            <?php echo $this->CustomText->getFullname($overtime['Employee']); ?>
								            </td>
								             <td class="">
								            <?php echo !empty($overtime['OvertimeExcess']['from']) ? date('Y/m/d H:i:a',strtotime($overtime['OvertimeExcess']['from'])) : ''; ?>
								            </td>
								            <td class="">
								            <?php echo !empty($overtime['OvertimeExcess']['to']) ? date('Y/m/d H:i:a',strtotime($overtime['OvertimeExcess']['to'])) : ''; ?>
								            </td>
											<td class="">
								           	 	<?php echo $overtime['OvertimeExcess']['used_time'] .' hr(s)' ?>
								            </td>

											<!-- <td class="">
												<?php 

													echo $this->Html->link('<span class="fa-stack">
																<i class="fa fa-square fa-stack-2x"></i>
																<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> Log </font></span>
																</span> ','#timeKeep',
																array('class' =>'add-timekeep table-link',
																	   'escape' => false,
																	   'title' => 'view excess time',
																	   'data-toggle' => 'modal',
																	   'data-id' => $overtime['OvertimeExcess']['id']
																	));
												?>
								            </td> -->
								        </tr>
								                
								   <?php endforeach; } ?> 
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


        $('.datepickerDateRange').daterangepicker();
	});
</script>
<style type="text/css">
	.error.appended-error {
	    top: 0px;
	}
	.datepickerDateRange {
		min-width: 215px;
	}
</style>
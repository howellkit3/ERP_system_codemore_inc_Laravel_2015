<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Jobs', array('controller' => 'jobs', 'action' => 'plans')); ?>
<?php $this->Html->addCrumb('Sheeting / Cutting', array('controller' => 'jobs', 'action' => 'sheeting')); 
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
?>
<?php echo $this->Html->css(array('HumanResource.default','Production.default','timepicker'));?>
<?php echo $this->Html->script(array(
						'Sales.jquery-sortable',
						'Sales.draggableproducts',
						'jquery.maskedinput.min',
						'HumanResource.custom',
                        'Production.machine_schedule',
                        'timepicker'
)); ?>

			
<?php 
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
 	echo $this->element('tab/jobs',array('active_tab' => $active_tab)); 

 ?>

<div class="row">
	<div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<div class="top-pad"></div>
			<div class="main-box-body clearfix">
			 
				<div class="tabs-wrapper">
					<div class="tab-content">
						<div class="tab-pane active" id="tab-calendar">
							<header class="main-box-header clearfix">
				                <h2 class="pull-left"><b><?php echo !empty($processDepartment['ProcessDepartment']['name']) ? $processDepartment['ProcessDepartment']['name'] : ''; ?></b> </h2>
				                <div class="filter-block pull-right">

				                 	<div class="form-group pull-left">
				                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
				                            <input placeholder="Search..." class="form-control searchMachine"  />
				                            <i class="fa fa-search search-icon"></i>
				                         <?php //echo $this->Form->end(); ?>
				                    </div>

				                    <div class="form-group pull-left">
			                 	
			                 			<input type="text" name="data[date]" id="changeDate" class="form-control datepick" value="<?php echo date('Y-m-d'); ?>">

			                            <i class="fa fa fa-calendar calendar-icon"></i>

			                    	</div>

				                   <br><br>
				               	</div>
				            </header>

							<div class="main-box-body clearfix">
				            	<div class="table-responsive overflow">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th><a href="#"><span>Job Ticket No.</span></a></th>
												<th><a href="#"><span>Product</span></a></th>
												<th><a href="#" class="text-center"><span>Quantity</span></a></th>
												<th><a href="#" class="text-center"><span>Schedule</span></a></th>
												<th><a href="#" class="text-center"><span>Start</span></a></th>
												<th><a href="#" class="text-center"><span>End</span></a></th>


												<th><a href="#" class="text-center"><span>Duration</span></a></th>



												<th><a href="#" class="text-center"><span>DT start </span></a></th>
												<th><a href="#" class="text-center"><span>DT end</span></a></th>

												<th><a href="#" class="text-center"><span>DT Duration</span></a></th>

												<th><a href="#" class="text-center"><span>Status</span></a></th>


												<th><a href="#"><span>Action</span></a></th>
											</tr>
										</thead>

										<?php //pr($machineScheduleData); 
									        if(!empty($outputs)){
									            foreach ($outputs as $key => $machineScheduleList): ?>
													<tbody aria-relevant="all" aria-live="polite" role="alert">
														<tr class="">

															<td class="">
									                           <?php echo $machineScheduleList['JobTicket']['uuid']; ?>
									                        </td>

									                        <td class="">
									                           <?php echo ucfirst($productName[$machineScheduleList['JobTicket']['product_id']]); ?>
									                        </td>

									                        <td class="quantity_input" >

									                        	<?php 
											                 			echo $this->Form->input('good',array(
													                 		'class' => 'select-department-view form-control',
													                 		'type' => 'number',
													                 		'div' => 'col-lg-6',
													                 		'placeholder' => '0',

													                 		'disabled' => 'disabled',
													                 		'value' => !empty($machineScheduleList['Output']['good']) ? $machineScheduleList['Output']['good'] : 0
													                 		));  ?>

									                        	<?php 
											                 			echo $this->Form->input('rejected',array(
													                 		'class' => 'select-department-view form-control',
													                 		'type' => 'number',
													                 		'div' => 'col-lg-6',
													                 		'placeholder' => '0',
													                 		'disabled' => 'disabled',
													                 		'value' => !empty($machineScheduleList['Output']['reject']) ? $machineScheduleList['Output']['reject'] : 0
													                 		));  ?>
									                          
									                        </td>

									                        <td class="">
									                           <?php 

									                           if (!empty( $machineScheduleList['MachineSchedule']['date'] )) {

									                           echo $machineScheduleList['MachineSchedule']['date'].' '.$machineScheduleList['MachineSchedule']['from'].' - '.$machineScheduleList['MachineSchedule']['to']; 
									                           }

									                           ?>
									                        </td>

									                        <td class="time_input">
									                         <!--   <?php echo !empty($machineScheduleList['MachineLog']['start']) ? $machineScheduleList['MachineLog']['start'] : ''; ?> -->

																<div class="form-group col-md-12">
																		<div class="input-group input-append bootstrap-timepicker">
																	
																			<?php echo !empty($machineScheduleList['MachineLog']['start']) ? $machineScheduleList['MachineLog']['start'] : '00:00:00'; ?>
																		</div>
																</div>


									                        </td>

									                        <td class="time_input">
									                          
									                           <div class="form-group col-md-12">
																		<div class="input-group input-append bootstrap-timepicker">
																		

																			<?php echo !empty($machineScheduleList['MachineLog']['end']) ? $machineScheduleList['MachineLog']['start'] : '00:00:00'; ?>
																		</div>
																</div>
									                        </td>


									                        <td class="time_input">
										                        <div class="input-group input-append bootstrap-timepicker">
																			
										                           <?php //echo !empty($machineScheduleList['MachineLog']['end']) ? $machineScheduleList['MachineLog']['end'] : ''; ?>
										                       </div>
									                        </td>



									                          <td class="time_input">
									                         <!--   <?php echo !empty($machineScheduleList['MachineLog']['start']) ? $machineScheduleList['MachineLog']['start'] : ''; ?> -->

																<div class="form-group col-md-12">
																		<div class="input-group input-append bootstrap-timepicker">
																				<?php echo !empty($machineScheduleList['MachineLog']['dt_start']) ? $machineScheduleList['MachineLog']['dt_start'] : '00:00:00'; ?>
																		</div>
																</div>


									                        </td>

									                        <td class="time_input">
									                          
									                           <div class="form-group col-md-12">
																		<div class="input-group input-append bootstrap-timepicker">
																			<?php echo !empty($machineScheduleList['MachineLog']['dt_end']) ? $machineScheduleList['MachineLog']['dt_end'] : '00:00:00'; ?>
																		</div>
																</div>
									                        </td>

									                        <td class="">
									                           <div class="input-group input-append bootstrap-timepicker">

									                           </div>
									                        </td>
									                        <td class="">
									                           <div class="input-group input-append bootstrap-timepicker">
									                           	<?php if(!empty($machineScheduleList['MachineLog']['status']) && $machineScheduleList['MachineLog']['status'] == 'full' ) : ?>
									                           		<span class="label label-success">Full</span>
									                           	<?php endif; ?>
									                           	<?php if(!empty($machineScheduleList['MachineLog']['status']) && $machineScheduleList['MachineLog']['status'] == 'partial' ) : ?>
									                           			<span class="label label-warning">Partial</span>
									                           	<?php endif; ?>
									                           </div>
									                        </td>

									                       	<td>
										                       	<a data-id="<?php echo $machineScheduleList['JobTicket']['id']; ?>" data-toggle="modal" title="View" data-url="/outputs/view_schedules/<?php echo $machineScheduleList['Output']['id']; ?>" class="view_full_ticket_details table-link" href="#ticketDataFullDetails">
										                       		<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
																	<!-- 	<span class="post"><font size="1px"> view </font></span> -->
																	</span>
																</a>
																
									                        </td>
									                    </tr>

									                </tbody>
									        <?php 
									            endforeach; 
									        } ?>
									</table>	

									<hr>

									<div class="paging" id="item_type_pagination">
			                            <?php
			                           
				                            // echo $this->Paginator->prev('< ' . __('previous'), array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable','model' => 'ClientOrder'));
				                            // echo $this->Paginator->numbers(array('separator' => '','paginate' => 'Employee'), array('paginate' => 'Employee'));
				                            // echo $this->Paginator->next(__('next') . ' >',  array('paginate' => 'Employee','model' => 'Employee'), null, array('class' => 'disable'));

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
</div>

<?php echo $this->element('modals/ticket_full_details'); ?>
<script>
		
	jQuery(document).ready(function($){

		$("#MachineSchedulePlansForm").validate();
		
		$('.datepick').datepicker({
			format: 'yyyy-mm-dd'
		});

		$('.timepicker').timepicker({
		    minuteStep: 5,
		    showSeconds: true,
		    showMeridian: false,
		    disableFocus: false,
		    showWidget: true
		}).focus(function() {
		    $(this).next().trigger('click');
		});
		
	});


</script>
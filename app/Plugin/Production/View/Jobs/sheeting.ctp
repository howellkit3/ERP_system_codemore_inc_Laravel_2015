<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Jobs', array('controller' => 'jobs', 'action' => 'plans')); ?>
<?php $this->Html->addCrumb('Sheeting / Cutting', array('controller' => 'jobs', 'action' => 'sheeting')); 
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
?>
<?php echo $this->Html->css(array('HumanResource.default'));?>
<?php echo $this->Html->css(array('Production.default'));?>
<?php echo $this->Html->script('Sales.jquery-sortable');?>
<?php echo $this->Html->script('Sales.draggableproducts');?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom',
                        'Production.machine_schedule'
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
				                <h2 class="pull-left"><b>Sheeting / Cutting</b> </h2>
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
				            	<div class="table-responsive">
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
												<th><a href="#"><span>Action</span></a></th>
											</tr>
										</thead>

										<?php //pr($machineScheduleData); 
									        if(!empty($machineScheduleData)){
									            foreach ($machineScheduleData as $key => $machineScheduleList): ?>
													<tbody aria-relevant="all" aria-live="polite" role="alert">
														<tr class="">

															<td class="">
									                           <?php echo $machineScheduleList['JobTicket']['uuid']; ?>
									                        </td>

									                        <td class="">
									                           <?php echo ucfirst($productName[$machineScheduleList['JobTicket']['product_id']]); ?>
									                        </td>

									                        <td class="">
									                           <?php //echo $machineScheduleList['MachineSchedule']['quantity']; ?>

									                            <td class="">
									                        	<?php 
											                 			echo $this->Form->input('good',array(
													                 		'class' => 'select-department-view form-control'
													                 		));  ?>

									                        	<?php 
											                 			echo $this->Form->input('rejected',array(
													                 		'class' => 'select-department-view form-control'
													                 		));  ?>
									                          
									                        </td>
									                        </td>

									                        <td class="">
									                           <?php 

									                           if (!empty( $machineScheduleList['MachineSchedule']['date'] )) {

									                           echo $machineScheduleList['MachineSchedule']['date'].' '.$machineScheduleList['MachineSchedule']['from'].' - '.$machineScheduleList['MachineSchedule']['to']; 
									                           }

									                           ?>
									                        </td>

									                        <td class="">
									                           <?php echo !empty($machineScheduleList['MachineLog']['start']) ? $machineScheduleList['MachineLog']['start'] : ''; ?>
									                        </td>

									                        <td class="">
									                           <?php echo !empty($machineScheduleList['MachineLog']['start']) ? $machineScheduleList['MachineLog']['end'] : ''; ?>
									                        </td>

									                       	<td>
										                       	<a data-id="<?php echo $machineScheduleList['JobTicket']['id']; ?>" data-toggle="modal" title="Edit Information" data-url="/machine_shedules/ticket_data_view/<?php echo $machineScheduleList['JobTicket']['id']; ?>" class="view_full_ticket_details table-link" href="#ticketDataFullDetails">
										                       		<span class="fa-stack">
																		<i class="fa fa-square fa-stack-2x"></i>
																		<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
																		<span class="post"><font size="1px"> view </font></span>
																	</span>
																</a>
																<?php if (empty($machineScheduleList['MachineLog']['start'])) { ?>
										                      		<a onclick="getTicketData(this,13)" data-id="13" data-toggle="modal" title="Time Out" class="add-timekeep table-link" href="#timeKeep">
										                       			<span class="fa-stack">
																			<i class="fa fa-square fa-stack-2x"></i>
																			<i class="fa fa-sign-out fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
																			<span class="post"><font size="1px"> Start </font></span>
																		</span> 
																	</a>
																<?php } else { ?>
																	<a onclick="getTicketData(this,13)" data-id="13" data-toggle="modal" title="Time Out" class="add-timekeep table-link" href="#timeKeep">
										                       			<span class="fa-stack">
																			<i class="fa fa-square fa-stack-2x"></i>
																			<i class="fa fa-sign-out fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;
																			<span class="post"><font size="1px">&nbsp; End </font></span>
																		</span> 
																	</a>
																<?php } ?>
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

<style type="text/css">
	.fa-stack{
		color: #03a9f4;
	}
	.header-drag-section{
		background: #03A9F4;
		padding: 15px 1px 1px;
	}
	.sched-header{
		color: white;
	}
	.dragField{
		padding: 0px;
	}
	/*.table-link{
		position: relative;
		top: -17px;
	}*/
	.modal-header{
		background: #03A9F4;
		color: white;
	}
</style>
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
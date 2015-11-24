<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>

			
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
				                <h2 class="pull-left"><b>Production Schedule</b> </h2>
				                <div class="filter-block pull-right">
<!-- 
				                 	<div class="form-group pull-left">
				                        <?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
				                            <input placeholder="Search..." class="form-control searchPrinting"  />
				                            <i class="fa fa-search search-icon"></i>
				                        <?php //echo $this->Form->end(); ?>
				                    </div>

				                    <div class="form-group pull-left">
			                 	
			                 			<input type="text" name="data[date]" id="changeDate" class="form-control datepick" value="<?php echo date('Y-m-d'); ?>">

			                            <i class="fa fa fa-calendar calendar-icon"></i>

			                    	</div> -->

				                   <br><br>
				               	</div>
				            </header>

							<div class="main-box-body clearfix">
				            	<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th><a href="#"><span>Date Recieved.</span></a></th>
												<th><a href="#"><span>Del Date</span></a></th>
												<th><a href="#" class="text-center"><span>Production Date</span></a></th>
												<th><a href="#" class="text-center"><span>Process</span></a></th>
												<th><a href="#" class="text-center"><span>Machine</span></a></th>
												<th><a href="#" class="text-center"><span>Material</span></a></th>
												<th><a href="#" class="text-center"><span>Raw Materials</span></a></th>
												<th><a href="#"><span>Cutting Size</span></a></th>
												<th><a href="#"><span>PO Quantity</span></a></th>
												<th><a href="#"><span> Quantity </span></a></th>
												<th><a href="#"><span> UOM </span></a></th>
												<th><a href="#"><span> OUTS </span></a></th>
											</tr>
										</thead>

										<?php 
									        if(!empty($tickets)){
									            foreach ($tickets as $key => $ticket): ?>
													<tbody aria-relevant="all" aria-live="polite" role="alert">
														<tr class="">
															<td class="">
									                           <?php echo !empty($ticket['RecievedTicket']['created']) ? date('Y-m-d',strtotime($ticket['RecievedTicket']['created'])) : '' ?>
									                        </td>
									                        <td class="">
									                           <?php echo !empty($ticket['ClientOrderDeliverySchedule'][0]['schedule']) ? date('Y-m-d',strtotime($ticket['ClientOrderDeliverySchedule'][0]['schedule'])) : '' ?>
									                        </td>
									                         <td class="">
									                           <?php echo !empty($ticket['TicketProcessSchedule']['production_date']) ? date('Y-m-d',strtotime($ticket['TicketProcessSchedule']['production_date'])) : '' ?>
									                        </td>
									                        <td class="">
									                           <?php echo !empty($ticket['TicketProcessSchedule']['department_process_id']) ?  $departmentProcess[$ticket['TicketProcessSchedule']['department_process_id']] : '' ?>
									                        </td>
									                        <td class="">
									                           <?php echo !empty($ticket['TicketProcessSchedule']['machine_id']) ?  $machineData[$ticket['TicketProcessSchedule']['machine_id']] : '' ?>
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
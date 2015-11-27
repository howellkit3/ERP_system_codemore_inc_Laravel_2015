<?php 
$this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); 
$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
echo $this->element('tab/jobs',array('active_tab' => $active_tab)); 
// echo $this->Html->script(array(
// 	'StickyTableHeaders/js/jquery.ba-throttle-debounce.min',
// 	'StickyTableHeaders/js/jquery.stickyheader'
// 	));
// echo $this->Html->css(array(
// 	'StickyTableHeaders/css/component.css',
// 	//'StickyTableHeaders/css/demo.css',
// 	'StickyTableHeaders/css/normalize.css'
// 	));
echo $this->Html->script(array(
                    'datetimepicker/jquery.datetimepicker',

)); 
echo $this->Html->css(array(
	'Production./css/default',
	'datetimepicker/jquery.datetimepicker'
	));


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
				                <div class="clearfix"></div>
				                <div class="filter-block pull-left">
				               	<?php echo $this->Form->create('Production',array('url' => array(
				               	'controller' => 'production_dashboards','action' => 'index'),'type'=> 'get')); ?>
									
									<div class="form-group pull-left">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input placeholder="Date Range" name="data[date]" data="1" type="text" class="form-control myDateRange"  value="<?php echo $selectedDate; ?>" >
										</div>
									</div>
									
										<button class="btn btn-success" type="submit">
												SEARCH
										</button>

			                    	<?php echo $this->Form->end(); ?>
				                   <br><br>
				               	</div>
				            </header>

							<div class="main-box-body clearfix">
				            	<div class="table-responsive overflow">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th><a href="#"><span>Date Recieved.</span></a></th>
												<th><a href="#"><span>Del Date</span></a></th>
												<th><a href="#" class="text-center"><span>Production Date</span></a></th>
												<th><a href="#" class="text-center"><span>Process</span></a></th>
												<th><a href="#" class="text-center"><span>Machine</span></a></th>
												<th><a href="#" class="text-center"><span>JobTicket</span></a></th>
												<th><a href="#" class="text-center"><span>PO Number</span></a></th>
												<th><a href="#" class="text-center"><span>Customer</span></a></th>
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
									                           <?php echo !empty($ticket['ClientOrderDeliverySchedule']['schedule']) ? date('Y-m-d',strtotime($ticket['ClientOrderDeliverySchedule']['schedule'])) : '' ?>
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

									                        <td>
									                        	<?php 
									                        		echo !empty($ticket['JobTicket']['uuid']) ? $ticket['JobTicket']['uuid'] : ''; 
									                        	?>
									                        </td>
									                         <td>
									                        	<?php 
									                        		echo !empty($ticket['JobTicket']['po_number']) ? $ticket['JobTicket']['po_number'] : ''; 
									                        	?>
									                        </td>

									                        <td>
									                        	<?php 
									                        		echo !empty($ticket['Company']['company_name']) ? $ticket['Company']['company_name'] : ''; 
									                        	?>
									                        </td>

									                        <td>
									                        	<?php 
									                        		echo !empty($ticket['Product']['name']) ? $ticket['Product']['name'] : ''; 
									                        	?>
									                        </td>

									                        <td class="">
									                           <?php echo !empty($ticket['ProductSpecificationPart']['material']) ?   $ticket['ProductSpecificationPart']['material'] : '' ?>
									                        </td>
									                         <td class="">
									                           <?php echo '' ?>
									                        </td>
									                          <td class="">
									                           <?php 
																echo !empty($ticket['ProductSpecificationPart']['size1']) ? $ticket['ProductSpecificationPart']['size1'] : '0'; 
																echo " x ";
																echo !empty($ticket['ProductSpecificationPart']['size2']) ? $ticket['ProductSpecificationPart']['size2'] : '0';
											
																?>
									                        </td>
									                        <td class="">
									                           <?php echo $ticket['ProductSpecification']['quantity']; ?>
									                        </td>
									                        <td class="">
									                           
									                           <?php echo !empty($ticket['ProductSpecificationPart']['quantity_unit_id']) ? $unitData[$ticket['ProductSpecificationPart']['quantity_unit_id']] : ''; ?>
									                        </td>
									                        <td class="">
									                           <?php
									                           	$outs1 = ($ticket['ProductSpecificationPart']['outs1'] > 0) ?  floatval($ticket['ProductSpecificationPart']['outs1']) : 1;
									                           	$outs2 = ($ticket['ProductSpecificationPart']['outs2'] > 0) ? floatval($ticket['ProductSpecificationPart']['outs2']) : 1;

									                           	echo $outs1 * $outs2;

									                            //echo $ticket['ProductSpecificationPart']['quantity']; ?>
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

<script type="text/javascript">
	$(document).ready(function(){

		$('.myDateRange').daterangepicker();




	});
</script>
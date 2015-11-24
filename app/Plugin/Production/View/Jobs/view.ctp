<?php $this->Html->addCrumb('Production', array('controller' => 'dashboards', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Jobs', array('controller' => 'jobs', 'action' => 'plans')); ?>
<?php $this->Html->addCrumb('Stripping', array('controller' => 'jobs', 'action' => 'stripping')); 
	$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
?>
<?php echo $this->Html->css(array('Production.default'));?>
<?php echo $this->Html->script('Sales.jquery-sortable');?>
<?php echo $this->Html->script('Sales.draggableproducts');?>
<?php echo $this->Html->script(array(
						'jquery.maskedinput.min',
						'HumanResource.custom',
                        'Production.machine_schedule'
)); 

$active_tab = !empty($this->params['named']['tab']) ? $this->params['named']['tab'] : '';
echo $this->element('tab/jobs',array('active_tab' => $active_tab)); 
 ?>



<div class="row">
	<div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<div class="top-pad"></div>
    		<div class="tabs-wrapper">
					<div class="tab-content">
						<div class="tab-pane active" id="tab-calendar">
						 <div class="filter-block pull-left">
							<h2>Job Ticket View</h2>
						 </div>
							  
							 <div class="filter-block pull-right">


										<div class="form-group pull-left">
					                        <?php 
					                        	
					                        	echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'jobs', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

					                        	if (!empty($RecievedTicket['RecievedTicket']['id']) && $RecievedTicket['RecievedTicket']['status']  == 'recieved') {

					                        	} else {

												echo $this->Html->link('<i class="fa fa fa-level-down fa-lg"></i> Recieved ', array('controller' => 'jobs', 'action' => 'recieved_tickets',$jobData['JobTicket']['id']),array('class' =>'btn btn-primary pull-right','escape' => false));

					                        	}
					                        ?>
				                    	</div>
				               	</div>
				        </div>
				    </div>
				</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box">

			<div class="main-box-body clearfix">
			<br>
				<div class="col-lg-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>Customer </td>
										<td> <?php echo !empty($companyData[$productData['Product']['company_id']]) ? ucfirst($companyData[$productData['Product']['company_id']]) : '' ; ?> </td>
									</tr>
									<tr>
										<td>Item </td>
										<td> <?php 
										echo !empty($productData['Product']['name']) ? ucfirst($productData['Product']['name']) : '' ;
									?> </td>
									</tr>
									<tr>
										<td>Item Size</td>
										<td>  <?php 
										echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size1'] : '0'; 
										echo " x ";
										echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size2'] : '0';
										echo " x ";
										echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size3'] : '0';
										?> 
										</td>
									</tr>
									<tr>
										<td>PO Quantity</td>
										<td> 
										<?php 
											echo $specs['ProductSpecification']['quantity']; 
											echo " ";
											echo $unitData[$specs['ProductSpecification']['quantity_unit_id']];
											
										?> </td>
									</tr>
									<tr>
										<td>Status</td>
										<td> 
										<?php if (!empty($RecievedTicket['RecievedTicket']['id']) && $RecievedTicket['RecievedTicket']['status']  == 'recieved') { ?>
												<span class="label label-success">Recieved</span>
					                       <?php } else { ?>

					                       	<span class="label label-default">Pending</span>
					                        <?php } ?> </td>
									</tr>
								</tbody>
							</table>
				</div>
				<div class="col-lg-6">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>Schedule No </td>
										<td>  <?php echo $jobData['JobTicket']['uuid']; ?> </td>
									</tr>
									<tr>
										<td>PO No.</td>
										<td> <?php echo $jobData['JobTicket']['po_number']; ?> </td>
									</tr>
									<tr>
										<td>Delivery Date</td>
										<td> 
										<?php echo !empty($schedules[0]['ClientOrderDeliverySchedule']['schedule']) ? date('Y-m-d',strtotime($schedules[0]['ClientOrderDeliverySchedule']['schedule'])) : ''; ?>
										 </td>
									</tr>
									<tr>
										<td>Stock Quantity</td>
										<td> <?php echo !empty($specs['ProductSpecification']['stock']) ? $specs['ProductSpecification']['stock'] : ''; ?> </td>
									</tr>
									<tr>
										<td>Recieved Date</td>
										<td> <?php echo !empty( $RecievedTicket['RecievedTicket']['created'] ) ? date('Y-m-d',strtotime($RecievedTicket['RecievedTicket']['created'])) : ''; ?> </td>
									</tr>
								</tbody>
						</table>
				</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box <?php echo (!empty($RecievedTicket['RecievedTicket']['id']) && $RecievedTicket['RecievedTicket']['status']  == 'recieved') ? '' : 'disabled' ?>">
				
			<div class="main-box-body clearfix">
					<h2 class="pull-left">
						Process
				</h2>
							<div class="clearfix"></div>

							<?php $componentCounter = 1?>
							<?php $partCounter = 1?>
							<?php $processCounter = 1?>
							<div class="row">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<?php 

											$product = array();
											foreach ($formatDataSpecs as $key => $specLists) { ?>
											
											<?php

												$component  = '';

										      	if($specLists['ProductSpecificationDetail']['model'] == 'Component'){

										      		echo $this->element('specs/component', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $componentCounter));
										      		$componentCounter++;

										      		$component = $formatDataSpecs[$key];

										      	}

										      	if($specLists['ProductSpecificationDetail']['model'] == 'Part'){
										      			
										      		echo $this->element('specs/part', array('formatDataSpecs' => $formatDataSpecs[$key],
										      			'key' => $partCounter,
										      			'component' => $component,
										      			'machines' => $machines
										      			 ));

										      		$partCounter++;

										      		if (!empty($specLists['ProductSpecificationDetail'])) {
										      				$product = $specLists['ProductSpecificationDetail'];


										      	}
										      		//pr($specLists); exit;
										      		$componentName = $specLists['ProductSpecificationPart']['name'];
										      		
										      	}

										      	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){

										      		echo $this->element('specs/set_process', array('dataSpecs' => $formatDataSpecs[$key]
										      			,'key' => $processCounter,
										      			'product' => $product,
										      			'componentName' => $componentName
										      			));

										      		$processCounter++;

										      	}

										     }
									      	?>
							      	
									</thead>
							    </table>
							    </div>
						   	</div> 
			</div>
		</div>
	</div>
</div>
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
	.table-link{
		position: relative;
		top: -17px;
	}
	.modal-header{
		background: #03A9F4;
		color: white;
	}
</style>

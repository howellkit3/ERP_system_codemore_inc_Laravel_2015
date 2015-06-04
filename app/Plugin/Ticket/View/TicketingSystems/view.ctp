<?php $this->Html->addCrumb('Ticketing System', array('controller' => 'ticketing_systems', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'ticketing_systems', 'action' => 'view')); ?>

<div class="row">
	<div class="col-lg-12">	

		<div class="row">
			<div class="col-lg-12">
				<header class="main-box-header clearfix">
					
					<h1 class="pull-left">
						Job Ticket View
					</h1>
					<div class="filter-block pull-right">
						<?php 
	                        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'ticketing_systems', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

	                        echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print ', array('controller' => 'ticketing_systems', 'action' => 'print_ticket',$productData['Product']['uuid'],$ticketData['JobTicket']['uuid'],$clientOrderId),array('class' =>'btn btn-primary pull-right','escape' => false,'target' => '_blank'));
	                    ?>
                    </div>
				</header>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="main-box">
					<center>
						<header class="main-box-header clearfix"><?php //echo pr($contactInfo);die; ?>
							<h1>Kou Fu Color Printing</h1>
							<h5>Lot 4-5, Blk 3 Phase 2, Mountview Industrial Complex, Bancal, Carmona, Cavite</h5>
							<h6>Tel#: (046) 972-1111 to 13 Fax#: (046) 972-0120</h6><br>
							<h2>Main Job Ticket</h2><br>
						</header>
					</center>
					
					<div class="main-box-body clearfix">
						<form class="form-horizontal" role="form">
							
							<div class="form-group">
								<div class="col-lg-2"></div>
								<div class="col-lg-6"></div>
								<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
									Date : <?php echo (new \DateTime())->format('l, F d, Y '); ?>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-2">
									&nbsp;&nbsp;Customer
								</div>
								<div class="col-lg-5">
									:&emsp;
									<?php 
										echo !empty($companyData[$productData['Product']['company_id']]) ? ucfirst($companyData[$productData['Product']['company_id']]) : '' ;

									?>
								</div>
								<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;
									Schedule No. : <?php echo $ticketData['JobTicket']['uuid']; ?>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-2">
									&nbsp;&nbsp;Item
								</div>
								<div class="col-lg-6">
									:&emsp;
									<?php 
										echo !empty($productData['Product']['name']) ? ucfirst($productData['Product']['name']) : '' ;
									?>
								</div>
								<div class="col-lg-4">&emsp;&emsp;&emsp;&emsp;
									 to follow
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-2">
									&nbsp;&nbsp;Item size
								</div>
								<div class="col-lg-5">
									:&emsp;
									<?php 
										echo $specs['ProductSpecification']['size1']; 
										echo " x ";
										echo $specs['ProductSpecification']['size2'];
										echo " x ";
										echo $specs['ProductSpecification']['size3'];
											
									?>
								</div>
								<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;
									Delivery Date : <?php echo date('M d, Y', strtotime($delData['ClientOrderDeliverySchedule'][0]['schedule'])); ?>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-2">
									&nbsp;&nbsp;PO Quantity 
								</div>
								<div class="col-lg-5">
									:&emsp;
									
										<?php 
											echo $specs['ProductSpecification']['quantity']; 
											echo " ";
											echo $unitData[$specs['ProductSpecification']['quantity_unit_id']];
											
										?>
									
								</div>
								<div class="col-lg-4">&emsp;&emsp;
									Stock Quantity : <?php //echo date('M d, Y', strtotime($delData['ClientOrderDeliverySchedule'][0]['schedule'])); ?>
								</div>
							</div>

							<hr>

							<?php $componentCounter = 1?>
							<?php $partCounter = 1?>
							<?php $processCounter = 1?>
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<?php foreach ($formatDataSpecs as $key => $specLists) { ?>
							
											<?php

										      	if($specLists['ProductSpecificationDetail']['model'] == 'Component'){

										      		echo $this->element('Specs/component', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $componentCounter));
										      		$componentCounter++;
										      	}
										      	if($specLists['ProductSpecificationDetail']['model'] == 'Part'){
										      		
										      		echo $this->element('Specs/part', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $partCounter));
										      		$partCounter++;
										      		
										      	}
										      	if($specLists['ProductSpecificationDetail']['model'] == 'Process'){
										      		
										      		echo $this->element('Specs/process', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $processCounter));
										      		$processCounter++;

										      	}
									      	?>
							      	
										<?php } ?>
									</thead>
							    </table>
						   	</div> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
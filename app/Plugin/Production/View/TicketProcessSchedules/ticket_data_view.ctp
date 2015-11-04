<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix"><?php  ?>
					<h1>Kou Fu Packaging Corporation</h1>
					<h5>Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h5>
					<h6>Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952</h6><br>
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
								echo !empty($companyData[$jobTickets['Product']['company_id']]) ? ucfirst($companyData[$jobTickets['Product']['company_id']]) : '' ;

							?>
						</div>
						<div class="col-lg-4">
							Schedule No. : <?php echo $jobTickets['JobTicket']['uuid']; ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-2">
							&nbsp;&nbsp;Item
						</div>
						<div class="col-lg-5">
							:&emsp;
							<?php 
								echo !empty($jobTickets['Product']['name']) ? ucfirst($jobTickets['Product']['name']) : '' ;
							?>
						</div>
						<div class="col-lg-4">
							PO No. : <?php echo $jobTickets['JobTicket']['po_number']; ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-2">
							&nbsp;&nbsp;Item size
						</div>
						<div class="col-lg-5">
							:&emsp;
							<?php 
								echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size1'] : '0'; 
								echo " x ";
								echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size2'] : '0';
								echo " x ";
								echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size3'] : '0';
									
							?>
						</div>
						<div class="col-lg-4">
							Delivery Date : <?php echo date('M d, Y', strtotime($jobTickets['ClientOrderDeliverySchedule']['schedule'])); ?>
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
						<div class="col-lg-4">
							Stock Quantity : <?php if(!empty($specs['ProductSpecification']['stock'])){ echo $specs['ProductSpecification']['stock']; }?>
						</div>
					</div>

					<hr>

					<?php $componentCounter = 1?>
					<?php $partCounter = 1?>
					<?php $processCounter = 1?>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<?php 

								foreach ($formatDataSpecs as $key => $specLists) { ?>
					
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

								      		
								      		echo $this->element('Specs/process', array('dataSpecs' => $formatDataSpecs[$key],'key' => $processCounter,'subProcessData' => $subProcessData,'ticketData' => $jobTickets));
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
<?php if (!empty($ticketData['JobTicket']['remarks'])) { ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="main-box">
				
				<header class="main-box-header clearfix">
					<h2>Remarks</h2>
				</header>
				<p style="text-indent:50px;">
					<?php echo ucfirst($ticketData['JobTicket']['remarks']); ?>
				</p>
				
			</div>
			
		</div>
	</div>
<?php } ?>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			
			<header class="main-box-header clearfix">
				<h2>Issuer</h2>
			</header>
			<p style="text-indent:50px;">
				<?php echo ucfirst($userData['User']['first_name']); ?>&nbsp;
				<?php echo ucfirst($userData['User']['last_name']); ?>
			</p>
			
		</div>
		
	</div>
</div>
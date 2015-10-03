<?php $this->Html->addCrumb('Ticketing System', array('controller' => 'ticketing_systems', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'ticketing_systems', 'action' => 'view')); ?>
<?php echo $this->Html->script('Ticket.ticket'); ?>
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

	                        if(!empty($ticketData['JobTicket']['remarks'])){
	                        	$buttonName = 'Edit Remarks';
	                        }else{
	                        	$buttonName = 'Add Remarks';
	                        }

	                        	echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> (Pre-Press) PDF ', array(
					        	'controller' => 'ticketing_systems', 
					        	'action' => 'prepress_ticket',$productData['Product']['uuid'],$ticketData['JobTicket']['uuid'],$clientOrderId),
					        	array('class' =>'btn btn-info pull-right','escape' => false,'target' => '_blank'));

	                       
							echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> (Job Ticket) EXCEL ', array(
					        	'controller' => 'ticketing_systems', 
					        	'action' => 'excel_ticket',$productData['Product']['uuid'],$ticketData['JobTicket']['uuid'],$clientOrderId),
					        	array('class' =>'btn btn-info pull-right ','escape' => false));


							echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> (Job Ticket) PDF ', array(
					        	'controller' => 'ticketing_systems', 
					        	'action' => 'print_ticket_export',$productData['Product']['uuid'],$ticketData['JobTicket']['uuid'],$clientOrderId,'pdf'),
					        	array('class' =>'btn btn-info pull-right','target' => '_blank','escape' => false));
						?>

						<!-- <a href="#" class="btn btn-primary mrg-b-lg pull-right <?php echo $noPermissionSales; ?>"> <i class="fa fa-file"></i> Export </a> -->

	                    <a data-toggle="modal" href="#myModalRemarks" class="btn btn-primary mrg-b-lg pull-right "><i class="fa fa-pencil fa-lg"></i> <?php echo $buttonName ;?></a>

                    </div>
				</header>
			</div>
		</div>

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
									Date : <?php echo date('M d, Y'); ?>
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
								<div class="col-lg-4">
									Schedule No. : <?php echo $ticketData['JobTicket']['uuid']; ?>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-2">
									&nbsp;&nbsp;Item
								</div>
								<div class="col-lg-5">
									:&emsp;
									<?php 
										echo !empty($productData['Product']['name']) ? ucfirst($productData['Product']['name']) : '' ;
									?>
								</div>
								<div class="col-lg-4">
									PO No. : <?php echo $ticketData['JobTicket']['po_number']; ?>
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
									Delivery Date : <?php 

									if (!empty($delData['ClientOrderDeliverySchedule'][0]['schedule'])) {
										echo date('M d, Y', strtotime($delData['ClientOrderDeliverySchedule'][0]['schedule'])); 
									}
									?>
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
<!-- 
							<div class="filter-block pull-left">
								<?php 
								echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> (Pre-Press) PDF ', array(
					        	'controller' => 'ticketing_systems', 
					        	'action' => 'prepress_ticket',$productData['Product']['uuid'],$ticketData['JobTicket']['uuid'],$clientOrderId),
					        	array('class' =>'btn btn-info pull-right '.$noPermissionSales,'escape' => false,'target' => '_blank'));


								?>
							</div> -->

							<div class="clearfix"></div>	
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

	</div>
</div>

<div class="modal fade" id="myModalRemarks" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Remarks</h4>
            </div>
            <div class="modal-body">
             <?php echo $this->Form->create('JobTicket',array('url'=>(array('controller' => 'ticketing_systems','action' => 'add_remarks')),'class' => 'form-horizontal'));?>
                <?php 
                    echo $this->Form->input('JobTicket.id', array('class' => 'form-control item_type required',
                        'type' => 'hidden',
                        'value' => $ticketData['JobTicket']['id'],
                        'type' => 'hidden'));
                    echo $this->Form->input('JobTicket.product_uuid', array('class' => 'form-control item_type required',
                        'type' => 'hidden',
                        'value' => $productData['Product']['uuid'],
                        'type' => 'hidden'));
                     echo $this->Form->input('JobTicket.client_order_id', array('class' => 'form-control item_type required',
                        'type' => 'hidden',
                        'value' => $ticketData['JobTicket']['client_order_id'],
                        'type' => 'hidden'));
                ?>

                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-2 control-label"> Remarks</label>
                        <div class="col-lg-9">
                            <?php 
                                echo $this->Form->input('JobTicket.remarks', array(
                                    'label' => false,
                                    'class' => 'form-control ',
                                    'empty' => false,
                                    'value' => !empty($ticketData['JobTicket']['remarks']) ? $ticketData['JobTicket']['remarks'] : ' '
                                )); ?>
                        </div>
                    </div>
   
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Add Remarks</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
                </form>
                
            </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="processModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Job Tickets</h4>
            </div>
            <div class="modal-body">
            	<div id="result-table">

            	</div>
            </div>
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

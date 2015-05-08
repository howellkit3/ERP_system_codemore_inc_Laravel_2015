<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotations', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'quotations', 'action' => 'view',$quotation['Quotation']['id'])); ?>
<?php echo $this->Html->script('Sales.custom');?>
<?php echo $this->Html->css('redactor.css?v='.filemtime('css/redactor.css')); ?>
<?php echo $this->Html->script('redactor/redactor/redactor_new.js?v='.filemtime('js/redactor/redactor/redactor_new.js'));?>

<div style="clear:both"></div>


<?php echo $this->element('sales_option');?>

<div class="filter-block pull-right">
    <?php
    	// buttons
        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

		if($clientOrderCount == 0){

			$status = ($this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';
	
			echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Create Order ', array('controller' => 'create_order', 'action' => 'index',$quotation['Quotation']['id'],$quotation['Quotation']['uuid']),array('class' =>'btn btn-primary pull-right '.$status,'escape' => false)) ;
		

			
		}else{

			echo $this->Html->link('<font color="white"><i class="fa fa-gift fa-lg"></i> Sales Order</font> ', array('controller' => 'quotations', 'action' => 'create_order',$quotation['Quotation']['id']),array('class' =>'btn btn-success pull-right','escape' => false,'disabled' => 'disabled')) ;
		}
	

    	echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i>Approved ', array('controller' => 'quotations', 'action' => 'approved',$quotation['Quotation']['id']),array('class' =>'btn btn-success pull-right','escape' => false)) ;
    	
		echo $this->Html->link('<i class="fa fa-share fa-lg"></i> Submit Quotation', array('controller' => 'quotations', 'action' => 'drafts',$quotation['Quotation']['id']),array('class' =>'btn btn-success pull-right','escape' => false)) ;
				
    	$status = ($this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';

		echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit ', array('controller' => 'quotations', 'action' => 'edit',$quotation['Quotation']['id'],$companyId),array('class' =>'btn btn-info pull-right '. $status ,'escape' => false)) ;
    	
    	$status = (!$this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';

    	echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print ', array(
		        	'controller' => 'quotations', 
		        	'action' => 'print_word',
		        	'ext' => 'pdf',
		        	$quotation['Quotation']['id'],$companyId),
		        	array('class' =>'btn btn-info pull-right '.$status,'escape' => false,'target' => '_blank'));

    	$status = (!$this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';

    	echo $this->Html->link('<i class="fa fa-envelope-o fa-lg"></i> Send Via Email ','#QuotationEmail',
		        	array('data-toggle' => 'modal', 'class' =>'btn btn-info pull-right '.$status,'escape' => false,'target' => '_blank'));
    				
    
    	

    	 // echo $this->Html->link('<i class="fa fa-times fa-lg"></i> Terminate ', array('controller' => 'quotations', 'action' => 'status',3,$quotation['Quotation']['id']),array('class' =>'btn btn-danger pull-right','escape' => false));

    	 // echo $this->Html->link('<i class="fa fa-location-arrow fa-lg"></i> Withdraw ', array('controller' => 'quotations', 'action' => 'status',4,$quotation['Quotation']['id']),array('class' =>'btn btn-warning pull-right','escape' => false));
     ?>
   
   <br><br>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix"><?php //echo pr($contactInfo);die; ?>
					<h1>Kou Fu Packaging Corp.</h1>
					<h5>Lot 4-5, Blk 3 Phase 2, Mountview Industrial Complex, Bancal, Carmona, Cavite</h5>
					<h6>Tel#: (046) 972-1111 to 13 Fax#: (046) 972-0120</h6><br>
					<h2>Price Quotation</h2><br>
				</header>
			</center>
			
			<div class="main-box-body clearfix">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-2">
							Attention
						</div>
						<div class="col-lg-5">
							:&emsp;
							<?php 
							// 	echo $quotation['Quotation']['attention_details']
								echo !empty($quotation['Quotation']['company_id']) ? ucfirst($companyData[$quotation['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$quotation['Quotation']['inquiry_id']]]) 
							?>
						</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							No : <u>PQ-<?php echo $quotation['Quotation']['uuid'] ?></u>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-5">
							___________________________________________________
						</div>
						<div class="col-lg-4">&emsp;&emsp;&emsp;
							Date :&nbsp;<?php echo !empty($quotation['Quotation']['created']) ? date('Y/m/d', strtotime($quotation['Quotation']['created'])) : '' ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-10">
							Dear :&nbsp; <?php echo ucfirst($quotation['ContactPerson']['firstname']).' '.ucfirst($quotation['ContactPerson']['lastname']) ?>&nbsp;
							
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-8">
							We are pleased to submit our price quotation on your printing requirement under the following specifications:
						</div>
					</div><br>
					<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Item
							</div>
							<div class="col-lg-8">
								<?php echo $quotation['Product']['name']?>
							</div>

					</div>
					<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Size
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['size']?>
							</div>

					</div>
					<div>
					<!-- <div class ="boxed2"> -->
					<div class="form-group">
							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Qty<br><br>
								Unit Price<br><br>
								Vat Price<br><br>
								Material
							</div>
							<div class="col-lg-8"><div class="pull-left"></div>
								<?php foreach ($quotation['QuotationItemDetail'] as $itemDetail){ ?>
									<table  class = "tbl">
										<tr>
											
											<td height ="35px" valign ="top" class ="column3 col-md-8"> 
												<div class="col-lg-12">
													<?php echo $itemDetail['quantity'];?> 

													<?php
													 echo !empty($units[$itemDetail['quantity_unit_id']]) ? $units[$itemDetail['quantity_unit_id']] : '' ?> 
												</div>
											</td>	
											
										</tr>
										<tr>
											<td height ="35px" valign ="top" class = "column4 col-md-8">
												<div class="col-lg-12">
													<?php echo (!empty($itemDetail['unit_price']) && is_numeric($itemDetail['unit_price'])) ? number_format($itemDetail['unit_price'],4) : '';?> 
													<?php
													 echo !empty($currencies[$itemDetail['unit_price_currency_id']]) ? $currencies[$itemDetail['unit_price_currency_id']] : '' ?> 
												</div>
											</td>
										</tr>
										<tr>
											<td height ="40px" class ="column2 col-md-8">
												<div class="col-lg-12">
													<?php echo $itemDetail['vat_price'];?> 
												</div>
											</td>
										</tr>

										<tr>
											
											<td height ="30px" class ="column2 col-md-8">
												<div class="col-lg-12">
													<?php echo $itemDetail['material'];?> 
												</div>
											</td>
											
										</tr>

									</table>
								<?php } ?>

							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Color
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['color']?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Process
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['process']?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Packaging
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['packaging']?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Other Specs
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['other_specs']?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Terms
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo !empty($paymentTerm[$quotation['Quotation']['payment_terms']]) ? $paymentTerm[$quotation['Quotation']['payment_terms']]: '' ?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Validity
							</div>
							<div class="col-lg-8">
								:&emsp;
								   <?php echo !empty($quotation['Quotation']['validity']) ? date('M d, Y', strtotime($quotation['Quotation']['validity'])) : 'No validity date'; ?>
							</div>

						</div>

						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Remarks
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['remarks']?>
							</div>

						</div>
			
						
					

					
					<br><br>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-10">
							Respectfully,
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-5">
							<?php echo ucfirst($user['User']['first_name']) ?>&nbsp;
							<?php echo ucfirst($user['User']['last_name'])?>
							<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-10">
							Approved by
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-5" style="display:inline-block !important;">

							Ms. Carryll Yu
							<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">

						</div>
						<br><br>
						<div class=" pull-right col-lg-3" style="display:inline-block !important;">
							<p class = "doc">
								<font size ="1">
									Doc No.: KFP-FR-MKT-07<br>
									REV. No.: 01
								</font>
							</p>
						</div>
					</div>
					<div style ="clear:both">
					</div>
				</form>
			</div>								
		</div>
	</div>	
</div>
<?php echo $this->element('send_email',array('quotation' => $quotation,'user' => $user )); ?>
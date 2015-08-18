<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotations', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'quotations', 'action' => 'view',$quotation['Quotation']['id'])); ?>
<?php  echo $this->Html->script('Sales.sweet_alert');?>
<?php echo $this->Html->script('Sales.custom');?>
<?php echo $this->Html->css('redactor.css?v='.filemtime('css/redactor.css')); ?>
<?php echo $this->Html->script('redactor/redactor/redactor_new.js?v='.filemtime('js/redactor/redactor/redactor_new.js'));?>

<div style="clear:both"></div>


<?php  echo $this->element('sales_option');?>

<div class="filter-block pull-right">
    <?php
    	// buttons
    	//start//for enable and disabled button//permission
    	if ($userData['User']['role_id'] == 1 || $userData['User']['role_id'] == 2 || $userData['User']['role_id'] == 3 || $userData['User']['role_id'] == 8) {
    	
	    	$printQuotation = '' ;
	    	$editQuotation = '' ;
	    	$sendQuotation = '' ;
	    	$createOrder = '' ;
	    	
	    } else {
	    	
	    	!in_array('Print Quotation', $myPermission) ? $printQuotation = 'disabled' : $printQuotation = '' ;
	    	
	    	!in_array('Edit Quotation', $myPermission) ? $editQuotation = 'disabled' : $editQuotation = '' ;

	    	!in_array('Send Quotation', $myPermission) ? $sendQuotation = 'disabled' : $sendQuotation = '' ;
	    }
	   
    	//start//for enable and disabled button//permission
    	
        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

		if($clientOrderCount == 0){

			$status = (!$this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';
	
			echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Create Order ', array('controller' => 'create_order', 'action' => 'index',$quotation['Quotation']['id'],$quotation['Quotation']['uuid']),array('class' =>'btn btn-primary pull-right '.$status.' '.$disabled,'escape' => false)) ;
		
		}else{

			echo $this->Html->link('<font color="white"><i class="fa fa-gift fa-lg"></i> Sales Order</font> ', array('controller' => 'quotations', 'action' => 'create_order',$quotation['Quotation']['id']),array('class' =>'btn btn-success pull-right','escape' => false,'disabled' => 'disabled')) ;
		}

		if ( !empty($rolesPermissionData) ) {
			
            if(in_array('3', $rolesPermissionData) ){		

					$status = (!$this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';

					echo "<button class='btn btn-primary pull-right terminateQuotation ".$status."' data-uuid='".$quotation['Quotation']['uuid']."' data='".$quotation['Quotation']['id']."'><i class='fa fa-times fa-lg'></i>Terminate</button>";

					//echo $this->Html->link('<i class="fa fa-times fa-lg"></i> Terminate ', array('controller' => 'quotations', 'action' => 'terminated',$quotation['Quotation']['id'],$quotation['Quotation']['uuid']),array('class' =>'btn btn-primary pull-right '.$status,'escape' => false)) ;
				}else{

					echo "<button disabled='disabled' class='btn btn-primary pull-right terminateQuotation ".$status."' data-uuid='".$quotation['Quotation']['uuid']."' data='".$quotation['Quotation']['id']."'><i class='fa fa-times fa-lg'></i>Terminate</button>";

					//echo $this->Html->link('<i class="fa fa-times fa-lg"></i> Terminate ', array('controller' => 'quotations', 'action' => 'terminated',$quotation['Quotation']['id'],$quotation['Quotation']['uuid']),array('class' =>'btn btn-primary pull-right ','escape' => false,'disabled' => 'disabled')) ;	
				
			}	
		}		
	
		$status = ($this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';
		$status1 = ($this->Status->isQuotationDraft($quotation['Quotation']['status'])) ? 'disabled' : '';



		if ( !empty($rolesPermissionData) ) {
			//pr($rolesPermissionData);exit();
            if(in_array('4', $rolesPermissionData)){

 				echo "<button class='btn btn-primary pull-right approvedQuotation ".$status." ".$status1."' data='".$quotation['Quotation']['id']."'><i class='fa fa-check-square-o fa-lg'></i>Approved</button>";
				//echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i>Approved ', array('controller' => 'quotations', 'action' => 'approved',$quotation['Quotation']['id']),array('class' =>'btn btn-success pull-right '.$status.' '.$status1,'escape' => false)) ;
            
            }else{
      			echo "<button class='not-active btn btn-primary pull-right approvedQuotation ".$status." ".$status1."' data='".$quotation['Quotation']['id']."'><i class='fa fa-check-square-o fa-lg'></i>Approved</button>";
				//echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i>Approved ', array('controller' => 'quotations', 'action' => 'approved',$quotation['Quotation']['id']),array('class' =>'not-active btn btn-info pull-right '.$status.' '.$status1,'escape' => false)) ;
            }
        }else{
            echo "<button class='not-active btn btn-primary pull-right approvedQuotation ".$status." ".$status1."' data='".$quotation['Quotation']['id']."'><i class='fa fa-check-square-o fa-lg'></i>Approved</button>";
			// echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i>Approved ', array('controller' => 'quotations', 'action' => 'approved',$quotation['Quotation']['id']),array('class' =>'not-active btn btn-info pull-right '.$status.' '.$status1,'escape' => false)) ;
        }    
	
    	
    	
    	$status = (!$this->Status->isQuotationDraft($quotation['Quotation']['status'])) ? 'disabled' : '';

		echo $this->Html->link('<i class="fa fa-share fa-lg"></i> Submit Quotation', array('controller' => 'quotations', 'action' => 'status',0,$quotation['Quotation']['id']),array('class' =>'btn btn-info pull-right '. $status,'escape' => false)) ;
				
    	$status = ($this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';

    	  if ( !empty($rolesPermissionData) ) {
                     if(in_array('2', $rolesPermissionData)){

                        
						echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit ', array('controller' => 'quotations', 'action' => 'edit',$quotation['Quotation']['id'],$companyId),array('class' =>'btn btn-info pull-right '. $status.' '.$editQuotation ,'escape' => false)) ;

                    }else{

                         
						echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit ', array('controller' => 'quotations', 'action' => 'edit',$quotation['Quotation']['id'],$companyId),array('class' =>'btn btn-info pull-right not-active'. $status.' '.$editQuotation ,'escape' => false)) ;
                    }
                }else  {
                
                  
						echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit ', array('controller' => 'quotations', 'action' => 'edit',$quotation['Quotation']['id'],$companyId),array('class' =>'btn btn-info pull-right not-active'. $status.' '.$editQuotation ,'escape' => false)) ;
                }    
	
    	$status = (!$this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';

    	echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print ', array(
		        	'controller' => 'quotations', 
		        	'action' => 'print_word',
		        	//'ext' => 'pdf',
		        	$quotation['Quotation']['id'],$companyId),
		        	array('class' =>'btn btn-info pull-right '.$status.' '.$printQuotation,'escape' => false,'target' => '_blank'));

    	$status = (!$this->Status->isQuotationApproved($quotation['Quotation']['status'])) ? 'disabled' : '';

    	echo $this->Html->link('<i class="fa fa-envelope-o fa-lg"></i> Send Via Email ','#QuotationEmail',
		        	array('data-toggle' => 'modal', 'class' =>'btn btn-info pull-right '.$status.' '.$sendQuotation,'escape' => false,'target' => '_blank'));
  
     ?>
   
   <br><br>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<br>
				<header class="main-box-header clearfix" >
					<img src="<?php echo Router::url('/', true) ?>img/koufu_logo.jpg" alt="logo" style="width:240px;height:50px;padding-bottom:10;"> <br><br>
					<label style="padding-bottom:0px; font-size:12px;">Lot 4-5 Blk 3 Ph2 Mountview Industrial Complex</label> <br>
					<label style="padding-bottom:0px; font-size:12px;">Brgy. Bancal Carmona Cavite</label><br>
					<label style="padding-bottom:0px; font-size:12px;">Tel: +632-5844928; &nbsp; +6346-4301576 &nbsp; Fax: +632-5844952</label><br><br>
						
					<label style="padding-bottom:8px; font-size:24px; font-style: arial;"><b>PRICE QUOTATION</label></b><br><br><br>
					
				</header>
			</center>
			
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<div class="col-lg-1"></div>
					<div class="col-lg-2">
						Attention
					</div>
					<div class="col-lg-5">
						:&emsp;
						<?php 
						 echo ucfirst($quotation['ContactPerson']['firstname']).' '.ucfirst($quotation['ContactPerson']['lastname']) 
						?>
					</div>
					<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
						No : <u>PQ-<?php echo $quotation['Quotation']['uuid'] ?></u>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-1"></div>
					<div class="col-lg-2">
						Company
					</div>
					<div class="col-lg-5">
						:&emsp;
						<?php 
						// 	echo $quotation['Quotation']['attention_details']
							echo !empty($quotation['Quotation']['company_id']) ? ucfirst($companyData[$quotation['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$quotation['Quotation']['inquiry_id']]]) 
						?>
					</div>
					<div class="col-lg-4">&emsp;&emsp;&emsp;
						Date :&nbsp;<?php echo !empty($quotation['Quotation']['created']) ? date('Y/m/d', strtotime($quotation['Quotation']['created'])) : '' ?>
					</div>
				</div>
				<?php if (!empty($quotation['ContactPerson']['firstname']) || !empty($quotation['ContactPerson']['lastname'])) { ?>
				<br>

				<div class="form-group">
					<div class="col-lg-1"></div>
					<div class="col-lg-10">
						Dear <?php echo ucfirst($quotation['ContactPerson']['firstname']).' '.ucfirst($quotation['ContactPerson']['lastname']) ?>,&nbsp;
						
					</div>
				</div>

				<?php } ?>

				<div class="form-group">
					<div class="col-lg-1"></div>
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
							:&emsp;<?php echo $quotation['Product']['name']?>
						</div>

				</div>
				<?php if (!empty($quotation['QuotationDetail']['size'])) { ?>
					<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Size
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['size']?>
							</div>

					</div>
				<?php } ?>
				<!-- <div class ="boxed2"> -->
				<?php 
					// $displayVat = 0;
					// $displayMat = 0;
				?>
				<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-2">
							Quantity
							<br><br>
							Unit Price
							<?php //if($displayVat == 0){ ?>
								<br><br>
								Vat Price
							<?php //} ?>
							<?php //if($displayMat == 0){ ?>
								<br><br>
								Material
							<?php //} ?>
							
						</div>
						<div class="col-lg-8"><div class="pull-left"></div>
							<?php foreach ($quotation['QuotationItemDetail'] as $key => $itemDetail){?>
								<table  class = "tbl">
									<tr>
										
										<td height ="35px" valign ="top" class ="column2 col-md-12"> 
											<div class="col-lg-12">
												<?php echo (!empty($itemDetail['quantity']) && is_numeric($itemDetail['quantity'])) ? number_format($itemDetail['quantity']) : '';
												?>
												<?php
												 echo !empty($units[$itemDetail['quantity_unit_id']]) ? $units[$itemDetail['quantity_unit_id']] : '' ?> 
											</div>
										</td>	
										
									</tr>
									<tr>
										<td height ="35px" valign ="top" class = "column2 col-md-12">
											<div class="col-lg-12">
												<?php
												 echo !empty($currencies[$itemDetail['unit_price_currency_id']]) ? $currencies[$itemDetail['unit_price_currency_id']] : '' ?>
												<?php echo (!empty($itemDetail['unit_price']) && is_numeric($itemDetail['unit_price'])) ? number_format($itemDetail['unit_price'],4) : '';?>
												/
												<?php
												 echo !empty($units[$itemDetail['unit_price_unit_id']]) ? $units[$itemDetail['unit_price_unit_id']] : '' ?> 
												 
											</div>
										</td>
									</tr>
									<?php //if($displayVat == 1){ ?>
										<tr>
											<td height ="40px" class ="column2 col-md-12">
												<div class="col-lg-12">
													<?php echo (!empty($itemDetail['vat_price']) && is_numeric($itemDetail['vat_price'])) ? number_format($itemDetail['vat_price'],4) : '';
													?> 
												</div>
											</td>
										</tr>
								
										<tr>
											
											<td height ="30px" class ="column2 col-md-12">
												<div class="col-lg-12">
													<?php echo $itemDetail['material'];?> 
												</div>
											</td>
										</tr>
								</table>
							<?php } ?>

						</div>

					</div>

					<?php if (!empty($quotation['QuotationDetail']['color'])) { ?>
						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Color
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['color']?>
							</div>

						</div>
					<?php } ?>

					<?php if (!empty($quotation['QuotationDetail']['process'])) { ?>
						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Process
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['process']?>
							</div>

						</div>
					<?php } ?>

					<?php if (!empty($quotation['QuotationDetail']['packaging'])) { ?>
						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Packaging
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['packaging']?>
							</div>

						</div>
					<?php } ?>

					<?php if (!empty($quotation['QuotationDetail']['other_specs'])) { ?>
						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Other Specs
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['other_specs']?>
							</div>

						</div>
					<?php } ?>

					<div class="form-group">

						<div class="col-lg-1"></div>
						<div class="col-lg-2">
							Terms
						</div>
						<div class="col-lg-8">
							:&emsp;<?php echo !empty($paymentTerm[$quotation['Quotation']['payment_terms']]) ? $paymentTerm[$quotation['Quotation']['payment_terms']]: '' ?>
						</div>

					</div>

					<?php if (!empty($quotation['Quotation']['validity'])) { ?>
						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Validity
							</div>
							<div class="col-lg-8">
								:&emsp;<?php 
								   if (!empty($quotation['Quotation']['validity']) 
								   	&& $this->DateFormat->isValidDateTimeString($quotation['Quotation']['validity'])){
								   	
								   		echo date('M d, Y', strtotime($quotation['Quotation']['validity']));
								   } else {

								   		echo 'No validity date';
								   } ?>
							</div>

						</div>
					<?php } ?>

					<?php if (!empty($quotation['Quotation']['remarks'])) { ?>
						<div class="form-group">

							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								Remarks
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $quotation['QuotationDetail']['remarks']?>
							</div>

						</div>
					<?php } ?>
		
				<br><br>
				<div class="form-group">
					<div class="col-lg-1"></div>
					<div class="col-lg-2">
						Respectfully,
					</div>
					<div class="col-lg-4"></div>
					<?php if(!empty($approvedUser)){ 
						echo" Approved by :" ;

					} ?>
				</div>

				<br>
				<div class="form-group">
					<div class="col-lg-1"></div>
					<div class="col-lg-2" style = "padding-bottom:0px;">

						<?php echo ucfirst($user['User']['first_name']) ?>&nbsp;
						<?php echo ucfirst($user['User']['last_name'])?>
						<hr style="height:1px; border:none; text-align: left; width: 200px; color:#b2b2b2; background-color:#b2b2b2;">
					</div>

					<div class="col-lg-2"></div>
					<div class="col-lg-6" style = " padding-bottom:0px;">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
							<?php if(!empty($approvedUser)){ ?>
							<?php echo ucfirst($approvedUser['User']['first_name']);
							echo '&nbsp';
						 	echo ucfirst($approvedUser['User']['last_name']);

							}else{
								echo "Note: Not yet approved. ";
							} ?>

							<?php if(!empty($approvedUser)){  ?>
						<hr style="height:1px; border:none; text-align: left; width: 200px; color:#b2b2b2; background-color:#b2b2b2;">
							<?php  }?>
					</div>
				</div>

				<br>

				<div style=" text-align:left; margin-left:90px;">
					
					<font size ="1">
						Doc No.: KFP-FR-MKT-07<br>
						REV. No.: 01
					</font>
					
				</div>
							
				<div style ="clear:both"></div>
			</form>
			</div>								
		</div>
	</div>	

<?php echo $this->element('send_email',array('quotation' => $quotation,'user' => $user )); ?>

<style>

.not-active {
   pointer-events: none;
   cursor: default;
    background-color: #5bc0de;
    border-color: #46b8da;
    box-shadow: none;
    cursor: not-allowed;
    opacity: 0.65;
    pointer-events: none;

}

</style>

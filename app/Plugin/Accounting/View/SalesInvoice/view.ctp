<?php $this->Html->addCrumb('Accounting', array('controller' => 'sales_invoice', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'sales_invoice', 'action' => 'view',$invoiceId)); ?>

<?php echo $this->element('account_option'); ?>

<style type="text/css">
 	.hide-me-first{
 		display: none;
 	}
 	.dsplayShow{
 		display: block ;
 	}
 	.dsplayShow1{
 		display: block ;
 	}
 </style>

<div class="filter-block pull-right">

	<?php 
		echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> Export ', array(
        	'controller' => 'sales_invoice', 
        	'action' => 'print_invoice',
        	$invoiceId,
        	$clientOrderId),
        	array('class' =>'btn btn-info pull-right ','escape' => false));
	?>

	<a data-toggle="modal" href="#myModalChangeVatStatus" class="btn btn-primary mrg-b-lg pull-right "><i class="fa fa-edit fa-lg"></i>Change Vat Status</a>

	<?php 

	if($invoiceData['SalesInvoice']['status'] == 0 ){

		echo $this->Html->link('<i class="fa fa-share-square-o fa-lg"></i> Change to Invoice ', array(
        	'controller' => 'sales_invoice', 
        	'action' => 'change_to_invoice',
        	$invoiceId),
        	array('class' =>'btn btn-info pull-right ','escape' => false));

	}
	
	?>
	<br><br>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix">
					<h1>Kou Fu Packaging Corporation</h1>
					<h5>Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h5>
					<h6>
						Tel: +63(2)5844928  &emsp;Fax: +63(2)5844952
					</h6><br>
					<h2>SALES INVOICE</h2><br>
				</header>
			</center>

			<div class="main-box-body clearfix">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<div class="col-lg-2"></div>
						<div class="col-lg-6"></div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							NO : <?php echo $invoiceData['SalesInvoice']['sales_invoice_no']?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">&emsp;
							SOLD TO
						</div>
						<div class="col-lg-6">
							:&emsp;
							<?php echo ucfirst($companyData)?>
						</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							DATE : <?php echo (new \DateTime())->format('m/d/Y'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">&emsp;
							BUSINESS STYLE
						</div>
						<div class="col-lg-6">:&emsp;</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							TIN : <?php echo ucfirst($clientData['Company']['tin'])?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2">&emsp;
							ADDRESS
						</div>
						<div class="col-lg-6">
							:&emsp;<?php echo ucfirst($drData['DeliveryDetail']['location'])?>
						</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							TERMS : <?php echo ucfirst($paymentTermData[$clientData['ClientOrder']['payment_terms']])
							?>
						</div>
					</div>
				</form>

				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td><center><b>P.O NO.</b></center></td>
								<td><center><b>DESCRIPTION</b></center></td>
								<td><center><b>QUANTITY</b></center></td>
								<td><center><b>PRICE</b></center></td>
								<td><center><b>AMOUNT</b></center></td>
							</tr>
							
							<tr>
								<td><center><?php echo $clientData['ClientOrder']['po_number']?></center></td>
								<td><center><?php echo ucfirst($clientData['Product']['name'])?></center></td>
								<td><center><?php echo number_format($drData['DeliveryDetail']['quantity'])?></center></td>
								<td><center><?php echo number_format($clientData['QuotationItemDetail']['unit_price'],4)?></center></td>
								<td>
									<center>
										<?php 

											if(!empty($drData['DeliveryDetail']['quantity'])){

											  	$totalQty = $drData['DeliveryDetail']['quantity'] * $clientData['QuotationItemDetail']['unit_price'];
											}else{

												$totalQty = $clientData['ClientOrderDeliverySchedule'][0]['quantity'] * $clientData['QuotationItemDetail']['unit_price'];
											}

											echo number_format($totalQty,2) ;
										?>
									</center>
								</td>
							</tr>
							<tr>
								<td>-</td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
							</tr>
							<tr>
								<td></td>
								<td>DR#<?php echo str_pad($drData['Delivery']['dr_uuid'],5,'0',STR_PAD_LEFT);?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							
						</thead>
					</table>
				</div>
				<div class="col-lg-5 pull-right">
					<div class="table-responsive">
						<table class="table ">
							<thead>
								<tr>
									<td><b>VATABLE SALE</b></td>
									<td>
										<?php 
											if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2 && $clientData['QuotationItemDetail']['vat_status'] == "Vatable Sale"){
												//$totalVat = ($totalQty * .12) + $totalQty;
												$totalVat = $totalQty;
												echo number_format($totalVat,2);
												//echo number_format((float)$totalQty, 4, '.', '');
											}else{
												echo "-";
											}
										?>
									</td>
								</tr>
								<tr>
									<td><b>VAT EXEMPT</b></td>
									<td>
										<?php 
											if($clientData['QuotationItemDetail']['vat_status'] == 'Vat Exempt'){
												
												echo number_format($totalQty,2 );
												//echo number_format((float)$totalQty, 4, '.', '');
											}else{
												echo "-";
											}
										?>
									</td>
								</tr>
								<tr>
									<td><b>ZERO RATED SALE</b></td>
									<td>
										<?php 
											if($clientData['QuotationItemDetail']['vat_status'] == 'Zero Rated Sale'){
												echo number_format($totalQty,2);
											}else{
												echo "-";
											}
										?>
									</td>
								</tr>
								<tr>
									<td><b>12% VAT</b></td>
									<td>
										<?php //pr($clientData); exit;

											if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2 && $clientData['QuotationItemDetail']['vat_status'] == "Vatable Sale"){
												$totalVat = $totalQty * .12;
												echo number_format($totalVat,2);
											}else{
												echo "-";
											}
										?>
									</td>
								</tr>
								<tr>
									<td><b>TOTAL AMOUNT DUE</b></td>
									<td>
										<?php 
											if($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2 && $clientData['QuotationItemDetail']['vat_status'] == "Vatable Sale"){
												$totalVat = $totalQty * .12;
												$fullVat = $totalQty + $totalVat;
												echo $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']] . " ";
												echo number_format($fullVat,2);
												
											}else{
												echo $currencyData[$clientData['QuotationItemDetail']['unit_price_currency_id']] . " ";
												echo number_format($totalQty,2);
											}
										?>
									</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<br><br><br><br><br><br><br><br><br><br>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td>
									<center>
										<b>PREPARED BY</b><br><br>
										<?php echo strtoupper($approved['User']['first_name'])?> <?php echo strtoupper($approved['User']['last_name'])?>
									</center>
								</td>
								<td>
									<center>
										<b>APPROVED BY</b><br><br>
										EMMA L. GOLFO
									</center>
								</td>
								<td>
									<center><b>RECEIVED BY</b></center>
								</td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-status" id="myModalChangeVatStatus" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content margintop">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Quotation Details</h4>
            </div> 

            <div class="modal-body">

                <?php 

                    echo $this->Form->create('QuotationItemDetail',array(
                        'url'=>(array('controller' => 'sales_invoice','action' => 'change_vat_status', $invoiceId) ),'class' => 'form-horizontal')); 
                ?>

                	<div class="form-group" id="existing_items">
                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Quantity</label>
                        <div class="col-lg-5">

                            <?php 

                                 echo $this->Form->input('QuotationItemDetail.quantity', array(
                                    'empty' => 'None',
                                    'required' => 'required',
                                    'class' => 'form-control item_type editable limitQuantity',
                                    'label' => false,
                                    'readonly' => 'readonly',
                                    'value' => $clientData['QuotationItemDetail']['quantity']
                                    ));

                                 	echo $this->Form->input('QuotationItemDetail.id', array(
                                    'class' => 'form-control item_type editable required maxQuantity',
                                    'label' => false,
                                    'type' => 'hidden',
                                    'readonly' => 'readonly',
                                    'value' => $clientData['QuotationItemDetail']['id']));

                            ?>
                        </div>

                        <div class="col-lg-4">

                            <?php echo $this->Form->input('QuotationItemDetail.quantity_unit_id', array(
                                'options' => array($units),  
                                'label' => false,
                                'readonly' => 'readonly',
                                'default' => $clientData['QuotationItemDetail']['quantity_unit_id'],
                                'class' => 'form-control required ',
                                'empty' => '---Select Unit---'
                                 )); 

					        ?>

                        </div>

                    </div>

                    <div class="form-group" id="existing_items">
                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Unit Price</label>
                        <div class="col-lg-5">

                            <?php 

                                 echo $this->Form->input('QuotationItemDetail.unit_price', array(
                                    'empty' => 'None',
                                    'required' => 'required',
                                    'class' => 'form-control item_type required unitPrice',
                                    'label' => false,
                                    'value' => $clientData['QuotationItemDetail']['unit_price']
                                    ));

                                 	echo $this->Form->input('QuotationItemDetail.id', array(
                                    'class' => 'form-control item_type editable required maxQuantity',
                                    'label' => false,
                                    'type' => 'hidden',
                                    'readonly' => 'readonly',
                                    'value' => $clientData['QuotationItemDetail']['id']));

                            ?>
                        </div>

                        <div class="col-lg-4">

                           	<?php echo $this->Form->input('QuotationItemDetail.unit_price_currency_id', array(
	                                'options' => array($currencyData),  
	                                'label' => false,
	                                'default' => $clientData['QuotationItemDetail']['unit_price_currency_id'],
	                                'class' => 'form-control currency-option',
	                                'empty' => '---Select Currency---'
	                                 )); 

					        ?>
                        </div>

                    </div>

                    <?php

                    $displayMe = '';
					$displayMe1 = '';

					if ($clientData['QuotationItemDetail']['unit_price_currency_id'] == 2) {

						$displayMe = 'dsplayShow';
						$hide = 'hide-me-first';
													
					}else {

						$displayMe1 = 'dsplayShow1';
						$hide = '';
					}

					?>

                    
                    <div class="form-group" id="existing_items">
                        <label class="col-lg-2 control-label">Vat Status</label>
                        <div class="col-lg-9">

                            <?php 
                            $vatType = array(1 => 'Vatable Sale',
											2 => 'Vat Exempt',
											3 => 'Zero Rated Sale');

							$vatTypeUSD = array(
									2 => 'Vat Exempt',
									3 => 'Zero Rated Sale');

							if($clientData['QuotationItemDetail']['vat_status'] == 'Vatable Sale'){

								$vatName = 1;

							} else if($clientData['QuotationItemDetail']['vat_status'] == 'Vat Exempt'){

								$vatName = 2;

							} else{


								$vatName = 3;
							}

                            echo $this->Form->input('QuotationItemDetail.vat_status', array( 
                                'options' => array($vatType),  
                                'label' => false,
                                'default' => $vatName,
                                'disabled' => true,
                                'class' => 'hide-me-first form-control for-php required select-vat-status '.$displayMe,
                                'empty' => '---Select Vat Type---'
                                 ));

							echo $this->Form->input('QuotationItemDetail.vat_status', array( 
								'options' => array($vatTypeUSD),
								'default' => $vatName,    
                                'label' => false,
                                'disabled' => true,
                                'empty' => '---Select Vat Type---',
                                'class' => 'hide-me-first form-control required for-usd '.$displayMe1
                                 ));
					        ?>

                        </div>
                    </div>

	                <div class = "vat <?php echo $hide?>">

	                    <div class = "vat-option">
	                    	<div class="form-group" id="existing_items">
		                        <label class="col-lg-2 control-label"><span style="color:red">*</span>Vat Price</label>
		                        <div class="col-lg-9">

		                            <?php 

		                                echo $this->Form->input('QuotationItemDetail.vat_price', array(
		                                    'empty' => 'None',
		                                    'required' => 'required',
		                                    'class' => 'form-control item_type editable limitQuantity vat-price',
		                                    'label' => false,
		                                    'value' => $clientData['QuotationItemDetail']['vat_price']
		                                    ));

		                            ?>
		                        </div>

	                    	</div>
	                    
							<div class="form-group">
								<label class="col-lg-1  control-label"></label>
								<div class="col-lg-5">	
									<input id="checkbox-1" class="checkvat checkIn checkbox-nice vat-price" type="checkbox" data-section='quotationItemDetail' name="[QuotationItemDetail][0][vat_price]" rel=".12"><label><font color="gray">&nbsp;Click to Compute the Vat Price</font></label>
										
								</div>

								<div class="col-lg-5">

									<input id="checkbox-1" class="checkEx vat-exclusive" type="checkbox" data-section='quotationItemDetail' name="[QuotationItemDetail][0][unit_price]"rel=".12" name ="togglecheckboxtext"><label>

									<font color="gray">&nbsp;Click to Compute the Unit Price</font></label>

								</div>

								
							</div>

							<div class="form-group">
								<label class="col-lg-1 control-label"></label>

								<div class="col-lg-5">	
									<input id="checkbox-1" class=" checkbox-nice vat-in" type="checkbox" data-section='quotationItemDetail' name="[QuotationItemDetail][0][vat_price]" rel=".12"><label><font color="gray">&nbsp;Click for Vat-Inclusive</font></label>
										
								</div>

								<div class="col-lg-5">

									<input id="checkbox-1" class="clear" type="checkbox" data-section='quotationItemDetail' name="[QuotationItemDetail][0][unit_price]"rel=".12" name ="togglecheckboxtext"><label>

									<font color="gray">&nbsp;Clear All</font></label>

								</div>



							</div>

						</div>
					</div>

                    <br><br>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg"></i> Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                <?php echo $this->Form->end();  ?> 
            </div>
        </div>
    </div>
</div>


 <script>

 	 $(document).ready(function() {

 		unitprice = $('.currency-option').val();

 		//dollar
 		if(unitprice == 1){

            $('.for-usd').prop('disabled', false);
            // $(".vat").addClass("hide-me-first");

 		}else{

 			$('.for-php').prop('disabled', false);
 			
 		}

 		$('body').on('change','.select-vat-status',function(){

 			statusType = $('.select-vat-status').val();

 			if(statusType == 1){

 				$(".vat").removeClass("hide-me-first");

 			}else{

 				$(".vat").addClass("hide-me-first");

 			}

 		});		

 	});

 	$('body').on('change','.currency-option',function(){

    	thisElement = $(this);

   		thisVal = $(this).val();
   		//alert(thisVal); 
   		if (thisVal) {
        if(thisVal == 2){

            thisElement.parents('.form-horizontal').find('.vat-section').show();
            thisElement.parents('.form-horizontal').find('.vat-option').show();
            $('.for-php').prop('disabled', false);
            $('.for-usd').prop('disabled', true);
            thisElement.parents('.form-horizontal').find('.for-php').show();
            thisElement.parents('.form-horizontal').find('.for-usd').hide();
            thisElement.parents('.form-horizontal').find('.select-vat-status').val('');
            thisElement.parents('.form-horizontal').find('.for-usd').removeClass('dsplayShow');
            thisElement.parents('.form-horizontal').find('.for-usd').addClass('dsplayShow1');
           // /VAT Exclusive
        }

        if(thisVal == 1){
            thisElement.parents('.form-horizontal').find('.vat-section').show();
            thisElement.parents('.form-horizontal').find('.for-php').hide();
            $('.for-php').prop('disabled', true);
            $('.for-usd').prop('disabled', false);
            thisElement.parents('.form-horizontal').find('.for-usd').show();
            thisElement.parents('.form-horizontal').find('.vat-option').hide();
            thisElement.parents('.form-horizontal').find('.for-usd').removeClass('dsplayShow1');
            thisElement.parents('.form-horizontal').find('.for-usd').addClass('dsplayShow');
           
            
        }
    }else{
        thisElement.parents('.form-horizontal').find('.vat-section').hide();
        thisElement.parents('.form-horizontal').find('.for-php').hide();
        thisElement.parents('.form-horizontal').find('.for-usd').hide();
        thisElement.parents('.form-horizontal').find('.vat-option').hide();
    }; 


	});

$('body').on('change','.checkIn',function(){

    if($(this).is(":checked")) {

	    unitprice = $('.unitPrice').val();

    	if (unitprice.length === 0 || unitprice == 0) {

    		alert('Unit Price has no value'); 

			$('.vat-in').prop('checked', false);  

    	}else{
        
	        vatprice = unitprice * .12;

	        $('.vat-price').val(vatprice);

	        $('.vat-in').prop('checked', false);

	        $('.checkEx').prop('checked', false);

    	}	

    }

}); 


$('body').on('change','.checkEx',function(){


    if($(this).is(":checked")) {

	    vatprice = $('.vat-price').val();

    	if (vatprice.length === 0 || vatprice == 0) {

    		alert('Unit Price has no value'); 

			$('.vat-in').prop('checked', false);  

    	}else{
        
	        unitprice = vatprice / 1.12;

	        $('.unitPrice').val(unitprice);

	        $('.vat-in').prop('checked', false);

			$('.checkIn').prop('checked', false);

    	}	

    }

});

$('body').on('change','.vat-in',function(){

	vatprice = $('.vat-price').val();

		if($(this).is(":checked")) {

			if (vatprice.length === 0 || vatprice == 0) {

				alert('Unit Price has no value'); 

				$('.vat-in').prop('checked', false);  
		    	
	    	}else{

	    		quantity = $('.limitQuantity').val();

	    		// vatprice = $('.vat-price').val();

	    		// amount = quantity * unitPrice;

	    		// vatQuotient = amount / 1.12;

	    		// vatProduct = vatQuotient * 0.12 ;

	    		//paulo's formula

	    		//unitPrice = vatprice / quantity; 

	    		unitPrice = vatprice * 0.12; 

		        $('.unitPrice').val(unitPrice.toFixed(2));

		        $('.checkEx').prop('checked', false);

		        $('.checkIn').prop('checked', false);

		    }

    	}

});

$('body').on('change','.clear',function(){

	if($(this).is(":checked")) {

		$('.unitPrice').val(" ");
		$('.vat-price').val(" ");

	}

});

 </script>
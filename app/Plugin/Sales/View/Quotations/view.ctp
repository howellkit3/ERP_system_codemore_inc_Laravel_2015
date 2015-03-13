<?php $this->Html->addCrumb('Sales', array('controller' => 'customer_sales', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('Quotation', array('controller' => 'quotation', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'quotation', 'action' => 'view',$quotation['Quotation']['id'])); ?>
<?php echo $this->Html->script('Sales.inquiry');?>
<div style="clear:both"></div>

<?php echo $this->element('sales_option');?>

<div class="filter-block pull-right">
    <?php

        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'quotations', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));

    ?>
    <?php
    	if ($quotation['Quotation']['status'] != 0) {

    		echo $this->Html->link('<i class="fa fa-print fa-lg"></i> Print ', array(
		        	'controller' => 'quotations', 
		        	'action' => 'print_word',
		        	'ext' => 'pdf',
		        	$quotation['Quotation']['id'],$companyId),
		        	array('class' =>'btn btn-primary pull-right','escape' => false,'target' => '_blank'));

    		if (!empty($salesStatus['SalesOrder']['quotation_id'])) {

    			echo $this->Html->link('<font color="white"><i class="fa fa-gift fa-lg"></i> Sales Order</font> ', array('controller' => 'quotations', 'action' => 'create_order',$quotation['Quotation']['id']),array('class' =>'btn btn-success pull-right','escape' => false,'disabled' => 'disabled')) ;

    		}else{

    			echo $this->Html->link('<i class="fa fa-pencil-square-o fa-lg"></i> Create Order ', array('controller' => 'quotations', 'action' => 'create_order',$quotation['Quotation']['id'],$quotation['Quotation']['unique_id']),array('class' =>'btn btn-primary pull-right','escape' => false)) ;

    		}
    		
    	} else{

    		echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Click to Approved ', array('controller' => 'quotations', 'action' => 'approved',$quotation['Quotation']['id']),array('class' =>'btn btn-primary pull-right','escape' => false)) ;

    		echo $this->Html->link('<i class="fa fa-edit fa-lg"></i> Edit ', array('controller' => 'quotations', 'action' => 'edit',$quotation['Quotation']['id'],$companyId),array('class' =>'btn btn-primary pull-right','escape' => false)) ;
    	}
     ?>
   
   <br><br>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix">
					<h1>KOU FU COLOR PRINTING CORP.</h1>
					<h5>Lot 4-5, Blk 3 Phase 2, Mountview Industrial Complex, Carmona, Cavite</h5>
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
							<?php echo !empty($quotation['Quotation']['company_id']) ? ucfirst($companyData[$quotation['Quotation']['company_id']]) : ucfirst($companyData[$inquiryId[$quotation['Quotation']['inquiry_id']]]) 
							?>
						</div>
						<div class="col-lg-4">&emsp;&emsp;&nbsp;&nbsp;&nbsp;
							No : <u><?php echo $quotation['Quotation']['unique_id'] ?></u>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-5">
							_______________________________________________________________________
						</div>
						<div class="col-lg-4">&emsp;&emsp;
							Date :&nbsp;<?php echo !empty($quotation['Quotation']['created']) ? date('F d, Y', strtotime($quotation['Quotation']['created'])) : '' ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-10">
							Dear :&nbsp; <?php echo ucfirst($contactInfo['ContactPerson']['firstname']) ?>&nbsp;
							<?php echo ucfirst($contactInfo['ContactPerson']['lastname']) ?>
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
								:&emsp;<?php echo $productName['Product']['product_name']?>
							</div>
						</div>
					<?php foreach ($quotationFieldInfo as $key => $value) {?>
						<div class="form-group">
							<div class="col-lg-1"></div>
							<div class="col-lg-2">
								<?php echo $field[$value['QuotationField']['custom_fields_id']] ?>
							</div>
							<div class="col-lg-8">
								:&emsp;<?php echo $value['QuotationField']['description'] ?>
							</div>
						</div>
					<?php } ?>
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
						<div class="col-lg-5">
							Ms. Carryll Yu
							<hr style="height:1px; border:none; color:#b2b2b2; background-color:#b2b2b2;">
						</div>
					</div>
					<hr style="height: 0; border-style: STYLEHERE; border-width: 1px 0 0 0; border-color:#COLORHERE;">
					<center>
						<header class="main-box-header clearfix">
							<h2>Acceptance Slip</h2><br>
						</header>
					</center>
					<div class="form-group">
						<div class="col-lg-2"></div>
						<div class="col-lg-2">
							Send to manager
						</div>
						<div class="col-lg-4"></div>
						<div class="col-lg-4">
							Date:________________
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-11">
							<center>
								I do hereby accept the price and other details submitted on your price quotation no.
								<?php echo $quotation['Quotation']['unique_id'] ?><br> Also, I do hereby authorize your company to proceed with and supply the work described above.
							</center>
						</div>
						<div class="col-lg-1">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-2"></div>
						<div class="col-lg-5">
							Athorized by:_________________
						</div>
						<div class="col-lg-4">
							Position:_________________
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-7"></div>
						<div class="col-lg-4">
							&emsp;&nbsp;Date:_________________
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-1"></div>
						<div class="col-lg-9">
							<?php echo (new \DateTime())->format('l, F d, Y '); ?>
						</div>
					</div>
				</form>
			</div>								
		</div>
	</div>	
</div>
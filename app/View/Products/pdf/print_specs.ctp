<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
	<?php include('specs.css'); 
	 header('Content-Type: text/html; charset=utf-8');
	 ?>
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf">
			<center>
				<header class="main-box-header clearfix">
					<h1>Kou Fu Color Packaging Corp.</h1>
					<h5>Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h5>
					<h6>Tel#: +63(2)5844928 Fax#: +63(2)5844952</h6><br>
					<h3>Main Job Ticket</h3>
				</header>
			</center>
			<br>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">&nbsp;</td>
						<td style="width:40px;">&nbsp;</td>
						<td style="width:40px;">&nbsp;</td>
						<td style="width:350px;">&nbsp;</td>
						<td>Date : 
							<?php echo (new \DateTime())->format('l, F d, Y '); ?>
						</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">Customer</td>
						<td style="width:40px;">&nbsp;</td>
						<td style="width:40px;">:</td>
						<td style="width:280px;">
							<?php echo strtoupper($companyData[$productData['Product']['company_id']]); ?>
						</td>
						<td>Schedule No. : <?php echo $ticketUuid; ?>
							<?php //echo (new \DateTime())->format('l, F d, Y '); ?>
						</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">Item</td>
						<td style="width:47px;"> &nbsp; </td>
						<td style="width:40px;">:</td>
						<td style="width:280px;">
							<?php echo $productData['Product']['name'] ;?>
						</td>
						<td>
							PO No. : <?php echo $ticketData['JobTicket']['po_number']; ?>
						</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">Item size</td>
						<td style="width:43px;">&nbsp;</td>
						<td style="width:40px;">:</td>
						<td style="width:280px;">
							<?php echo $specs['ProductSpecification']['size1']; ?> x
							<?php echo $specs['ProductSpecification']['size2']; ?> x
							<?php echo $specs['ProductSpecification']['size3']; ?>
						</td>
						<td>Delivery Date :
							<?php
							 	if (!empty($delData['ClientOrderDeliverySchedule'][0]['schedule'])){

							 		echo date('M d, Y', strtotime($delData['ClientOrderDeliverySchedule'][0]['schedule']));
							 	} 
							?>
						</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">PO Quantity</td>
						<td style="width:27px;">&nbsp;</td>
						<td style="width:40px;">:</td>
						<td style="width:280px;">
							<?php echo $specs['ProductSpecification']['quantity'] ;?>
							<?php echo $unitData[$specs['ProductSpecification']['quantity_unit_id']] ;?>
						</td>
						<td>Stock Quantity :<?php echo $specs['ProductSpecification']['stock'] ?>
						</td>
					</tr>
				</thead>
			</table>
			<br>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;"><h3>Product Specification</h3></td>
					</tr>
				</thead>
			</table>
			<br>
			<?php $componentCounter = 1 ;?>
			<?php $partCounter = 1 ; ?>
			<?php $processCounter = 1 ;?>
			<?php foreach ($formatDataSpecs as $key => $specLists) { ?>
				<table class="layout">
					<thead>
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
			      	</thead>
			    </table>
			<?php } ?>
			<br><br><br>
			<?php if (!empty($ticketData['JobTicket']['remarks'])) { ?>
				<table class="layout">
					<thead>
						<tr>
							<td style="width:40px;">Remarks</td>
							<td style="width:40px;"> </td>
						</tr>
						<tr>
							<td style="width:40px;"> </td>
							<td style="width:40px;"><?php echo ucfirst($ticketData['JobTicket']['remarks'])?></td>
						</tr>
					</thead>
				</table>
			<?php } ?>
			<br><br>
			<table class="layout" >
				<thead>
					<tr>
						<td style="width:40px;">Issuer</td>
						<td style="width:40px;"> </td>
					</tr>
					<tr>
						<td style="width:40px;">&nbsp;</td>
					</tr>
					<tr>
						<td style="width:40px;">&nbsp;</td>
					</tr>
				</thead>
			</table>

			<table class="layout" style="border-top:1px solid #000;margin-left:50px;">
				<thead>
					<tr>
						<td style="width:100px;">&nbsp;</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:35px;">&nbsp;</td>
						<td style="width:0px;">
							<?php echo ucfirst($userData['User']['first_name']); ?>&nbsp;
							<?php echo ucfirst($userData['User']['last_name']); ?>
						</td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
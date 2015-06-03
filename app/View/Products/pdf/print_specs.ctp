<style>
	<?php include('specs.css'); ?>
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<center>
				<header class="main-box-header clearfix">
					<h3>Kou Fu Color Printing </h3>
					<h6 style="font-family: Calibri;">Lot 4-5, Blk 3 Phase 2, Mountview Industrial Complex, Bancal, Carmona, Cavite</h6>
					<h6>Tel#: (046) 972-1111 to 13 Fax#: (046) 972-0120</h6><br>
					<h3>Main Job Ticket</h3>
				</header>
			</center>
			<br>
			<table class="layout">
				<thead>
					
					<tr>
						<td style="width:40px;"> </td>
						<td style="width:40px;"> </td>
						<td style="width:40px;"> </td>
						<td style="width:350px;"> </td>
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
						<td style="width:40px;"> </td>
						<td style="width:40px;">:</td>
						<td style="width:280px;">
							<?php echo strtoupper($companyData[$productData['Product']['company_id']]) ?>
						</td>
						<td>Schedule No. : 99999999
							<?php //echo (new \DateTime())->format('l, F d, Y '); ?>
						</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">Item</td>
						<td style="width:47px;"> </td>
						<td style="width:40px;">:</td>
						<td style="width:355px;">
							<?php echo $productData['Product']['name'] ?>
						</td>
						<td>to follow
							<?php //echo (new \DateTime())->format('l, F d, Y '); ?>
						</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">Item size</td>
						<td style="width:43px;"> </td>
						<td style="width:40px;">:</td>
						<td style="width:280px;">
							<?php echo $specs['ProductSpecification']['size1'] ?> x
							<?php echo $specs['ProductSpecification']['size2'] ?> x
							<?php echo $specs['ProductSpecification']['size3'] ?>
						</td>
						<td>Delivery Date :
							<?php echo (new \DateTime())->format('l, F d, Y '); ?>
						</td>
					</tr>
				</thead>
			</table>
			<table class="layout">
				<thead>
					<tr>
						<td style="width:40px;">PO Quantity</td>
						<td style="width:27px;"> </td>
						<td style="width:40px;">:</td>
						<td style="width:276px;">
							<?php echo $specs['ProductSpecification']['quantity'] ?>
							<?php echo $unitData[$specs['ProductSpecification']['quantity_unit_id']] ?>
						</td>
						<td>Stock Quantity :
							<?php //echo (new \DateTime())->format('l, F d, Y '); ?>
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
			<?php $componentCounter = 1?>
			<?php $partCounter = 1?>
			<?php $processCounter = 1?>
			<?php foreach ($formatDataSpecs as $key => $specLists) { ?>
				<table class="layout">
					<thead>
						<?php

					      	if($specLists['ProductSpecificationDetail']['model'] == 'Component'){

					      		echo $this->element('Specs/Component', array('formatDataSpecs' => $formatDataSpecs[$key],'key' => $componentCounter));
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
			
		</div>
	</div>
</div>
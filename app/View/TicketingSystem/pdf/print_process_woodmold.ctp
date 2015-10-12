<?php
// header("Content-disposition: attachment; filename="'this.pdf');
// header("Content-type: application/pdf");
Configure::write('debug',0);
?>
<style>
<?php include('word.css'); ?>

</style>

<html>
<head>
	<title>Print Process</title>
</head>
<body style="font-family:sans-serif; font-size:13px">	

<div class="large-padding">
		<table class="full-width">
				<tr>
					<td><h2>Koufu Packaging Corp.</h2></td>
				</tr>	
				<tr>
					<td><strong><?php echo $subProcess[$processId] ?> Job Ticket</strong></td>
					<td class="text-right">
						<label class="strong">Date</label>
						<?php echo date('Y/m/d'); ?>
					</td>
				</tr>				
		</table>
		<br>
		<table class="full-width border">
				<tr>
					<td>
						Customer <?php echo !empty($companyData[$productData['Product']['company_id']]) ? ucwords($companyData[$productData['Product']['company_id']]) : '';  ?>
					</td>
					<td class="text-right">
						Schedule No <?php echo $ticketUuid; ?>
					</td>
					
				</tr>
				<tr>
					<td>
						Item  <?php echo $productData['Product']['name']; ?>
					</td>
					<td class="text-right">
						Description <?php echo $productData['Product']['remarks']  ?>
					</td>
				</tr>
					<tr>
					<td >Item Size <?php echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size1'].' x '.$specs['ProductSpecification']['size2'].' x '.$specs['ProductSpecification']['size3'] : '' ?></td>
					<td class="text-right"><label class="">Outs</label> </td>
					</tr>
		</table>
		<table class="full-width border">
				<tr>
					<td style="width:350px">
						Sample
					</td>
					<td>
						<strong>Supplier</strong>
					</td>
					
				</tr>
				<tr>
					<td>
						<?php echo $part['ProductSpecificationPart']['material']; ?>
					</td>
					<td class="text-right">
						
					</td>
					</tr>
				<tr>
					<td >
						<?php if (!empty($modelData['WoodMoldJobTicket']['category'])) {

							echo $modelData['WoodMoldJobTicket']['category'];
						 } ?>

					</td>
					<td >
						<?php if (!empty($modelData['WoodMoldJobTicket']['style'])) {

							echo $modelData['WoodMoldJobTicket']['style'];
						 } ?>
						</td>
				</tr>
		</table>

			<table class="full-width border" style="height:260px">
				<tr>
					<td style="vertical-align:top">
						<p>Crease   <?php echo !empty($modelData['WoodMoldJobTicket']['crease']) ? $modelData['WoodMoldJobTicket']['crease'] : '' ?></p>
						<p>Knife  <?php echo !empty($modelData['WoodMoldJobTicket']['crease']) ? $modelData['WoodMoldJobTicket']['crease'] : '' ?> </p>
					</td>
				</tr>
			</table>
			<table class="full-width">
			<tr>
			<td>Sales : <?php echo $userData['User']['first_name'].', '.$userData['User']['last_name'] ?></td>
			<td>Approved By: </td>
			</tr>
			</table>		
</div>

</body>
</html>
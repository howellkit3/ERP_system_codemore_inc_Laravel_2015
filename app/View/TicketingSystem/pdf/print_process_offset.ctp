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
					<td><strong>Plate Making <?php //echo $subProcess[$processId] ?> Job Ticket</strong></td>
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
						<span class="grey-label bold">Customer</span> <?php echo !empty($companyData[$productData['Product']['company_id']]) ? ucwords($companyData[$productData['Product']['company_id']]) : '';  ?>
					</td>
					<td class="text-right">
						<span class="grey-label bold"> Schedule No </span> <?php echo $ticketUuid; ?>
					</td>
					
				</tr>
				<tr>
					<td>
						<span class="grey-label bold">Item </span> <?php echo $productData['Product']['name']; ?>
					</td>
					<!-- <td class="text-right">
						<span class="grey-label bold"> Description </span> <?php echo $productData['Product']['remarks']  ?>
					</td> -->
				</tr>
					<tr>
					<td style="width:350px" > <span class="grey-label bold" >Item Size  </span> <?php echo !empty($specs['ProductSpecification']['size1']) ? $specs['ProductSpecification']['size1'].' x '.$specs['ProductSpecification']['size2'].' x '.$specs['ProductSpecification']['size3'] : '' ?></td>
					<td class="text-left"><label class="grey-label bold">Outs</label> </td>
					</tr>
		</table>

			<table class="full-width border" style="height:260px">
				<tr>
					<td style="vertical-align:top; width: 350px">
						<table >
								<tr>
									<td style="width:80px"> <span class="grey-label bold"> Plate Type </span> </td>
									<td> 
										<?php echo !empty($subProcess[$processId]) ? $subProcess[$processId] : ''; ?>
									</td>
									<td> <span class="grey-label bold"> Film Type </span> </td>
									<td> </td>
								</tr>
								<tr>
									<td> <span class="grey-label bold"> Color </span> </td>
									<td>  </td>
								</tr>
								<tr>
									<td> <span class="grey-label bold"> Finishing Size </span> </td>
									<td>  </td>
								</tr>
								<tr>
									<td style="height:70px; vertical-align:top;"> <span class="grey-label bold"> Sample </span> </td>
									<td> 


									 </td>
								</tr>

								<tr>
									<td> 	Paper Gripper  <?php echo !empty($PlateMakingProcess['PlateMakingProcess']['paper_gripper']) ? $PlateMakingProcess['PlateMakingProcess']['paper_gripper'] : '' ?> </td>
									<td> 


									 </td>
								</tr>
							
						</table>

						<table class="full-width" style="height:70px; border-top:1px solid #000" >
							<tr>
								<td> LPI </td>
							</tr>
							<tr>
								<td> <!-- Screen Type --> </td>
							</tr>
						</table>

						<table class="full-width" style="height:70px; border-top:1px solid #000" >
							<tr>
								<td>  <span class="grey-label bold"> Offset Machine  </span> </td>
								<td>  <?php echo !empty($PlateMakingProcess['Machine']['name']) ? $PlateMakingProcess['Machine']['name'] : '' ?>   </td>
							</tr>
							<tr>
								<td> <span class="grey-label bold"> Plate Size </span> </td>
								<td>  <?php echo !empty($PlateMakingProcess['PlateMakingProcess']['plate']) ? $PlateMakingProcess['PlateMakingProcess']['plate'] : '' ?>   </td>
							</tr>
								<tr>
								<td> <span class="grey-label bold"> Plate Gripper </span> </td>
								<td>  <?php echo !empty($PlateMakingProcess['PlateMakingProcess']['plate_gripper']) ? $PlateMakingProcess['PlateMakingProcess']['plate_gripper'] : '' ?>   </td>
							</tr>
						</table>
					</td>
					<td style="vertical-align:top;">
						<table style="border-left:1px solid #000; height:300px">
								<tr>
									<td style="vertical-align:top;"> 
									<strong>Remark</strong>
									</td>
								</tr>
						</table>
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
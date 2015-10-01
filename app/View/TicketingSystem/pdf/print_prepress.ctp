<?php
// header("Content-disposition: attachment; filename="'this.pdf');
// header("Content-type: application/pdf");
?>
<style>
<?php include('word.css'); ?>

</style>

<html>
<head>
	<title>Prepress</title>
</head>
<body>

	<div class="large-padding">
			<div class="border full-width">
					<table class="full-width border header" style="font-family:sans-serif;">
							<tr>
								<td style="text-left" style="padding-left:15px"> <h2  style="padding-left:25px"> Koufu Packaging Corp. </h2> </td>
								<td class="text-right" style="padding-right:15px"> <h1> Prepess Job Ticket </h1> </td>
							</tr>
					</table>
					<table class="full-width border header" style="font-family:sans-serif; padding: 10px ;font-size:15px;">
							<tr>
								<td  style="padding-left:15px">
								<table class="full-width">
									<tr><td style="width:70px"> Customer </td> 
									<td> <div style="border-bottom:1px dashed #000; ">
									<?php echo !empty($companyData[$productData['Product']['company_id']]) ? ucwords($companyData[$productData['Product']['company_id']]) : '';  ?>
									</div></td> 
									</tr>
								</table>
								</td>
								<td  style="padding-left:15px" > <table class="full-width"><tr><td style="width:100px"> Schedule No.  </td> <td> <div style="border-bottom:1px dashed #000; "> <?php echo $ticketUuid; ?> </div> </td> </tr></table>  </td>
								<td style="width:70px"> 
								<table class="full-width">
									<tr><td style="width:30px"> REV </td> 
										<td> <div style="border-bottom:1px dashed #000; "> NEW </div></td> 
									</tr>
								</table> 
								</td>
							</tr>
								<tr>
								<td  style="padding-left:15px">
								<table class="full-width">
									<tr><td style="width:100px"> Item Name </td> 
									<td> <div style="border-bottom:1px dashed #000; "> <?php echo $productData['Product']['name']; ?></div></td> 
									</tr>
								</table>
								</td>
								<td  style="padding-left:15px" > <table class="full-width"><tr><td style="width:120px"> Job Description.  </td> <td> <div style="border-bottom:1px dashed #000; ">  Manual </div> </td> </tr></table>  </td>
								<td> <div style="border-bottom:1px dashed #000; ">  <span style="color:#fff">a</span> </div> </td> </tr></table>  </td>
							</tr>

					</table>

					<table class="full-width border header" style="font-family:sans-serif; padding: 10px ;font-size:15px;">
							<tr>
								<td class="" style="border-right:1px solid #000"></td>
								<td class=""></td>
							</tr>
					</table>
			</div>
	</div>
</body>
</html>
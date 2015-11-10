<?php
// header("Content-disposition: attachment; filename="'this.pdf');
// header("Content-type: application/pdf");
?>
<style>
<?php include('word.css'); ?>

</style>

<html>
<head>
	<title>Print Process</title>
</head>
<body style="font-family:sans-serif;">	

<div class="large-padding">
		<table class="full-width">
				<tr>
					<td><img src="<?php echo $this->Html->url('/',true)?>/img/koufu_logo.png" style="width:130px;height:40px;"></td>
					<td style="text-align:right"><h2>REQUEST FOR OVERTIME</h2></td>
				</tr>				
		</table>
		<br>
			<br>
		<table class="full-width border" style="border-bottom:0">
				<tr>
					<td style="width:430px">
						Section : 
					</td>
					<td style="width:200px" class="border-left">
						Date : <?php echo !empty($request['Overtime']['date']) ? date('m-d-y',strtotime($request['Overtime']['date'])) : ''; ?>
					</td>
					
				</tr>
				
		</table>
		<table style=" border:1px solid black;border-collapse:collapse; margin-bottom:0px;  " class="full-width">
					<tr>
						<td align = "center" style="border:1px solid black; width:10px; font-size:70%;" ><b>No.</b></td>
						<td align = "center" style =" width:150px; word-wrap: break-word; font-size:60%;" ><b>NAME</b></td>
						<td align = "center" style="border:1px solid black; width:20px; font-size:60%;"><b>Requested Time</b>
							<table class="full-width text-center border-top">
								<tr>
									<td class="border-right" style="width:50%">From</td>
									<td style="width:50%">To</td>
								</tr>
							</table>

						</td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b>Reason</b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b>Signature</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Actual Time</b>
								<table class="full-width text-center border-top">
								<tr>
									<td class="border-right" style="width:50%">From</td>
									<td style="width:50%">To</td>
								</tr>
							</table>

						</td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Total Time</b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"><b>Incharge Verification</b></td>
					</tr>
	
				<?php $count = 1; foreach ($employees as $key => $list) { ?>
				
					<tr >
						<td align = "center" style="border:1px solid black; width:17px; font-size:70%;" ><b><?php echo $count; ?></b></td>
						<td align = "center" style ="width:300p;word-wrap: break-word; font-size:60%; border-top:1px solid;" ><b><?php echo $list['Employee']['full_name']?></b></td>
						<td align = "center" style="border:1px solid black; width:20px; font-size:60%;">
							<table class="full-width text-center">
								<tr>
									<td class="border-right" style="width:50%"> <?php echo date('H:i',strtotime($request['Overtime']['from'])); ?></td>
									<td style="width:50%"><?php echo date('H:i',strtotime($request['Overtime']['to'])); ?></td>
								</tr>
							</table>

						</td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b><?php echo $request['Overtime']['remarks']; ?></b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b></b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;">
								<table class="full-width text-center">
								<tr>
									<td class="border-right" style="width:50%">  </td>
									<td style="width:50%">  </td>
								</tr>
							</table>

						</td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;">  </td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"> </td>
					</tr>
			<?php $count++; } ?>

			<?php if ($count < 10 ) { ?>

				<?php for($i = $count; $i <= 10; $i++) { ?>

				<tr>
						<td align = "center" style="border:1px solid black; width:10px; font-size:70%;" ><b><?php echo $i; ?></b></td>
						<td align = "center" style =" width:150px; word-wrap: break-word; font-size:60%; border-top:1px solid;" > </td>
						<td align = "center" style="border:1px solid black; width:20px; font-size:60%;">
							<table class="full-width text-center">
								<tr>
									<td class="border-right" style="width:50%">  </td>
									<td style="width:50%"> </td>
								</tr>
							</table>

						</td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b> </b></td>
						<td align = "center" style="border:1px solid black; width:35px; font-size:60%;"><b></b></td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;">
								<table class="full-width text-center">
								<tr>
									<td class="border-right" style="width:50%">  </td>
									<td style="width:50%">  </td>
								</tr>
							</table>

						</td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;">  </td>
						<td align = "center" style="border:1px solid black; width:40px; font-size:60%;"> </td>

				<?php } ?>

			<?php } ?>


	</table>
	<table class="full-width border medium-font">
		<tr>
				<td style="width:30%;position:relative; height:50px; border-right:1px solid #000;">
						<p style="position:absolute;margin-top:-2px"> Prepared By: </p>

						<p style="position:absolute;margin-top:40px;margin-left:30%">Name & Signature </p>
				</td>
				<td style="width:30%;position:relative; height:50px; border-right:1px solid #000;">
						<p style="position:absolute;margin-top:-2px"> Noted By: </p>

						<p style="position:absolute;margin-top:40px;margin-left:30%">Department Head </p>
				</td>
				
				<td style="width:20%;position:relative; height:50px; border-right:1px solid #000; vertical-align:top">
						<p style="position:absolute;margin-top:0px"> Approved: </p>

				</td>
				<td style="width:20%;position:relative; height:50px; ">
						<p style="position:absolute;margin-top:-2px">Checked By: </p>

						<p style="position:absolute;margin-top:40px;margin-left:30%"> Timekeeper</p>
				</td>
				


		</tr>
	</table>
	<table class="full-width medium-font">
		<tr>
				<td style="width:10%;position:relative; height:50px;;">
						<p style="position:absolute;top:10%"> NOTES </p>
				</td>
				<td style="width:70%;position:relative; height:100px;">
					<p>1. Indicate in the Time if AM or PM </p>
					<p>1. In Charge should verify actual OT and sign; HR will not pay unverified unsigned OT. </p>
				</td>

				<td style="width:20%;position:relative; height:100px; ">
					<p>KP-FR-HR1-007 Rev 1</p>
					<p>Effective 02 Oct 2015</p>
				</td>


		</tr>
	</table>
		
		
</div>

</body>
</html>

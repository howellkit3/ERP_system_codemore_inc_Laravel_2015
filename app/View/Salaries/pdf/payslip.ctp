<?php
header("Content-disposition: attachment; filename=".'payslip-'.$payroll['Payroll']['id'].'-'.time().".pdf");
header("Content-type: application/pdf");
?>
<style>
<?php include('payslip.css'); ?>

</style>
<?php $siteUrl = $this->Html->url('/',true); ?>

<html>
<head>
	<title>Payslip</title>
</head>
	<body>
		<?php  foreach ($salaries as $key => $salary) :

				$employee_name = $this->CustomText->getFullname($salary['Employee']);

			 	$payrollDate = date('F',strtotime($salary['from'])).' '.date('d',strtotime($salary['from'])).'-'.date('d',strtotime($salary['to'])).','.date('Y',strtotime($salary['from']));
		 ?>
		 <div class="container">
			<table class="center container medium-font">
						<tr>
						<td>
						<?php echo $this->Html->image($siteUrl.'/img/koufu_logo.jpg',array('width' => '80px')); ?>
						</td>
						<td class="text-right">
						Lot 4-5 Blk 3 Ph2 Mountview Industrial Complex 
						Brgy. Bancal Carmona Cavite
						<br>
						Tel: +632-5844928; +6346-4301576 <br> Fax: +632-5844952
						</td>
						</tr>
				</table>
				<br><br>

				<table class="center container medium-font">
						<tr>
							<td class="label-table">
								<strong>Employee Name : </strong>
							</td>
							<td>
							<?php echo $employee_name; ?>
							</td>
							<td class="label-table">
								<strong>Employee Number : </strong>
							</td>
							<td>
								<?php echo $salary['Employee']['code']; ?>
							</td>
						</tr>
						<tr>
							<td class="label-table">
								<strong>Payroll Period : </strong>
							</td>
							<td>
								<?php echo $payrollDate; ?>
							</td>
							<td class="label-table">
								<strong>Department : </strong>
							</td>
							<td>
								<?php  echo ucwords($salary['Department']['name']) ; ?>
							</td>
						</tr>
						<tr>
							<td class="label-table"></td>
							<td></td>
							<td class="label-table">
								<strong>Position : </strong>
							</td>
							<td>
								<?php echo !empty($salary['Position']['name']) ? ucwords($salary['Position']['name']) : '' ; ?>
							</td>
						</tr>
				</table>
				<br>
				<br>
				<table class="border container center">
						<tr>
							<td class="border-bottom">
								<table class="full-width border-right">	
									<tr>
										<td><strong>Earnings</strong></td>
										<td class="text-right"> Hours </td>
										<td class="text-right"> Amount </td>
									</tr>
								</table>
							</td>
							<td class="border-bottom">
							<table class="full-width">	
									<tr>
										<td><strong>Deductions</strong></td>
										<td class="text-right"> Amount </td>
									</tr>
								</table></td>
						</tr>
						<tr>
							<td>
							<table class="full-width border-right">	
								<tr>
									<td>Basic pay (Days : <?php echo $salary['days']; ?>)</td>
									<td class="text-right"><?php echo $salary['hours_regular']; $total_hours = $salary['hours_regular'];  ?></td>
									<td class="text-right"><?php echo number_format($salary['regular'],2); $total_earnings = 0.00; ?></td>
								</tr>
								<tr>
									<td>OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_ot']) ?  $salary['hours_ot'] : 0; 
									$total_hours += $salary['hours_ot'];?></td>
									<td class="text-right"><?php echo number_format($salary['OT'],2) ?></td>
								</tr>
								<tr>
									<td>Sun</td>
									<td class="text-right"><?php echo !empty($salary['hours_sunday_work']) ?  $salary['hours_sunday_work'] : 0; 
										$total_hours +=  $salary['hours_sunday_work'];
									?></td>
									<td class="text-right">
									<?php echo !empty($salary['sunday_work'])  ? number_format($salary['sunday_work'],2) : '0.00'; ?>
									</td>
								</tr>
								<tr>
									<td>Sun OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_sunday_work_ot']) ?  $salary['hours_sunday_work_ot'] : 0; 
										$total_hours +=  $salary['hours_sunday_work_ot'];
									?></td>
									<td class="text-right"><?php echo !empty($salary['sunday_work_ot'])  ? number_format($salary['sunday_work_ot'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>LH</td>

									<td class="text-right"></td>
									<td class="text-right"><?php echo !empty($salary['legal_holiday'])  ? number_format($salary['legal_holiday'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>LH Work</td>
									<td class="text-right"><?php echo !empty($salary['hours_legal_holiday_work']) ?  $salary['hours_legal_holiday_work'] : 0; $total_hours +=  $salary['hours_legal_holiday_work']; ?></td>
									<td class="text-right"><?php echo !empty($salary['legal_holiday_work'])  ? number_format($salary['legal_holiday_work'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>LH OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_legal_holiday_work_ot']) ?  $salary['hours_legal_holiday_work_ot'] : 0;  $total_hours +=  $salary['hours_legal_holiday_work_ot'];  ?></td>	
									<td class="text-right"><?php echo !empty($salary['legal_holiday_work_ot'])  ? number_format($salary['legal_holiday_work_ot'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>LH Sunday Work</td>
									<td class="text-right"><?php echo !empty($salary['hours_legal_holiday_sunday_work']) ?  $salary['hours_legal_holiday_sunday_work'] : 0; $total_hours +=  $salary['hours_legal_holiday_sunday_work'];?></td>		
									<td class="text-right"><?php echo !empty($salary['legal_holiday_sunday_work'])  ? number_format($salary['legal_holiday_sunday_work'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>LH Sunday OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_legal_holiday_sunday_work_ot']) ?  $salary['hours_legal_holiday_sunday_work_ot'] : 0; $total_hours += $salary['hours_legal_holiday_sunday_work_ot']; ?></td>
									<td class="text-right"><?php echo !empty($salary['legal_holiday_sunday_work_ot'])  ? number_format($salary['legal_holiday_sunday_work_ot'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>Special Holiday</td>
									<td></td>
									<td class="text-right"><?php echo !empty($salary['special_holiday'])  ? number_format($salary['special_holiday'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>Special Holiday Work</td>
									<td class="text-right"><?php echo !empty($salary['hours_special_holiday_work']) ?  $salary['hours_special_holiday_work'] : 0; $total_hours += $salary['hours_special_holiday_work'];?></td>
									<td class="text-right"><?php echo !empty($salary['special_holiday_work'])  ? number_format($salary['special_holiday_work'],2) : '0.00'; ?></td>
								</tr>
									<tr>
									<td>Special Holiday OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_special_holiday_work_ot']) ?  $salary['hours_special_holiday_work_ot'] : 0; $total_hours += $salary['hours_special_holiday_work_ot'];?></td>
									<td class="text-right"><?php echo !empty($salary['special_holiday_work_ot'])  ? number_format($salary['special_holiday_work_ot'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>Night Diff</td>
									<td class="text-right"></td>
									<td class="text-right"><?php echo !empty($salary['night_diff'])  ? number_format($salary['night_diff'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>Vacation Leave</td>

									<td class="text-right"></td>
									<td class="text-right"><?php echo !empty($salary['leave'])  ? number_format($salary['leave'],2) : '0.00'; ?></td>
								</tr>

								<tr>
									<td>CTPA + SEA</td>

									<td class="text-right"></td>
									<td class="text-right"> <?php echo !empty($salary['ctpa'])  ? $salary['ctpa'] : '0.00'; $additional = $salary['ctpa'];  ?> +  <?php echo !empty($salary['sea'])  ? $salary['sea'] : '0.00';   $additional += $salary['sea'];  ?> = <?php echo  number_format($additional,2) ?></td>
								</tr>

								<tr>
									<td  class="border-top"><strong>Adjustments </strong> </td>
									<td class="border-top text-right"> </td>
									<td class="border-top text-right"> </td>
								</tr>

								<tr>
									<td>Allowances</td>

									<td class="text-right"></td>
									<td class="text-right"><?php echo !empty($salary['allowances'])  ? number_format($salary['allowances'],2) : '0.00'; ?></td>
								</tr>

								<tr>
									<td>Incentives</td>
									<td class="text-right"></td>
									<td class="text-right"><?php echo !empty($salary['incentives'])  ? number_format($salary['incentives'],2) : '0.00'; ?></td>
								</tr>
							</table>
							</td>
							<td style="vertical-align:top"> 
							<table class="full-width" >	
								<?php foreach ($deductions as $deduction_key => $list) : ?>
								<tr style="vertical-align:top">
									<td><?php echo $list; ?></td>
									<td class="text-right"><?php 
										$index = str_replace(' ','_',strtolower($list));
										echo !empty($salary[$index]) ? number_format($salary[$index],2) : '0.00';
									 ?></td>
								</tr>
							<?php endforeach; ?>

								<tr>
									<td  class="border-top"><strong>Tax </strong> </td>
									<td class="border-top text-right"> </td>
								</tr>

								<tr>
									<td>SSS </td>
									<td class="text-right">
									<?php echo !empty($salary['sss'])  ? number_format($salary['sss'],2) : '0.00'; ?>
									</td>
								</tr>
								<tr>
									<td>PhilHealth</td>
									<td class="text-right">
									<?php echo !empty($salary['philhealth'])  ? number_format($salary['philhealth'],2) : '0.00'; ?>
									</td>
								</tr>
								<tr>
									<td>Pagibig</td>
									<td class="text-right">
										<?php echo !empty($salary['pagibig'])  ? number_format($salary['pagibig'],2) : '0.00'; ?>
									</td>
								</tr>
								<tr>
									<td>Withholding Tax</td>
									<td class="text-right">
										<?php echo !empty($salary['with_holding_tax'])  ? number_format($salary['with_holding_tax'],2) : '0.00'; ?>
									</td>
								</tr>
							</table>
						 </td>
						</tr>


						<tr>
							<td class="border-top">
								<table class="full-width border-right">	
									<tr>
										<td><strong>Total</strong></td>
										<td class="text-right"><?php echo $total_hours; ?> hrs</td>
										<td class="text-right"> <?php echo number_format($salary['total_earnings'],2) ?> </td>
									</tr>
								</table>
							</td>
							<td class="border-top"><table class="full-width">	
									<tr>
										<td><strong>Total Deductions</strong></td>
										<td class="text-right"> <?php echo number_format($salary['total_deduction'],2) ?>  </td>
									</tr>
								</table></td>
						</tr>

				</table>
				<br><br>
				<table class="container border">
					<tr>
						<td colspan="2"> <strong>Total Net Pay : </strong> </td> 
						<td class="text-right">
						 	<strong><?php echo number_format($salary['total_pay'],2);	?></strong> 
						 </td>
					</tr>
				</table>
					<br><br><!-- 
				<table class="container">
					<tr>
						<td class="border-top"> Employee Signature </td> 
						<td >  </td>

						<td class="border-top"> Accounting Staff </td>
					</tr>
				</table> -->
			</div>
				 <div style="page-break-before: always;"></div> 
<?php endforeach; ?>
	</body>
</html>
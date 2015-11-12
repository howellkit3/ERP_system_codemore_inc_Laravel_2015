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
	<body style="max-width:800px">
		<?php  
			$startKey = 1;	
			foreach ($salaries as $key => $salary) :

				$total_hours= 0;

				$employee_name = $this->CustomText->getFullname($salary['Employee']);
				
				if ($payroll['Payroll']['type'] == '13_month') {

					$payrollDate = date('F d',strtotime($payroll['Payroll']['from'])).'-'.date('F d',strtotime($payroll['Payroll']['to'])).','.date('Y',strtotime($payroll['Payroll']['from']));

				} else {

					$payrollDate = date('F',strtotime($payroll['Payroll']['from'])).'-'.date('d',strtotime($payroll['Payroll']['to'])).','.date('Y',strtotime($payroll['Payroll']['from']));
				}


				//regular hours

				$hours_regular = !empty($salary['hours_regular']) ? $salary['hours_regular'] : 0;

				$hours_ot = !empty($Salary['hours_ot']) ? $salary['hours_ot'] : 0;

				$hours_sunday_work = !empty($salary['hours_sunday_work']) ? $salary['hours_sunday_work'] : 0;

				$hours_legal_holiday_work = !empty($salary['hours_legal_holiday_work']) ? $salary['hours_legal_holiday_work'] : 0;


				$hours_legal_holiday_work_ot = !empty($salary['hours_legal_holiday_work_ot']) ? $salary['hours_legal_holiday_work_ot'] : 0;


				$hours_legal_holiday_sunday_work = !empty($salary['hours_legal_holiday_sunday_work']) ? $salary['hours_legal_holiday_sunday_work'] : 0;


				$hours_legal_holiday_sunday_work_ot = !empty($salary['hours_legal_holiday_sunday_work_ot']) ? $salary['hours_legal_holiday_sunday_work_ot'] : 0;



				$hours_special_holiday_work  = !empty($salary['hours_special_holiday_work ']) ? $salary['hours_special_holiday_work '] : 0;

				$hours_special_holiday_work_ot  = !empty($salary['hours_special_holiday_work_ot ']) ? $salary['hours_special_holiday_work_ot '] : 0;


				$regular  = !empty($salary['regular']) ? $salary['regular'] : 0;


		 ?>
		 	<div class="main-container">
		 	<div class="border">
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
								<strong> Name : </strong>
							</td>
							<td>
							<?php echo $employee_name; ?>
							</td>
							<td class="label-table">
								<strong>Emp # : </strong>
							</td>
							<td>
								<?php echo $salary['Employee']['code']; ?>
							</td>
						</tr>
						<tr>
							<td class="label-table">
								<strong>Period : </strong>
							</td>
							<td>
								<?php echo $payrollDate; ?>
							</td>
							<td class="label-table">
								<strong>Dpt : </strong>
							</td>
							<td>
								<?php  echo ucwords($salary['Department']['description']) ; ?>
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
			</div>
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
									<td> Basic (Days : <?php 
										$days =  $salary['hours_regular'] / 8;
										echo number_format($days,2); ?>)</td>
									<td class="text-right"><?php echo $hours_regular;  $total_hours = $hours_regular   ?></td>
									<td class="text-right"><?php echo !empty($salary['regular']) ? number_format($salary['regular'],2) : '0.00'; $total_earnings = 0.00; ?></td>
								</tr>
								<tr>
									<td>OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_ot']) ?  $salary['hours_ot'] : 0; 
									$total_hours += !empty($salary['hours_ot']) ? $salary['hours_ot'] : 0;?></td>
									<td class="text-right"><?php 
									
									$total_overtime =  !empty($salary['OT']) ? $salary['OT'] : 0;
									
									//add excess overtime
									$total_overtime += !empty($salary['excess_ot']) ? $salary['excess_ot'] : 0;

									echo number_format($total_overtime,2);

									?></td>
								</tr>
								<tr>
									<td>Sun</td>
									<td class="text-right"><?php echo !empty($salary['hours_sunday_work']) ?  $salary['hours_sunday_work'] : 0; 
										$total_hours +=  !empty($salary['hours_sunday_work']) ? $salary['hours_sunday_work'] : 0;
									?></td>
									<td class="text-right">
									<?php echo !empty($salary['sunday_work'])  ? number_format($salary['sunday_work'],2) : '0.00'; ?>
									</td>
								</tr>
								<tr>
									<td>Sun OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_sunday_work_ot']) ?  $salary['hours_sunday_work_ot'] : 0; 
										$total_hours += !empty($salary['hours_sunday_work_ot']) ? $salary['hours_sunday_work_ot'] : 0;
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
									<td class="text-right"><?php echo !empty($salary['hours_legal_holiday_work']) ?  $salary['hours_legal_holiday_work'] : 0; 
									$total_hours += !empty($salary['hours_legal_holiday_work']) ? $salary['hours_legal_holiday_work'] : 0; ?></td>
									<td class="text-right"><?php echo !empty($salary['legal_holiday_work'])  ? number_format($salary['legal_holiday_work'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>LH OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_legal_holiday_work_ot']) ?  $salary['hours_legal_holiday_work_ot'] : 0;  
									$total_hours +=  !empty($salary['hours_legal_holiday_work_ot']) ? $salary['hours_legal_holiday_work_ot'] : 0 ;  ?></td>	
									<td class="text-right"><?php echo !empty($salary['legal_holiday_work_ot'])  ? number_format($salary['legal_holiday_work_ot'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>LH Sunday Work</td>
									<td class="text-right"><?php echo !empty($salary['hours_legal_holiday_sunday_work']) ?  $salary['hours_legal_holiday_sunday_work'] : 0;
									 $total_hours +=  !empty($salary['hours_legal_holiday_sunday_work']) ? $salary['hours_legal_holiday_sunday_work'] : 0 ; ?></td>		
									<td class="text-right"><?php echo !empty($salary['legal_holiday_sunday_work'])  ? number_format($salary['legal_holiday_sunday_work'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>LH Sunday OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_legal_holiday_sunday_work_ot']) ?  $salary['hours_legal_holiday_sunday_work_ot'] : 0; 
									$total_hours += !empty($salary['hours_legal_holiday_sunday_work_ot']) ? $salary['hours_legal_holiday_sunday_work_ot'] : 0; ?></td>
									<td class="text-right"><?php echo !empty($salary['legal_holiday_sunday_work_ot'])  ? number_format($salary['legal_holiday_sunday_work_ot'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>SH</td>
									<td></td>
									<td class="text-right"><?php echo !empty($salary['special_holiday'])  ? number_format($salary['special_holiday'],2) : '0.00'; ?></td>
								</tr>
								<tr>
									<td>SH Work</td>
									<td class="text-right"><?php echo !empty($salary['hours_special_holiday_work']) ?  $salary['hours_special_holiday_work'] : 0; 
									$total_hours += !empty($salary['hours_special_holiday_work']) ? $salary['hours_special_holiday_work'] : 0 ;?></td>
									<td class="text-right"><?php echo !empty($salary['special_holiday_work'])  ? number_format($salary['special_holiday_work'],2) : '0.00'; ?></td>
								</tr>
									<tr>
									<td>SH OT</td>
									<td class="text-right"><?php echo !empty($salary['hours_special_holiday_work_ot']) ?  $salary['hours_special_holiday_work_ot'] : 0;
									 $total_hours += !empty($salary['hours_special_holiday_work_ot']) ? $salary['hours_special_holiday_work_ot'] : 0 ; ?></td>
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

									<td>SUN CTPA + SEA (days : <?php echo $salary['sunday_days']; ?>)</td>

									<td class="text-right"></td>
									<td class="text-right"> <?php echo !empty($salary['sunday_ctpa'])  ? $salary['ctpa'] : '0.00'; $additional = $salary['sunday_ctpa'];  ?> +  <?php echo !empty($salary['sunday_sea'])  ? $salary['sunday_sea'] : '0.00';   $additional += $salary['sunday_sea'];  ?> = <?php echo  number_format($additional,2) ?></td>
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
									<td>Adjustment</td>
									<td class="text-right"></td>
									<td class="text-right"><?php echo !empty($salary['adjustment'])  ? number_format($salary['adjustment'],2) : '0.00'; ?></td>
								</tr>

								<?php if ($payroll['Payroll']['type'] == '13_month') : ?>

								<tr>
									<td>13 Month</td>
									<td class="text-right"></td>
									<td class="text-right"><?php echo !empty($salary['thirteen_month'])  ? number_format($salary['thirteen_month'],2) : '0.00'; ?></td>
								</tr>

								<?php endif; ?>	
							</table>
							</td>
							<td style="vertical-align:top"> 
							<table class="full-width" >	
							<?php foreach ($deductions as $deduction_key => $list) :
							 ?>
								<tr style="vertical-align:top">
									<td><?php echo $list['Loan']['name']; ?></td>
									<td class="text-right"><?php 
										$index = str_replace(' ','_',strtolower($list['Loan']['name']));
										echo !empty($salary[$index]) ? number_format($salary[$index],2) : '0.00';

									 ?></td>
								</tr>
							<?php endforeach; ?>
								<tr>
									<td class="border-top"><strong> Deductions </strong> </td>
									<td class="border-top text-right"> </td>
								</tr>

								<tr>
									<td>SSS </td>
									<td class="text-right">
										<?php
										 echo !empty($salary['sss']) && is_int($salary['sss'])  ? number_format($salary['sss'],2) : '0.00'; ?>
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
							<td class="border-top">
								<table class="full-width">	
									<tr>
										<td><strong>Deductions</strong></td>
										<td class="text-right"> <?php echo number_format($salary['total_deduction'],2) ?>  </td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				<table class="container border">
					<tr>
						<td colspan="2"> <strong>Total Net Pay : </strong> </td> 
						<td class="text-right">
						 	<strong><?php echo number_format($salary['total_pay'],2);	?></strong> 
						 </td>
					</tr>
				</table>
			</div>
			<?php if($key != 0) : ?>
				<div style="page-break-before: always;"></div>
			<?php endif; ?>


			<!-- 	 <div style="page-break-before: always;"></div>  -->
<?php $startKey++; endforeach; ?>
	</body>
</html>
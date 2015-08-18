<style>
<?php include('word.css'); ?>

</style>
<html>
<head>
	<title> R1 Reports </title>
</head>
<body >
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-container" >
				
				<table width="" class="sss-table" style="margin-top:235px;">
					<?php 
						foreach ($employees as $key => $employee) :
						
						$emp['MonthlyIncome'] = 0;
						
						foreach ($employee as $key => $list) :
						
							$emp['Employee'] = $list['Employee'];
							$emp['AdditionalInformation'] = $list['EmployeeAdditionalInformation'];
							$emp['MonthlyIncome'] += $list['SalaryReport']['total_pay'];
							$emp['SssRecord'] = $list['SssRecord'];
							$emp['Position'] = $list['Position'];
						endforeach;
					 ?>
					<tr>
						<td class="ss_number"> 
							<?php echo !empty($emp['SssRecord']['value']) ? $emp['SssRecord']['value'] : '-'  ?>
						 </td>
						<td class="emp_name"> 
							<table>
									<tr>
										<td><?php echo $emp['Employee']['last_name'] ?></td>
										<td><?php echo $emp['Employee']['first_name'] ?></td>
										<td><?php echo $emp['Employee']['middle_name'] ?></td>
									</tr>
							</table>
						 </td>
						 <td class="birthday"> 
							<?php echo !empty($emp['AdditionalInformation']['birth_day']) ? date('m/d/Y',strtotime($emp['AdditionalInformation']['birth_day'])) : ' - '  ?>
						 </td>
						 <td class="date_hired"> 
							<?php echo !empty($emp['Employee']['date_hired']) ? date('m/d/Y',strtotime($emp['Employee']['date_hired'])) : ' - '  ?>
						 </td>
						 <td class="monthly_income"> 
							 <?php echo $emp['MonthlyIncome']; ?>
						 </td>
						 <td class="position" style="<?php echo strlen($emp['Position']['name']) > 15 ? 'font-size:55%; word-wrap:break-word;': 'font-size: 80%'; ?>">
						 	<div style="width:80px;">
							 <?php echo !empty($emp['Position']['name']) ? $emp['Position']['name'] : '-' ; ?>
							</div>
						 </td>
						 <td style="width:100px">
							 - 
						 </td>
						  <td style="width:100px">
							-
						 	</td>
					</tr>
					<?php  endforeach; ?>
				</table>
		</div>
	</div>
</div>
</body>
</html>

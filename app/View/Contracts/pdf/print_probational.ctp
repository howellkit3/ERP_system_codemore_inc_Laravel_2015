<style>
<?php include('word.css'); ?>

</style>
<div class="row">
	<div class="col-lg-12">
		<div class="main-box main-pdf" >
			<center>
				<header class="main-box-header clearfix" >
					<h2 style="padding-bottom:10px;">Kou Fu Packaging Corporation</h2>
					<h6 style="padding-bottom:8px;">Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h6>
					<h6>
						Tel: +63(2)5844928 &nbsp; Fax: +63(2)5844952
					</h6><br>
					<h3>Probational</h3><br>
				</header>
			</center>

			<table class="layout">
				<thead>
					<tr>
						<td style="width:123px;font-family: Calibri;"> </td>
						<td style="width:20px;"> </td>
						<td style="width:400px;"> </td>
						<td>
							<center>SN : <?php echo $employeeData['Employee']['code'] ?> </center>
						</td>
					</tr>

					<tr>
						<td style="width:123px;font-family: Calibri;"> </td>
						<td style="width:20px;"> </td>
						<td style="width:400px;"> </td>
						<td>
							<center>___________________ </center>
						</td>
					</tr>

					<tr>
						<td style="width:123px;font-family: Calibri;"> </td>
						<td style="width:20px;"> </td>
						<td style="width:400px;"> </td>
						<td>
							<center>Date </center>
						</td>
					</tr>
					
				</thead>
			</table>

			<table class="layout">
				<thead>
					<tr>
						<td style="font-family: Calibri;">TO : </td>
						<td style="font-family: Calibri;"> 
							<?php echo !empty($employeeData['Employee']['full_name']) ? ucwords($employeeData['Employee']['full_name']) : ''; ?>
						</td>
						
					</tr>

					<tr>
						<td style="width:20px;"> </td>
						<td style="font-family: Calibri;">
							Kou Fu Packaging Corporation is pleased to inform you of your hiring, under the following terms and conditions:
						</td>
						
					</tr>
				</thead>
			</table>

			<table class="layout">
				<thead>

					<tr>
						<td style="width:123px;font-family: Calibri;">Status</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							Probationary Employee
						</td>
					</tr>

					<tr>
						<td style="width:123px;font-family: Calibri;">Title/Position</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php echo ucfirst($employeeData['Position']['name']) ?>/<?php echo ucfirst($employeeData['Department']['name']) ?>
						</td>
					</tr>

					<tr>
						<td style="width:123px;font-family: Calibri;">Salary</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php

								switch ($employeeData['Salary']['employee_salary_type']) {
									case 'daily':
											echo !empty($employeeData['Salary']['basic_pay']) ? number_format($employeeData['Salary']['basic_pay'],2).' / per Day ' : '';
										break;
									case 'monthly':
											
											echo !empty($employeeData['Salary']['basic_pay']) ? number_format($employeeData['Salary']['basic_pay'],2).' / per Month ' : '';
										break;
									default:
										# code...
										break;
								}

							?>
						</td>
					</tr>

					<tr>
						<td style="width:123px;font-family: Calibri;">Allowance</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php echo !empty($employeeData['Salary']['allowance']) ? number_format($employeeData['Salary']['allowance'],2) : ''; ?>
						</td>
					</tr>
				</thead>
			</table>

			<table class="layout">
				<thead>
					<tr>
						<td style="width:230px;font-family: Calibri;">Conditional Temporary Productivity Allowance (CTPA)</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
						<?php echo !empty($employeeData['Salary']['ctpa']) ? number_format($employeeData['Salary']['ctpa'],2) : ''; ?>	
						</td>
					</tr>

					<tr>
						<td style="width:230px;font-family: Calibri;">Socio-Economic Allowance</td>
						<td style="width:20px;">:</td>
						<td style="width:200px;">
							<?php echo !empty($employeeData['Salary']['sea']) ? number_format($employeeData['Salary']['sea'],2) : ''; ?>
						</td>
					</tr>
				</thead>
			</table>

			<table class="layout">
				<thead>
					
					<tr>
						<td style="font-family: Calibri;text-indent: 30px;">
							Your probationary employment shall take effect on _01 May 2015 and will last for five (5) months, or until _30 September 2015 During your probationary employment, you are expected to abide by company rules and regulations and meet work and performance standards.  Management reserves the right to terminate your services if it finds that your performance does not meet our company’s requirements based on performance audits.  Evaluation will be based on:
						</td>
						
					</tr>
				</thead>
			</table>

			<div class="table-responsive" style="margin-left:120px">
				<table class="table">
					<thead>
						<tr>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td>1.  Job Competence</td>
							<td> </td>
							<td> </td>
							<td>4.  Dependability</td>
						</tr>
						<tr>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td>2.  Quality and Quantity of Work</center></td>
							<td> </td>
							<td> </td>
							<td>5.  Work Attitude and Habits</td>
						</tr>
						<tr>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td>3.  Initiative and Resourcefulness</td>
							<td> </td>
							<td> </td>
							<td>6.  Punctuality and Attendance</td>
						</tr>
					</thead>
				</table>
			</div>

			<table class="layout">
				<thead>
					
					<tr>
						<td style="font-family: Calibri;text-indent: 30px;">
							Should you pass the evaluation of your work performance as a probationary employee, you will be regularized in employment at the end of your five-month probationary employment. 
						</td>
						
					</tr>

					<tr>
						<td style="font-family: Calibri;text-indent: 30px;">
							Pursuant to the provisions of the Labor Code of the Philippines, you will be rendering a total of forty-eight (48) hours of regular work in a week. Any work rendered in excess of the said 48 hours will be duly compensated. The “no-work, no-pay” principle shall apply in the payment of wages and other related compensation. 
						</td>
						
					</tr>

					<tr>
						<td style="font-family: Calibri;text-indent: 30px;">
							The Company expects that you will faithfully perform duties assigned to you to the best of your ability, to devote your full and undivided time to your duties.  
						</td>
						
					</tr>

					<tr>
						<td style="font-family: Calibri;text-indent: 30px;">
							TWith this, we welcome you to Kou Fu Packaging Corporation. Please indicate your conformity to the foregoing terms and conditions of employment by signing on the space provided below. Your signature will also serve as a confirmation of the fact that you have been apprised of the company rules and regulations, as well as the work and performance standards expected of you.
						</td>
						
					</tr>
				</thead>
			</table>

			<br><br>

			<table style="width:100%; text-align:center;">
				<tr>
					<td style="width:100%; text-align:center;">
							<b><p>APPROVED</p></b>
						<div class="col-lg-12" style="width:100%;"><center>_________________________________</center></div>
						<div style="font-size:12px; width:100%;" >KOU FU PACKAGING CORP.</div>
					</td>
					<td style="width:100%; text-align:center;">
						<b><p>CONFORME</p></b>
						<div class="col-lg-12" style="width:100%;"><center>_________________________________</center></div>
						<div style="font-size:12px;width:100%;">PRINT NAME AND SIGN.</div>	
					</td>
				</tr>

			</table>

			<!-- <div class="one col-lg-6">
				<div class="form-group">
					<div class="col-lg-10"><center>_________________________________</center></div>
					<div style="font-size:12px;width:230px;">KOU FU PACKAGING CORP.</div>
				</div>
			</div>

			<div class="one col-lg-6">
				<div class="form-group">
					<div class="col-lg-6"><center>__________________________________</center></div>
					<div style="font-size:12px">PRINT NAME AND SIGN</div>
				</div>
			</div> -->
			
			<div class="form-group">
				<div class="col-lg-1" style="font-size:12px;width:230px;">Date : </div><br><br>
				<div class="col-lg-1" style="font-size:12px;width:230px;">
					Doc No.:  KP-FR-HR1-012 Rev 0<br>
					Effective  16 May 2015
				</div>
			</div>
			
		</div>
	</div>
</div>
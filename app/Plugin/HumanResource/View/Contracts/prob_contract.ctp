<?php $this->Html->addCrumb('Contract', array('controller' => 'contracts', 'action' => 'index')); ?>
<?php $this->Html->addCrumb('View', array('controller' => 'contracts', 'action' => 'view',$employeeData['Employee']['id'])); ?>
<?php echo $this->element('hr_options'); ?>

<div class="filter-block pull-right">
    <?php
    	
        echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back ', array('controller' => 'contracts', 'action' => 'index'),array('class' =>'btn btn-primary pull-right','escape' => false));
		
     ?>
   
   <br><br>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="main-box">
			<center>
				<header class="main-box-header clearfix">
					<h1>Kou Fu Packaging Corporation</h1>
					<h5>Lot 3-4 Blk 4 Mountview Industrial Complex Brgy. Bancal Carmona Cavite</h5>
					<h6>
						Tel: +63(2)5844928  &emsp;Fax: +63(2)5844952
					</h6><br>
					<h2>Probational</h2><br>
				</header>
			</center>

			<div class="main-box-body clearfix">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-2"> </div>
						<div class="col-lg-5"> </div>
						<div class="col-lg-4"><center>SN : <?php echo $employeeData['Employee']['code'] ?> 	</center></div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-2"> </div>
						<div class="col-lg-5"> </div>
						<div class="col-lg-4"><center>___________________</center>	
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-2"> </div>
						<div class="col-lg-5"> </div>
						<div class="col-lg-4"><center>Date</center>	
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-1">&emsp;&emsp;&emsp;&emsp;TO &emsp;:&emsp;</div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-1"> </div>
						<div class="col-lg-10">&emsp;&emsp;&emsp;&emsp;Kou Fu Packaging Corporation is pleased to inform you of your hiring, under the following terms and conditions:</div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-2">&emsp;&emsp;&emsp;&emsp;Status</div>
						<div class="col-lg-1">:</div>
						<div class="col-lg-8">Probationary Employee</div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-2">&emsp;&emsp;&emsp;&emsp;Title/Position</div>
						<div class="col-lg-1">:</div>
						<div class="col-lg-8"><?php echo ucfirst($employeeData['Position']['name']) ?>/<?php echo ucfirst($employeeData['Department']['name']) ?></div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-2">&emsp;&emsp;&emsp;&emsp;Salary</div>
						<div class="col-lg-1">:</div>
						<div class="col-lg-8"> </div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-2">&emsp;&emsp;&emsp;&emsp;Allowance</div>
						<div class="col-lg-1">:</div>
						<div class="col-lg-8"> </div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-4">&emsp;&emsp;&emsp;&emsp;Conditional Temporary Productivity Allowance (CTPA)</div>
						<div class="col-lg-1">:</div>
						<div class="col-lg-6"> </div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-4">&emsp;&emsp;&emsp;&emsp;Socio-Economic Allowance</div>
						<div class="col-lg-1">:</div>
						<div class="col-lg-6"> </div>
					</div>

					<div class="form-group">
						<div class="col-lg-1"> </div>
						<div class="col-lg-1"> </div>
						<div class="col-lg-9">
							&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Your probationary employment shall take effect on _01 May 2015 and will last for five (5) months, or until _30 September 2015 During your probationary employment, you are expected to abide by company rules and regulations and meet work and performance standards.  Management reserves the right to terminate your services if it finds that your performance does not meet our company’s requirements based on performance audits.  Evaluation will be based on:
						</div>
					</div>

				</form>

				<div class="table-responsive">
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
								<td>6.  Punctuality and Attendance</td>
							</tr>
						</thead>
					</table>
				</div>

				<div class="main-box-body clearfix">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<div class="col-lg-1"> </div>
							<div class="col-lg-10">
								&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
								Should you pass the evaluation of your work performance as a probationary employee, you will be regularized in employment at the end of your five-month probationary employment.
								<br><br>
								&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
								Pursuant to the provisions of the Labor Code of the Philippines, you will be rendering a total of forty-eight (48) hours of regular work in a week.  Any work rendered in excess of the said 48 hours will be duly compensated.  The “no-work, no-pay” principle shall apply in the payment of wages and other related compensation.
								<br><br>
								&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
								The Company expects that you will faithfully perform duties assigned to you to the best of your ability, to devote your full and undivided time to your duties.
								<br><br>
								&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
								With this, we welcome you to Kou Fu Packaging Corporation.  Please indicate your conformity to the foregoing terms and conditions of employment by signing on the space provided below.  Your signature will also serve as a confirmation of the fact that you have been apprised of the company rules and regulations, as well as the work and performance standards expected of you.
							</div>
						</div>

						
					</form>
				</div>

				<div class="form-group">
					<div class="col-lg-6"><center>APPROVED</center></div>
					<div class="col-lg-6"><center>Conforme</center></div><br><br><br>
					<div class="col-lg-6"><center>___________________________________________</center></div>
					<div class="col-lg-6"><center>___________________________________________</center></div>
					<div class="col-lg-6"><center>KOU FU PACKAGING CORP.</center></div>
					<div class="col-lg-6"><center>PRINT NAME AND SIGN</center></div>
					
				</div>
				
			</div>
			<br></br>
			Doc No.:  KP-FR-HR1-012 Rev 0<br>
			Effective  16 May 2015
		</div>
	</div>
</div>

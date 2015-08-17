<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th><a href="#"><span>Code</span></a></th>
					<th><a href="#"><span>Employee</span></a></th>
					<th><a href="#"><span>Pay Date</span></a></th>
					<th><a href="#" class="text-center"><span>From</span></a></th>
					<th><a href="#" class="text-center"><span>To</span></a></th>
					<th><a href="#"><span>Gross</span></a></th>
					<th><a href="#"><span>SSS</span></a></th>
					<th><a href="#"><span>PhilHealth</span></a></th>
					<th><a href="#"><span>WTax</span></a></th>
					<th><a href="#"><span>Deductions</span></a></th>

					<th><a href="#"><span>Remarks</span></a></th>
				</tr>
			</thead>


			<tbody aria-relevant="all" aria-live="polite" role="alert">
									<?php  if(!empty($employees)) { ?>

								           <?php foreach ($employees as $key => $employee): ?>
													
													<tr >
														<td> <?php echo $employee['Employee']['code']; ?></td>
														<td class="">
								                          <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
								                        </td>

								                         <td class="">
								                          <?php echo date('Y/m/d')  ?>
								                        </td>
								                          <td class="">
								                          <?php echo !empty($customDate['start']) ? date('Y/m/d',strtotime($customDate['start'])) : '' ?>
								                        </td>
								                          <td class="">
								                           <?php echo !empty($customDate['end']) ? date('Y/m/d',strtotime($customDate['end'])) : '' ?>
								                        </td>

								                        <td class="">
								                           <?php $gross = $this->Salaries->gross_pay($employee,$employee['Salary']); echo number_format($gross['gross'],2); ?>
								                        </td>

								                        <td class="">
								                           <?php 
								                           echo $this->Salaries->sss_pay($employee,$employee['Salary'],$payScheds,$gross['gross']); ?>
								                        </td>
								                        <td class="">
								                           <?php echo $this->Salaries->philhealth_pay($employee,$employee['Salary'],$payScheds,$gross['gross']); ?>
								                        </td>
								                        <td class="">
								                           <?php echo '0.00'; //$this->Salaries->sss_pay($employee['Attendance'],$employee['Salary'],$payScheds,$gross); ?>
								                        </td>
								                        <td class="">
								                           <?php echo '0.00';//$this->Salaries->sss_pay($employee['Attendance'],$employee['Salary'],$payScheds,$gross); ?>
								                        </td>
								                        <td class="">
								                           <?php //echo $this->Salaries->sss_pay($employee['Attendance'],$employee['Salary'],$payScheds,$gross); ?>
								                        </td>
								                      
								                    </tr>

								                
								        <?php  endforeach;  ?>
								       <?php } ?> 
			</tbody>
			</table>
</div>
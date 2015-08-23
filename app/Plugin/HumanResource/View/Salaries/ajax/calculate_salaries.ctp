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
									<?php  if(!empty($salaries)) { ?>

								           <?php foreach ($salaries as $key => $salary): ?>
													
													<tr >
													<td> 
													<?php 

													$employee = $this->CustomEmployee->findEmployee($salary['employee_id']);
													echo !empty( $employee ) ?  $employee['Employee']['code'] : ''; ?>   
													</td>
														<td class="">
								                          <?php echo $this->CustomText->getFullname($employee['Employee']);  ?>
								                        </td>

								                         <td class="">
								                          <?php echo date('Y/m/d')  ?>
								                        </td>
								                          <td class="">
								                          <?php echo !empty($salary['from']) ? date('Y/m/d',strtotime($salary['from'])) : '' ?>
								                        </td>
								                          <td class="">
								                           <?php echo !empty($salary['to']) ? date('Y/m/d',strtotime($salary['to'])) : '' ?>
								                        </td>

								                        <td class="">
								                           <?php echo $salary['gross_pay']; ?>
								                        </td>
								                        <td class="">
								                       
								                           <?php echo $salary['sss']; ?>
								                        </td>
								                        <td class="">

								                           <?php echo !empty($salary['philhealth']) ? $salary['philhealth'] : '0.00'; ?>
								                        </td>
								                        <td class="">
								                            	0.00
								                        </td>
								                        <td class="">
								                          <?php echo $salary['total_deduction']; ?>
								                        </td>
								                         <td class="">
								                        </td>
								                      
								                    </tr>

								                
								        <?php  endforeach;  ?>
								       <?php } ?> 
			</tbody>
			</table>
</div>
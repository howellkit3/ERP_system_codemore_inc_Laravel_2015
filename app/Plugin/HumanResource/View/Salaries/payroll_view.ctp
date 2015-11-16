<?php 
 echo $this->Html->css(array(
                    'HumanResource.default',
                    'HumanResource.select2.css',
                    'timepicker'
)); 

echo $this->Html->script(array(
					'jquery.maskedinput.min',
					'HumanResource.moment',
					'HumanResource.custom',
					'HumanResource.payroll'

)); 


echo $this->element('payroll_options');

$active_tab = 'sss_table';
 ?>

 <div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix body-pad">
    		<?php echo $this->element('tab/salaries',array('active_tab' => $active_tab )); ?>
		<div class="main-box-body clearfix">
		 
			<div class="tabs-wrapper">
				<div class="tab-content">
					<div class="tab-pane active" id="tab-calendar">
					<div class="main-box-body clearfix">
						<br>	
						<header class="pull-left">
			                <h2 class="pull-left"><b>Payroll Summary</b> </h2>
            			</header>
            			
            			<div class="filter-block pull-right">

						<?php echo $this->Html->link('<i class="fa fa-arrow-circle-left fa-lg"></i> Go Back', array(
		                         	'controller' => 'salaries',
		                         	'action' => 'payroll',
	                         		$payroll['Payroll']['id']),
		                         	array(
		                         	'escape' => false ,
		                         	'class' => 'ble-link btn btn-primary pull-right',
		                         	 )
                         ); ?>

                        <?php if($payroll['Payroll']['status'] == 'process') : 
                    
                         /* echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Summary', array(
                         			'controller' => 'salaries',
                         			'action' => 'export_salaries',
                         			$payroll['Payroll']['id'],
                         			'excel',
                         			),array(
		                         	'escape' => false,
		                         	'class' => 'ble-link btn btn-primary pull-right summary-btn',
									'data-type' => 'excel',
		                         	 )
                        	 ); 

                            echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Generate Payslip', array(
                         			'controller' => 'salaries',
                        			'action' => 'export_salaries',
                         			$payroll['Payroll']['id'],
                         			'payslip'
                         	), array(
                         		'target' => '_blank',
                         		'escape' => false,
                         		'class' => 'ble-link btn btn-primary pull-right',
                         	 )
                         ); */

							echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Summary','#printPayslip',array(
									                         	'escape' => false,
									                         	'class' => 'ble-link btn btn-primary pull-right summary-btn',
																'data-type' => 'excel',
																'data-toggle' => 'modal',
									                         	 )
							                        	 ); 

                     		echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Generate Payslip','#printPayslip', array(
                         		'escape' => false,
                         		'data-type' => 'word',
                         		'class' => 'ble-link btn btn-primary pull-right summary-btn',
                         		'data-toggle' => 'modal',
                     		 ));

                        endif; 

                        if($payroll['Payroll']['status'] == 'pending' || $payroll['Payroll']['status'] == '3') : 


                          

                         echo $this->Html->link('<i class="fa fa-trash-o fa-lg"></i> Reject', array(
                         	'controller' => 'salaries',
                         	'action' => 'reject_payroll',
                         	$payroll['Payroll']['id']),
                         	array(
                         		'escape' => false,
                         		'class' => 'table-link btn btn-primary pull-right',
                         		'id' => 'rejectPayroll'
                         	)
                         );

                          echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Process', array(
                         'controller' => 'salaries',
                         'action' => 'process_payroll',
                         	$payroll['Payroll']['id']),
                         	array(
                         	'escape' => false,
                         	'class' => 'ble-link btn btn-primary pull-right',
                         	'id' => 'updatePayroll'
                         	 )
                         );

                            echo $this->Html->link('<i class="fa fa-refresh"></i> Reload','#',
                         	array(
                         	'escape' => false,
                         	'class' => 'ble-link btn btn-primary pull-right',
                         	'id' => 'reloadPayroll'
                         	 )
                         );


                         endif;

                         ?>


                          </div>
                         </div>
            			<div class="main-box-body clearfix">
		            			<table class="table table-bordered table-hover" >
		            					<tbody>
			            					
			            					<tr>
			            						<td> Payroll Date : </td>
			            						<td> <?php echo date('Y/m/d',strtotime($payroll['Payroll']['date'])); ?> </td>
			            					</tr>
			            					
			            					<tr>
			            						<td> Period  : </td>
			            						<td> <?php echo date('Y/m/d',strtotime($payroll['Payroll']['from'])).' - '. date('Y/m/d',strtotime($payroll['Payroll']['to'])) ?> </td>
			            					</tr>

			            					<tr>
			            						<td> Type : </td>
			            						<td> <?php echo Inflector::humanize($payroll['Payroll']['type']); ?> </td>
			            					</tr>
			            					
			            					<tr>
			            						<td> Status : </td>
			            						<td> 
			            						<?php if($payroll['Payroll']['status'] == 'process') : ?>
			            							<span class="label label-success">Process</span>
			            						<?php else : ?>
			            							<span class="label label-warning">Pending</span>
			            						<?php endif; ?>	
			            						</td>
			            					</tr>

			            					<tr>
			            						<td> Description : </td>
			            						<td> <?php echo $payroll['Payroll']['description'] ?></td>
			            					</tr>

			            					<tr>
			            						<td> Total Employee : </td>
			            						<td> <?php echo count($salariesList); ?></td>
			            					</tr>

		            					</tbody>
		            					
		            			</table>
            			</div>

            			<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Employee</b> </h2>
            			</header>


			       		<div class="main-box-body clearfix">

								<div class="filter-block">

									<div class="form-group pull-left">
											<?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
											<input placeholder="Search..." class="form-control searchEmployee"  />
											<i class="fa fa-search search-icon"></i>
											<?php //echo $this->Form->end(); ?>
									</div>
									

								</div>

								<div class="clearfix"></div>

			            		<div id="result-table">
			            		  <div class="table-responsive overflow">
		                                <div class="table-responsive">
		            					
		                                	<div class="table-responsive">
										<table class="table table-bordered table-hover table-payroll">
										<thead>
										<tr>
											<th><a href="#"><span>Code</span></a></th>
											<th><a href="#"><span>Employee</span></a></th>
											<th><a href="#"><span>Pay Date</span></a></th>
											<th><a href="#" class="text-center"><span>From</span></a></th>
											<th><a href="#" class="text-center"><span>To</span></a></th>

											<th> <a href="#" > <span> BASIC/MONTHLY </span> </a> </th>
											
											<!-- regular days -->

											<th><a href="#"><span>Hours</span></a> </th>

											<th> <a href="#"><span>Days</span></a> </th>

											<th> <a href="#"><span>Regular</span></a> </th>
											

											<th><a href="#"><span>Ot_hours</span></a></th>
											<th><a href="#"><span>OT</span></a></th>

											<th><a href="#"><span>NIght Diff (HRS) </span></a></th>

											<th><a href="#"><span>NIght Diff </span></a></th>

											<th><a href="#"><span>Night Diff OT (HRS) </span></a></th>

											<th><a href="#"><span>Night Diff OT </span></a></th>


											<th><a href="#"><span>LH (HRS)</span></a></th>

											<th><a href="#"><span>LH</span></a></th>

											<th><a href="#"><span>SP (HRS)</span></a></th>	

											<th><a href="#"><span>SP</span></a></th>	


											<th><a href="#"><span>SP ND (HRS)</span></a></th>	

											<th><a href="#"><span>SP ND</span></a></th>	


											<th><a href="#"><span>LH ND (HRS)</span></a></th>	

											<th><a href="#"><span>LH ND</span></a></th>	


											<th><a href="#"><span>LH-ND-OT (HRS)</span></a></th>	

											<th><a href="#"><span>LH-ND-OT</span></a></th>	

											<th><a href="#"><span>Sun (hrs) </span></a></th>

											<th><a href="#"><span>Sun</span></a></th>

											<th><a href="#"><span>Sunday OT (HRS) </span></a></th>

											<th><a href="#"><span>Sunday OT </span></a></th>

											<th><a href="#"><span>Sunday ND (HRS) </span></a></th>

											<th><a href="#"><span>Sunday ND</span></a></th>


											<th><a href="#"><span>Sunday ND-OT (HRS) </span></a></th>

											<th><a href="#"><span>Sunday ND-OT </span></a></th>

											<th><a href="#"><span>Sunday CTPA + SEA (PER DAY)</span></a></th>

											<th><a href="#"><span>Sunday CTPA + SEA (TOTAL) </span></a></th>


											<th><a href="#"><span>Gross Pay </span></a></th>

											<th><a href="#"><span> PhilHealth </span></a></th>

											<th><a href="#"><span> Pagibig </span></a></th>

											<th><a href="#"><span> SSS </span></a></th>

											<th><a href="#"><span> Withholding Tax </span></a></th>

											<!-- minus deductions-->

											<?php foreach ($deductions as $deduction_key => $list) : ?>
											
												<th class="deductions_th"><a href="#"><span><?php echo $list['Loan']['name']; ?></span></a>
													<?php if(!empty($list['Loan']['description'])) : ?>
																( <?php echo $list['Loan']['description']; ?> )
													<?php endif; ?>
												</th>
											
											<?php endforeach; ?>

											<!-- get all deductions -->
											<th><a href="#"><span>Allowance</span></a></th>

											<th><a href="#"><span>Net Pay</span></a></th>

											<th><a href="#"><span>Adjustments</span></a></th>

											<th><a href="#"><span>Irreg OT</span></a></th>

											<th><a href="#"><span> Total Pay / NET PAY </span></a></th>


											<th><a href="#"><span>Remarks</span></a></th>

											<th><a href="#"><span>Action</span></a></th>
										</tr>
										</thead>
										<tbody aria-relevant="all" aria-live="polite" class="tbody_cont" role="alert">
															
															<?php if(!empty($salariesList)) { ?>

														           <?php 

														           foreach ($salariesList as $key => $salary): ?>
																			<tr>
																				<td> 
																				<?php echo !empty( $salary['Employee'] ) ?  $salary['Employee']['code'] : ''; ?>   
																				</td>
																				<td class="name">
														                          <?php echo $this->CustomText->getFullname($salary['Employee']);  ?>
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
														                       		<?php 
														                       		if ($salary['Salary']['employee_salary_type'] == 'monthly') {

														                       			$wage = $salary['Salary']['basic_pay'] / 2; 

														                       		} else {

														                       			$wage = $salary['Salary']['basic_pay'] ; 
														                       		}

														                       		echo $wage;

														                       		?>
														                       </td>
														                       <td class="">
														                       		<?php echo $salary['hours_regular']; ?>
														                       </td>
														                       <td class="">
														                       		<?php 

															                       		$days = $salary['hours_regular'] / 8;

															                       		echo number_format($days,2);

														                       		?>
														                       </td>
														                       <td class="">
														                       		<?php echo  number_format($salary['regular'],2); ?>
														                       </td>


														                       <td class="">
														                     
														                       		<?php echo $salary['hours_ot'] ?>
														                       </td>

														                       <td class="">
														                   
														                       		<?php echo number_format($salary['OT'],2) ?>
														                       </td>


														                       <td class="">
														                  
														                       		<?php echo $salary['hours_night_diff'] ?>
														                       </td>

														                       <td class="">

														                       		<?php echo $salary['night_diff'] ?>
														                       </td>

														                        <td class="">
														                       		<?php echo $salary['hours_night_diff_ot'] ?>
														                       </td>

														                       <td class="">
														                       		<?php echo $salary['night_diff_ot'] ?>
														                       </td>
																				
																			   <td class="">
														                       		<?php echo $salary['hours_legal_holiday_work'] ?>
														                       </td>

														                       <td class="">
														                       		<?php
														                       		 $legal = $salary['legal_holiday']; 
														                       		 $legal += $salary['legal_holiday_work']; 
														                       		 echo $legal;
														                       		 ?>
														                       </td>

														                      
														                       <td class="">
														                       		<?php echo $salary['hours_special_holiday_work'] ?>
														                       </td>

																				<td class="">
														                       		<?php

														                       		 $legal = $salary['special_holiday']; 
														                       		 $legal += $salary['special_holiday_work']; 
														                       		 echo $legal;

														                       		 ?>
														                       </td>

														                       <td class="">

														                       		<?php echo $salary['hours_special_holiday_work_night_diff'] ?>
														                       </td>

																				<td class="">
														                       		<?php 

														                       		//night diff special holiday
														                       		$legal = $salary['night_diff_special_holiday']; 
															                       		 	echo $legal; ?>
														                       	</td>

														                       	<td class="">

														                       		<?php 
														                       			//legal holiday night diff hours
														                       			
															                       		 echo !empty($salary['hours_legal_holiday_work_night_diff']) ? $salary['hours_legal_holiday_work_night_diff'] : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 
														                       			//legal holiday night diff
															                       		 echo !empty($salary['night_diff_legal_holiday']) ? $salary['night_diff_legal_holiday'] : '';

														                       		 ?>
														                       	</td>

														                       		<td class="">
														                       		<?php 
														                       			//legal holiday night diff hours ot
														                       			
															                       		echo !empty($salary['hours_legal_holiday_work_night_diff']) ? $salary['hours_legal_holiday_work_night_diff'] : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 
														                       			//legal holiday night diff ot
															                       		 //echo !empty($salary['sunday_work']) ? $salary['sunday_work'] : '';
														                       			echo !empty($salary['night_diff_legal_holiday']) ? $salary['night_diff_legal_holiday'] : '';

														                       		 ?>
														                       	</td>

																				<td class="">
														                       		<?php 

															                       		 echo !empty($salary['hours_sunday_work']) ? $salary['hours_sunday_work'] : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 


															                       		 echo !empty($salary['sunday_work']) ? $salary['sunday_work'] : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 
															                       		 echo !empty($salary['hours_sunday_work_ot']) ? $salary['hours_sunday_work_ot'] : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 
															                       		 echo !empty($salary['sunday_work_ot']) ? $salary['sunday_work_ot'] : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 
															                       		 echo !empty($salary['hours_night_diff_sunday_work']) ? $salary['hours_night_diff_sunday_work'] : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 
															                       		 echo !empty($salary['night_diff_sunday_work']) ? $salary['night_diff_sunday_work'] : '';

														                       		 ?>
														                       	</td>

														                       		<td class="">
														                       		<?php 
															                       		 echo !empty($salary['hours_night_diff_sunday_work_ot']) ? $salary['hours_night_diff_sunday_work_ot'] : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 
															                       		 echo !empty($salary['night_diff_sunday_work_ot']) ? $salary['night_diff_sunday_work_ot'] : '';

														                       		 ?>
														                       	</td>


														                       	<td class="">
														                       		<?php 

														                       			//sunday ctpa per day mu
															                       		 //echo !empty($salary['Salary']['ctpa']) ? $salary['Salary']['ctpa'] : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 

														                       			//sunday ctpa per day
															                       		 echo !empty($salary['Salary']['ctpa']) ? $salary['Salary']['ctpa'] : '';

														                       		 ?>
														                       	</td>


														                       		<td class="">
														                       		<?php 

														                       			//sunday ctpa per day
															                       		 echo !empty($salary['gross']) ? number_format($salary['gross'],2) : '';

														                       		 ?>
														                       	</td>

														                       	<td class="">
														                       		<?php 

															                       		 echo !empty($salary['philhealth']) ? number_format($salary['philhealth'],2) : '';

														                       		 ?>
														                       	</td>

														                       	  	<td class="">
														                       		<?php 

															                       		 echo !empty($salary['pagibig']) ? number_format($salary['pagibig'],2) : '';

														                       		 ?>
														                       	</td>


														                       	 <td class="">
														                       		<?php 

														                       			//sunday ctpa per day
															                       		 echo !empty($salary['sss']) ? number_format($salary['sss'],2) : '';

														                       		 ?>
														                       	</td>



														                       	 <td class="">
														                       		<?php 

														                       			//sunday ctpa per day
															                       		 echo !empty($salary['with_holding_tax']) ? number_format($salary['with_holding_tax'],2) : '';

														                       		 ?>
														                       	</td>



																				<?php foreach ($deductions as $deduction_key => $list) : ?>
																				
																				   <td class="deductions_th"> <?php 

																				   $index = str_replace(' ','_',strtolower($list['Loan']['name']));
																					echo !empty($salary[$index]) ? number_format($salary[$index],2) : '0.00';

																					?></td>

																				<?php endforeach; ?>

																				
																			<!-- 	<td class="">
														                          <?php echo $salary['days']; ?>
														                        </td>

														                        <td class="">
														                          <?php echo $salary['hours_regular']; ?>
														                        </td>
																				<td class="">
														                          <?php

														                          	$total_overtime =  !empty($salary['OT']) ? $salary['OT'] : 0;
									
																					//add excess overtime
																					$total_overtime += !empty($salary['excess_ot']) ? $salary['excess_ot'] : 0;

																					echo number_format($total_overtime,2);

									 												?>
														                        </td>

														                        <td class="">
														                          <?php echo $salary['hours_ot']; ?>
														                        </td>
														                        <td class="">
														                         	<?php echo !empty($salary['sunday_work'])  ? number_format($salary['sunday_work'],2) : '0.00'; ?>
														                        </td>
														                        <td class="">
														                         	<?php echo !empty($salary['sunday_work_ot'])  ? number_format($salary['sunday_work_ot'],2) : '0.00'; ?>
														                        </td>
														                        <td class="">
														                         	<?php echo !empty($salary['sunday_work_ot'])  ? number_format($salary['sunday_work_ot'],2) : '0.00'; ?>
														                        </td>
														                        <td class="">
														                         <?php echo !empty($salary['legal_holiday'])  ? number_format($salary['legal_holiday'],2) : '0.00'; ?>	
														                        </td>
														                        <td class="">
														                         <?php echo !empty($salary['legal_holiday_work'])  ? number_format($salary['legal_holiday_work'],2) : '0.00'; ?>	
														                        </td>
														                        <td class="">
														                         <?php echo !empty($salary['hours_legal_holiday_work_ot'])  ? number_format($salary['hours_legal_holiday_work_ot'],2) : '0.00'; ?>	
														                        </td>

														                        <td class="">
														                         <?php echo !empty($salary['legal_holiday_sunday_work'])  ? number_format($salary['legal_holiday_sunday_work'],2) : '0.00'; ?>	
														                        </td>

														                        <td class="">
														                         <?php echo !empty($salary['legal_holiday_sunday_work_ot'])  ? number_format($salary['legal_holiday_sunday_work_ot'],2) : '0.00'; ?>	
														                        </td>

														                        <td class="">
														                         <?php echo !empty($salary['special_holiday'])  ? number_format($salary['special_holiday'],2) : '0.00'; ?>	
														                        </td>

														                        <td class="">
														                         <?php echo !empty($salary['special_holiday_work'])  ? number_format($salary['special_holiday_work'],2) : '0.00'; ?>	
														                        </td>

														                        <td class="">
														                         <?php echo !empty($salary['special_holiday_work_ot'])  ? number_format($salary['special_holiday_work_ot'],2) : '0.00'; ?>	
														                        </td>

														                        <td class="">
														                         <?php echo !empty($salary['night_diff'])  ? number_format($salary['night_diff'],2) : '0.00'; ?>	
														                        </td>

														                        <td class="">
														                         <?php echo !empty($salary['leave']) ? number_format($salary['leave'],2) : '0.00'; ?>	
														                        </td>


														                         <td class="">
														                         <?php echo !empty($salary['ctpa']) ? number_format($salary['ctpa'],2) : '0.00'; ?>	
														                        </td>

  																				<td class="">
														                         <?php echo !empty($salary['sea']) ? number_format($salary['sea'],2) : '0.00'; ?>	
														                        </td>

 -->

														                        <td class="">
														                         <?php echo number_format($salary['allowances'],2); ?>
														                        </td>

														                        <td class="">
														                         <?php echo number_format($salary['net_pay'],2); ?>
														                        </td>
														                         <td class="">
														                         <?php echo number_format($salary['adjustment'],2); ?>
														                        </td>
														                        <td class="">
														                         <?php echo number_format($salary['excess_ot'],2); ?>
														                        </td>
														                         <td class="">
														                         <?php echo number_format($salary['total_pay'],2); ?>
														                        </td>
														                        <td>

														                        </td>
																				<td class="">
																					<?php 
																					echo $this->Html->link('<span class="fa-stack">
																					<i class="fa fa-square fa-stack-2x"></i><i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;<span class ="post"><font size = "1px"> View </font></span></span> ',
																					'#payrollDetails', 
																					array('class' =>' table-link',
																					'escape' => false, 
																					'title'=>'View Details',
																					'data-empID' => $salary['Employee']['id'],
																					'data-month' => $payroll['Payroll']['from'].'/'.$payroll['Payroll']['to'],
																					'data-year' => $payroll['Payroll']['date'], 
																					'data-payroll-id' => $payroll['Payroll']['id'],
																					'data-toggle' => 'modal',
																					'id' => 'CheckDetails'
																					));


																					?>
														                        </td>

																				
														                   	 </tr>

														                
														        <?php  endforeach;  ?>
														       <?php } ?> 
										</tbody>
										</table>
										</div>
										</div>
									</div>
									<!-- 
									    	<?php if (!empty($salarySplit) && count($salarySplit) > 0) : ?>
												<div class="paging" style="margin: 18px 0;">
												<span class="disable"><?php echo $this->Html->link(' &lt; First',array('controller' => 'salaries','action' => 'payroll_view',$payroll['Payroll']['id'],'page' =>0),array('escape' => false )); ?></span>

												<?php for($i=1; $i < count($salarySplit); $i++): ?>
												<span><?php echo $this->Html->link($i,array('controller' => 'salaries','action' => 'payroll_view',$payroll['Payroll']['id'],'page' => $i)); ?></span>

												<?php endfor; ?>
												</div>
	                  						 <?php endif; ?> -->
	                   
             				</div> 
             			</div>
					</div>		
	     		</div>
			</div>
		</div>	
		 </div>
    </div>
</div>
<?php echo $this->element('modals/payslip'); ?>

<script type="text/javascript">

$('#reloadPayroll').click(function() {
    location.reload();
});

$('body').on('click','#CheckDetails',function(e){

$employeeId = $(this).data('empid');
$month = $(this).data('month');
$year = $(this).data('period');

$payrollId = $(this).data('payroll-id');
$.ajax({
	url: serverPath + "human_resource/salaries/checkDetails/",
	type: "POST",
	async: false,
	data : {'empId' : $employeeId, 'month' : $month, 'year' : $year,'payrollId':$payrollId},
	dataType: "html",
	success: function(data) {

		console.log(data);
		$('#payrollDetails .result-details').html(data);
						
	}
});			
});
	
$('.searchEmployee').on('keyup', function(e) {



    if ('' != this.value) {
        var reg = new RegExp(this.value, 'i'); // case-insesitive
        $table = $('#result-table').find('.tbody_cont');

        $table.find('tr').each(function() {
            var $me = $(this);
            if (!$me.children('.name').text().match(reg)) {
                $me.hide();
            } else {
                $me.show();
            }
        });
    } else {
        $('.tbody_cont').find('tr').show();
    }
});


</script>
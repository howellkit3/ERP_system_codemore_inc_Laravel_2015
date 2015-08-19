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
                    
                          echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Summary', array(
                         			'controller' => 'salaries',
                         			'action' => 'export_salaries',
                         			$payroll['Payroll']['id'],
                         			'excel',
                         			),array(
		                         	'escape' => false,
		                         	'class' => 'ble-link btn btn-primary pull-right',
		                         	 )
                        	); 

                            echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i> Genereate Payslip', array(
                         			'controller' => 'salaries',
                        			'action' => 'export_salaries',
                         			$payroll['Payroll']['id'],
                         			'payslip'
                         	), array(
                         		'escape' => false,
                         		'class' => 'ble-link btn btn-primary pull-right',
                         	 )
                         );

                        endif; ?>		
						<?php if($payroll['Payroll']['status'] == 'pending') : ?>
                         
                         <a title="Edit Information" data-process="reject" class=" table-link btn btn-primary pull-right overtime-process" href="/koufunet/human_resource/overtimes/process/8/reject">
                         	<i class="fa fa-times fa-lg"></i> Delete 
                         </a>
                      
                         <?php echo $this->Html->link('<i class="fa fa-check-square-o fa-lg"></i> Process', array(
                         'controller' => 'salaries',
                         'action' => 'process_payroll',
                         	$payroll['Payroll']['id']),
                         	array(
                         	'escape' => false,
                         	'class' => 'ble-link btn btn-primary pull-right',
                         	'id' => 'updatePayroll'
                         	 )
                         ); ?>
                     	<?php endif; ?>


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
		            						<td> Normal </td>
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
		            					</tbody>
		            					
		            			</table>
            			</div>

            			<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Employee</b> </h2>
            			</header>


			       		<div class="main-box-body clearfix">
			            	<div id="result-table">
			            		  <div class="table-responsive">
		                                <div class="table-responsive">
		            					
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
										</div>
							
               					 </div>
             				</div> 
             			</div>
					</div>		
	     		</div>
			</div>
		</div>	
		 </div>
    </div>
</div>
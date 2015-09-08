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
	                         		'data-type' => 'payslip',
	                         		'class' => 'ble-link btn btn-primary pull-right summary-btn',
	                         		'data-toggle' => 'modal',
                         		 ));

                        endif; 

                        if($payroll['Payroll']['status'] == 'pending') : 


                          

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
		            					</tbody>
		            					
		            			</table>
            			</div>

            			<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Employee</b> </h2>
            			</header>


			       		<div class="main-box-body clearfix">
			            	<div id="result-table">
			            		  <div class="table-responsive overflow">
		                                <div class="table-responsive">
		            					
		                                <div class="table-responsive">
										<table class="table table-bordered table-hover">
										<thead>
										<tr>
											<th><a href="#"><span>Code</span></a></th>
											<th><a href="#"><span>Employee</span></a></th>
											<?php 
											$months = array( '01' => 'January','02' => 'February','03' => 'March','04' => 'April','05' => 'May','06' => 'June','07' => 'July','08' => 'August','09' =>'September', '10' =>'October','11' => 'November','12' => 'December');

											foreach ($months as $key => $list) {
												
												echo '<th><a href="#"><span>'.$list.'</span></a></th>';
											}

											?>

											<th><a href="#"><span>Total</span></a></th>
											<th><a href="#"><span> 13 Month</span></a></th>
											<th><a href="#"><span> Actions </span></a></th>

										</tr>
										</thead>
										
										<tbody aria-relevant="all" aria-live="polite" role="alert">
															<?php  if(!empty($salariesList)) { ?>

														           <?php foreach ($salariesList as $key => $salary): ?>
																			<tr>
																				<td> 
																				<?php echo !empty( $salary['Employee'] ) ?  $salary['Employee']['code'] : ''; ?>   
																				</td>
																				<td class="">
														                          <?php echo $this->CustomText->getFullname($salary['Employee']);  ?>
														                        </td>

														                        <?php
														                      	$salary['grand_total'] = 0;
														                        $grandTotal = 0;

														                        foreach ($months as $innerkey => $list) { ?>
															                        <td class="">
															                          <?php
															                          		$totalPay = 0;

															                          		if (!empty($salary['Salaries'][$list])) {

															                          		
															                          		foreach ($salary['Salaries'][$list] as $subkey => $monthly) {
															                          				
															                          

															                          				if (!empty($monthly)) {

															                          						$totalPay += $monthly['SalaryReport']['basic_pay_month'];


															                          				}
															                          				

															                          		}
															                          	} 
															                          		
															                          	$salary['grand_total'] += $totalPay;
															                          		

															                          ?>
																						<input type="text" class="form-control input-value" value="<?php echo number_format($totalPay,2); ?>">
															                        </td>
															                        
														                        <?php } ?>
														                         <td class="text-right">
															                         	<?php echo number_format($salary['grand_total'],2); ?>
															                        </td>
															                        <td class="text-right">
															                         	<?php 
															                         	$thirteen = $salary['grand_total'] / 12;
																							echo number_format($thirteen,2);
															                         	  ?>
															                        </td>

															                        <td class="text-right">
															                         	<?php 
																							
																							echo $this->Html->link('<span class="fa-stack">
																								<i class="fa fa-square fa-stack-2x"></i>
																								<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>&nbsp;&nbsp;&nbsp;<span class ="post"><font size = "1px"> View </font></span>
																								</span> ','#viewSummary',
																							array('class' =>'view-thirteen-summary table-link',
																								'escape' => false,
																								'title' => 'view summary' ,
																								'data-toggle' => 'modal',
																								'data-id' => $salary['Employee']['id'],
																								'data-year' => date('Y')
																								//'onClick' => 'getEmployeeData(this,'.$schedule['Attendance']['id'].')'
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
									    	<?php if (!empty($salarySplit) && count($salarySplit) > 0) : ?>
												<div class="paging">
												<span class="disable"><?php echo $this->Html->link(' &lt; First',array('controller' => 'salaries','action' => 'payroll_view',$payroll['Payroll']['id'],'page' =>0),array('escape' => false )); ?></span>

												<?php for($i=1; $i < count($salarySplit); $i++): ?>
												<span><?php echo $this->Html->link($i,array('controller' => 'salaries','action' => 'payroll_view',$payroll['Payroll']['id'],'page' => $i)); ?></span>

												<?php endfor; ?>
												</div>
	                  						 <?php endif; ?>
	                   
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
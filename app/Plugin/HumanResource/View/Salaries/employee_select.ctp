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
					'HumanResource.payroll',
					'HumanResource.select_employee',
					'HumanResource.jquery.playSound'

)); 

echo $this->element('payroll_options');

$active_tab = 'sss_table';

if(!empty($contracts)) : ?>
<div class="alert alert-block alert-danger fade in">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4>Warning! There's some employees which is near or end of contract!</h4>
	<p>See list: </p>
<br>


<div class="panel-group accordion" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a class="accordion-toggle collapsed " data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				   <i class="fa fa-chevron-circle-down"></i> Employee Near / End of Contract
				</a>
			</h4>
		</div>

		<div id="collapseOne" class="panel-collapse collapse in" style="">
		<div class="panel-body">

					<table class="table table-bordered alert-table">
						<thead>
							<tr>
								<th style="width:70px"><span>Include in Payroll</span></th>
								<th style="width:70px"><span>Last Payroll</span></th>
								<th><span>Employee</span></th>
								<th><span>Date Hired</span></th>
								<th><span>End Contract</span></th>
								<th class="text-center"><span>Contract</span></th>
							</tr>
						</thead>
					<tbody>
					<?php echo $this->Form->create('Salaries',array('url' => array('controller' => 'salaries','actions' => 'employee_select',$id,'payroll' => true))); ?>
					<?php $select_emp = array(); foreach ($contracts as $key => $list) { ?>
						<tr>

							<td> <input type="checkbox" name="data[Payroll][emp_id][<?php echo $key ?>]" value="<?php echo $list['Employee']['id']; ?>" checked> </td>
							<td> <input type="checkbox" name="data[LastPayroll][emp_id][<?php echo $key ?>]" value="<?php echo $list['Employee']['id']; ?>"> </td>
							<td> <?php echo $list['Employee']['full_name']; ?>  </td>
							<td class="">
								<?php echo !empty($list['date_hired']) ? date('Y-m-d',strtotime($list['date_hired']))  : '' ?>
							</td>
							<td class="">
							<?php 
								if (!empty($list['Employee']['date_resigned'])) {

									echo date('Y-m-d',strtotime($list['Employee']['date_resigned']));

								} else if(!empty($list['end_contract'])) {

									echo date('Y-m-d',strtotime($list['end_contract']));

								} else {

								}

							?>
							</td>
							<td class="text-center">
								<span class="label label-success"><?php echo $list['Contract']['name']; ?></span>
							</td>
						</tr>
					<?php  $select_emp[] = $list['Employee']['id'];  } ?>
					</tbody>
					</table>	

		 </div>
		</div>
	</div>
</div>




<?php echo $this->Form->input('all_employee',array('value' => json_encode($select_emp),'type' => 'hidden')); ?>

<?php echo $this->Form->input('payroll_id',array('value' => $id,'type' => 'hidden')); ?>

<?php echo $this->Form->end(); ?>
	
	<br>
<p>
<?php 
if(empty($this->params['named']['payroll'])) :

	echo $this->Html->link('Press To Continue',array(
		'controller' => 'salaries',
		'action' => 'employee_select',
		$id,
		'payroll' => true	
		),array(
		'class' => 'btn btn-danger continue',
		)); 

endif;
?>
 <?php echo $this->Html->link('Back to Employee List',array(
	'controller' => 'salaries',
	'action' => 'employee_select',
	$id	
	),array(
	'class' => 'btn btn-default'
	)); ?>
</p>
</div>
<?php endif; ?>
<?php if (!empty($this->params['named']['payroll'])) : ?>
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

            			 <button class="ProcessPayroll btn btn-success pull-right"> <i class="fa fa-floppy-o"></i> Process Payroll</button>

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
		            					<tr>
		            						<td> Total Employee : </td>
		            						<td> <?php echo count($employees); ?></td>
		            					</tr>		
		            					</tbody>
		            					
		            			</table>
            			</div>

            		<!-- 	<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b>Employee</b> </h2>
            			</header> -->
		<div class="main-box-body clearfix">
			            	<div id="result-table">
			            		  <div class="table-responsive overflow">
		                                <div class="table-responsive">
		            					
		                                	<div class="table-responsive">
		                                	<div class="col-lg-6 employees" id="employeeTable">
												<header class="clearfix pull-left">
													<h2 class="pull-left"><b>Employee</b> </h2>
												</header>
												 
												 <div class="filter-block pull-right">

													<div class="form-group pull-left">
															<?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
															<input placeholder="Search..." class="form-control searchEmployee"  />
															<i class="fa fa-search search-icon"></i>
															<?php //echo $this->Form->end(); ?>
													</div>
													<div class="pull-right"><button class="btn btn-success" id="selectEmployee">ADD</button></div>


												 </div>
													
													<br>
													<table class="table table-bordered table-hover" style="margin:0px;">
														<thead>
															<tr>
																<th style="width:50px"><input type="checkbox" id="selectAll" name=""></th>
																<th style="width:112px"><a href="#"><span>Code</span></a></th>
																<th><a href="#"><span> Employee </span></a></th>
															</tr>
														</thead>
													</table>
													<div class="employee-cont">

				                                		<table class="table table-bordered table-hover">
																
																<tbody aria-relevant="all" aria-live="polite" role="alert" class="tbody_cont" id="employee_orig_cont">
																			
																			<?php if (!empty($employees)) :  ?>
																				<?php foreach ($employees as $key => $value) : ?>
																					<tr>
																						<td style="width:50px">
																						<input type="checkbox" class="employee_select" value="<?php echo $value['Employee']['id']; ?>" name="data[Payroll][emp][]">
																						</td>
																						<td style="width:110px" class="code"><?php echo $value['Employee']['code']; ?></td>
																						<td class="name"><?php echo $value['Employee']['full_name']; ?></td>
																					</tr>
																				<?php endforeach; ?>	
																			<?php endif; ?>
																</tbody>
														
														</table>
													</div>
											</div>		
		                                	<div class="col-lg-6 employees">

		                                	<header class="clearfix pull-left">
												<h2 class="pull-left"><b>Selected</b> </h2>
											</header>
		                                	
											
											<div class="filter-block pull-right">

													<div class="form-group pull-left">
															<?php //echo $this->Form->create('Quotation',array('controller' => 'quotations','action' => 'search', 'type'=> 'get')); ?>
															<input placeholder="Search..." class="form-control searchEmployee"  />
															<i class="fa fa-search search-icon"></i>
															<?php //echo $this->Form->end(); ?>
													</div>
													<div class="pull-right"><button class="btn btn-success" id="removeEmployee">Remove</button></div>
											</div>


											<div class="clearfix"></div>

											<?php echo $this->Form->create('Payroll',array('url' => array('controller' => 'salaries','action' => 'process_payroll_save') ));  ?>

											<?php echo $this->Form->input('payroll_id',array('type' => 'hidden','value' => $payroll['Payroll']['id'] )); ?>
											<?php echo $this->Form->input('department_id',array('type' => 'hidden','value' => $departmentId)); ?>
												<table class="table table-bordered table-hover" style="margin:0px;">
													<thead>
													<tr>
														<th style="width:50px"><input type="checkbox" id="selectAll" name=""></th>
														<th style="width:112px"><a href="#"><span>Code</span></a></th>
														<th><a href="#"><span>Employee</span></a></th>
													</tr>
													</thead>
												</table>

												<div class="employee-cont">

				                                	<table id="appendTable" class="table table-bordered table-hover">
														<tbody aria-relevant="all" aria-live="polite" role="alert" class="tbody_cont" id="result-table"></tbody>				
													</table>

												</div>
												<?php echo $this->Form->end(); ?>

		                                	</div>		
											
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

<?php endif; ?>

<script type="text/javascript">
	
$('.searchEmployee').on('keyup', function(e) {
    if ('' != this.value) {
        var reg = new RegExp(this.value, 'i'); // case-insesitive
        $table = $(this).parents('.employees').find('.tbody_cont');

        $table.find('tr').each(function() {
            var $me = $(this);
            if (!$me.children('.name').text().match(reg)) {
                $me.hide();
            } else {
                $me.show();
            }
        });
    } else {
        $('.table tbody').find('tr').show();
    }
});

$(document).ready(function(){
	
	if ($('.alert-block').length >= 1) {

		$.playSound(serverPath + '/sounds/warning');
	}

});
</script>
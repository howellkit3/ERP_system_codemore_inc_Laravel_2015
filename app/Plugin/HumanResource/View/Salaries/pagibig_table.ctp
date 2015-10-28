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
						<header class="main-box-header clearfix">
			                <h2 class="pull-left"><b> Pagibig Fund Contribution Table</b> </h2>
			                <div class="filter-block pull-left">
			                 <div class="form-group pull-left">
			                 	
								</div>

             </div>
            </header>

			       <div class="main-box-body clearfix">
			            	<div id="result-table">
			            		   <div class="table-responsive">
                                <div class="table-responsive">
            								<table class="table table-bordered">
								<thead>
								<tr>
									<th><a href="#"><span>Range of compensations</span></a></th>
									<th><a href="#" class="asc"><span>Employer</span></a></th>
									<th class="text-center"><span>Employee</span></th>
								</tr>
								</thead>
								<tbody>
								<?php if (!empty($ranges)) { ?>
								<?php foreach ($ranges as $key => $range) { ?>
										
									<tr>
										<td>
											<?php echo $range['PagibigRange']['range_from'] ?>  - 
											<?php
												if (!empty($range['PagibigRange']['conditions'])) {

													 echo $range['PagibigRange']['conditions'];

												} else {

												 echo $range['PagibigRange']['range_to'];
												}
											  ?>  
										</td>
										<td>
											<?php echo $range['PagibigRange']['employees']; $total = $range['PagibigRange']['employees']?> 
										</td>

										<td class="text-center">
											<?php echo $range['PagibigRange']['employer']; $total += $range['PagibigRange']['employer']?> 
										</td >
								</tr>
								<?php } ?>
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